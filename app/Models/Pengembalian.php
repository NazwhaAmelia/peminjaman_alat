<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $peminjaman_id
 * @property string $tanggal_kembali
 * @property string $kondisi_alat
 * @property numeric $denda
 */
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
