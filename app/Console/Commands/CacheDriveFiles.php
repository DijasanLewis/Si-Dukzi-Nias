<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ZIChecklist;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Cache;

class CacheDriveFiles extends Command
{
    protected $signature = 'cache:drivefiles';
    protected $description = 'Ambil daftar file dari Google Drive untuk folder "Terisi" dan simpan ke cache';

    public function handle()
    {
        $this->info('Memulai proses caching daftar file dari Google Drive...');

        // Inisialisasi service
        $driveService = new GoogleDriveService();

        // Ambil semua checklist yang berstatus "Terisi" dan memiliki folder ID
        $checklists = ZIChecklist::where('status', 'Terisi')
                                 ->whereNotNull('google_drive_folder_id')
                                 ->get();

        if ($checklists->isEmpty()) {
            $this->info('Tidak ada checklist "Terisi" yang perlu di-cache. Selesai.');
            return;
        }

        foreach ($checklists as $checklist) {
            $folderId = $checklist->google_drive_folder_id;
            $cacheKey = 'files_in_folder_' . $checklist->id;

            // Ambil daftar file dari Google Drive
            $files = $driveService->getFilesInFolder($folderId);

            // Simpan ke cache selamanya (atau tentukan durasi, misal: now()->addHours(2))
            Cache::forever($cacheKey, $files);

            $this->line('Cache untuk checklist #' . $checklist->id . ' berhasil disimpan.');
        }

        $this->info('Proses caching selesai.');
    }
}