<?php

namespace App\Livewire;

use App\Models\Petugas;
use App\Models\ZIChecklist;
use Filament\Notifications\Notification;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\Support\Facades\Cache; // Import Cache facade
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Exception;
use HighSolutions\LaravelSearchy\Facades\Searchy;

class DashboardChecklist extends Component
{
    public string $search = '';
    public Collection $petugasList;

    // Properti ini akan menampung data kendala untuk setiap item
    public array $kendala = [];

    // Properti ini akan menampung data petugas_id untuk setiap item
    public array $assignedPetugas = [];

    public ?ZIChecklist $editingKendala = null;
    public string $kendalaText = '';

    // Untuk fitur ambil daftar nama file dari google drive
    public array $cachedFiles = [];

    public function mount(): void
    {
        // Muat daftar petugas sekali saat komponen diinisialisasi
        $this->petugasList = Petugas::orderBy('nama')->get();

        // Inisialisasi properti kendala dan petugas dari data yang ada di database
        $checklists = ZIChecklist::all();
        foreach ($checklists as $item) {
            $this->kendala[$item->id] = $item->kendala;
            $this->assignedPetugas[$item->id] = $item->petugas_id;
        }

        // Muat cache saat komponen pertama kali dijalankan
        $this->refreshCachedFiles();
    }

    /**
     * Metode ini akan dipanggil oleh event 'checklist-updated' SETELAH sinkronisasi
     * dan juga saat komponen di-mount.
     */
    
    public function refreshCachedFiles(): void
    {
        // Ambil ID dari semua checklist yang statusnya terisi
        $terisiIds = ZIChecklist::where('status', 'Terisi')->pluck('id');
        $this->cachedFiles = [];

        // Untuk setiap ID, ambil datanya dari cache
        foreach ($terisiIds as $id) {
            $cacheKey = 'files_in_folder_' . $id;
            $this->cachedFiles[$id] = Cache::get($cacheKey, []); 
        }
    }

    /**
     * "Magic method" yang akan dipanggil setiap kali dropdown petugas diubah.
     */
    public function updatedAssignedPetugas($petugasId, $checklistId): void
    {
        $checklist = ZIChecklist::find($checklistId);
        if ($checklist) {
            $checklist->update(['petugas_id' => $petugasId ?: null]);
        }
    }

    /**
     * "Magic method" yang akan dipanggil setiap kali textarea kendala diubah.
     * .debounce(500) artinya method ini hanya akan dipanggil 500ms setelah pengguna berhenti mengetik.
     */
    public function updatedKendala($kendalaText, $checklistId): void
    {
        $checklist = ZIChecklist::find($checklistId);
        if ($checklist) {
            $checklist->update(['kendala' => $kendalaText]);
        }
    }

    /**
     * Membuka modal dan mengirim event ke browser.
     */
    public function editKendala(int $checklistId): void
    {
        $this->editingKendala = ZIChecklist::find($checklistId);
        $this->kendalaText = $this->editingKendala?->kendala ?? '';
        
        // Kirim event untuk membuka modal di sisi frontend
        $this->dispatch('open-kendala-modal');
    }

    /**
     * Menyimpan data kendala dan mengirim event untuk menutup modal.
     */
    public function saveKendala(): void
    {
        if ($this->editingKendala) {
            $this->editingKendala->update(['kendala' => $this->kendalaText]);
            $this->kendala[$this->editingKendala->id] = $this->kendalaText;
            
            Notification::make()
                ->title('Kendala berhasil disimpan')
                ->success()
                ->send();
        }

        $this->closeKendalaModal();
    }
    
    /**
     * Menutup modal, mereset properti, dan mengirim event ke browser.
     */
    public function closeKendalaModal(): void
    {
        $this->reset('editingKendala', 'kendalaText');

        // Kirim event untuk menutup modal di sisi frontend
        $this->dispatch('close-kendala-modal');
    }

    #[On('checklist-updated')]
    public function refreshComponent(): void
    {
        // Metode ini sengaja kosong. Atribut #[On] akan memicu re-render
        // komponen secara otomatis saat event 'checklist-updated' diterima.
    }
    
    public function copyLink(string $folderId): void
    {
        $link = "https://drive.google.com/drive/folders/{$folderId}";
        $this->dispatch('copy-to-clipboard', text: $link);

        Notification::make()
            ->title('Tautan berhasil disalin!')
            ->success()
            ->send();
    }

    public function syncStatus(): void
    {
        Log::info('Memulai proses sinkronisasi status folder via tombol.');

        try {
            set_time_limit(0); // Tetap penting untuk proses yang mungkin lama

            // 1. Panggil service yang sudah ada.
            $driveService = new \App\Services\GoogleDriveService();

            $itemsToSync = ZIChecklist::whereNotNull('google_drive_folder_id')->get();
            Log::info("Ditemukan {$itemsToSync->count()} item untuk disinkronkan.");

            foreach ($itemsToSync as $item) {
                // 2. Gunakan metode isFolderEmpty() yang sudah kita buat di service
                $isFolderEmpty = $driveService->isFolderEmpty($item->google_drive_folder_id);
                $newStatus = $isFolderEmpty ? 'Kosong' : 'Terisi';

                // 3. Logika update tetap sama
                if ($item->status !== $newStatus) {
                    Log::info("Memperbarui item ID: {$item->id} dari '{$item->status}' menjadi '{$newStatus}'.");
                    $item->status = $newStatus;
                    $item->save();
                }
            }

            Notification::make()
                ->title('Sinkronisasi Berhasil')
                ->body('Status semua folder telah diperbarui sesuai kondisi di Google Drive.')
                ->success()
                ->send();
                
            Log::info('Proses sinkronisasi status folder selesai dengan sukses.');
            
            // Memberi tahu komponen untuk me-refresh dirinya sendiri. Ini sudah benar.
            $this->dispatch('checklist-updated');

        } catch (Exception $e) {
            Log::error('Sinkronisasi Gagal: ' . $e->getMessage());
            Notification::make()
                ->title('Sinkronisasi Gagal')
                ->body('Terjadi kesalahan. Periksa file log untuk detail.')
                ->danger()
                ->send();
        }
    }

    public function render(): View
    {
        $checklists = collect();
        if (!empty($this->search)) {
            // MENGGUNAKAN FACADE SECARA LANGSUNG DENGAN NAMESPACE LENGKAP
            $results = Searchy::search('z_i_checklists')
                              ->fields(['pertanyaan', 'aspek', 'area', 'pilar', 'sub_pilar'])
                              ->query($this->search)
                              ->get();
            
            // Mendapatkan kembali koleksi model
            $checklists = ZIChecklist::hydrate($results->toArray());
        } else {
            $checklists = ZIChecklist::all();
        }

        return view('livewire.dashboard-checklist', [
            'checklists' => $checklists->sortBy('id')->groupBy(['aspek', 'area', 'pilar', 'sub_pilar']),
        ]);
    }
}
