<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::create([
            'nama' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'level' => 'admin',
            'no_telp' => '08123456789',
        ]);
    }
}
