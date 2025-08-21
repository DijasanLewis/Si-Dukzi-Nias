<?php

namespace App\Livewire;

use App\Models\ZIChecklist;
use Filament\Notifications\Notification;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Exception;

class DashboardChecklist extends Component
{
    public string $search = '';

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
        Log::info('Memulai proses sinkronisasi status folder.');

        try {
            set_time_limit(0);

            $client = new Client();
            $client->setAuthConfig(storage_path('app/' . env('GOOGLE_DRIVE_CREDENTIALS_PATH')));
            $client->addScope(Drive::DRIVE);
            $drive = new Drive($client);

            $itemsToSync = ZIChecklist::whereNotNull('google_drive_folder_id')->get();
            Log::info("Ditemukan {$itemsToSync->count()} item untuk disinkronkan.");

            foreach ($itemsToSync as $item) {
                $query = "'{$item->google_drive_folder_id}' in parents and trashed = false";
                $results = $drive->files->listFiles(['q' => $query, 'pageSize' => 1, 'fields' => 'files(id)']);
                $newStatus = count($results->getFiles()) > 0 ? 'Terisi' : 'Kosong';

                if ($item->status !== $newStatus) {
                    Log::info("Memperbarui item ID: {$item->id} ('{$item->pertanyaan}') dari '{$item->status}' menjadi '{$newStatus}'.");
                    $item->status = $newStatus;
                    $item->save();
                }
            }

            Notification::make()
                ->title('Sinkronisasi Berhasil')
                ->body('Status semua folder telah diperbarui.')
                ->success()
                ->send();
                
            Log::info('Proses sinkronisasi status folder selesai dengan sukses.');
            
            // Memberi tahu komponen untuk me-refresh dirinya sendiri.
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
        $query = ZIChecklist::query()->orderBy('id');

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

        return view('livewire.dashboard-checklist', [
            'checklists' => $query->get()->groupBy(['aspek', 'area', 'pilar', 'sub_pilar']),
        ]);
    }
}
