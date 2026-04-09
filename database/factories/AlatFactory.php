<?php

namespace Database\Factories;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Alat>
 */
class AlatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_alat' => fake()->word(),
            'deskripsi' => fake()->sentence(),
            'kategori_id' => Kategori::inRandomOrder()->first()?->id ?? Kategori::factory(),
            'jumlah_tersedia' => fake()->numberBetween(1, 50),
            'kondisi' => fake()->randomElement(['baik', 'rusak']),
        ];
    }
}
