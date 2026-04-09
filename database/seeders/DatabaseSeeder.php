<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->admin()->create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@example.com',
        ]);

        // Create Petugas Users
        User::factory()->petugas()->create([
            'username' => 'petugas1',
            'name' => 'Petugas Satu',
            'email' => 'petugas1@example.com',
        ]);

        User::factory()->petugas()->create([
            'username' => 'petugas2',
            'name' => 'Petugas Dua',
            'email' => 'petugas2@example.com',
        ]);

        // Create Peminjam Users
        User::factory()->peminjam()->count(5)->create();

        // Call other seeders
        $this->call([
            KategoriSeeder::class,
            AlatSeeder::class,
        ]);
    }
}
