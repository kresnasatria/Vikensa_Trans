<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun dengan role 'admin'
        User::create([
            'name' => 'Admin Kresna',
            'email' => 'admin@travel.com',
            'password' => Hash::make('password123'), // Anda bisa ganti passwordnya nanti
            'role' => 'admin',
        ]);
    }
}