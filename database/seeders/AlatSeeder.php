<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alats = [
            [
                'nama_alat' => 'Bor Listrik Makita',
                'deskripsi' => 'Bor listrik profesional dari Makita dengan tenaga 13mm',
                'kategori_id' => 2,
                'jumlah_tersedia' => 5,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Mesin Gerinda Bosch',
                'deskripsi' => 'Mesin gerinda sudut profesional Bosch GWS',
                'kategori_id' => 2,
                'jumlah_tersedia' => 3,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Laptop Lenovo ThinkPad',
                'deskripsi' => 'Laptop bisnis dengan spesifikasi tinggi',
                'kategori_id' => 5,
                'jumlah_tersedia' => 2,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Proyektor Epson XGA',
                'deskripsi' => 'Proyektor dengan resolusi XGA untuk presentasi',
                'kategori_id' => 1,
                'jumlah_tersedia' => 4,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Kamera Canon EOS 200D',
                'deskripsi' => 'Kamera DSLR entry-level dengan lensa kit',
                'kategori_id' => 3,
                'jumlah_tersedia' => 2,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Tang Potong Stanley',
                'deskripsi' => 'Tang potong 8 inch standar',
                'kategori_id' => 4,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Meteran Gulung 5m',
                'deskripsi' => 'Meteran pengukur panjang 5 meter',
                'kategori_id' => 4,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Tripod Kamera 1/4',
                'deskripsi' => 'Tripod standar untuk kamera atau proyektor',
                'kategori_id' => 3,
                'jumlah_tersedia' => 3,
                'kondisi' => 'baik',
            ],
        ];

        foreach ($alats as $alat) {
            Alat::create($alat);
        }
    }
}
