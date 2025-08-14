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
        $client->setAuthConfig(storage_path('app/prismatic-sunup-468904-s3-0dc16aa431a6.json'));
        $client->addScope(Drive::DRIVE);
        $this->drive = new Drive($client);
    }

    public function index()
    {
        // Jika tabel kosong, inisiasi data awal
        if (ZIChecklist::count() == 0) {
            $this->initiateData();
        }

        $checklists = ZIChecklist::all();
        return view('zi_index', compact('checklists'));
    }

    private function initiateData()
    {
        // Ganti dengan folder ID utama Anda dari Langkah 2
        $parentFolderId = '16EctshwCuM-lNssaFsSt4fDiaskq18h_'; 

        // Ini adalah data dummy, ganti dengan data ZI yang sebenarnya
        $ziData = [
            // 1. Manajemen Perubahan
            ['area' => 'Manajemen Perubahan', 'poin' => '1a. Penyusunan Tim Kerja - Pembentukan Tim'],
            ['area' => 'Manajemen Perubahan', 'poin' => '1b. Penyusunan Tim Kerja - Penentuan Anggota'],
            ['area' => 'Manajemen Perubahan', 'poin' => '2a. Rencana Pembangunan ZI - Dokumen Rencana Kerja'],
            ['area' => 'Manajemen Perubahan', 'poin' => '2b. Rencana Pembangunan ZI - Target Prioritas Relevan'],
            ['area' => 'Manajemen Perubahan', 'poin' => '2c. Rencana Pembangunan ZI - Sosialisasi'],
            ['area' => 'Manajemen Perubahan', 'poin' => '3a. Pemantauan & Evaluasi - Pelaksanaan Sesuai Rencana'],
            ['area' => 'Manajemen Perubahan', 'poin' => '3b. Pemantauan & Evaluasi - Monitoring Berkala'],
            ['area' => 'Manajemen Perubahan', 'poin' => '3c. Pemantauan & Evaluasi - Tindak Lanjut Hasil'],
            ['area' => 'Manajemen Perubahan', 'poin' => '4a. Perubahan Pola Pikir - Pimpinan Sebagai Role Model'],
            ['area' => 'Manajemen Perubahan', 'poin' => '4b. Perubahan Pola Pikir - Penetapan Agen Perubahan'],
            ['area' => 'Manajemen Perubahan', 'poin' => '4c. Perubahan Pola Pikir - Pembangunan Budaya Kerja'],
            ['area' => 'Manajemen Perubahan', 'poin' => '4d. Perubahan Pola Pikir - Keterlibatan Anggota'],
        
            // 2. Penataan Tatalaksana
            ['area' => 'Penataan Tatalaksana', 'poin' => '1a. SOP - Mengacu Peta Proses Bisnis'],
            ['area' => 'Penataan Tatalaksana', 'poin' => '1b. SOP - Penerapan SOP'],
            ['area' => 'Penataan Tatalaksana', 'poin' => '1c. SOP - Evaluasi SOP'],
            ['area' => 'Penataan Tatalaksana', 'poin' => '2a. SPBE - Pengukuran Kinerja via TI'],
            ['area' => 'Penataan Tatalaksana', 'poin' => '2b. SPBE - Manajemen SDM via TI'],
            ['area' => 'Penataan Tatalaksana', 'poin' => '2c. SPBE - Pelayanan Publik via TI'],
            ['area' => 'Penataan Tatalaksana', 'poin' => '2d. SPBE - Monitoring Pemanfaatan TI'],
            ['area' => 'Penataan Tatalaksana', 'poin' => '3a. Keterbukaan Informasi Publik - Penerapan Kebijakan'],
            ['area' => 'Penataan Tatalaksana', 'poin' => '3b. Keterbukaan Informasi Publik - Monitoring & Evaluasi'],
        
            // 3. Penataan Sistem Manajemen SDM
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '1a. Perencanaan Kebutuhan Pegawai - Acuan Peta Jabatan & ABK'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '1b. Perencanaan Kebutuhan Pegawai - Penempatan Sesuai Kebutuhan'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '1c. Perencanaan Kebutuhan Pegawai - Monev Penempatan'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '2a. Pola Mutasi Internal - Mutasi Antar Jabatan'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '2b. Pola Mutasi Internal - Mutasi Sesuai Kompetensi'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '2c. Pola Mutasi Internal - Monev Mutasi'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '3a. Pengembangan Pegawai - Training Need Analysis'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '3b. Pengembangan Pegawai - Rencana Pengembangan'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '3c. Pengembangan Pegawai - Kesenjangan Kompetensi'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '3d. Pengembangan Pegawai - Hak Mengikuti Diklat'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '3e. Pengembangan Pegawai - Upaya Pengembangan'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '3f. Pengembangan Pegawai - Monev Hasil Pengembangan'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '4a. Penetapan Kinerja Individu - Kinerja Terkait Organisasi'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '4b. Penetapan Kinerja Individu - Ukuran Kinerja Sesuai Level'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '4c. Penetapan Kinerja Individu - Pengukuran Periodik'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '4d. Penetapan Kinerja Individu - Dasar Pemberian Reward'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '5a. Penegakan Aturan Disiplin - Implementasi Aturan'],
            ['area' => 'Penataan Sistem Manajemen SDM', 'poin' => '6a. Sistem Informasi Kepegawaian - Pemutakhiran Data'],
        
            // 4. Penguatan Akuntabilitas
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '1a. Keterlibatan Pimpinan - Penyusunan Perencanaan'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '1b. Keterlibatan Pimpinan - Penyusunan Penetapan Kinerja'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '1c. Keterlibatan Pimpinan - Pemantauan Pencapaian Kinerja'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '2a. Pengelolaan Akuntabilitas Kinerja - Dokumen Perencanaan'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '2b. Pengelolaan Akuntabilitas Kinerja - Perencanaan Berorientasi Hasil'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '2c. Pengelolaan Akuntabilitas Kinerja - Penetapan IKU'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '2d. Pengelolaan Akuntabilitas Kinerja - Indikator Kriteria SMART'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '2e. Pengelolaan Akuntabilitas Kinerja - Laporan Kinerja Tepat Waktu'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '2f. Pengelolaan Akuntabilitas Kinerja - Laporan Kinerja Informatif'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '2g. Pengelolaan Akuntabilitas Kinerja - Sistem Informasi Kinerja'],
            ['area' => 'Penguatan Akuntabilitas', 'poin' => '2h. Pengelolaan Akuntabilitas Kinerja - Peningkatan Kapasitas SDM'],
        
            // 5. Penguatan Pengawasan
            ['area' => 'Penguatan Pengawasan', 'poin' => '1a. Pengendalian Gratifikasi - Public Campaign'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '1b. Pengendalian Gratifikasi - Implementasi'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '2a. Penerapan SPIP - Pembangunan Lingkungan Pengendalian'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '2b. Penerapan SPIP - Penilaian Risiko'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '2c. Penerapan SPIP - Kegiatan Pengendalian Risiko'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '2d. Penerapan SPIP - Sosialisasi SPI'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '3a. Pengaduan Masyarakat - Implementasi Kebijakan'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '3b. Pengaduan Masyarakat - Tindak Lanjut Pengaduan'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '3c. Pengaduan Masyarakat - Monev Penanganan'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '3d. Pengaduan Masyarakat - Tindak Lanjut Hasil Evaluasi'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '4a. Whistle Blowing System (WBS) - Penerapan WBS'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '4b. Whistle Blowing System (WBS) - Evaluasi Penerapan'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '4c. Whistle Blowing System (WBS) - Tindak Lanjut Hasil Evaluasi'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '5a. Penanganan Benturan Kepentingan - Pemetaan'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '5b. Penanganan Benturan Kepentingan - Sosialisasi'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '5c. Penanganan Benturan Kepentingan - Implementasi'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '5d. Penanganan Benturan Kepentingan - Evaluasi'],
            ['area' => 'Penguatan Pengawasan', 'poin' => '5e. Penanganan Benturan Kepentingan - Tindak Lanjut Hasil Evaluasi'],
        
            // 6. Peningkatan Kualitas Pelayanan Publik
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '1a. Standar Pelayanan - Kebijakan Standar Pelayanan'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '1b. Standar Pelayanan - Maklumat Pelayanan'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '1c. Standar Pelayanan - Reviu & Perbaikan'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '1d. Standar Pelayanan - Publikasi'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '2a. Budaya Pelayanan Prima - Peningkatan Kemampuan'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '2b. Budaya Pelayanan Prima - Akses Informasi Pelayanan'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '2c. Budaya Pelayanan Prima - Sistem Reward & Sanksi'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '2d. Budaya Pelayanan Prima - Sistem Kompensasi'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '2e. Budaya Pelayanan Prima - Sarana Layanan Terpadu'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '2f. Budaya Pelayanan Prima - Inovasi Pelayanan'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '3a. Pengelolaan Pengaduan - Media Terintegrasi SP4N-Lapor!'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '3b. Pengelolaan Pengaduan - Unit Pengelola'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '3c. Pengelolaan Pengaduan - Evaluasi Penanganan'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '4a. Penilaian Kepuasan - Pelaksanaan Survei'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '4b. Penilaian Kepuasan - Akses Hasil Survei'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '4c. Penilaian Kepuasan - Tindak Lanjut Hasil Survei'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '5a. Pemanfaatan TI - Penerapan TI'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '5b. Pemanfaatan TI - Database Terintegrasi'],
            ['area' => 'Peningkatan Kualitas Pelayanan Publik', 'poin' => '5c. Pemanfaatan TI - Perbaikan Berkelanjutan'],
        ];

        foreach ($ziData as $data) {
            $folderMetadata = new Drive\DriveFile([
                'name' => $data['poin'],
                'mimeType' => 'application/vnd.google-apps.folder',
                'parents' => [$parentFolderId]
            ]);

            $folder = $this->drive->files->create($folderMetadata, ['fields' => 'id']);

            ZIChecklist::create([
                'area_perubahan' => $data['area'],
                'poin_penilaian' => $data['poin'],
                'google_drive_folder_id' => $folder->id,
                'status' => 'Kosong'
            ]);
        }
    }

    public function syncStatus()
    {
        $checklists = ZIChecklist::all();

        foreach ($checklists as $item) {
            $folderId = $item->google_drive_folder_id;
            $query = "'$folderId' in parents";
            $optParams = [
                'q' => $query,
                'pageSize' => 1, // Kita hanya butuh tahu ada file atau tidak
                'fields' => 'files(id)',
            ];

            $results = $this->drive->files->listFiles($optParams);

            if (count($results->getFiles()) > 0) {
                $item->status = 'Terisi';
            } else {
                $item->status = 'Kosong';
            }
            $item->save();
        }

        return redirect()->route('zi.index')->with('success', 'Status folder berhasil disinkronkan!');
    }
}