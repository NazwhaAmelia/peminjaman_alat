<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'phone_number' => '08123456789',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        // Create Petugas Users
        User::create([
            'username' => 'petugas1',
            'name' => 'Petugas Satu',
            'email' => 'petugas1@example.com',
            'phone_number' => '08123456790',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'status' => 'aktif',
        ]);

        User::create([
            'username' => 'petugas2',
            'name' => 'Petugas Dua',
            'email' => 'petugas2@example.com',
            'phone_number' => '08123456791',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'status' => 'aktif',
        ]);

        // Create Peminjam Users
        User::factory()->peminjam()->count(5)->create();
    }
}
