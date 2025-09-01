<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ZIChecklist;
use App\Services\GoogleDriveService;

class SyncDriveStatusCommand extends Command
{
    /**
     * Nama dan tanda tangan dari perintah konsol.
     *
     * @var string
     */
    protected $signature = 'sync:drivestatus';

    /**
     * Deskripsi dari perintah konsol.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi status "Kosong" atau "Terisi" dari Google Drive ke database lokal';

    /**
     * Jalankan logika perintah.
     */
    public function handle(GoogleDriveService $driveService)
    {
        $this->info('Memulai sinkronisasi status folder...');

        $checklists = ZIChecklist::whereNotNull('google_drive_folder_id')->get();

        if ($checklists->isEmpty()) {
            $this->info('Tidak ada checklist yang memiliki ID folder Google Drive. Proses dihentikan.');
            return 0;
        }

        $bar = $this->output->createProgressBar(count($checklists));
        $bar->start();

        foreach ($checklists as $item) {
            $isFolderEmpty = $driveService->isFolderEmpty($item->google_drive_folder_id);
            $newStatus = $isFolderEmpty ? 'Kosong' : 'Terisi';

            // Hanya update jika statusnya berubah untuk efisiensi database
            if ($item->status !== $newStatus) {
                $item->status = $newStatus;
                $item->save();
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nSinkronisasi status folder selesai.");

        return 0;
    }
}