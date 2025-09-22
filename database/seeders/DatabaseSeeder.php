<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menggunakan updateOrCreate untuk menghindari error duplikasi
        // Ini akan mencari user dengan email 'test@example.com'
        // Jika tidak ada, user baru akan dibuat.
        // Jika sudah ada, namanya akan di-update menjadi 'Test User'.

        User::updateOrCreate(
            ['email' => 'test@example.com'], // Kondisi pencarian
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // Pastikan ada password default
            ]
        );

        $this->call([
            PetugasSeeder::class,
            UserSeeder::class,
        ]);
    }
}
