<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Daftarkan semua seeder yang mau dijalankan
        $this->call([
            PetugasSeeder::class,
        ]);
    }
}
