<?php

// config/zi_checklist.php

return [
    /*
    |--------------------------------------------------------------------------
    | Data Master Checklist Zona Integritas (ZI)
    |--------------------------------------------------------------------------
    |
    | File ini berisi semua data statis untuk checklist ZI.
    | Dipisahkan dari controller untuk menjaga kebersihan kode.
    |
    */

    'data' => [
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'i. Penyusunan Tim Kerja',
            'pertanyaan' => 'a. Unit Kerja Telah Membentuk Tim Untuk Melakukan Pembangunan Zona Integritas',
            'rencana_aksi' => <<<EOT
Uraian: Penyusunan Tim Kerja ZI Tahun 2025
Output: Tim kerja Pembangunan ZI
Dokumen: SK Tim Kerja ZI
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Evita
EOT,
            'petugas_id' => 28,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'i. Penyusunan Tim Kerja',
            'pertanyaan' => 'b. Penentuan Anggota Tim Dipilih Melalui Prosedur/Mekanisme Yang Jelas',
            'rencana_aksi' => <<<EOT
Uraian: Rapat penyusunan tim kerja ZI Tahun 2025
Output: Prosedur/mekanisme penentuan anggota tim
Dokumen: ND, Notulen, Dokumentasi, Daftar Hadir
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Evita
EOT,
            'petugas_id' => 19,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'ii. Rencana Pembangunan Zona Integritas',
            'pertanyaan' => 'a. Terdapat Dokumen Rencana Kerja Pembangunan Zona Integritas Menuju WBK/WBBM',
            'rencana_aksi' => <<<EOT
Uraian: Pembuatan dokumen rencana kerja pembangunan ZI
Output: Rencana pembangunan WBK
Dokumen: ND Rapat pembuatan rencana kerja
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 28,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'ii. Rencana Pembangunan Zona Integritas',
            'pertanyaan' => 'b. Dalam Dokumen Pembangunan Terdapat Target-Target Prioritas Yang Relevan Dengan Tujuan Pembangunan WBK/WBBM',
            'rencana_aksi' => <<<EOT
Uraian: Penentuan target prioritas
Output: Adanya target prioritas pembangunan ZI
Dokumen: ND Rapat pembuatan rencana kerja
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 28,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'ii. Rencana Pembangunan Zona Integritas',
            'pertanyaan' => 'c. Terdapat Mekanisme Atau Media Untuk Mensosialisasikan Pembangunan WBK/WBBM',
            'rencana_aksi' => <<<EOT
Uraian: Sosialisasi pembangunan ZI WBK
Output: Sosialisasi secara online dan offline
Dokumen: Screenshoot Media Sosial Website, Spanduk banner
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 15,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'iii. Pemantauan Dan Evaluasi Pembangunan WBK/WBBM',
            'pertanyaan' => 'a. Seluruh Kegiatan Pembangunan Sudah Dilaksanakan Sesuai Dengan Rencana',
            'rencana_aksi' => <<<EOT
Uraian: Evaluasi pembangunan WBK
Output: Rapat evaluasi pembanguan ZI WBK
Dokumen: ND Rapat evaluasi eva pelaksanaan WBK
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 27,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'iii. Pemantauan Dan Evaluasi Pembangunan WBK/WBBM',
            'pertanyaan' => 'b. Terdapat Monitoring Dan Evaluasi Terhadap Pembangunan Zona Integritas',
            'rencana_aksi' => <<<EOT
Uraian: Monitoring dan evaluasi pembangunan ZI
Output: Pemantauan dan evaluasi kegiatan
Dokumen: Laporan monitoring pelaksanaan ZI
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 4,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'iii. Pemantauan Dan Evaluasi Pembangunan WBK/WBBM',
            'pertanyaan' => 'c. Hasil Monitoring Dan Evaluasi Telah Ditindaklanjuti',
            'rencana_aksi' => <<<EOT
Uraian: Tindak lanjut hasil monitoring dan evaluasi pembangunan ZI
Output: Tindak lanjut hasil monitoring dan evaluasi
Dokumen: Laporan tindak monitoring pelaksanaan ZI
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 4,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'iv. Perubahan Pola Pikir Dan Budaya Kerja',
            'pertanyaan' => 'a. Pimpinan Berperan Sebagai Role Model Dalam Pelaksanaan Pembangunan WBK/WBBM',
            'rencana_aksi' => <<<EOT
Uraian: Pimpinan menjadi role model dalam pelaksanaan pembangunan ZI
Output: Kehadiran Kepala BPS di dan serta kekayaan pajak
Dokumen: Dokumentasi keikutsertaan kepala kantor, bukti LHKPN, SPT, Pakta Integritas, Laporan pelaporan rapat dan daftar hadir kepala kantor
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 28,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'iv. Perubahan Pola Pikir Dan Budaya Kerja',
            'pertanyaan' => 'b. Sudah Ditetapkan Agen Perubahan',
            'rencana_aksi' => <<<EOT
Uraian: Penetapan Change Ambassador (CA)
Output: Terpilihnya Change Ambassador (CA)
Dokumen: ND Surat penetapan CA, SK Penetapan CA
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 28,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'iv. Perubahan Pola Pikir Dan Budaya Kerja',
            'pertanyaan' => 'c. Telah Dibangun Budaya Kerja Dan Pola Pikir Di Lingkungan Organisasi',
            'rencana_aksi' => <<<EOT
Uraian: Pembangunan budaya kerja dan pola pikir di BPS Kabupaten Nias
Output: Perubahan budaya kerja dan pola pikir pegawai sesuai nilai-nilai Berakhlak
Dokumen: ND dengan agenda RB. Notulen, dokumentasi, daftar hadir
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 28,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'iv. Perubahan Pola Pikir Dan Budaya Kerja',
            'pertanyaan' => 'd. Anggota Organisasi Terlibat Dalam Pembangunan Zona Integritas Menuju WBK/WBBM',
            'rencana_aksi' => <<<EOT
Uraian: Keterlibatan anggota tim dalam pembangunan WBK
Output: Setiap pegawai terlibat dalam setiap rapat pelaksanaan kegiatan dan memberi masukan
Dokumen: ND Rapat, Notulen, Dokumentasi, daftar hadir dengan agenda pembangunan ZI
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Elvira
EOT,
            'petugas_id' => 27,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'i. Prosedur Operasional Tetap (SOP) Kegiatan Utama',
            'pertanyaan' => 'a. SOP Mengacu Pada Peta Proses Bisnis Instansi',
            'rencana_aksi' => <<<EOT
Uraian: SOP mengacu pada peta proses bisnis instansi
Output: 1. SOP 2. Dokumen Inovasi
Dokumen: i. Dokumen SOP Teknis dan Non Teknis/Administrasi BPS Kabupaten Nias ii. Dokumen SOP Inovasi
Tim Kerja Terkait: Disesuaikan dengan Tim Kerja
Pemeriksa: Elvira
EOT,
            'petugas_id' => 12,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'i. Prosedur Operasional Tetap (SOP) Kegiatan Utama',
            'pertanyaan' => 'b. Prosedur Operasional Tetap (SOP) Telah Diterapkan',
            'rencana_aksi' => <<<EOT
Uraian: Penerapan prosedur operasional tetap/SOP
Output: 1. SOP 2. Dokumen Inovasi dan profil SOP
Dokumen: i. Dokumen monitoring penerapan SOP ii. Dokumen SOP Inovasi
Tim Kerja Terkait: Disesuaikan dengan Tim Kerja
Pemeriksa: Elvira
EOT,
            'petugas_id' => 12,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'i. Prosedur Operasional Tetap (SOP) Kegiatan Utama',
            'pertanyaan' => 'c. Prosedur Operasional Tetap (SOP) Telah Dievaluasi',
            'rencana_aksi' => <<<EOT
Uraian: Evaluasi prosedur operasional tetap/SOP
Output: Dokumen Monev SOP
Dokumen: i. Buki pelaksanaan rapat evaluasi SOP (Undangan, Daftar Hadir, Notulen); ii. Kertas kerja evaluasi SOP iii. Dokumen SOP awal dan SOP perbaikan
Tim Kerja Terkait: Pilar 2
Pemeriksa: Elvira
EOT,
            'petugas_id' => 12,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE)',
            'pertanyaan' => 'a. Sistem Pengukuran Kinerja Unit Sudah Menggunakan Teknologi Informasi',
            'rencana_aksi' => <<<EOT
Uraian: Penggunaan TI dalam sistem pengukuran kinerja
Output: Sistem pengukuran kinerja berbasis TI
Dokumen: i. Daftar seluruh penerapan teknologi informasi yang digunakan satker terkait pengukuran kinerja unit ii. Dokumen Screenshot aplikasi terkait pengukuran kinerja unit dan sudah berjalan iii. Inovasi dilengkapi dengan Laporan Pemanfaatan
Tim Kerja Terkait: Tim Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 10,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE)',
            'pertanyaan' => 'b. Operasionalisasi Manajemen SDM Sudah Menggunakan Teknologi Informasi',
            'rencana_aksi' => <<<EOT
Uraian: Penggunaan TI dalam operasionalisasi manajemen SDM
Output: Operasionalisasi manajemen SDM berbasis TI
Dokumen: i. Daftar seluruh penerapan teknologi informasi yang digunakan satker terkait operasionalisasi manajemen SDM ii. Dokumen Screenshot aplikasi terkait operasionalisasi manajemen SDM dan sudah berjalan iii. Inovasi dilengkapi dengan Laporan Pemanfaatan Aplikasi
Tim Kerja Terkait: Tim Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 10,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE)',
            'pertanyaan' => 'c. Pemberian Pelayanan Kepada Publik Sudah Menggunakan Teknologi Informasi',
            'rencana_aksi' => <<<EOT
Uraian: Penggunaan TI dalam pemberian layanan publik
Output: Pemberian layanan publik berbasis TI
Dokumen: i. Daftar seluruh penerapan teknologi informasi yang digunakan satker terkait pemberian pelayanan publik ii. Dokumen Screenshot aplikasi terkait pelayanan publik dan sudah berjalan iii. Inovasi dilengkapi dengan Laporan Pemanfaatan Aplikasi
Tim Kerja Terkait: Tim Diseminasi, Pengelolaan PST, dan Website (DIPWEB)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 10,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE)',
            'pertanyaan' => 'd. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Pemanfaatan Teknologi Informasi Dalam Pengukuran Kinerja Unit, Operasionalisasi SDM, Dan Pemberian Layanan Kepada Publik',
            'rencana_aksi' => <<<EOT
Uraian: Telah dilakukan monitoring dan evaluasi terhadap pemanfaatan teknologi informasi dalam pengukuran kinerja unit, operasionalisasi SDM, dan pemberian layanan kepada publik
Output: Monev sistem informasi
Dokumen: i. Laporan monitoring dan evaluasi pemanfaatan TI ii. Dokumentasi rapat monitoring dan evaluasi pemanfaatan TI
Tim Kerja Terkait: Tim Subbag Umum, dan Tim Diseminasi, Pengelolaan PST, dan Website (DIPWEB)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 3,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'iii. Keterbukaan Informasi Publik',
            'pertanyaan' => 'a. Kebijakan Tentang Keterbukaan Informasi Publik Telah Diterapkan',
            'rencana_aksi' => <<<EOT
Uraian: Penerapan kebijakan tentang keterbukaan informasi publik
Output: Layanan Informasi publik
Dokumen: i. SK PPID 2025 ii. Daftar informasi publik satker yang dapat diakses iii. Screen shot media pengelolaan informasi publik satker.
Tim Kerja Terkait: Tim PPID, dan Tim Diseminasi, Pengelolaan PST, dan Website (DIPWEB)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 3,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'iii. Keterbukaan Informasi Publik',
            'pertanyaan' => 'b. Telah Dilakukan Monitoring Dan Evaluasi Pelaksanaan Kebijakan Keterbukaan Informasi Publik',
            'rencana_aksi' => <<<EOT
Uraian: Monitoring penerapan kebijakan tentang keterbukaan informasi publik
Output: Monev Kehumasan
Dokumen: Laporan berkala monitoring dan evaluasi pelaksanaan kebijakan keterbukaan informasi publik dan bukti tindak lanjutnya
Tim Kerja Terkait: Tim PPID, Tim Diseminasi, Pengelolaan PST, dan Website (DIPWEB)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 20,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'i. Perencanaan Kebutuhan Pegawai Sesuai Dengan Kebutuhan Organisasi',
            'pertanyaan' => 'a. Kebutuhan Pegawai Yang Disusun Oleh Unit Kerja Mengacu Kepada Peta Jabatan Dan Hasil Analisis Beban Kerja Untuk Masing-Masing Jabatan',
            'rencana_aksi' => <<<EOT
Uraian: Menyusun kebutuhan pegawai yang mengacu kepada peta jabatan dan hasil analisis beban kerja untuk masing-masing jabatan
Output: Kebutuhan pegawai berdasarkan peta jabatan dan hasil analisis beban kerja
Dokumen: Kebutuhan pegawai berdasarkan peta jabatan dan hasil analisis beban kerja
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 11,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'i. Perencanaan Kebutuhan Pegawai Sesuai Dengan Kebutuhan Organisasi',
            'pertanyaan' => 'b. Penempatan Pegawai Hasil Rekrutmen Murni Mengacu Kepada Kebutuhan Pegawai Yang Telah Disusun Per Jabatan',
            'rencana_aksi' => <<<EOT
Uraian: Menempatkan pegawai sesuai kebutuhan pegawai yang mengacu kepada kebutuhan pegawai yang telah disusun per jabatan
Output: SK penempatan pegawai hasil rekrutmen yang berpedoman pada kebutuhan pegawai
Dokumen: SK penempatan pegawai hasil rekrutmen yang berpedoman pada kebutuhan pegawai
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 11,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'i. Perencanaan Kebutuhan Pegawai Sesuai Dengan Kebutuhan Organisasi',
            'pertanyaan' => 'c. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Penempatan Pegawai Rekrutmen Untuk Memenuhi Kebutuhan Jabatan Dalam Organisasi Telah Memberikan Perbaikan Terhadap Kinerja Unit Kerja',
            'rencana_aksi' => <<<EOT
Uraian: Monitoring dan evaluasi penempatan pegawai untuk memenuhi kebutuhan
Output: Laporan Monev terhadap penempatan pegawai
Dokumen: Laporan Monev terhadap penempatan pegawai
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 11,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'ii. Pola Mutasi Internal',
            'pertanyaan' => 'a. Dalam Melakukan Pengembangan Karier Pegawai, Telah Dilakukan Mutasi Pegawai Antar Jabatan',
            'rencana_aksi' => <<<EOT
Uraian: Mutasi pegawai internal antar jabatan untuk pengembangan kompetensi
Output: Adanya mutasi antar tim kerja
Dokumen: SK Tim Kerja
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 7,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'ii. Pola Mutasi Internal',
            'pertanyaan' => 'b. Dalam Melakukan Mutasi Pegawai Antar Jabatan Telah Memperhatikan Kompetensi Jabatan Dan Mengikuti Pola Mutasi Yang Telah Ditetapkan',
            'rencana_aksi' => <<<EOT
Uraian: Pola mutasi memperhatikan aturan dan instruksi dan BPS Provinsi Sumut
Output: Cascading kegiatan disesuaikan dengan jabatan dan instruksi
Dokumen: Kertas Kerja alokasi Tim Kerja/Mutasi
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 7,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'ii. Pola Mutasi Internal',
            'pertanyaan' => 'c. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Kegiatan Mutasi Yang Telah Dilakukan Dalam Kaitannya Dengan Perbaikan Kinerja',
            'rencana_aksi' => <<<EOT
Uraian: Pengawasan terhadap mutasi yang telah dilaksanakan
Output: Laporan pengawasan terhadap pegawai beserta outputnya
Dokumen: Laporan kepada Pimpinan Satker
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 7,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
            'pertanyaan' => 'a. Unit Kerja Melakukan Training Need Analysis Untuk Pengembangan Kompetensi',
            'rencana_aksi' => <<<EOT
Uraian: Pegawai mengikuti Diklat/Pelatihan untuk pengembangan kompetensi
Output: Daftar pegawai yang sudah melakukan pengembangan kompetensi
Dokumen: 1. Laporan/ND usulan Pelatihan & Diklat seluruh pegawai 2. screenshot penggunaan aplikasi training
Tim Kerja Terkait: Subbag Umum (Layanan Pengembangan SOM, Hukum dan Fungsional)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 2,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
            'pertanyaan' => 'b. Dalam Menyusun Rencana Pengembangan Kompetensi Pegawai, Telah Mempertimbangkan Hasil Pengelolaan Kinerja Pegawai',
            'rencana_aksi' => <<<EOT
Uraian: menyusun rencana pengembangan kompetensi pegawai berdasarkan Capaian kinerja pegawai, komposisi diklat saat ini dan rencana diklat yg akan diikuti
Output: Rencana pengembangan kompetensi pegawai berdasarkan Capaian kinerja pegawai, komposisi diklat saat ini dan rencana diklat yg akan diikuti
Dokumen: Capaian kinerja pegawai komposisi diklat saat ini dan rencana diklat yg akan diikuti
Tim Kerja Terkait: Subbag Umum (Layanan Pengembangan SDM, Hukum dan Fungsional)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 2,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
            'pertanyaan' => 'c. Tingkat Kesenjangan Kompetensi Pegawai Yang Ada Dengan Standar Kompetensi Yang Ditetapkan Untuk Masing-Masing Jabatan',
            'rencana_aksi' => <<<EOT
Uraian: Daftar Pegawai dibandingkan dengan ABK
Output: Laporan kesenjangan pegawai
Dokumen: Kesenjangan Kompetensi dari Rekapitulasi Perbandingan JPM
Tim Kerja Terkait: Subbag Umum (Layanan Pengembangan SDM, Hukum dan Fungsional)
Pemeriksa: Yuris
EOT,
            'petugas_id' => 2,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
            'pertanyaan' => 'd. Pegawai Di Unit Kerja Telah Memperoleh Kesempatan/Hak Untuk Mengikuti Diklat Maupun Pengembangan Kompetensi Lainnya',
            'rencana_aksi' => <<<EOT
Uraian: Seluruh pegawai telah diberikan kesempatan/hak yang sama mengikuti diklat maupun workshop pengembangan kompetensi dalam mendukung pencapaian kinerja pegawai, rekomendasi tugas belajar izin belajar
Output: Pelatihan/Diklat
Dokumen: Sertifikat mengikuti Pelatihan/Diklat, Daftar pegawai tugas belajar/izin belajar
Tim Kerja Terkait: Subbag Umum (Layanan Pengembangan SOM, Hukum dan Fungsional)
Pemeriksa: Denuari
EOT,
            'petugas_id' => 2,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
            'pertanyaan' => 'e. Dalam Pelaksanaan Pengembangan Kompetensi, Unit Kerja Melakukan Upaya Pengembangan Kompetensi Kepada Pegawai (Seperti Pengikutsertaan Pada Lembaga Pelatihan, In-House Training, Coaching, Atau Mentoring)',
            'rencana_aksi' => <<<EOT
Uraian: Pegawai diusulkan untuk mengikuti beberapa pelatihan, coaching ataupun mentoring
Output: Pelatihan/Diklat yang diusulkan
Dokumen: 1. ND/Undangan, presensi, Notulen/isi materi, Foto Dokumentasi kegiatan pengembangan kompetensi pegawai 2. Rekapitulasi usulan diklat seluruh pegawai
Tim Kerja Terkait: Subbag Umum (Layanan Pengembangan SDM, Hukum dan Fungsional)
Pemeriksa: Denuari
EOT,
            'petugas_id' => 2,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iii. Pengembangan Pegawai Berbasis Kompetensi',
            'pertanyaan' => 'f. Telah Dilakukan Monitoring Dan Evaluasi Terhadap Hasil Pengembangan Kompetensi Dalam Kaitannya Dengan Perbaikan Kinerja',
            'rencana_aksi' => <<<EOT
Uraian: Monitoring dan evaluasi terhadap hasil pengembangan kompetensi
Output: Evaluasi terhadap hasil pengembangan kompetensi
Dokumen: Laporan Monitoring dan evaluasi
Tim Kerja Terkait: Subbag Umum (Layanan Pengembangan SDM, Hukum dan Fungsional)
Pemeriksa: Denuari
EOT,
            'petugas_id' => 2,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iv. Penetapan Kinerja Individu',
            'pertanyaan' => 'a. Terdapat Penetapan Kinerja Individu Yang Terkait Dengan Perjanjian Kinerja Organisasi',
            'rencana_aksi' => <<<EOT
Uraian: IKI yang disesuaikan dengan Perjanjian Kinerja (PK) Tahun 2025
Output: IKI yang dituangkan pada aplikasi KipApp
Dokumen: Kipapp
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Denuari
EOT,
            'petugas_id' => 29,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iv. Penetapan Kinerja Individu',
            'pertanyaan' => 'b. Ukuran Kinerja Individu Telah Memiliki Kesesuaian Dengan Indikator Kinerja Individu Level Diatasnya',
            'rencana_aksi' => <<<EOT
Uraian: IKI telah sesuai dengan Rencana Ketua Tim Kerja
Output: IKI dari Rencana Kerja (RK) Ketua Tim
Dokumen: Kipapp
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Denuari
EOT,
            'petugas_id' => 29,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iv. Penetapan Kinerja Individu',
            'pertanyaan' => 'c. Pengukuran Kinerja Individu Dilakukan Secara Periodik',
            'rencana_aksi' => <<<EOT
Uraian: Penilaian IKI dilakukan secara rutin per bulan
Output: Penilaian SKP Bulanan
Dokumen: Kipapp
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Denuari
EOT,
            'petugas_id' => 29,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iv. Penetapan Kinerja Individu',
            'pertanyaan' => 'd. Hasil Penilaian Kinerja Individu Telah Dijadikan Dasar Untuk Pemberian Reward',
            'rencana_aksi' => <<<EOT
Uraian: Penilaian IKI menjadi dasar pemberian Reward (penghargaan)
Output: Best employee per bulan
Dokumen: Kipapp
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Denuari
EOT,
            'petugas_id' => 29,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'v. Penegakan Aturan Disiplin/Kode Etik/Kode Perilaku Pegawai',
            'pertanyaan' => 'a. Aturan Disiplin/Kode Etik/Kode Perilaku Telah Dilaksanakan/Diimplementasikan',
            'rencana_aksi' => <<<EOT
Uraian: Semua pegawai melaksanakan semua aturan yang berlaku
Output: Semua pegawai melaksanakan semua aturan yang berlaku
Dokumen: SKP Bulanan & Tahunan untuk penilaian ASN Berakhlak
Tim Kerja Terkait: Subbag Umum (Layanan Pengembangan SOM, Hukum dan Fungsional)
Pemeriksa: Denuari
EOT,
            'petugas_id' => 7,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'vi. Sistem Informasi Kepegawaian',
            'pertanyaan' => 'a. Data Informasi Kepegawaian Unit Kerja Telah Dimutakhirkan Secara Berkala',
            'rencana_aksi' => <<<EOT
Uraian: Permutakhiran berkala data informasi Kepegawaian
Output: Data Kepegawaiaan yang terupdate (real time) melalui aplikasi sistim yang tersedia
Dokumen: Aplikasi Simpeg
Tim Kerja Terkait: Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Denuari
EOT,
            'petugas_id' => 7,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'i. Keterlibatan Pimpinan',
            'pertanyaan' => 'a. Unit Kerja Telah Melibatkan Pimpinan Secara Langsung Pada Saat Penyusunan Perencanaan',
            'rencana_aksi' => <<<EOT
Uraian: Melibatkan pimpinan dalam proses perencanaan
Output: Laporan kegiatan penyusunan renstra/renja/rkakl, profil risiko, rencana kerja ZI, dan perjanjian kinerja
Dokumen: 1. Laporan kegiatan penyusunan renstra/renja/rkakl 2. Laporan kegiatan penyusunan profil risiko 3. Laporan kegiatan penyusunan rencana kerja ZI 4. Laporan kegiatan penetapan perjanjian kinerja
Tim Kerja Terkait: Tim SAKIP, Tim ZI
Pemeriksa: Denuari
EOT,
            'petugas_id' => 16,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'i. Keterlibatan Pimpinan',
            'pertanyaan' => 'b. Unit Kerja Telah Melibatkan Secara Langsung Pimpinan Saat Penyusunan Penetapan Kinerja',
            'rencana_aksi' => <<<EOT
Uraian: Melibatkan pimpinan dalam penetapan kinerja
Output: Laporan kegiatan penyusunan, penandatanganan dan penetapan perjanjian kinerja
Dokumen: Laporan kegiatan penetapan perjanjian kinerja
Tim Kerja Terkait: Tim SAKIP, Tim ZI
Pemeriksa: Denuari
EOT,
            'petugas_id' => 16,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'i. Keterlibatan Pimpinan',
            'pertanyaan' => 'c. Pimpinan Memantau Pencapaian Kinerja Secara Berkala',
            'rencana_aksi' => <<<EOT
Uraian: Memantau pencapaian kinerja secara berkala
Output: Laporan capaian kinerja secara berkala
Dokumen: Undangan, notula (disertai kendala, solusi, tindak lanjut, PIC tindak lanjut dan batas waktu tindak lanjut), daftar hadir, foto rapat monitoring capaian kinerja (FRA triwulanan), sesuai pada Simonev
Tim Kerja Terkait: Tim SAKIP, Tim ZI
Pemeriksa: Denuari
EOT,
            'petugas_id' => 23,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
            'pertanyaan' => 'a. Dokumen Perencanaan Kinerja Sudah Ada',
            'rencana_aksi' => <<<EOT
Uraian: menyusun dokumen RKAKL
Output: RKAKL
Dokumen: RKAKL 2024 dan RKAKL 2025
Tim Kerja Terkait: Tim Keuangan
Pemeriksa: Denuari
EOT,
            'petugas_id' => 23,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
            'pertanyaan' => 'b. Perencanaan Kinerja Telah Berorientasi Hasil',
            'rencana_aksi' => <<<EOT
Uraian: Perencanaan kinerja telah berorientasi kepada hasil
Output: Laporan penetapan PK 2025 dan Laporan Penetapan SKP seluruh pegawai tahun 2025
Dokumen: 1. Dokumen PK 2025 yang ditandatangani oleh pimpinan 2. Dokumen daftar link PK 2025 yang diupload di PPID 3. Seluruh dokumen MPH dari aplikasi Kipapp yang ditandatangani oleh pimpinan
Tim Kerja Terkait: TIM SAKIP
Pemeriksa: Denuari
EOT,
            'petugas_id' => 23,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
            'pertanyaan' => 'c. Terdapat Penetapan Indikator Kinerja Utama (IKU)',
            'rencana_aksi' => <<<EOT
Uraian: Menetapkan IKI
Output: SKP dan Manual IKI
Dokumen: 1. Penetapan Kinerja, SKP dan Manual IK Kepala Kantor 2. SKP seluruh pegawai 3. Manual IKI Utama seluruh pegawai yang telah ditetapkan
Tim Kerja Terkait: TIM SAKIP
Pemeriksa: Kartika
EOT,
            'petugas_id' => 18,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
            'pertanyaan' => 'd. Indikator Kinerja Telah Memenuhi Kriteria SMART',
            'rencana_aksi' => <<<EOT
Uraian: menjelaskan bahwa IKI telah memenuhi kriteria SMART
Output: Dokumen kinerja dan penjelasan SMART IKU
Dokumen: 1. Perjanjian Kinerja, Pohon Kinerja SKP, dan Manual IKI Kepala Kantor 2. SKP seluruh pegawai 3. Manual IKI Utama seluruh pegawai yang telah ditetapkan
Tim Kerja Terkait: TIM SAKIP
Pemeriksa: Denuari
EOT,
            'petugas_id' => 18,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
            'pertanyaan' => 'e. Laporan Kinerja Telah Disusun Tepat Waktu',
            'rencana_aksi' => <<<EOT
Uraian: menyusun laporan kinerja
Output: laporan kinerja
Dokumen: 1. Dokumen Laporan Kinerja 2024 yang ditandatangani oleh pimpinan secara tepat waktu, 2. Dokumen daftar link Laporan Kinerja 2025 yang diupload di PPID 3. Screenshot bukti unggah Laporan Kinerja 2025 secara tepat waktu.
Tim Kerja Terkait: TIM SAKIP
Pemeriksa: Kartika
EOT,
            'petugas_id' => 18,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
            'pertanyaan' => 'f. Laporan Kinerja Telah Memberikan Informasi Tentang Kinerja',
            'rencana_aksi' => <<<EOT
Uraian: memastikan laporan kinerja memberikan informasi yang cukup tentang kinerja
Output: laporan kinerja
Dokumen: 1. Dokumen Laporan Kinerja 2024 yang ditandatangani oleh pimpinan 2. Dokumen daftar link Laporan Kinerja 2024 yang diupload di PPID
Tim Kerja Terkait: TIM SAKIP
Pemeriksa: Kartika
EOT,
            'petugas_id' => 22,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
            'pertanyaan' => 'g. Terdapat Sistem Informasi/Mekanisme Informasi Kinerja',
            'rencana_aksi' => <<<EOT
Uraian: memastikan aplikasi informasi kinerja digunakan
Output: aplikasi informasi kinerja
Dokumen: 1. Sreenshot pada aplikasi e-performance kepala kantor
Tim Kerja Terkait: TIM SAKIP
Pemeriksa: Kartika
EOT,
            'petugas_id' => 22,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'ii. Pengelolaan Akuntabilitas Kinerja',
            'pertanyaan' => 'h. Unit Kerja Telah Berupaya Meningkatkan Kapasitas SDM Yang Menangani Akuntabilitas Kinerja',
            'rencana_aksi' => <<<EOT
Uraian: meningkatkan kapasitas SDM yang menangani akuntabilitas kinerja
Output: pengelolaan akuntabilitas kinerja dilaksanakan oleh seluruh SDM yang kompeten
Dokumen: 1. SK Tim SAKIP Tahun 2025 2. Dokumen daftar data individu seluruh anggota Tim SAKIP yang memuat data kompetensi dan sertifikat pembinaan terkait akuntabilitas kinerja (akumulasi kompetensi hingga tahun 2025)
Tim Kerja Terkait: TIM SAKIP
Pemeriksa: Kartika
EOT,
            'petugas_id' => 22,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'i. Pengendalian Gratifikasi',
            'pertanyaan' => 'a. Telah Dilakukan Public Campaign Tentang Pengendalian Gratifikasi',
            'rencana_aksi' => <<<EOT
Uraian: Melakukan public campaign tentang pengendalian gratifikasi
Output: Public campaign tentang pengendalian gratifikasi
Dokumen: ND/undangan, daftar hadir, publikasi media cetak, spanduk, banner dan screenshot media sosial tentang pengendalian gratifikasi
Tim Kerja Terkait: Tim Subbag Umum (Tim Hubmas,) (Layanan Rumah Tangga & Protokoler)
Pemeriksa: Kartika
EOT,
            'petugas_id' => 25,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'i. Pengendalian Gratifikasi',
            'pertanyaan' => 'b. Pengendalian Gratifikasi Telah Diimplementasikan',
            'rencana_aksi' => <<<EOT
Uraian: Implementasi pengendalian gratifikasi
Output: Laporan pengendalian gratifikasi
Dokumen: 1 SK penetapan Unit Pengendalian Gratifikasi (UPG); 2. Laporan Rekapitulasi Penanganan Gratifikasi (Semesteran sesuaiPMK-227/PMK.09/2021); 3. Laporan Profiling Pegawai & Laporan tindak lanjut (jika ada ketidakwajaran) 4. Rencana Kerja dan Laporan/Output pelaksanaan tugas UPG 5. Pakta Integritas Internal (Pimpinan) dan Eksternal 6. Komitmen Anti Gratifikasi di internal unit kerja
Tim Kerja Terkait: Tim Pilar 5
Pemeriksa: Kartika
EOT,
            'petugas_id' => 25,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'ii. Penerapan Sistem Pengawasan Internal Pemerintah (SPIP)',
            'pertanyaan' => 'a. Telah Dibangun Lingkungan Pengendalian',
            'rencana_aksi' => <<<EOT
Uraian: Pembangunan lingkungan pengendalian
Output: Lingkungan pengendalian
Dokumen: 1. Kode Etik Pegawai 2. ND/notulensi/dokumentasi terkait Pimpinan menjadi Role Model) 3. Struktur Organisasi 4. Analisis Jabatan 5. ND mutasi pegawai dan analisis mutasi internal pegawai 6. Laporan Koordinasi 7. ND terkait inovasi pengendalian internal yang bersifat kearifan lokal
Tim Kerja Terkait: Tim PIPP
Pemeriksa: Kartika
EOT,
            'petugas_id' => 21,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'ii. Penerapan Sistem Pengawasan Internal Pemerintah (SPIP)',
            'pertanyaan' => 'b. Telah Dilakukan Penilaian Risiko Atas Pelaksanaan Kebijakan',
            'rencana_aksi' => <<<EOT
Uraian: Penilaian risiko atas pelaksanaan kebijakan
Output: Laporan Manajemen Risiko
Dokumen: Perwujudan peran aparat 1. Piagam Manajemen Risiko 2. Penetapan Konteks Manajemen Risiko 3. Formulir Profil Risiko dan Peta Risiko 4. Konsep Rencana Penanganan Risiko 5. Formulir Pemantauan Triwulanan laporan pemantauan profil risiko (triwulanan) 6. Manual Indikator Risiko Utama (IRU) 7. SK pimpinan unit kerja tentang pembentukan Tim pengelola risiko. 8. ND Inovasi terkait penilaian risiko sesuai karakteristik unit kerja
Tim Kerja Terkait: Tim PIPP
Pemeriksa: Kartika
EOT,
            'petugas_id' => 21,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'ii. Penerapan Sistem Pengawasan Internal Pemerintah (SPIP)',
            'pertanyaan' => 'c. Telah Dilakukan Kegiatan Pengendalian Untuk Meminimalisir Risiko Yang Telah Diidentifikasi',
            'rencana_aksi' => <<<EOT
Uraian: Pengendalian risiko Lingkungan pengendalian Laporan Manajemen Risiko
Output: Kegiatan pengendalian untuk meminimalisir risiko
Dokumen: 1. laporan Profil Risiko 2. laporan pemantauan profil risiko 3. ND Inovasi terkait penilaian risiko sesuai karakteristik unit kerja
Tim Kerja Terkait: Tim PIPP
Pemeriksa: Kartika
EOT,
            'petugas_id' => 21,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'ii. Penerapan Sistem Pengawasan Internal Pemerintah (SPIP)',
            'pertanyaan' => 'd. SPI Telah Diinformasikan Dan Dikomunikasikan Kepada Seluruh Pihak Terkait',
            'rencana_aksi' => <<<EOT
Uraian: Penyampaian. Informasi terkait SPI kepada seluruh pihak terkait
Output: Informasi terkait SPI kepada seluruh pihak terkait
Dokumen: 1. ND, undangan, daftar hadir, notulensi dan dokumentasi terkait sosialisasi SPI pada seluruh pegawai 2. ND, undangan, daftar hadir, notulensi dan dokumentasi terkait sosialisasi SPI pada stakeholders 3. Screenshot media sosial
Tim Kerja Terkait: Tim PIPP
Pemeriksa: Kartika
EOT,
            'petugas_id' => 21,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'iii. Pengaduan Masyarakat',
            'pertanyaan' => 'a. Kebijakan Pengaduan Masyarakat Telah Diimplementasikan',
            'rencana_aksi' => <<<EOT
Uraian: Implementasi kebijakan pengaduan masyarakat
Output: Kebijakan pengaduan masyarakat
Dokumen: Screenshoot Media Sosial
Tim Kerja Terkait: TIM PPID
Pemeriksa: Kartika
EOT,
            'petugas_id' => 6,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'iii. Pengaduan Masyarakat',
            'pertanyaan' => 'b. Pengaduan Masyarakat Ditindaklanjuti',
            'rencana_aksi' => <<<EOT
Uraian: Tindaklanjut pengaduan masyarakat
Output: Tindaklanjut pengaduan masyarakat
Dokumen: Laporan kegiatan pengelolaan pengaduan
Tim Kerja Terkait: TIM PPIDm 
Pemeriksa: Kartika
EOT,
            'petugas_id' => 6,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'iii. Pengaduan Masyarakat',
            'pertanyaan' => 'c. Telah Dilakukan Monitoring Dan Evaluasi Atas Penanganan Pengaduan Masyarakat',
            'rencana_aksi' => <<<EOT
Uraian: Melakukan monitoring dan evaluasi atas penanganan pengaduan masyarakat
Output: Laporan monev monitoring dan evaluasi atas penanganan pengaduan masyarakat
Dokumen: kegiatan pengelolaan pengaduan dan rekomendasi atas monev
Tim Kerja Terkait: TIM PPID
Pemeriksa: Kartika
EOT,
            'petugas_id' => 6,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'iii. Pengaduan Masyarakat',
            'pertanyaan' => 'd. Hasil Evaluasi Atas Penanganan Pengaduan Masyarakat Telah Ditindaklanjuti',
            'rencana_aksi' => <<<EOT
Uraian: Melakukan evaluasi atas penanganan pengaduan masyarakat telah ditindaklanjuti
Output: Evaluasi atas penanganan pengaduan masyarakat telah ditindaklanjuti
Dokumen: Laporan tindak lanjut hasil monitoring dan evaluasi atas penanganan pengaduan masyarakat
Tim Kerja Terkait: TIM PPID
Pemeriksa: Kartika
EOT,
            'petugas_id' => 6,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'iv. Whistle-Blowing System',
            'pertanyaan' => 'a. Whistle-Blowing System Telah Diterapkan',
            'rencana_aksi' => <<<EOT
Uraian: Sosialisasi Whistle Blowing System
Output: Penerapan Whistle Blowing System
Dokumen: ND, undangan, daftar hadir, notulensi dan dokumentasi terkait sosialisasi Whistle Blowing System
Tim Kerja Terkait: TIM PPID
Pemeriksa: Wisni
EOT,
            'petugas_id' => 13,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'iv. Whistle-Blowing System',
            'pertanyaan' => 'b. Telah Dilakukan Evaluasi Atas Penerapan Whistle-Blowing System',
            'rencana_aksi' => <<<EOT
Uraian: Monev penerapan Whistle Blowing System
Output: Monev penerapan Whistle Blowing System
Dokumen: Laporan pengelolaan WBS dengan outline a. Rekapitulasi jumlah aduan per bulan (jenis aduan); b. Rekapitulasi jumlah aduan per bulan (jenis aduan); c. Tindak lanjut WBS d. Kendala dan. solusi dalam penanganan WBS.
Tim Kerja Terkait: TIM PPID
Pemeriksa: Wisni
EOT,
            'petugas_id' => 13,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'iv. Whistle-Blowing System',
            'pertanyaan' => 'c. Hasil Evaluasi Atas Penerapan Whistle-Blowing System Telah Ditindaklanjuti',
            'rencana_aksi' => <<<EOT
Uraian: Evaluasi atas penerapan Whistle Blowing System telah ditindaklanjuti
Output: Laporan tindak lanjut atas monev penerapan Whistle Blowing System
Dokumen: Laporan pengelolaan WBS dengan outline: a. Rekapitulasi jumlah aduan per bulan (jenis aduan); b. Rekapitulasi jumlah aduan per bulan (jenis aduan); c. Tindak lanjut WBS d. Kendala dan solusi dalam penanganan WBS
Tim Kerja Terkait: TIM PPID
Pemeriksa: Wisni
EOT,
            'petugas_id' => 13,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'v. Penanganan Benturan Kepentingan',
            'pertanyaan' => 'a. Telah Terdapat Identifikasi/Pemetaan Benturan Kepentingan Dalam Tugas Fungsi Utama',
            'rencana_aksi' => <<<EOT
Uraian: Pemetaan benturan kepentingan dalam tugas fungsi utama
Output: Peta benturan kepentingan dalam tugas fungsi utama
Dokumen: 1. SE/ND terkait identifikasi/pemetaan Benturan Kepentingan berdasarkan lampiran Perka BPS Nomor 36 Tahun 2023 tentang Pedoman Penanganan Benturan Kepentingan di Lingkungan Badan Pusat Statistik halaman 23; 2. Matriks identifikasi/pemetaan hubungan istimewa
Tim Kerja Terkait: TIM PPID
Pemeriksa: Wisni
EOT,
            'petugas_id' => 26,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'v. Penanganan Benturan Kepentingan',
            'pertanyaan' => 'b. Penanganan Benturan Kepentingan Telah Disosialisasikan/Internalisasi',
            'rencana_aksi' => <<<EOT
Uraian: Sosialisasi/internalisasi penanganan benturan kepentingan
Output: Sosialisasi/internalisasi penanganan benturan kepentingan
Dokumen: ND undangan, daftar hadir, notulensi dan dokumentasi terkait sosialisasi benturan kepentingan kepada seluruh pegawai dan atau mitra
Tim Kerja Terkait: Subbag Umum (Layanan Pengembangan SOM, Hukum dan Fungsional) Tim PPID
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 26,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'v. Penanganan Benturan Kepentingan',
            'pertanyaan' => 'c. Penanganan Benturan Kepentingan Telah Diimplementasikan',
            'rencana_aksi' => <<<EOT
Uraian: Implementasi penanganan benturan Kepentingan
Output: Penanganan benturan kepentingan
Dokumen: 1. Laporan/ND penerapan penanganan Benturan Kepentingan pada unit kerja; 2. Dokumen surat pernyataan bebas dari benturan kepentingan untuk seluruh pegawai berdasarkan lampiran Perka BPS Nomor 36 Tahun 2023 tentang Pedoman Penanganan Benturan Kepentingan di Lingkungan Badan Pusat Statistik halaman 22
Tim Kerja Terkait: Tim Subbag Umum (Layanan Pengembangan SDM, Hukum dan Fungsional)
Pemeriksa: Wisni
EOT,
            'petugas_id' => 26,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'v. Penanganan Benturan Kepentingan',
            'pertanyaan' => 'd. Telah Dilakukan Evaluasi Atas Penanganan Benturan Kepentingan',
            'rencana_aksi' => <<<EOT
Uraian: Evaluasi atas Penanganan Benturan Kepentingan
Output: Evaluasi atas Penanganan Benturan Kepentingan
Dokumen: Laporan monitoring dan evaluasi penanganan benturan kepentingan berdasarkan lampiran Perka BPS Nomor 36 Tahun 2023 tentang Pedoman Penanganan Benturan Kepentingan di Lingkungan Badan Pusat Statistik halaman 25
Tim Kerja Terkait: Tim Subbag Umum (Layanan Pengembangan SDM, Hukum dan Fungsional)
Pemeriksa: Wisni
EOT,
            'petugas_id' => 26,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'v. Penanganan Benturan Kepentingan',
            'pertanyaan' => 'e. Hasil Evaluasi Atas Penanganan Benturan Kepentingan Telah Ditindaklanjuti',
            'rencana_aksi' => <<<EOT
Uraian: Evaluasi atas penanganan benturan kepentingan telah ditindaklanjuti
Output: Evaluasi atas penanganan benturan kepentingan telah ditindaklanjuti
Dokumen: Laporan Tindak Lanjut atas monev penanganan benturan kepentingan (100% telah ditindaklanjuti (mengacu pada rencana tindak lanjut di pertanyaan A.1.5.d)
Tim Kerja Terkait: Tim Subbag Umum (Layanan Pengembangan SDM, Hukum dan Fungsional)
Pemeriksa: Wisni
EOT,
            'petugas_id' => 26,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'i. Standar Pelayanan',
            'pertanyaan' => 'a. Terdapat Kebijakan Standar Pelayanan',
            'rencana_aksi' => <<<EOT
Uraian: Penyusunan Standar Pelayanan
Output: 1. Perka BPS tentang Standar Pelayanan Statistik Terpadu di Badan Pusat Statistik 2. SK Kepala BPS Kabupaten Nias tentang Standar Pelayanan pada BPS Kabupaten Nias
Dokumen: 1. Perka BPS tentang Standar Pelayanan Statistik Terpadu di Badan Pusat Statistik 2. SK Kepala BPS Kabupaten Nias tentang Standar Pelayanan pada BPS Kabupaten Nias
Tim Kerja Terkait: Tim PPID
Pemeriksa: Wisni
EOT,
            'petugas_id' => 8,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'i. Standar Pelayanan',
            'pertanyaan' => 'b. Standar Pelayanan Telah Dimaklumatkan',
            'rencana_aksi' => <<<EOT
Uraian: Standar Pelayanan telah dimaklumatkan
Output: 1. Maklumat Standar Pelayanan 2. SK Kepala BPS Kabupaten Nias tentang Maklumat Pelayanan
Dokumen: 1. Maklumat Standar Pelayanan 2. SK Kepala BPS Kabupaten Nias tentang Maklumat Pelayanan
Tim Kerja Terkait: Tim PPID, Tim DIPWEB
Pemeriksa: Wisni
EOT,
            'petugas_id' => 24,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'i. Standar Pelayanan',
            'pertanyaan' => 'c. Dilakukan Reviu Dan Perbaikan Atas Standar Pelayanan',
            'rencana_aksi' => <<<EOT
Uraian: Rapat reviu dan perbaikan atas Standar Pelayanan
Output: 1. Rapat reviu minimal 2 kali setahun
Dokumen: 1. UANG rapat reviu
Tim Kerja Terkait: Tim PPID
Pemeriksa: Wisni
EOT,
            'petugas_id' => 17,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'i. Standar Pelayanan',
            'pertanyaan' => 'd. Telah Melakukan Publikasi Atas Standar Pelayanan Dan Maklumat Pelayanan',
            'rencana_aksi' => <<<EOT
Uraian: Publisitas Standar Pelayanan dan Maklumat Standar Pelayanan
Output: 1. Maklumat Pelayanan tayang pada website dan media sosial 2. Standing banner Maklumat Pelayanan dan dipasang pada halaman/ruang PPID
Dokumen: 1. Maklumat Standar Pelayanan tayang pada website dan media sosial 2. Standing banner Maklumat Pelayanan dan dipasang pada halaman/ruang PPID
Tim Kerja Terkait: Tim DIPWEB dan Tim HUBMAS
Pemeriksa: Wisni
EOT,
            'petugas_id' => 24,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'ii. Budaya Pelayanan Prima',
            'pertanyaan' => 'a. Telah Dilakukan Berbagai Upaya Peningkatan Kemampuan Dan/Atau Kompetensi Tentang Penerapan Budaya Pelayanan Prima',
            'rencana_aksi' => <<<EOT
Uraian: Sosialisasi pelayanan prima
Output: 1. Sosialisasi pelayanan prima minimal 2 kali setahun
Dokumen: 1. UANG sosialisasi pelayanan prima
Tim Kerja Terkait: Tim PPID
Pemeriksa: Wisni
EOT,
            'petugas_id' => 30,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'ii. Budaya Pelayanan Prima',
            'pertanyaan' => 'b. Informasi Tentang Pelayanan Mudah Diakses Melalui Berbagai Media',
            'rencana_aksi' => <<<EOT
Uraian: Informasi tentang pelayanan BPS mudah diakses melalui berbagai media.
Output: 1. Maklumat Standar Pelayanan tampil langsung ketika buka Web BPS 2. Maklumat Standar Pelayanan jadi pinned post pada FB dan Instagram
Dokumen: 1. Maklumat Standar Pelayanan tampil langsung ketika buka Web 2. Maklumat Standar Pelayanan jadi pinned post pada FB dan Instagram
Tim Kerja Terkait: Tim DIPWEB dan Tim HUBMAS
Pemeriksa: Wisni
EOT,
            'petugas_id' => 24,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'ii. Budaya Pelayanan Prima',
            'pertanyaan' => 'c. Telah Terdapat Sistem Pemberian Penghargaan Dan Sanksi Bagi Petugas Pemberi Pelayanan',
            'rencana_aksi' => <<<EOT
Uraian: Adanya sistem pemberian penghargaan dan sanksi bagi petugas pemberi pelayanan
Output: 1. Sertifikat bagi Employee of the month, dan posting di medsos 2. Adanya rapat internal jika ada indikasi pelayanan petugas yang tidak baik
Dokumen: 1. Sertifikat bagi Employee of the month, dan posting di medsos 2. Surat pernyataan Pimpinan secara periodik jika tidak ada petugas pelayanan yang berkinerja tidak baik 3. Foto penyerahan piagam bagi EOTM
Tim Kerja Terkait: Tim Subbag Umum (Layanan SDM)
Pemeriksa: Wisni
EOT,
            'petugas_id' => 8,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'ii. Budaya Pelayanan Prima',
            'pertanyaan' => 'd. Telah Terdapat Sistem Pemberian Kompensasi Kepada Penerima Layanan Bila Layanan Tidak Sesuai Standar',
            'rencana_aksi' => <<<EOT
Uraian: Adanya sistem pemberian kompensasi apabila layanan tidak sesuai standar
Output: 1. Surat Edaran pimpinan tentang Kompensasi
Dokumen: 1. Surat Edaran pimpinan tentang Kompensasi
Tim Kerja Terkait: Tim Subbag Umum (Layanan Pengembangan SOM, Hukum & Fungsional)
Pemeriksa: Wisni
EOT,
            'petugas_id' => 8,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'ii. Budaya Pelayanan Prima',
            'pertanyaan' => 'e. Terdapat Sarana Layanan Terpadu/Terintegrasi',
            'rencana_aksi' => <<<EOT
Uraian: Adanya layanan terpadu/terintegrasi
Output: 1. Layanan terpadu/terintegrasi satu link BPS Kab Nias
Dokumen: 1. Dokumentasi layanan terpadu dalam satu link BPS Kab Nias (TALIFUSO, Website, dkk)
Tim Kerja Terkait: Tim DIPWEB
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 30,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'ii. Budaya Pelayanan Prima',
            'pertanyaan' => 'f. Terdapat Inovasi Pelayanan',
            'rencana_aksi' => <<<EOT
Uraian: Adanya inovasi pelayanan
Output: 1. Handbook inovasi pelayanan satu link BPS Kab Nias
Dokumen: 1. Handbook inovasi pelayanan satu link BPS Kab Nias
Tim Kerja Terkait: Tim DIPWEB
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 30,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'iii. Pengelola Pengaduan',
            'pertanyaan' => 'a. Terdapat Media Pengaduan Dan Konsultasi Pelayanan Yang Terintegrasi Dengan SP4N-Lapor!',
            'rencana_aksi' => <<<EOT
Uraian: Adanya media pengaduan layanan yang tidak baik
Output: 1. SK Unit Pengaduan Masyarakat 2. Adanya link SP4N-Lapor pada menu page website
Dokumen: 1. SK Unit Pengaduan Masyarakat 2. Screenshoot website BPS Kab Nias yang menampilkan adanya SP4N-Lapor
Tim Kerja Terkait: Tim PPID dan Tim DIPWEB
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 8,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'iii. Pengelola Pengaduan',
            'pertanyaan' => 'b. Terdapat Unit Yang Mengelola Pengaduan Dan Konsultasi Pelayanan',
            'rencana_aksi' => <<<EOT
Uraian: Adanya unit yang menangani pengaduan
Output: 1. SK dan surat tugas pengelola pengaduan 2. Dapat mengakses SP4N-Lapor
Dokumen: 1. SK dan surat tugas pengelola pengaduan 2. Screenshoot admin mengakses SP4N-Lapor
Tim Kerja Terkait: Tim Subbag Umu (Layanan Pengembangan SDM, Hukum & Fungsional)
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 17,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'iii. Pengelola Pengaduan',
            'pertanyaan' => 'c. Telah Dilakukan Evaluasi Atas Penanganan Keluhan/Masukan Dan Konsultasi',
            'rencana_aksi' => <<<EOT
Uraian: Adanya monitoring dan evaluasi pengaduan secara periodik
Output: 1. Notulen monitoring dan evaluasi pengaduan secara periodik
Dokumen: 1. Notulen monitoring dan evaluasi pengaduan secara periodik
Tim Kerja Terkait: Tim PPID
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 17,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'iv. Penilaian Kepuasan Terhadap Pelayanan',
            'pertanyaan' => 'a. Telah Dilakukan Survei Kepuasan Masyarakat Terhadap Pelayanan',
            'rencana_aksi' => <<<EOT
Uraian: Adanya survei kepuasan masyarakat secara periodik
Output: 1. Laporan SKD
Dokumen: 1. Laporan SKD secara periodik
Tim Kerja Terkait: Tim DIPWEB
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 30,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'iv. Penilaian Kepuasan Terhadap Pelayanan',
            'pertanyaan' => 'b. Hasil Survei Kepuasan Masyarakat Dapat Diakses Secara Terbuka',
            'rencana_aksi' => <<<EOT
Uraian: Publisitas hasil SKD secara periodik
Output: 1. Publisitas hasil SKD
Dokumen: 1. Dokumentasi hasil publisitas SKD
Tim Kerja Terkait: Tim DIPWEB
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 30,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'iv. Penilaian Kepuasan Terhadap Pelayanan',
            'pertanyaan' => 'c. Dilakukan Tindak Lanjut Atas Hasil Survei Kepuasan Masyarakat',
            'rencana_aksi' => <<<EOT
Uraian: Tindaklanjut hasil SKD
Output: 1. Adanya rapat evaluasi hasil SKD
Dokumen: 1. UANG rapat evaluasi
Tim Kerja Terkait: Tim DIPWEB
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 30,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'v. Pemanfaatan Teknologi Informasi',
            'pertanyaan' => 'a. Telah Menerapkan Teknologi Informasi Dalam Memberikan Pelayanan',
            'rencana_aksi' => <<<EOT
Uraian: Seluruh pelayanan menggunakan teknologi informasi
Output: 1. Pengisian buku tamu secara online 2. Pelayanan via email, whatsapp, atau media sosial.
Dokumen: 1. Dokumentasi pelayanan secara online
Tim Kerja Terkait: Tim DIPWEB
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 24,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'v. Pemanfaatan Teknologi Informasi',
            'pertanyaan' => 'b. Telah Dilakukan Perbaikan Secara Terus Menerus',
            'rencana_aksi' => <<<EOT
Uraian: Dilakukan perbaikan dan update TI secara terus menerus
Output: 1. Dokumen monitoring dan evaluasi perbaikan pelayanan TI per triwulanan (before-after).
Dokumen: 1. Dokumen monitoring dan evaluasi perbaikan pelayanan TI per triwulanan (before-after).
Tim Kerja Terkait: Tim DIPWEB
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 24,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'I. Pemenuhan',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'v. Pemanfaatan Teknologi Informasi',
            'pertanyaan' => 'c. Telah Membangun Database Pelayanan Yang Terintegrasi',
            'rencana_aksi' => <<<EOT
Uraian: Adanya database pelayanan terintegrasi
Output: 1. Dokumen narasi terkait sistem pelayanan BPS yang terintegrasi menggunakan PST, dimana databasenya tersentralisir
Dokumen: 1. Dokumen narasi terkait sistem pelayanan BPS yang terintegrasi menggunakan PST, dimana databasenya tersentralisir
Tim Kerja Terkait: Tim DIPWEB
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 30,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'i. Komitmen Dalam Perubahan',
            'pertanyaan' => 'a. Agen Perubahan Telah Membuat Perubahan Yang Konkret Di Instansi (Dalam 1 Tahun)',
            'rencana_aksi' => <<<EOT
Uraian: Melakukan perubahan konkret di instansi dalam 1 tahun terakhir
Output: Perubahan konkret di Instansi dalam 1 tahun terakhir
Dokumen: SK CA: Laporan CA
Tim Kerja Terkait: Tim Pilar 1
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 28,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'i. Komitmen Dalam Perubahan',
            'pertanyaan' => 'b. Perubahan Yang Dibuat Agen Perubahan Telah Terintegrasi Dalam Sistem Manajemen',
            'rencana_aksi' => <<<EOT
Uraian: Melakukan perubahan yang telah terintegrasi dalam sistem manajemen
Output: Perubahan yang terintegrasi dalam sistem manajemen
Dokumen: ND/Laporan Pelembagaan perubahan yang sudah dibuat oleh Ketua tim ZI
Tim Kerja Terkait: Tim RB/ZI
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 28,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'ii. Komitmen Pimpinan',
            'pertanyaan' => 'a. Pimpinan Memiliki Komitmen Terhadap Pelaksanaan Reformasi Birokrasi, Dengan Adanya Target Capaian Reformasi Yang Jelas Di Dokumen Perencanaan',
            'rencana_aksi' => <<<EOT
Uraian: Pimpinan melaksanakan tugas dengan selalu menunjukkan komitmen terhadap reformasi birokrasi
Output: Komitmen pimpinan terhadap pelaksanaan reformasi birokrasi
Dokumen: Dokumentasi keikutsertaan kepala kantor, bukti LHKPN, SPT, Pakta Integritas, Laporan daftar hadir kepala kantor
Tim Kerja Terkait: Tim RB/ZI
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 19,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '1. Manajemen Perubahan',
            'sub_pilar' => 'iii. Membangun Budaya Kerja',
            'pertanyaan' => 'a. Instansi Membangun Budaya Kerja Positif Dan Menerapkan Nilai-Nilai Organisasi Dalam Pelaksanaan Tugas Sehari-Hari',
            'rencana_aksi' => <<<EOT
Uraian: Membangun budaya kerja positif dan menerapkan nilai-nilai organisasi dalam pelaksanaan tugas sehari-hari
Output: Budaya kerja positif dan penerapan nilai nilai organisasi
Dokumen: Undangan, daftar hadir, notulensi dan dokumentasi terkait internalisasi nilai-nilai berakhlak
Tim Kerja Terkait: Tim Pilar 2
Pemeriksa: Agus Mardin
EOT,
            'petugas_id' => 4,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'i. Peta Proses Bisnis Mempengaruhi Penyederhanaan Jabatan',
            'pertanyaan' => 'a. Telah Disusun Peta Proses Bisnis Dengan Adanya Penyederhanaan Jabatan',
            'rencana_aksi' => <<<EOT
Uraian: Penyusunan peta proses bisnis
Output: Peta proses bisnis
Dokumen: Peraturan BPS Nomor 7 Tahun 2020 Tentang Organisasi dan Tata Kerja BPS (BPS Pusat) serta Peraturan BPS Nomor 5 Tahun 2023 Tentang Organisasi dan. Tata Kerja BPS Provinsi dan BPS Kabupaten/Kota (BPS Daerah): Surat perintah penyederhanaan organisasi di Surat Edaran (SE) Menteri PANRB Nomor 393 Tahun 2019 tentang langkah Strategis dan Konkret Penyederhanaan Birokrasi dan diperkuat oleh SE Menteri PANRB Nomor 15 tahun 2023 tentang Tata Cara Penilaian Penyederhanaan Birokrasi
Tim Kerja Terkait: Tim Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 12,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE) Yang Terintegrasi',
            'pertanyaan' => 'a. Implementasi SPBE Telah Terintegrasi Dan Mampu Mendorong Pelaksanaan Pelayanan Publik Yang Lebih Cepat Dan Efisien',
            'rencana_aksi' => <<<EOT
Uraian: Implementasi SPBE
Output: Pelayanan publik yang lebih efisien
Dokumen: i. Daftar Layanan pada pelayanan publik yang mengimplementasikan SPBE ii. Dokumen narasi penjelasan SPBE iii. Dokumen yang menyatakan bahwa SPBE telah terintegrasi.
Tim Kerja Terkait: TIM PEMEJA
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 10,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'ii. Sistem Pemerintahan Berbasis Elektronik (SPBE) Yang Terintegrasi',
            'pertanyaan' => 'b. Implementasi SPBE Telah Terintegrasi Dan Mampu Mendorong Pelaksanaan Pelayanan Internal Organisasi Yang Lebih Cepat Dan Efisien',
            'rencana_aksi' => <<<EOT
Uraian: Implementasi SPBE
Output: Pelayanan Internal yang cepat dan efisien
Dokumen: Daftar Layanan pada pelayanan internal organisasi yang mengimplementasikan SPBE, Dokumen narasi penjelasan SPBE, Dokumen yang menyatakan bahwa SPBE telah terintegrasi.
Tim Kerja Terkait: TIM PEMEJA
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 10,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'iii. Transformasi Digital Memberikan Nilai Manfaat',
            'pertanyaan' => 'a. Transformasi Digital Pada Bidang Proses Bisnis Utama Telah Mampu Memberikan Nilai Manfaat Bagi Unit Kerja Secara Optimal',
            'rencana_aksi' => <<<EOT
Uraian: Transformasi digital pada bidang proses bisnis utama
Output: Nilai manfaat bagi unit kerja secara optimal
Dokumen: perubahan metode pencacahan dari PAPI menjadi CAPI; Buku Pedoman penggunaan PAPI dan CAPI pada kegiatan Survei Angkatan Kerja Nasional (Sakemas) iii. Surat edaran BPS Pusat terkait pencacahan menggunakan CAPI iv. Screen shot pemanfaatan CAPI pada berbagai survei v. Dokumen evaluasi atas transformasi digital PAPI ke CAPI
Tim Kerja Terkait: Tim Kerja Terkait
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 3,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'iii. Transformasi Digital Memberikan Nilai Manfaat',
            'pertanyaan' => 'b. Transformasi Digital Pada Bidang Administrasi Pemerintahan Telah Mampu Memberikan Nilai Manfaat Bagi Unit Kerja Secara Optimal',
            'rencana_aksi' => <<<EOT
Uraian: Transformasi digital pada bidang administrasi pemerintahan
Output: Nilai manfaat bagi unit kerja secara optimal
Dokumen: 1. Narasi alasan perubahan metode pencacahan dari PAPI menjadi CAPI ii. Buku Pedoman penggunaan PAPI dan CAPI pada kegiatan Survei Angkatan Kerja Nasional (Sakernas) iii. Surat edaran BPS Pusat terkait pencacahan menggunakan CAPI iv. Screen shot pemanfaatan CAPI pada berbagai survei v. Dokumen evaluasi atas transformasi digital PAPI ke CAPI
Tim Kerja Terkait: Tim Kerja Terkait
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 20,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '2. Penataan Tatalaksana',
            'sub_pilar' => 'iii. Transformasi Digital Memberikan Nilai Manfaat',
            'pertanyaan' => 'c. Transformasi Digital Pada Bidang Pelayanan Publik Telah Mampu Memberikan Nilai Manfaat Bagi Unit Kerja Secara Optimal',
            'rencana_aksi' => <<<EOT
Uraian: Transformasi digital pada bidang pelayanan publik
Output: Nilai manfaat bagi unit kerja secara optimal
Dokumen: 1.Narasi/buku pedoman pemanfaatan website, Silastik, Romanlik, PPID, SIRUP dll. Screen shot pemanfaatan website, Silastik Romantik, PPID, SIRUP dll. iii. Dokumen evaluasi atas pemanfaatan website, Silastik Romantik, PPID, SIRUP, dll
Tim Kerja Terkait: Tim PPID, Tim Subbag Umum (Perencanaan & Penganggaran)
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 20,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'i. Kinerja Individu',
            'pertanyaan' => 'a. Ukuran Kinerja Individu Telah Berorientasi Hasil (Outcome) Sesuai Pada Levelnya',
            'rencana_aksi' => <<<EOT
Uraian: Hasil yang didapatkan dan IKI sesuai dengan Rencana Kerja
Output: Laporan dan IKI
Dokumen: Kipapp
Tim Kerja Terkait: Subbagian Umum (Layanan Kepegawaian)
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 2,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'ii. Assessment Pegawai',
            'pertanyaan' => 'a. Hasil Assessment Telah Dijadikan Pertimbangan Untuk Mutasi Dan Pengembangan Karir Pegawai',
            'rencana_aksi' => <<<EOT
Uraian: Penerapan mutasi, rotasi maupun pengembangan karir pegawai menggunakan hasil assesment sebagai salah satu komponen dasar
Output: Assesment test untuk pegawai
Dokumen: Hasil assesment test
Tim Kerja Terkait: Tim Subbagian Umum (Layanan Pengembangan SDM, Hukum & Fungsional)
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 29,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '3. Penataan Sistem Manajemen SDM Aparatur',
            'sub_pilar' => 'iii. Pelanggaran Disiplin Pegawai',
            'pertanyaan' => 'a. Penurunan Pelanggaran Disiplin Pegawai',
            'rencana_aksi' => <<<EOT
Uraian: Upaya preventif dalam mengurangi sekaligus mendisiplinkan pegawai
Output: Penetapan dan pelaksanaan aturan-aturan yg dituangkan dalam bentuk dokumen tertulis
Dokumen: SK, SOP Mekanisme Kerja
Tim Kerja Terkait: Tim Subbagian Umum (Layanan Pengembangan SOM, Hukum & Fungsional)
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 11,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'i. Meningkatnya Capaian Kinerja Unit Kerja',
            'pertanyaan' => 'a. Persentase Sasaran Dengan Capaian 100% Atau Lebih',
            'rencana_aksi' => <<<EOT
Uraian: Peningkatan capaian kinerja unit
Output: Capaian kinerja satker
Dokumen: Capaian kinerja seluruh IKU pimpinan unit kerja
Tim Kerja Terkait: Tim SAKIP
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 16,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'ii. Pemberian Reward And Punishment',
            'pertanyaan' => 'a. Hasil Capaian/Monitoring Perjanjian Kinerja Telah Dijadikan Dasar Sebagai Pemberian Reward And Punishment Bagi Organisasi',
            'rencana_aksi' => <<<EOT
Uraian: Pemberian Reward and Punishment
Output: Terdapat reward kepada pegawai teladan atas capaian yang telah dilakukan
Dokumen: 1. SK pegawai teladan pemberian penghargaan 2. Dokumentasi
Tim Kerja Terkait: Tim Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 16,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '4. Penguatan Akuntabilitas',
            'sub_pilar' => 'iii. Kerangka Logis Kinerja',
            'pertanyaan' => 'a. Apakah Terdapat Penjenjangan Kinerja (Kerangka Logis Kinerja) Yang Mengacu Pada Kinerja Utama Organisasi Dan Dijadikan Dalam Penentuan Kinerja Seluruh Pegawai?',
            'rencana_aksi' => <<<EOT
Uraian: Penjenjangan kinerja pegawai
Output: Kerangka logis kinerja
Dokumen: 1. Pohon Kinerja 2. Matriks Cascading Unit Kerja
Tim Kerja Terkait: Tim Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 23,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'i. Mekanisme Pengendalian',
            'pertanyaan' => 'a. Telah Dilakukan Mekanisme Pengendalian Aktivitas Secara Berjenjang',
            'rencana_aksi' => <<<EOT
Uraian: Melakukan pengendalian aktivitas utama organisasi secara berjenjang
Output: Laporan mekanisme pengendalian aktivitas utama secara berjenjang yang memuat a) Perencanaan kegiatan b) Penilaian Pengendalian aktivitas utama organisasi yang tersistem
Dokumen: risiko c) Monitoring pengawasan kegiatan d) Monitoring melalui sistem aplikasi e) Monitoring capaian kinerja (FRA, KipApp) f) Pelaporan (laporan kegiatan dan laporan kinerja)
Tim Kerja Terkait: Tim PIPP, Tim SAKIP
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 13,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'ii. Penanganan Pengaduan Masyarakat',
            'pertanyaan' => 'a. Persentase Penanganan Pengaduan Masyarakat',
            'rencana_aksi' => <<<EOT
Uraian: Menangani Pengaduan Masyarakat
Output: Penanganan Pengaduan Masyarakat
Dokumen: Rekapitulasi Progres Tindak Lanjut Aduan Yang Masuk
Tim Kerja Terkait: Tim PPID
Pemeriksa: Hamdan
EOT,
            'petugas_id' => 6,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '5. Penguatan Pengawasan',
            'sub_pilar' => 'iii. Penyampaian Laporan Harta Kekayaan',
            'pertanyaan' => 'a. Persentase Penyampaian LHKPN',
            'rencana_aksi' => <<<EOT
Uraian: Melaporkan kekayaan melalui LHKASN
Output: Bukti penyampaian LHKASN
Dokumen: Bukti penyampaian LHKASN
Tim Kerja Terkait: Tim Subbag Umum (Layanan Kepegawaian)
Pemeriksa: Brillian
EOT,
            'petugas_id' => 25,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'i. Upaya Dan/Atau Inovasi Pelayanan Publik',
            'pertanyaan' => 'a. Upaya Dan/Atau Inovasi Telah Mendorong Perbaikan Pelayanan Publik Pada: 1. Kesesuaian Persyaratan 2. Kemudahan Sistem, Mekanisme, Dan Prosedur 3. Kecepatan Waktu Penyelesaian 4. Kejelasan Biaya/Tarif, Gratis 5. Kualitas Produk Spesifikasi Jenis Pelayanan 6. Kompetensi Pelaksana/Web 7. Perilaku Pelaksana/Web 8. Kualitas Sarana Dan Prasarana 9. Penanganan Pengaduan, Saran Dan Masukan',
            'rencana_aksi' => <<<EOT
Uraian: Dampak inovasi terhadap perbaikan pelayanan publik yang prima
Output: Narasi dampak Inovasi
Dokumen: Narasi dampak inovasi
Tim Kerja Terkait: Tim Hubmas, Tim DIPWEB
Pemeriksa: Brillian
EOT,
            'petugas_id' => 24,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'i. Upaya Dan/Atau Inovasi Pelayanan Publik',
            'pertanyaan' => 'b. Upaya Dan/Atau Inovasi Pada Perijinan/Pelayanan Telah Dipermudah: 1. Waktu Lebih Cepat 2. Pelayanan Publik Yang Terpadu 3. Alur Lebih Pendek/Singkat 4. Terintegrasi Dengan Aplikasi',
            'rencana_aksi' => <<<EOT
Uraian: Kepuasan pengguna layanan terhadap waktu pelayanan yang lebih mudah
Output: Persentase hasil Survei Kebutuhan Data
Dokumen: Narasi hasil Survei Kebutuhan Data
Tim Kerja Terkait: Tim Hubmas, Tim DIPWEB
Pemeriksa: Brillian
EOT,
            'petugas_id' => 30,
        ],
        [
            'aspek' => 'A. Pengungkit',
            'area' => 'II. Reform',
            'pilar' => '6. Peningkatan Kualitas Pelayanan Publik',
            'sub_pilar' => 'ii. Penanganan Pengaduan Pelayanan Dan Konsultasi',
            'pertanyaan' => 'a. Penanganan Pengaduan Pelayanan Dilakukan Melalui Berbagai Kanal/Media Secara Responsif Dan Bertanggung Jawab',
            'rencana_aksi' => <<<EOT
Uraian: Pengaduan pelayanan telah direspon dengan waktu yang lebih cepat
Output: Pengaduan telah direspon
Dokumen: Narasi monitoring dan evaluasi pengaduan
Tim Kerja Terkait: Tim PPID
Pemeriksa: Brillian
EOT,
            'petugas_id' => 17,
        ],
    ]
];