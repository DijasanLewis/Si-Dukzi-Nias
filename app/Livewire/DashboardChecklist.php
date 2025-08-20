<?php

namespace App\Livewire;

use App\Models\ZIChecklist;
use Filament\Notifications\Notification;
use Google\Client;
use Google\Service\Drive;
use Illuminate\View\View;
use Livewire\Component;
use Exception;

class DashboardChecklist extends Component
{
    /**
     * Properti yang terhubung dengan input pencarian di frontend.
     * Ini adalah SATU-SATUNYA state yang perlu dikelola Livewire.
     * @var string
     */
    public string $search = '';

    /**
     * Fungsi untuk menyalin link dan mengirim notifikasi menggunakan sistem bawaan Filament.
     */
    public function copyLink(string $folderId): void
    {
        $link = "https://drive.google.com/drive/folders/{$folderId}";
        $this->dispatch('copy-to-clipboard', text: $link);

        Notification::make()
            ->title('Tautan berhasil disalin!')
            ->success()
            ->send();
    }

    /**
     * Sinkronisasi status folder (Kosong/Terisi) langsung dari komponen Livewire.
     */
    public function syncStatus(): void
    {
        try {
            set_time_limit(0);

            $client = new Client();
            $client->setAuthConfig(storage_path('app/' . env('GOOGLE_DRIVE_CREDENTIALS_PATH')));
            $client->addScope(Drive::DRIVE);
            $drive = new Drive($client);

            $itemsToSync = ZIChecklist::whereNotNull('google_drive_folder_id')->get();

            foreach ($itemsToSync as $item) {
                $query = "'{$item->google_drive_folder_id}' in parents and trashed = false";
                $results = $drive->files->listFiles(['q' => $query, 'pageSize' => 1, 'fields' => 'files(id)']);
                $item->status = count($results->getFiles()) > 0 ? 'Terisi' : 'Kosong';
                $item->save();
            }

            Notification::make()
                ->title('Sinkronisasi Berhasil')
                ->body('Status semua folder telah diperbarui.')
                ->success()
                ->send();

        } catch (Exception $e) {
            Notification::make()
                ->title('Sinkronisasi Gagal')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Merender (menampilkan) view komponen.
     * Semua logika pengambilan dan pemrosesan data sekarang ada di sini.
     */
    public function render(): View
    {
        // Memulai query ke model ZIChecklist
        $query = ZIChecklist::query()->orderBy('id');

        // Jika ada input di kotak pencarian, tambahkan filter ke query
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $searchTerm = '%' . $this->search . '%';
                $q->where('pertanyaan', 'like', $searchTerm)
                  ->orWhere('aspek', 'like', $searchTerm)
                  ->orWhere('area', 'like', $searchTerm)
                  ->orWhere('pilar', 'like', $searchTerm)
                  ->orWhere('sub_pilar', 'like', $searchTerm);
            });
        }

        // Eksekusi query untuk mendapatkan semua data
        $allChecklists = $query->get();

        // Kelompokkan data untuk tampilan akordion
        $checklists = $allChecklists->groupBy(['aspek', 'area', 'pilar', 'sub_pilar']);

        // Kirim data yang sudah diproses ke view
        return view('livewire.dashboard-checklist', [
            'checklists' => $checklists,
        ]);
    }
}
