<?php

namespace App\Http\Controllers;

use App\Models\ZIChecklist;
use App\Services\GoogleDriveService; // <-- Impor service yang baru
use Illuminate\Http\Request;

class ZIController extends Controller
{
    /**
     * Menampilkan halaman utama (dashboard).
     * Logika data ditangani oleh komponen Livewire.
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Fungsi untuk migrasi/sinkronisasi massal dari file config/zi_checklist.php.
     * Sekarang menggunakan GoogleDriveService untuk menjaga konsistensi.
     */
    public function migrateDriveStructure()
    {
        set_time_limit(0);

        // Panggil service Google Drive kita
        $driveService = new GoogleDriveService();

        // Ambil data dari file config
        $ziData = config('zi_checklist.data');
        // Data Untuk Testing
        // $ziData = config('zi_checklist_test.data');

        if (!$ziData) {
            return "<b>Error:</b> File konfigurasi 'config/zi_checklist.php' tidak ditemukan atau kosong.";
        }
        
        echo "Memulai proses sinkronisasi dari file config...<br><br>";

        foreach ($ziData as $data) {
            echo "Memproses: <strong>" . htmlspecialchars($data['pertanyaan']) . "</strong><br>";

            // 1. Gunakan service untuk membuat struktur folder
            $folderId = $driveService->createChecklistFolderStructure($data);

            // 2. Simpan atau perbarui data di database lokal
            if ($folderId) {
                ZIChecklist::updateOrCreate(
                    ['pertanyaan' => $data['pertanyaan']], // Kunci unik untuk mencari data yang ada
                    [
                        'aspek' => $data['aspek'],
                        'area' => $data['area'],
                        'pilar' => $data['pilar'],
                        'sub_pilar' => $data['sub_pilar'],
                        'google_drive_folder_id' => $folderId,
                    ]
                );
                echo "Berhasil memetakan.<hr>";
            } else {
                echo "Gagal membuat folder untuk item ini.<hr>";
            }
        }

        return "<b>Proses Migrasi Selesai!</b>";
    }

    // TIDAK ADA LAGI FUNGSI-FUNGSI PRIVATE DI SINI
    // Semua sudah dipindahkan ke GoogleDriveService

    /**
     * FUNGSI KHUSUS UNTUK TESTING YANG AMAN.
     * Fungsi ini tidak akan menyimpan apapun ke database.
     */
    public function testMigrateDriveStructure()
    {
        set_time_limit(0);

        // 1. Ambil data dari file config TEST
        $ziData = config('zi_checklist_test.data');

        if (!$ziData) {
            return "<b>Error:</b> File 'config/zi_checklist_test.php' tidak ditemukan atau kosong.";
        }

        // 2. Gunakan ID Folder "Wadah" Testing dari .env
        // Ganti ID_FOLDER_TESTING_ANDA dengan ID folder dari Langkah 1
        $testRootFolderId = 'ID_FOLDER_TESTING_ANDA';

        // Panggil service Google Drive
        $driveService = new \App\Services\GoogleDriveService();

        echo "Memulai PROSES UJI COBA (DRY RUN)...<br>";
        echo "Folder Root untuk Uji Coba: " . $testRootFolderId . "<br><br>";

        foreach ($ziData as $data) {
            echo "Memproses (tanpa simpan DB): <strong>" . htmlspecialchars($data['pertanyaan']) . "</strong><br>";

            // 3. Panggil fungsi di service, TAPI ganti $rootFolderId dengan $testRootFolderId
            // Kita modifikasi sedikit GoogleDriveService untuk ini (lihat langkah selanjutnya)
            $folderId = $driveService->createChecklistFolderStructure($data, $testRootFolderId);

            if ($folderId) {
                echo "Folder berhasil dibuat/ditemukan dengan ID: " . $folderId . "<hr>";
            } else {
                echo "Gagal membuat folder untuk item ini.<hr>";
            }
        }

        return "<b>UJI COBA SELESAI.</b> Periksa folder 'SI-DUKZI - TESTING' di Google Drive Anda. Tidak ada data yang diubah di database produksi.";
    }
}