<?php

namespace App\Http\Controllers;

use App\Models\ZIChecklist;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Http\Request;

class ZIController extends Controller
{
    private $drive;

    public function __construct()
    {
        $client = new Client();
        // Pastikan path ke file JSON Anda benar
        $client->setAuthConfig(storage_path('app/' . env('GOOGLE_DRIVE_CREDENTIALS_PATH')));
        $client->addScope(Drive::DRIVE);
        $this->drive = new Drive($client);
    }

    /**
     * Menampilkan halaman utama.
     * (View perlu disesuaikan nanti untuk menampilkan data dari database baru)
     */
    public function index()
    {
        // Tugas controller sekarang hanya menampilkan view utama.
        // Semua logika data sudah ditangani oleh komponen Livewire.    
        return view('dashboard');
    }

    /**
     * Fungsi utama untuk migrasi dan sinkronisasi struktur folder.
     */
    public function migrateDriveStructure()
    {
        set_time_limit(0);

        // GANTI INI dengan ID folder utama di Google Drive BPS Kab. Nias
        $rootFolderId = '1d4KZVTIRkHgZdstKoCvtS843pjgsTe0p'; 

        // Ambil data dari file config dengan helper config()
        $ziData = config('zi_checklist.data');

        // Sintaks untuk test apakah file $ziData berfungsi dan sudah benar
        // dd($ziData); 

        echo "Memulai proses sinkronisasi dengan struktur folder 5 level...<br><br>";

        foreach ($ziData as $data) {
            // Langsung gunakan teks 'pertanyaan' sebagai nama folder
            $finalFolderName = trim($data['pertanyaan']);

            // Logika penamaan folder ringkas dan nama folder panjang
            preg_match('/^([a-z0-9A-Z]+\.)/', $data['pertanyaan'], $matches);
            $nomorPertanyaan = $matches[0] ?? '';
            $shortFolderName = trim($data['subpilar'] . ' - ' . str_replace('.', '', $nomorPertanyaan));
            $longFolderName = trim($data['pertanyaan']);
            
            echo "Memproses: <strong>" . $longFolderName . "</strong><br>";

            // === LOGIKA NAVIGASI FOLDER YANG SUDAH DIPERBAIKI ===
            // 1. Dapatkan atau buat folder Aspek di dalam folder utama ($rootFolderId)
            $aspekFolderId = $this->getOrCreateFolder($data['aspek'], $rootFolderId);
            
            // 2. Dapatkan atau buat folder Pilar di dalam folder Aspek
            $pilarFolderId = $this->getOrCreateFolder($data['pilar'], $aspekFolderId);

            // 3. Dapatkan atau buat folder Area di dalam folder Pilar
            $areaFolderId = $this->getOrCreateFolder($data['area'], $pilarFolderId);

            // 4. Dapatkan atau buat folder Sub Pilar di dalam folder Area
            $subpilarFolderId = $this->getOrCreateFolder($data['subpilar'], $areaFolderId); // Induknya adalah Area

            // Langsung cari atau buat folder PERTANYAAN (nama panjang) di dalam folder SUBPILAR
            $finalFolderId = $this->getOrCreateFolder($finalFolderName, $subpilarFolderId);

            // Simpan atau perbarui data di database lokal (ini sudah benar)
            if ($finalFolderId) {
                ZIChecklist::updateOrCreate(
                    ['pertanyaan' => $data['pertanyaan']], // Kunci unik
                    [
                        'aspek' => $data['aspek'],
                        'area' => $data['area'],
                        'pilar' => $data['pilar'],
                        'sub_pilar' => $data['subpilar'],
                        'google_drive_folder_id' => $finalFolderId,
                    ]
                );
            }
            echo "Berhasil memetakan.<hr>";
        }

        echo "<b>Proses Migrasi Selesai!</b>";
    }

    private function sanitizeFolderName($name)
    {
        // 1. Hapus tanda kutip ganda di awal dan akhir
        $trimmedName = trim(trim($name), '"');
        // 2. Ganti karakter baris baru dengan spasi
        $cleanName = str_replace(["\r", "\n"], ' ', $trimmedName);
        // 3. Hapus spasi berlebih
        return preg_replace('/\s+/', ' ', $cleanName);
    }
    
    /**
     * Helper untuk mencari atau membuat folder.
     */
    private function getOrCreateFolder($name, $parentId)
    {
        $folder = $this->findFolderByName($name, $parentId);
        if ($folder) {
            return $folder->id;
        }
        return $this->createFolder($name, $parentId)->id;
    }

    /**
     * Helper untuk mencari folder berdasarkan nama dan parent ID.
     */
    private function findFolderByName($name, $parentId)
    {
        // Gunakan fungsi sanitasi yang baru
        $cleanName = $this->sanitizeFolderName($name);
        // Escape tanda kutip tunggal untuk keamanan kueri
        $escapedName = str_replace("'", "\\'", $cleanName);

        $query = "name = '$escapedName' and '$parentId' in parents and mimeType = 'application/vnd.google-apps.folder' and trashed = false";
        $optParams = ['q' => $query, 'fields' => 'files(id, name)', 'pageSize' => 1];
        $results = $this->drive->files->listFiles($optParams);

        return count($results->getFiles()) > 0 ? $results->getFiles()[0] : null;
    }
    
    /**
     * Helper untuk membuat folder baru.
     */
    private function createFolder($name, $parentId)
    {
        // Gunakan fungsi sanitasi yang baru
        $cleanName = $this->sanitizeFolderName($name);

        $folderMetadata = new \Google\Service\Drive\DriveFile([
            'name' => $cleanName, // Gunakan nama yang sudah bersih
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => [$parentId]
        ]);
        return $this->drive->files->create($folderMetadata, ['fields' => 'id']);
    }

    /**
     * Helper untuk mengganti nama folder.
     */
    private function renameFolder($folderId, $newName)
    {
        // Gunakan fungsi sanitasi yang baru
        $cleanName = $this->sanitizeFolderName($newName);

        $fileMetadata = new \Google\Service\Drive\DriveFile(['name' => $cleanName]); // Gunakan nama yang sudah bersih
        $this->drive->files->update($folderId, $fileMetadata, ['fields' => 'id']);
    }

    /**
     * Sinkronisasi status folder (Kosong/Terisi).
     */
    // public function syncStatus()
    // {
    //     set_time_limit(0);
    //     $checklists = ZIChecklist::whereNotNull('google_drive_folder_id')->get();
    //     foreach ($checklists as $item) {
    //         $query = "'{$item->google_drive_folder_id}' in parents and trashed = false";
    //         $results = $this->drive->files->listFiles(['q' => $query, 'pageSize' => 1, 'fields' => 'files(id)']);
    //         $item->status = count($results->getFiles()) > 0 ? 'Terisi' : 'Kosong';
    //         $item->save();
    //     }
    //     return redirect()->route('zi.index')->with('success', 'Status folder berhasil disinkronkan!');
    // }
}