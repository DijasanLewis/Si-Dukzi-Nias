<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ZIChecklist;
use App\Services\GoogleDriveService;
use Exception;

class ZIDriveSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        set_time_limit(0);

        // Ambil data dari file config
        $ziData = config('zi_checklist.data');

        if (!$ziData) {
            echo "Error: File konfigurasi 'config/zi_checklist.php' tidak ditemukan atau kosong.";
            return;
        }

        echo "Memulai proses sinkronisasi dari file config...";

        try {
            // Gunakan dependency injection pada seeder
            $driveService = app(GoogleDriveService::class);
            
            foreach ($ziData as $data) {
                echo "Memproses: " . htmlspecialchars($data['pertanyaan']) . "\n";

                $folderId = $driveService->createChecklistFolderStructure($data);

                if ($folderId) {
                    ZIChecklist::updateOrCreate(
                        ['pertanyaan' => $data['pertanyaan']],
                        [
                            'aspek' => $data['aspek'],
                            'area' => $data['area'],
                            'pilar' => $data['pilar'],
                            'sub_pilar' => $data['sub_pilar'],
                            'google_drive_folder_id' => $folderId,
                        ]
                    );
                    echo "Berhasil memetakan.\n";
                } else {
                    echo "Gagal membuat folder.\n";
                }
            }
            echo "Proses Migrasi Selesai!";
        } catch (Exception $e) {
            echo "Proses Migrasi Gagal: " . $e->getMessage();
        }
    }
}