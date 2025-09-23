<?php

namespace App\Livewire;

use App\Exports\ChecklistExport;
use App\Models\Petugas;
use App\Models\ZIChecklist;
use Filament\Notifications\Notification;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\Support\Facades\Cache; // Import Cache facade
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Exception;
use HighSolutions\LaravelSearchy\Facades\Searchy;
use Maatwebsite\Excel\Facades\Excel;

class DashboardChecklist extends Component
{
    public string $search = '';
    public string $selectedPetugas = ''; 
    public string $searchPemeriksa = ''; 
    public Collection $petugasList;

    // Properti ini akan menampung data kendala untuk setiap item
    public array $kendala = [];

    // Properti ini akan menampung data rencana aksi untuk setiap item
    public array $rencanaAksi = [];

    // Properti ini akan menampung data petugas_id untuk setiap item
    public array $assignedPetugas = [];

    public ?ZIChecklist $editingKendala = null;
    public string $kendalaText = '';

    public ?ZIChecklist $editingRencanaAksi = null;
    public string $rencanaAksiText = '';

    // Untuk pemeriksa
    public array $statusPemeriksa = [];
    public array $catatanPemeriksa = [];
    public ?ZIChecklist $editingCatatanPemeriksa = null;
    public string $catatanPemeriksaText = '';

    // Untuk fitur ambil daftar nama file dari google drive
    public array $cachedFiles = [];

    public $initialDataLoaded = false;
    public function mount(): void
    {
        // Muat daftar petugas sekali saat komponen diinisialisasi
        $this->petugasList = Petugas::orderBy('nama')->get();

        // Inisialisasi properti kendala dan petugas dari data yang ada di database
        $checklists = ZIChecklist::all();
        foreach ($checklists as $item) {
            $this->kendala[$item->id] = $item->kendala;
            $this->rencanaAksi[$item->id] = $item->rencana_aksi;
            $this->assignedPetugas[$item->id] = $item->petugas_id;
            $this->statusPemeriksa[$item->id] = ($item->status_pemeriksa === 'Sudah Lengkap');
            $this->catatanPemeriksa[$item->id] = $item->catatan_pemeriksa;
        }

        // Muat cache saat komponen pertama kali dijalankan
        $this->refreshCachedFiles();

        $this->initialDataLoaded = true;
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
            // Tentukan timestamp. Jika teks kendala kosong, timestamp di-null-kan.
            $timestamp = !empty($this->kendalaText) ? Carbon::now() : null;

            // Update database dengan teks kendala dan timestamp
            $this->editingKendala->update([
                'kendala' => $this->kendalaText,
                'kendala_updated_at' => $timestamp,
            ]);

            // Sinkronkan state lokal (opsional tapi baik untuk UI reaktif)
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

    /**
     * "Magic method" yang akan dipanggil setiap kali textarea rencana aksi diubah.
     */
    public function updatedRencanaAksi($rencanaAksiText, $checklistId): void
    {
        $checklist = ZIChecklist::find($checklistId);
        if ($checklist) {
            $checklist->update(['rencana_aksi' => $rencanaAksiText]);
        }
    }

    /**
     * Membuka modal dan mengirim event ke browser.
     */
    public function editRencanaAksi(int $checklistId): void
    {
        $this->editingRencanaAksi = ZIChecklist::find($checklistId);
        $this->rencanaAksiText = $this->editingRencanaAksi?->rencana_aksi ?? '';
        
        // Kirim event untuk membuka modal di sisi frontend
        $this->dispatch('open-rencana-aksi-modal');
    }

    /**
     * Menyimpan data rencana aksi dan mengirim event untuk menutup modal.
     */
    public function saveRencanaAksi(): void
    {
        if ($this->editingRencanaAksi) {
            $this->editingRencanaAksi->update([
                'rencana_aksi' => $this->rencanaAksiText,
            ]);
            $this->rencanaAksi[$this->editingRencanaAksi->id] = $this->rencanaAksiText;
            
            Notification::make()
                ->title('Rencana Aksi berhasil disimpan')
                ->success()
                ->send();
        }
        $this->closeRencanaAksiModal();
    }

    /**
     * Menutup modal, mereset properti, dan mengirim event ke browser.
     */
    public function closeRencanaAksiModal(): void
    {
        $this->reset('editingRencanaAksi', 'rencanaAksiText');

        // Kirim event untuk menutup modal di sisi frontend
        $this->dispatch('close-rencana-aksi-modal');
    }

    public function updatedStatusPemeriksa($value, $checklistId): void
    {
        $checklist = ZIChecklist::find($checklistId);
        if ($checklist) {
            // Jika nilai checkbox adalah 'on', ubah status menjadi 'Sudah Lengkap' atau default
            $newStatus = $value ? 'Sudah Lengkap' : 'Belum Lengkap';  
            $timestamp = Carbon::now();

            // Perbarui kolom 'status_pemeriksa' di database
            $checklist->update([
                'status_pemeriksa' => $newStatus,
                'timestamp_catatan_pemeriksa' => $timestamp,
            ]);

            // Perbarui properti di komponen Livewire agar UI reaktif
            $this->statusPemeriksa[$checklistId] = $value;

            Notification::make()
                ->title('Status Pemeriksa Diperbarui')
                ->body('Status checklist berhasil diperbarui.')
                ->success()
                ->send();
        }
    }

    public function editCatatanPemeriksa(int $checklistId): void
    {
        $this->editingCatatanPemeriksa = ZIChecklist::find($checklistId);
        $this->catatanPemeriksaText = $this->editingCatatanPemeriksa?->catatan_pemeriksa ?? '';

        $this->dispatch('open-catatan-modal');
    }

    public function saveCatatanPemeriksa(): void
    {
        if ($this->editingCatatanPemeriksa) {
            $timestamp = !empty($this->catatanPemeriksaText) ? Carbon::now() : null;

            $this->editingCatatanPemeriksa->update([
                'catatan_pemeriksa' => $this->catatanPemeriksaText,
                'timestamp_catatan_pemeriksa' => $timestamp,
            ]);

            $this->catatanPemeriksa[$this->editingCatatanPemeriksa->id] = $this->catatanPemeriksaText;

            Notification::make()
                ->title('Catatan Pemeriksa berhasil disimpan')
                ->success()
                ->send();
        }

        $this->closeCatatanPemeriksaModal();
    }

    public function closeCatatanPemeriksaModal(): void
    {
        $this->reset('editingCatatanPemeriksa', 'catatanPemeriksaText');
        $this->dispatch('close-catatan-modal');
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

            // logika untuk menjalankan proses caching.
            // Buat instance dari command CacheDriveFiles
            $cacheCommand = new \App\Console\Commands\CacheDriveFiles();
            // Jalankan method handle-nya untuk caching
            $cacheCommand->handle();
            Log::info('Proses caching file Google Drive selesai.');

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
        // 1. Mulai dengan query builder, bukan mengambil semua data langsung
        $query = ZIChecklist::query();

        // 2. Terapkan filter pencarian umum (menggantikan Searchy)
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('pertanyaan', 'like', '%' . $this->search . '%')
                ->orWhere('aspek', 'like', '%' . $this->search . '%')
                ->orWhere('area', 'like', '%' . $this->search . '%')
                ->orWhere('pilar', 'like', '%' . $this->search . '%')
                ->orWhere('sub_pilar', 'like', '%' . $this->search . '%');
            });
        }

        // 3. Terapkan filter Petugas yang dipilih
        if (!empty($this->selectedPetugas)) {
            $query->where('petugas_id', $this->selectedPetugas);
        }

        // 4. Terapkan filter Pemeriksa di dalam kolom rencana_aksi
        if (!empty($this->searchPemeriksa)) {
            $query->where('rencana_aksi', 'like', '%' . $this->searchPemeriksa . '%');
        }

        // 5. Ambil hasil setelah semua filter diterapkan
        $checklists = $query->get();

        // 6. Kembalikan view dengan data yang sudah difilter dan dikelompokkan
        return view('livewire.dashboard-checklist', [
            'checklists' => $checklists->sortBy('id')->groupBy(['aspek', 'area', 'pilar', 'sub_pilar']),
        ]);
    }
    public function export()
    {
        return Excel::download(new ChecklistExport, '1201_Rencana Kerja BPS 1201_'.date('Y-m-d').'.xlsx');
    }
}
