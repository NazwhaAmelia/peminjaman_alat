<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
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
        $peminjams = User::factory()->peminjam()->count(5)->create();

        // Call other seeders
        $this->call([
            KategoriSeeder::class,
            AlatSeeder::class,
        ]);

        // Create sample peminjaman data
        $alats = Alat::all();
        $peminjam = $peminjams->first();

        // Create approved peminjaman
        $peminjaman1 = Peminjaman::create([
            'user_id' => $peminjam->id,
            'alat_id' => $alats->first()->id,
            'jumlah_pinjam' => 2,
            'tanggal_pinjam' => now()->subDays(5)->toDateString(),
            'tanggal_kembali_rencana' => now()->addDays(2)->toDateString(),
            'status' => 'disetujui',
        ]);

        // Create pending peminjaman
        Peminjaman::create([
            'user_id' => $peminjam->id,
            'alat_id' => $alats->get(1)->id,
            'jumlah_pinjam' => 1,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali_rencana' => now()->addDays(5)->toDateString(),
            'status' => 'pending',
        ]);

        // Create completed peminjaman with return
        $peminjaman2 = Peminjaman::create([
            'user_id' => $peminjam->id,
            'alat_id' => $alats->get(2)->id,
            'jumlah_pinjam' => 1,
            'tanggal_pinjam' => now()->subDays(10)->toDateString(),
            'tanggal_kembali_rencana' => now()->subDays(5)->toDateString(),
            'status' => 'selesai',
        ]);

        // Create pengembalian for completed peminjaman
        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman2->id,
            'tanggal_kembali' => now()->subDays(3)->toDateString(),
            'kondisi_alat' => 'baik',
            'denda' => 0,
        ]);

        // Update peminjaman2 with pengembalian_id
        $peminjaman2->update(['pengembalian_id' => $pengembalian->id]);
    }
}
