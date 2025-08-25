<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Petugas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan pengecekan foreign key
        Schema::disableForeignKeyConstraints();

        // Kosongkan tabel terlebih dahulu untuk menghindari duplikasi jika seeder dijalankan ulang
        DB::table('petugas')->truncate();

        // Aktifkan kembali pengecekan foreign key
        Schema::enableForeignKeyConstraints();

        // Lanjutkan proses membaca CSV dan mengisi data
        $csvFile = fopen(database_path('seeders/csv/petugas.csv'), 'r');

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if (!$firstline) {
                Petugas::create([
                    // Sesuaikan 'nama' dengan nama kolom di file CSV dan tabel Anda
                    'nama' => $data[0],      // Kolom pertama di CSV
                    // Tambahkan kolom lain jika ada
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
