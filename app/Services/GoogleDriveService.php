<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Exception;
use Illuminate\Support\Facades\Log;

class GoogleDriveService
{
    protected $drive;

    public function __construct()
    {
        try {
            $client = new Client();
            // Pastikan path ke file JSON Anda benar dan ada di file .env
            $credentialsPath = storage_path('app/' . env('GOOGLE_DRIVE_CREDENTIALS_PATH'));

            if (!file_exists($credentialsPath)) {
                throw new Exception("File kredensial Google Drive tidak ditemukan di: " . $credentialsPath);
            }

            $client->setAuthConfig($credentialsPath);
            $client->addScope(Drive::DRIVE);
            $this->drive = new Drive($client);
        } catch (Exception $e) {
            // Tangani error jika koneksi gagal, misalnya dengan logging
            Log::error('Gagal terhubung ke Google Drive: ' . $e->getMessage());
            // Untuk sekarang kita tampilkan error agar mudah di-debug
            throw $e;
        }
    }

    /**
     * Fungsi utama untuk membuat struktur folder checklist dan mengembalikan ID folder final.
     *
     * @param array $data Data dari form (aspek, pilar, area, sub_pilar, pertanyaan)
     * @param string|null $overrideRootFolderId ID folder root yang akan digunakan sebagai root.
     * @return string|null ID dari folder pertanyaan yang baru dibuat atau null jika gagal.
     */
    public function createChecklistFolderStructure(array $data, string $overrideRootFolderId = null): ?string
    {
        // GANTI INI dengan ID folder root ZI di Google Drive Anda dari file .env
        $rootFolderId = $overrideRootFolderId ?? env('GOOGLE_DRIVE_ROOT_FOLDER_ID', 'YOUR_ROOT_FOLDER_ID_HERE');

        // 1. Dapatkan atau buat folder Aspek
        $aspekFolderId = $this->getOrCreateFolder($data['aspek'], $rootFolderId);
        
        // 2. Dapatkan atau buat folder Pilar di dalam Aspek
        $pilarFolderId = $this->getOrCreateFolder($data['pilar'], $aspekFolderId);

        // 3. Dapatkan atau buat folder Area di dalam Pilar
        $areaFolderId = $this->getOrCreateFolder($data['area'], $pilarFolderId);

        // 4. Dapatkan atau buat folder Sub Pilar di dalam Area
        $sub_pilarFolderId = $this->getOrCreateFolder($data['sub_pilar'], $areaFolderId);

        // 5. Buat folder Pertanyaan di dalam Sub Pilar
        $finalFolderId = $this->getOrCreateFolder($data['pertanyaan'], $sub_pilarFolderId);

        return $finalFolderId;
    }

    private function getOrCreateFolder(string $name, string $parentId): ?string
    {
        $folder = $this->findFolderByName($name, $parentId);
        if ($folder) {
            return $folder->id;
        }
        return $this->createFolder($name, $parentId)->id;
    }

    private function findFolderByName(string $name, string $parentId)
    {
        $cleanName = $this->sanitizeFolderName($name);
        $escapedName = str_replace("'", "\\'", $cleanName);

        $query = "name = '$escapedName' and '$parentId' in parents and mimeType = 'application/vnd.google-apps.folder' and trashed = false";
        $optParams = ['q' => $query, 'fields' => 'files(id, name)', 'pageSize' => 1];
        $results = $this->drive->files->listFiles($optParams);

        return count($results->getFiles()) > 0 ? $results->getFiles()[0] : null;
    }

    private function createFolder(string $name, string $parentId)
    {
        $cleanName = $this->sanitizeFolderName($name);
        $folderMetadata = new \Google\Service\Drive\DriveFile([
            'name' => $cleanName,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => [$parentId]
        ]);
        return $this->drive->files->create($folderMetadata, ['fields' => 'id']);
    }

    private function sanitizeFolderName(string $name): string
    {
        $trimmedName = trim(trim($name), '"');
        $cleanName = str_replace(["\r", "\n"], ' ', $trimmedName);
        return preg_replace('/\s+/', ' ', $cleanName);
    }

    /**
     * Mengambil daftar file dari dalam sebuah folder Google Drive.
     *
     * @param string $folderId
     * @return array Daftar nama file.
     */
    public function getFilesInFolder(string $folderId): array
    {
        try {
            // Kueri untuk mencari semua file (bukan folder) di dalam folder induk ($folderId)
            $query = "'{$folderId}' in parents and mimeType != 'application/vnd.google-apps.folder' and trashed = false";
            
            // Parameter untuk meminta nama dan link web dari setiap file
            $optParams = [
                'q' => $query,
                'fields' => 'files(name, webViewLink)',
                'pageSize' => 20 // Batasi hingga 20 file per folder
            ];

            $results = $this->drive->files->listFiles($optParams);
            $files = [];

            // Ulangi setiap hasil dan simpan nama serta link-nya
            foreach ($results->getFiles() as $file) {
                $files[] = [
                    'name' => $file->getName(),
                    'link' => $file->getWebViewLink()
                ];
            }

            return $files;

        } catch (\Exception $e) {
            // Jika terjadi error (misal: folder tidak ada), kembalikan array kosong
            // menambahkan Log::error() di sini untuk debugging
            Log::error('Error saat mengambil file dari folder: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Memeriksa apakah sebuah folder di Google Drive kosong atau tidak.
     *
     * @param string $folderId
     * @return bool True jika kosong, false jika berisi file.
     */
    public function isFolderEmpty(string $folderId): bool
    {
        try {
            // Kueri untuk mencari HANYA SATU file di dalam folder
            $query = "'{$folderId}' in parents and mimeType != 'application/vnd.google-apps.folder' and trashed = false";
            
            $optParams = [
                'q' => $query,
                'fields' => 'files(id)',
                'pageSize' => 1 // Kunci efisiensi: kita hanya butuh 1 hasil untuk tahu folder ini tidak kosong
            ];

            $results = $this->drive->files->listFiles($optParams);
            
            // Jika jumlah file adalah 0, maka folder kosong
            return count($results->getFiles()) === 0;

        } catch (\Exception $e) {
            // Jika terjadi error (misal: folder tidak ada), anggap saja kosong
            return true;
        }
    }
}