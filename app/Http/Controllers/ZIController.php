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
        set_time_limit(0);

        // GANTI INI dengan ID folder utama di Google Drive BPS Kab. Nias
        $rootFolderId = '1d4KZVTIRkHgZdstKoCvtS843pjgsTe0p'; 

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
                'pertanyaan' => 'b. Penentuan Anggota Tim Dipilih Melalui Prosedur/Mekanisme Yang Jelas',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'ii. Rencana Pembangunan Zona Integritas',
                'pertanyaan' => 'a. Terdapat Dokumen Rencana Kerja Pembangunan Zona Integritas Menuju WBK/WBBM',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'ii. Rencana Pembangunan Zona Integritas',
                'pertanyaan' => 'b. Dalam Dokumen Pembangunan Terdapat Target-Target Prioritas Yang Relevan Dengan Tujuan Pembangunan WBK/WBBM',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'ii. Rencana Pembangunan Zona Integritas',
                'pertanyaan' => 'c. Terdapat Mekanisme Atau Media Untuk Mensosialisasikan Pembangunan WBK/WBBM',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iii. Pemantauan Dan Evaluasi Pembangunan WBK/WBBM',
                'pertanyaan' => 'a. Seluruh Kegiatan Pembangunan Sudah Dilaksanakan Sesuai Dengan Rencana',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iii. Pemantauan Dan Evaluasi Pembangunan WBK/WBBM',
                'pertanyaan' => 'b. Terdapat Monitoring Dan Evaluasi Terhadap Pembangunan Zona Integritas',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iii. Pemantauan Dan Evaluasi Pembangunan WBK/WBBM',
                'pertanyaan' => 'c. Hasil Monitoring Dan Evaluasi Telah Ditindaklanjuti',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iv. Perubahan Pola Pikir Dan Budaya Kerja',
                'pertanyaan' => 'a. Pimpinan Berperan Sebagai Role Model Dalam Pelaksanaan Pembangunan WBK/WBBM',
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
                'pertanyaan' => 'd. Anggota Organisasi Terlibat Dalam Pembangunan Zona Integritas Menuju WBK/WBBM',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'i. Prosedur Operasional Tetap (SOP) Kegiatan Utama',
                'pertanyaan' => 'a. SOP Mengacu Pada Peta Proses Bisnis Instansi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'i. Prosedur Operasional Tetap (SOP) Kegiatan Utama',
                'pertanyaan' => 'b. Prosedur Operasional Tetap (SOP) Telah Diterapkan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'i. Prosedur Operasional Tetap (SOP) Kegiatan Utama',
                'pertanyaan' => 'c. Prosedur Operasional Tetap (SOP) Telah Dievaluasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE)',
                'pertanyaan' => 'a. Sistem Pengukuran Kinerja Unit Sudah Menggunakan Teknologi Informasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE)',
                'pertanyaan' => 'b. Operasionalisasi Manajemen SDM Sudah Menggunakan Teknologi Informasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE)',
                'pertanyaan' => 'c. Pemberian Pelayanan Kepada Publik Sudah Menggunakan Teknologi Informasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE)',
                'pertanyaan' => 'd. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Pemanfaatan Teknologi Informasi Dalam Pengukuran Kinerja Unit, Operasionalisasi SDM, Dan Pemberian Layanan Kepada Publik',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'iii. Keterbukaan Informasi Publik',
                'pertanyaan' => 'a. Kebijakan Tentang Keterbukaan Informasi Publik Telah Diterapkan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'iii. Keterbukaan Informasi Publik',
                'pertanyaan' => 'b. Telah Dilakukan Monitoring Dan Evaluasi Pelaksanaan Kebijakan Keterbukaan Informasi Publik',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'i. Perencanaan Kebutuhan Pegawai Sesuai Dengan Kebutuhan Organisasi',
                'pertanyaan' => 'a. Kebutuhan Pegawai Yang Disusun Oleh Unit Kerja Mengacu Kepada Peta Jabatan Dan Hasil Analisis Beban Kerja Untuk Masing-Masing Jabatan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'i. Perencanaan Kebutuhan Pegawai Sesuai Dengan Kebutuhan Organisasi',
                'pertanyaan' => 'b. Penempatan Pegawai Hasil Rekrutmen Murni Mengacu Kepada Kebutuhan Pegawai Yang Telah Disusun Per Jabatan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'i. Perencanaan Kebutuhan Pegawai Sesuai Dengan Kebutuhan Organisasi',
                'pertanyaan' => 'c. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Penempatan Pegawai Rekrutmen Untuk Memenuhi Kebutuhan Jabatan Dalam Organisasi Telah Memberikan Perbaikan Terhadap Kinerja Unit Kerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'ii. Pola Mutasi Internal',
                'pertanyaan' => 'a. Dalam Melakukan Pengembangan Karier Pegawai, Telah Dilakukan Mutasi Pegawai Antar Jabatan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'ii. Pola Mutasi Internal',
                'pertanyaan' => 'b. Dalam Melakukan Mutasi Pegawai Antar Jabatan Telah Memperhatikan Kompetensi Jabatan Dan Mengikuti Pola Mutasi Yang Telah Ditetapkan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'ii. Pola Mutasi Internal',
                'pertanyaan' => 'c. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Kegiatan Mutasi Yang Telah Dilakukan Dalam Kaitannya Dengan Perbaikan Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'a. Unit Kerja Melakukan Training Need Analysis Untuk Pengembangan Kompetensi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'b. Dalam Menyusun Rencana Pengembangan Kompetensi Pegawai, Telah Mempertimbangkan Hasil Pengelolaan Kinerja Pegawai',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'c. Tingkat Kesenjangan Kompetensi Pegawai Yang Ada Dengan Standar Kompetensi Yang Ditetapkan Untuk Masing-Masing Jabatan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'd. Pegawai Di Unit Kerja Telah Memperoleh Kesempatan/Hak Untuk Mengikuti Diklat Maupun Pengembangan Kompetensi Lainnya',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'e. Dalam Pelaksanaan Pengembangan Kompetensi, Unit Kerja Melakukan Upaya Pengembangan Kompetensi Kepada Pegawai (Seperti Pengikutsertaan Pada Lembaga Pelatihan, In-House Training, Coaching, Atau Mentoring)',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
                'pertanyaan' => 'f. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Hasil Pengembangan Kompetensi Dalam Kaitannya Dengan Perbaikan Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iv. Penetapan Kinerja Individu',
                'pertanyaan' => 'a. Terdapat Penetapan Kinerja Individu Yang Terkait Dengan Perjanjian Kinerja Organisasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iv. Penetapan Kinerja Individu',
                'pertanyaan' => 'b. Ukuran Kinerja Individu Telah Memiliki Kesesuaian Dengan Indikator Kinerja Individu Level Diatasnya',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iv. Penetapan Kinerja Individu',
                'pertanyaan' => 'c. Pengukuran Kinerja Individu Dilakukan Secara Periodik',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iv. Penetapan Kinerja Individu',
                'pertanyaan' => 'd. Hasil Penilaian Kinerja Individu Telah Dijadikan Dasar Untuk Pemberian Reward',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'v. Penegakan Aturan Disiplin/Kode Etik/Kode Perilaku Pegawai',
                'pertanyaan' => 'a. Aturan Disiplin/Kode Etik/Kode Perilaku Telah Dilaksanakan/Diimplementasikan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'vi. Sistem Informasi Kepegawaian',
                'pertanyaan' => 'a. Data Informasi Kepegawaian Unit Kerja Telah Dimutakhirkan Secara Berkala',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'i. Keterlibatan Pimpinan',
                'pertanyaan' => 'a. Unit Kerja Telah Melibatkan Pimpinan Secara Langsung Pada Saat Penyusunan Perencanaan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'i. Keterlibatan Pimpinan',
                'pertanyaan' => 'b. Unit Kerja Telah Melibatkan Secara Langsung Pimpinan Saat Penyusunan Penetapan Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'i. Keterlibatan Pimpinan',
                'pertanyaan' => 'c. Pimpinan Memantau Pencapaian Kinerja Secara Berkala',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'a. Dokumen Perencanaan Kinerja Sudah Ada',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'b. Perencanaan Kinerja Telah Berorientasi Hasil',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'c. Terdapat Penetapan Indikator Kinerja Utama (IKU)',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'd. Indikator Kinerja Telah Memenuhi Kriteria SMART',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'e. Laporan Kinerja Telah Disusun Tepat Waktu',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'f. Laporan Kinerja Telah Memberikan Informasi Tentang Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'g. Terdapat Sistem Informasi/Mekanisme Informasi Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
                'pertanyaan' => 'h. Unit Kerja Telah Berupaya Meningkatkan Kapasitas SDM Yang Menangani Akuntabilitas Kinerja',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'i. Pengendalian Gratifikasi',
                'pertanyaan' => 'a. Telah Dilakukan Public Campaign Tentang Pengendalian Gratifikasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'i. Pengendalian Gratifikasi',
                'pertanyaan' => 'b. Pengendalian Gratifikasi Telah Diimplementasikan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'ii. Penerapan Sistem Pengawasan Internal Pemerintah (SPIP)',
                'pertanyaan' => 'a. Telah Dibangun Lingkungan Pengendalian',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'ii. Penerapan Sistem Pengawasan Internal Pemerintah (SPIP)',
                'pertanyaan' => 'b. Telah Dilakukan Penilaian Risiko Atas Pelaksanaan Kebijakan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'ii. Penerapan Sistem Pengawasan Internal Pemerintah (SPIP)',
                'pertanyaan' => 'c. Telah Dilakukan Kegiatan Pengendalian Untuk Meminimalisir Risiko Yang Telah Diidentifikasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'ii. Penerapan Sistem Pengawasan Internal Pemerintah (SPIP)',
                'pertanyaan' => 'd. SPI Telah Diinformasikan Dan Dikomunikasikan Kepada Seluruh Pihak Terkait',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'iii. Pengaduan Masyarakat',
                'pertanyaan' => 'a. Kebijakan Pengaduan Masyarakat Telah Diimplementasikan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'iii. Pengaduan Masyarakat',
                'pertanyaan' => 'b. Pengaduan Masyarakat Ditindaklanjuti',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'iii. Pengaduan Masyarakat',
                'pertanyaan' => 'c. Telah Dilakukan Monitoring Dan Evaluasi Atas Penanganan Pengaduan Masyarakat',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'iii. Pengaduan Masyarakat',
                'pertanyaan' => 'd. Hasil Evaluasi Atas Penanganan Pengaduan Masyarakat Telah Ditindaklanjuti',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'iv. Whistle-Blowing System',
                'pertanyaan' => 'a. Whistle-Blowing System Telah Diterapkan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'iv. Whistle-Blowing System',
                'pertanyaan' => 'b. Telah Dilakukan Evaluasi Atas Penerapan Whistle-Blowing System',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'iv. Whistle-Blowing System',
                'pertanyaan' => 'c. Hasil Evaluasi Atas Penerapan Whistle-Blowing System Telah Ditindaklanjuti',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'v. Penanganan Benturan Kepentingan',
                'pertanyaan' => 'a. Telah Terdapat Identifikasi/Pemetaan Benturan Kepentingan Dalam Tugas Fungsi Utama',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'v. Penanganan Benturan Kepentingan',
                'pertanyaan' => 'b. Penanganan Benturan Kepentingan Telah Disosialisasikan/Internalisasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'v. Penanganan Benturan Kepentingan',
                'pertanyaan' => 'c. Penanganan Benturan Kepentingan Telah Diimplementasikan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'v. Penanganan Benturan Kepentingan',
                'pertanyaan' => 'd. Telah Dilakukan Evaluasi Atas Penanganan Benturan Kepentingan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'v. Penanganan Benturan Kepentingan',
                'pertanyaan' => 'e. Hasil Evaluasi Atas Penanganan Benturan Kepentingan Telah Ditindaklanjuti',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Standar Pelayanan',
                'pertanyaan' => 'a. Terdapat Kebijakan Standar Pelayanan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Standar Pelayanan',
                'pertanyaan' => 'b. Standar Pelayanan Telah Dimaklumatkan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Standar Pelayanan',
                'pertanyaan' => 'c. Dilakukan Reviu Dan Perbaikan Atas Standar Pelayanan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Standar Pelayanan',
                'pertanyaan' => 'd. Telah Melakukan Publikasi Atas Standar Pelayanan Dan Maklumat Pelayanan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'ii. Budaya Pelayanan Prima',
                'pertanyaan' => 'a. Telah Dilakukan Berbagai Upaya Peningkatan Kemampuan Dan/Atau Kompetensi Tentang Penerapan Budaya Pelayanan Prima',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'ii. Budaya Pelayanan Prima',
                'pertanyaan' => 'b. Informasi Tentang Pelayanan Mudah Diakses Melalui Berbagai Media',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'ii. Budaya Pelayanan Prima',
                'pertanyaan' => 'c. Telah Terdapat Sistem Pemberian Penghargaan Dan Sanksi Bagi Petugas Pemberi Pelayanan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'ii. Budaya Pelayanan Prima',
                'pertanyaan' => 'd. Telah Terdapat Sistem Pemberian Kompensasi Kepada Penerima Layanan Bila Layanan Tidak Sesuai Standar',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'ii. Budaya Pelayanan Prima',
                'pertanyaan' => 'e. Terdapat Sarana Layanan Terpadu/Terintegrasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'ii. Budaya Pelayanan Prima',
                'pertanyaan' => 'f. Terdapat Inovasi Pelayanan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'iii. Pengelola Pengaduan',
                'pertanyaan' => 'a. Terdapat Media Pengaduan Dan Konsultasi Pelayanan Yang Terintegrasi Dengan SP4N-Lapor!',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'iii. Pengelola Pengaduan',
                'pertanyaan' => 'b. Terdapat Unit Yang Mengelola Pengaduan Dan Konsultasi Pelayanan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'iii. Pengelola Pengaduan',
                'pertanyaan' => 'c. Telah Dilakukan Evaluasi Atas Penanganan Keluhan/Masukan Dan Konsultasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'iv. Penilaian Kepuasan Terhadap Pelayanan',
                'pertanyaan' => 'a. Telah Dilakukan Survei Kepuasan Masyarakat Terhadap Pelayanan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'iv. Penilaian Kepuasan Terhadap Pelayanan',
                'pertanyaan' => 'b. Hasil Survei Kepuasan Masyarakat Dapat Diakses Secara Terbuka',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'iv. Penilaian Kepuasan Terhadap Pelayanan',
                'pertanyaan' => 'c. Dilakukan Tindak Lanjut Atas Hasil Survei Kepuasan Masyarakat',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'v. Pemanfaatan Teknologi Informasi',
                'pertanyaan' => 'a. Telah Menerapkan Teknologi Informasi Dalam Memberikan Pelayanan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'v. Pemanfaatan Teknologi Informasi',
                'pertanyaan' => 'b. Telah Dilakukan Perbaikan Secara Terus Menerus',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'I. Pemenuhan',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'v. Pemanfaatan Teknologi Informasi',
                'pertanyaan' => 'c. Telah Membangun Database Pelayanan Yang Terintegrasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'i. Komitmen Dalam Perubahan',
                'pertanyaan' => 'a. Agen Perubahan Telah Membuat Perubahan Yang Konkret Di Instansi (Dalam 1 Tahun)',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'i. Komitmen Dalam Perubahan',
                'pertanyaan' => 'b. Perubahan Yang Dibuat Agen Perubahan Telah Terintegrasi Dalam Sistem Manajemen',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'ii. Komitmen Pimpinan',
                'pertanyaan' => 'a. Pimpinan Memiliki Komitmen Terhadap Pelaksanaan Reformasi Birokrasi, Dengan Adanya Target Capaian Reformasi Yang Jelas Di Dokumen Perencanaan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '1. Manajemen Perubahan',
                'subpilar' => 'iii. Membangun Budaya Kerja',
                'pertanyaan' => 'a. Instansi Membangun Budaya Kerja Positif Dan Menerapkan Nilai-Nilai Organisasi Dalam Pelaksanaan Tugas Sehari-Hari',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'i. Peta Proses Bisnis Mempengaruhi Penyederhanaan Jabatan',
                'pertanyaan' => 'a. Telah Disusun Peta Proses Bisnis Dengan Adanya Penyederhanaan Jabatan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE) Yang Terintegrasi',
                'pertanyaan' => 'a. Implementasi SPBE Telah Terintegrasi Dan Mampu Mendorong Pelaksanaan Pelayanan Publik Yang Lebih Cepat Dan Efisien',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE) Yang Terintegrasi',
                'pertanyaan' => 'b. Implementasi SPBE Telah Terintegrasi Dan Mampu Mendorong Pelaksanaan Pelayanan Internal Organisasi Yang Lebih Cepat Dan Efisien',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'iii. Transformasi Digital Memberikan Nilai Manfaat',
                'pertanyaan' => 'a. Transformasi Digital Pada Bidang Proses Bisnis Utama Telah Mampu Memberikan Nilai Manfaat Bagi Unit Kerja Secara Optimal',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'iii. Transformasi Digital Memberikan Nilai Manfaat',
                'pertanyaan' => 'b. Transformasi Digital Pada Bidang Administrasi Pemerintahan Telah Mampu Memberikan Nilai Manfaat Bagi Unit Kerja Secara Optimal',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '2. Penataan Tatalaksana',
                'subpilar' => 'iii. Transformasi Digital Memberikan Nilai Manfaat',
                'pertanyaan' => 'c. Transformasi Digital Pada Bidang Pelayanan Publik Telah Mampu Memberikan Nilai Manfaat Bagi Unit Kerja Secara Optimal',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'i. Kinerja Individu',
                'pertanyaan' => 'a. Ukuran Kinerja Individu Telah Berorientasi Hasil (Outcome) Sesuai Pada Levelnya',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'ii. Assessment Pegawai',
                'pertanyaan' => 'a. Hasil Assessment Telah Dijadikan Pertimbangan Untuk Mutasi Dan Pengembangan Karir Pegawai',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
                'subpilar' => 'iii. Pelanggaran Disiplin Pegawai',
                'pertanyaan' => 'a. Penurunan Pelanggaran Disiplin Pegawai',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'i. Meningkatnya Capaian Kinerja Unit Kerja',
                'pertanyaan' => 'a. Persentase Sasaran Dengan Capaian 100% Atau Lebih',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'ii. Pemberian Reward And Punishment',
                'pertanyaan' => 'a. Hasil Capaian/Monitoring Perjanjian Kinerja Telah Dijadikan Dasar Sebagai Pemberian Reward And Punishment Bagi Organisasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '4. Penguatan Akuntabilitas',
                'subpilar' => 'iii. Kerangka Logis Kinerja',
                'pertanyaan' => 'a. Apakah Terdapat Penjenjangan Kinerja (Kerangka Logis Kinerja) Yang Mengacu Pada Kinerja Utama Organisasi Dan Dijadikan Dalam Penentuan Kinerja Seluruh Pegawai?',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'i. Mekanisme Pengendalian',
                'pertanyaan' => 'a. Telah Dilakukan Mekanisme Pengendalian Aktivitas Secara Berjenjang',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'ii. Penanganan Pengaduan Masyarakat',
                'pertanyaan' => 'a. Persentase Penanganan Pengaduan Masyarakat',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '5. Penguatan Pengawasan',
                'subpilar' => 'iii. Penyampaian Laporan Harta Kekayaan',
                'pertanyaan' => 'a. Persentase Penyampaian LHKPN',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Upaya Dan/Atau Inovasi Pelayanan Publik',
                'pertanyaan' => 'a. Upaya Dan/Atau Inovasi Telah Mendorong Perbaikan Pelayanan Publik Pada: 1. Kesesuaian Persyaratan 2. Kemudahan Sistem, Mekanisme, Dan Prosedur 3. Kecepatan Waktu Penyelesaian 4. Kejelasan Biaya/Tarif, Gratis 5. Kualitas Produk Spesifikasi Jenis Pelayanan 6. Kompetensi Pelaksana/Web 7. Perilaku Pelaksana/Web 8. Kualitas Sarana Dan Prasarana 9. Penanganan Pengaduan, Saran Dan Masukan',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'i. Upaya Dan/Atau Inovasi Pelayanan Publik',
                'pertanyaan' => 'b. Upaya Dan/Atau Inovasi Pada Perijinan/Pelayanan Telah Dipermudah: 1. Waktu Lebih Cepat 2. Pelayanan Publik Yang Terpadu 3. Alur Lebih Pendek/Singkat 4. Terintegrasi Dengan Aplikasi',
            ],
            [
                'aspek' => 'A. Pengungkit',
                'area' => 'II. Reform',
                'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
                'subpilar' => 'ii. Penanganan Pengaduan Pelayanan Dan Konsultasi',
                'pertanyaan' => 'a. Penanganan Pengaduan Pelayanan Dilakukan Melalui Berbagai Kanal/Media Secara Responsif Dan Bertanggung Jawab',
            ],
        ];

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