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
        // Logika Penggabungan Data dari Field Kondisional
        
        // Aspek
        if ($data['aspek'] === 'other') {
            $data['aspek'] = $data['aspek_other'];
        }
        unset($data['aspek_other']);

        // Area
        if ($data['area'] === 'other') {
            $data['area'] = $data['area_other'];
        }
        unset($data['area_other']);

        // Pilar
        if ($data['pilar'] === 'other') {
            $data['pilar'] = $data['pilar_other'];
        }
        unset($data['pilar_other']);

        // Sub Pilar
        if (isset($data['sub_pilar']) && $data['sub_pilar'] === 'other') {
            $data['sub_pilar'] = $data['sub_pilar_other'];
        }
        unset($data['sub_pilar_other']);
        
        // Logika Pembuatan Folder Google Drive (sudah ada)
        
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
