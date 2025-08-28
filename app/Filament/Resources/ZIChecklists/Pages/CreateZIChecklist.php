<?php

namespace App\Filament\Resources\ZIChecklists\Pages;

use App\Filament\Resources\ZIChecklists\ZIChecklistResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Services\GoogleDriveService;

class CreateZIChecklist extends CreateRecord
{
    protected static string $resource = ZIChecklistResource::class;

    /**
     * Memodifikasi data form sebelum disimpan ke database.
     * Di sini kita akan membuat folder di Google Drive.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // 1. Panggil service kita
        $driveService = new GoogleDriveService();

        // 2. Jalankan fungsi untuk membuat folder berdasarkan data form
        $folderId = $driveService->createChecklistFolderStructure($data);

        // 3. Masukkan ID folder yang didapat ke dalam data yang akan disimpan
        $data['google_drive_folder_id'] = $folderId;

        // 4. Kembalikan data yang sudah dimodifikasi
        return $data;
    }
}
