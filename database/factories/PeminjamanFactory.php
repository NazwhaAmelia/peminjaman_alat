<?php

namespace Database\Factories;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggal_pinjam = fake()->dateTimeBetween('-30 days');

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'alat_id' => Alat::inRandomOrder()->first()?->id ?? Alat::factory(),
            'jumlah_pinjam' => fake()->numberBetween(1, 5),
            'tanggal_pinjam' => $tanggal_pinjam,
            'tanggal_kembali_rencana' => fake()->dateTimeBetween($tanggal_pinjam, '+30 days'),
            'status' => fake()->randomElement(['pending', 'disetujui', 'ditolak', 'selesai']),
        ];
    }
}
