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
                        'sub_pilar' => $data['subpilar'],
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
}