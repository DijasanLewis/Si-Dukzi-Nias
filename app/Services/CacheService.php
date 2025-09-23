<?php

namespace App\Services;

use App\Models\ZIChecklist;
use App\Services\GoogleDriveService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheService
{
    /**
     * Mengambil daftar file dari Google Drive dan menyimpannya ke cache.
     * Metode ini dirancang untuk dapat dipanggil dari mana saja.
     */
    public function cacheDriveFiles(): void
    {
        Log::info('Memulai proses caching daftar file dari Google Drive...');

        // Inisialisasi service
        $driveService = new GoogleDriveService();

        // Ambil semua checklist yang berstatus "Terisi" dan memiliki folder ID
        $checklists = ZIChecklist::where('status', 'Terisi')
                                 ->whereNotNull('google_drive_folder_id')
                                 ->get();

        if ($checklists->isEmpty()) {
            Log::info('Tidak ada checklist "Terisi" yang perlu di-cache. Selesai.');
            return;
        }

        foreach ($checklists as $checklist) {
            $folderId = $checklist->google_drive_folder_id;
            $cacheKey = 'files_in_folder_' . $checklist->id;

            // Ambil daftar file dari Google Drive
            $files = $driveService->getFilesInFolder($folderId);

            // Simpan ke cache selamanya
            Cache::forever($cacheKey, $files);

            Log::info('Cache untuk checklist #' . $checklist->id . ' berhasil disimpan.');
        }

        Log::info('Proses caching selesai.');
    }
}