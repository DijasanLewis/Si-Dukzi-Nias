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
        $client->setAuthConfig(storage_path('app/si-dukzi-bps-nias-bcdb9900169c.json'));
        $client->addScope(Drive::DRIVE);
        $this->drive = new Drive($client);
    }

    /**
     * Menampilkan halaman utama.
     * (View perlu disesuaikan nanti untuk menampilkan data dari database baru)
     */
    public function index()
    {
        // Mengambil data dan mengelompokkannya untuk tampilan yang lebih terstruktur
        $checklists = ZIChecklist::orderBy('id')->get()->groupBy(['aspek', 'area', 'pilar', 'sub_pilar']);
        return view('zi_index', compact('checklists'));
    }

    /**
     * Fungsi utama untuk migrasi dan sinkronisasi struktur folder.
     */
    public function migrateDriveStructure()
    {
        // GANTI INI dengan ID folder utama di Google Drive BPS Kab. Nias
        $parentFolderId = '1d4KZVTIRkHgZdstKoCvtS843pjgsTe0p'; 

        $ziData = [
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'i. Penyusunan Tim Kerja',
                'pertanyaan' => 'a. Unit Kerja Telah Membentuk Tim Untuk Melakukan Pembangunan Zona Integritas',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'i. Penyusunan Tim Kerja',
                'pertanyaan' => 'b. Penentuan Anggota Tim Dipilih Melalui Prosedur/mekanisme Yang Jelas',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'ii. Rencana Pembangunan Zona Integritas',
                'pertanyaan' => 'a. Terdapat Dokumen Rencana Kerja Pembangunan Zona Integritas Menuju Wbk/wbbm',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'ii. Rencana Pembangunan Zona Integritas',
                'pertanyaan' => 'b. Dalam Dokumen Pembangunan Terdapat Target-target Prioritas Yang Relevan Dengan Tujuan Pembangunan Wbk/wbbm',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'ii. Rencana Pembangunan Zona Integritas',
                'pertanyaan' => 'c. Terdapat Mekanisme Atau Media Untuk Mensosialisasikan Pembangunan Wbk/wbbm',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iii. Pemantauan Dan Evaluasi Pembangunan Wbk/wbbm',
                'pertanyaan' => 'a. Seluruh Kegiatan Pembangunan Sudah Dilaksanakan Sesuai Dengan Rencana',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iii. Pemantauan Dan Evaluasi Pembangunan Wbk/wbbm',
                'pertanyaan' => 'b. Terdapat Monitoring Dan Evaluasi Terhadap Pembangunan Zona Integritas',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iii. Pemantauan Dan Evaluasi Pembangunan Wbk/wbbm',
                'pertanyaan' => 'c. Hasil Monitoring Dan Evaluasi Telah Ditindaklanjuti',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iv. Perubahan Pola Pikir Dan Budaya Kerja',
                'pertanyaan' => 'a. Pimpinan Berperan Sebagai Role Model Dalam Pelaksanaan Pembangunan Wbk/wbbm',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iv. Perubahan Pola Pikir Dan Budaya Kerja',
                'pertanyaan' => 'b. Sudah Ditetapkan Agen Perubahan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iv. Perubahan Pola Pikir Dan Budaya Kerja',
                'pertanyaan' => 'c. Telah Dibangun Budaya Kerja Dan Pola Pikir Di Lingkungan Organisasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iv. Perubahan Pola Pikir Dan Budaya Kerja',
                'pertanyaan' => 'd. Anggota Organisasi Terlibat Dalam Pembangunan Zona Integritas Menuju Wbk/wbbm',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'i. Prosedur Operasional Tetap (sop) Kegiatan Utama',
                'pertanyaan' => 'a. Sop Mengacu Pada Peta Proses Bisnis Instansi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'i. Prosedur Operasional Tetap (sop) Kegiatan Utama',
                'pertanyaan' => 'b. Prosedur Operasional Tetap (sop) Telah Diterapkan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'i. Prosedur Operasional Tetap (sop) Kegiatan Utama',
                'pertanyaan' => 'c. Prosedur Operasional Tetap (sop) Telah Dievaluasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'ii. E-office',
                'pertanyaan' => 'a. "telah Membangun Lingkungan Kerja Berbasis Teknologi Informasi (e-office) Pada Level:"',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'ii. E-office',
                'pertanyaan' => 'b. "telah Dilakukan Monitoring Dan Evaluasi Terhadap Pemanfaatan Teknologi Informasi Dalam Pengukuran Kinerja Unit, Operasionalisasi Sdn, Dan Pemberian Layanan Kepada Publik"',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'iii. Keterbukaan Informasi Publik',
                'pertanyaan' => 'a. Membuat Kebijakan Tentang Keterbukaan Informasi Publik',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'iii. Keterbukaan Informasi Publik',
                'pertanyaan' => 'b. Melakukan Monitoring Dan Evaluasi Pelaksanaan Kebijakan Keterbukaan Informasi Publik',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'i. Perencanaan Kebutuhan Pegawai',
                'pertanyaan' => 'a. Kebutuhan Pegawai Yang Disusun Mengacu Kepada Peta Jabatan Dan Hasil Analisis Beban Kerja Untuk Masing-masing Jabatan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'i. Perencanaan Kebutuhan Pegawai',
                'pertanyaan' => 'b. Penempatan Pegawai Hasil Rekrutmen Murni Mengacu Kepada Kebutuhan Pegawai Yang Telah Disusun Per Jabatan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'i. Perencanaan Kebutuhan Pegawai',
                'pertanyaan' => 'c. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Penempatan Pegawai Rekrutmen',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'ii. Pola Mutasi Internal',
                'pertanyaan' => 'a. Dalam Melakukan Pengembangan Karier Pegawai, Telah Mempertimbangkan Kebutuhan Organisasi Serta Kompetensi Dan Kualifikasi Pegawai',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'ii. Pola Mutasi Internal',
                'pertanyaan' => 'b. Dalam Melakukan Mutasi Pegawai Antar Jabatan, Telah Memperhatikan Kompetensi Jabatan Dan Mengikuti Pola Mutasi Yang Telah Ditetapkan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'ii. Pola Mutasi Internal',
                'pertanyaan' => 'c. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Kegiatan Mutasi Yang Dilakukan Dalam Kaitannya Dengan Perbaikan Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'a. Unit Kerja Melakukan Training Need Analysis Untuk Pengembangan Kompetensi Staf',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'b. Dalam Menyusun Rencana Pengembangan Kompetensi Pegawai, Telah Mempertimbangkan Hasil Pengelolaan Kinerja Pegawai',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'c. Persentase Kesenjangan Kompetensi Pegawai Yang Ada Dengan Standar Kompetensi Yang Ditetapkan Untuk Masing-masing Jabatan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'd. Pegawai Di Unit Kerja Telah Memperoleh Kesempatan/hak Untuk Mengikuti Diklat Maupun Pengembangan Kompetensi Lainnya',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'e. Dalam Pelaksanaan Pengembangan Kompetensi, Unit Kerja Melakukan Upaya Pengembangan Kompetensi Kepada Pegawai (misalnya Melalui Coaching, Mentoring, Dsb.)',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'f. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Hasil Pengembangan Kompetensi Dalam Kaitannya Dengan Perbaikan Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iv. Penetapan Kinerja Individu',
                'pertanyaan' => 'a. Terdapat Penetapan Kinerja Individu Yang Terkait Dengan Kinerja Organisasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iv. Penetapan Kinerja Individu',
                'pertanyaan' => 'b. Ukuran Kinerja Individu Telah Memiliki Kesesuaian Dengan Indikator Kinerja Individu Level Di Atasnya',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iv. Penetapan Kinerja Individu',
                'pertanyaan' => 'c. Pengukuran Kinerja Individu Dilakukan Secara Periodik',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'iv. Penetapan Kinerja Individu',
                'pertanyaan' => 'd. Hasil Penilaian Kinerja Individu Telah Dilaksanakan/diimplementasikan Mulai Dari Penetapan, Implementasi Dan Pemantauan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'v. Penegakan Aturan Disiplin/kode Etik/kode Perilaku Pegawai',
                'pertanyaan' => 'a. Aturan Disiplin/kode Etik/kode Perilaku Telah Dilaksanakan/diimplementasikan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen Sdm',
                'subpilar' => 'vi. Sistem Informasi Kepegawaian',
                'pertanyaan' => 'a. Data Informasi Kepegawaian Unit Kerja Telah Dimutakhirkan Secara Berkala',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'i. Keterlibatan Pimpinan',
                'pertanyaan' => 'a. Pimpinan Terlibat Secara Langsung Pada Saat Penyusunan Perjanjian Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'i. Keterlibatan Pimpinan',
                'pertanyaan' => 'b. Pimpinan Memantau Pencapaian Kinerja Secara Berkala',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'a. Dokumen Perencanaan Sudah Berorientasi Hasil',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'b. Indikator Kinerja Utama (iku) Telah Digunakan Sebagai Dasar Untuk Mengukur Keberhasilan Pencapaian Sasaran Strategis',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'c. Laporan Kinerja Telah Disusun Tepat Waktu',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'd. Laporan Kinerja Telah Memberikan Informasi Tentang Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'e. Telah Terdapat Upaya Peningkatan Kapasitas Sdm Yang Menangani Akuntabilitas Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'f. Pemberian Reward And Punishment',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'g. Hasil Capaian/monitoring Perjanjian Kinerja Telah Dijadikan Dasar Sebagai Pemberian Reward And Punishment Bagi Organisasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'iii. Kerangka Logis Kinerja',
                'pertanyaan' => 'a. Apakah Terdapat Penjenjangan Kinerja (kerangka Logis Kinerja) Yang Mengacu Pada Kinerja Utama Organisasi Dan Dijadikan Dalam Penentuan Kinerja Seluruh Pegawai?',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'i. Mekanisme Pengendalian',
                'pertanyaan' => 'a. Telah Dilakukan Mekanisme Pengendalian Aktivitas Secara Berjenjang',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'ii. Penanganan Pengaduan Masyarakat',
                'pertanyaan' => 'a. Persentase Penanganan Pengaduan Masyarakat',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'iii. Penyampaian Laporan Harta Kekayaan',
                'pertanyaan' => 'a. Persentase Penyampaian Lhkpn',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Upaya Dan/atau Inovasi Pelayanan Publik',
                'pertanyaan' => 'a. "upaya Dan/atau Inovasi Telah Mendorong Perbaikan Pelayanan Publik Pada:
        1. Kesesuaian Persyaratan
        2. Kemudahan Sistem, Mekanisme, Dan Prosedur
        3. Kecepatan Waktu Penyelesaian
        4. Kejelasan Biaya/tarif, Gratis
        5. Kualitas Produk Spesifikasi Jenis Pelayanan
        6. Kompetensi Pelaksana/web
        7. Perilaku Pelaksana/web
        8. Kualitas Sarana Dan Prasarana
        9. Penanganan Pengaduan, Saran Dan Masukan"',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Upaya Dan/atau Inovasi Pelayanan Publik',
                'pertanyaan' => 'b. "upaya Dan/atau Inovasi Pada Perijinan/pelayanan Telah Dipermudah:
        1. Waktu Lebih Cepat
        2. Pelayanan Publik Yang Terpadu
        3. Alur Lebih Pendek/singkat
        4. Prosedur Lebih Sederhana
        5. Biaya Lebih Murah
        6. Bebas Dari Kkn
        7. Terdapat Sistem Reward And Punishment Bagi Pelaksana Layanan"',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Upaya Dan/atau Inovasi Pelayanan Publik',
                'pertanyaan' => 'c. Telah Dibangun/dikembangkan Sistem Pelayanan Terpadu/terintegrasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Upaya Dan/atau Inovasi Pelayanan Publik',
                'pertanyaan' => 'd. Telah Dilakukan Perbaikan/inovasi Pelayanan Publik Berdasarkan Hasil Survei Kepuasan Masyarakat',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Upaya Dan/atau Inovasi Pelayanan Publik',
                'pertanyaan' => 'e. Telah Terdapat Inovasi Pelayanan Publik Yang Menjadi Percontohan Di Tingkat Nasional/internasional',
            ],
        ];

        echo "Memulai proses sinkronisasi dengan struktur folder baru...<br><br>";

        foreach ($ziData as $data) {
            // Logika penamaan folder ringkas dan nama folder panjang
            preg_match('/^([a-z0-9A-Z]+\.)/', $data['pertanyaan'], $matches);
            $nomorPertanyaan = $matches[0] ?? '';
            $shortFolderName = trim($data['subpilar'] . ' - ' . str_replace('.', '', $nomorPertanyaan));
            $longFolderName = trim($data['pertanyaan']);
            
            echo "Memproses: <strong>" . $longFolderName . "</strong><br>";

            // === LOGIKA NAVIGASI FOLDER YANG SUDAH DIPERBAIKI ===
            // 1. Dapatkan atau buat folder Aspek di dalam folder utama ($parentFolderId)
            $aspekFolderId = $this->getOrCreateFolder($data['aspek'], $parentFolderId);
            
            // 2. Dapatkan atau buat folder Pilar di dalam folder Aspek
            $pilarFolderId = $this->getOrCreateFolder($data['pilar'], $aspekFolderId);

            // 3. Dapatkan atau buat folder Area di dalam folder Pilar
            $areaFolderId = $this->getOrCreateFolder($data['area'], $pilarFolderId);
            
            // 4. Cari folder pertanyaan (ringkas/panjang) di dalam folder Area
            $finalFolderId = null;
            $folder = $this->findFolderByName($shortFolderName, $areaFolderId);
            if ($folder) {
                $finalFolderId = $folder->id;
            } else {
                $folder = $this->findFolderByName($longFolderName, $areaFolderId);
                if ($folder) {
                    $finalFolderId = $folder->id;
                    $this->renameFolder($finalFolderId, $shortFolderName); // Rapikan nama
                }
            }

            // 5. Jika tidak ada, buat folder pertanyaan di dalam folder Area
            if (!$finalFolderId) {
                $finalFolderId = $this->createFolder($shortFolderName, $areaFolderId)->id;
            }
            // === AKHIR LOGIKA YANG DIPERBAIKI ===

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

    /**
     * Helper untuk menavigasi atau membuat path folder.
     */
    private function getFolderIdByPath($data, $rootFolderId)
    {
        $pilarFolderId = $this->getOrCreateFolder($data['pilar'], $rootFolderId);
        $areaFolderId = $this->getOrCreateFolder($data['area'], $pilarFolderId);
        return $areaFolderId; // Folder pertanyaan akan berada di dalam folder Area
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
        $cleanName = addslashes(trim($name));
        $query = "name = '$cleanName' and '$parentId' in parents and mimeType = 'application/vnd.google-apps.folder' and trashed = false";
        $optParams = ['q' => $query, 'fields' => 'files(id, name)', 'pageSize' => 1];
        $results = $this->drive->files->listFiles($optParams);

        return count($results->getFiles()) > 0 ? $results->getFiles()[0] : null;
    }
    
    /**
     * Helper untuk membuat folder baru.
     */
    private function createFolder($name, $parentId)
    {
        $folderMetadata = new \Google\Service\Drive\DriveFile([
            'name' => trim($name),
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
        $fileMetadata = new \Google\Service\Drive\DriveFile(['name' => trim($newName)]);
        $this->drive->files->update($folderId, $fileMetadata, ['fields' => 'id']);
    }

    /**
     * Sinkronisasi status folder (Kosong/Terisi).
     */
    public function syncStatus()
    {
        $checklists = ZIChecklist::whereNotNull('google_drive_folder_id')->get();
        foreach ($checklists as $item) {
            $query = "'{$item->google_drive_folder_id}' in parents and trashed = false";
            $results = $this->drive->files->listFiles(['q' => $query, 'pageSize' => 1, 'fields' => 'files(id)']);
            $item->status = count($results->getFiles()) > 0 ? 'Terisi' : 'Kosong';
            $item->save();
        }
        return redirect()->route('zi.index')->with('success', 'Status folder berhasil disinkronkan!');
    }
}