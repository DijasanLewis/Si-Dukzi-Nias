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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        // Membuat 10 user biasa dengan factory
        User::factory(10)->create([
            'is_admin' => false,
        ]);
    }
}