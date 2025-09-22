<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat satu user admin secara manual
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Kondisi pencarian
            [
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            ]
        );

        // Membuat 10 user biasa dengan factory
        User::factory(10)->create([
            'is_admin' => false,
        ]);
    }
}