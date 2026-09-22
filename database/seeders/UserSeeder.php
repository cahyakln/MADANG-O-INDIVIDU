<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Owner (pemilik usaha)
        User::create([
            'name' => 'Mbak Tatik',
            'username' => 'owner_tatik',
            'email' => 'tatik@segosambel.com',
            'wa_number' => '083119508675',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        // Karyawan
        User::create([
            'name' => 'Sari',
            'username' => 'karyawan_sari',
            'email' => 'sari@segosambel.com',
            'wa_number' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        // Pelanggan dummy (20 orang)
        User::factory()->count(20)->pelanggan()->create();
    }
}
