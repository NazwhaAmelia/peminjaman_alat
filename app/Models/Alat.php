<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_alat',
        'deskripsi',
        'kategori_id',
        'jumlah_tersedia',
        'kondisi',
    ];

    /**
     * Relasi ke Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke Peminjaman
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
