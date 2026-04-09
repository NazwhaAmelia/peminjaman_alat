<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    /**
     * Relasi ke Alat
     */
    public function alats()
    {
        return $this->hasMany(Alat::class);
    }
}
