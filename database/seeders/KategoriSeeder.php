<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Alat-alat elektronik',
            ],
            [
                'nama_kategori' => 'Peralatan Listrik',
                'deskripsi' => 'Peralatan listrik dan power tools',
            ],
            [
                'nama_kategori' => 'Fotografi',
                'deskripsi' => 'Peralatan fotografi dan video',
            ],
            [
                'nama_kategori' => 'Perkakas',
                'deskripsi' => 'Peralatan tangan dan perkakas umum',
            ],
            [
                'nama_kategori' => 'Komputer',
                'deskripsi' => 'Perangkat komputer dan aksesoris',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
