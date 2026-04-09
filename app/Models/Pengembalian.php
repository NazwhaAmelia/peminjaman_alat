<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali',
        'kondisi_alat',
        'denda',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kembali' => 'date',
            'denda' => 'decimal:2',
        ];
    }

    /**
     * Relasi ke Peminjaman
     */
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
