<?php

namespace Database\Factories;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengembalian>
 */
class PengembalianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'peminjaman_id' => Peminjaman::inRandomOrder()->first()?->id ?? Peminjaman::factory(),
            'tanggal_kembali' => fake()->dateTime(),
            'kondisi_alat' => fake()->randomElement(['baik', 'rusak', 'hilang']),
            'denda' => fake()->randomElement([0, 50000, 100000, 150000]),
        ];
    }
}
