<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $alat_id
 * @property int $jumlah_pinjam
 * @property string $tanggal_pinjam
 * @property string $tanggal_kembali_rencana
 * @property string $status
 */
class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'alat_id',
        'jumlah_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali_rencana',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pinjam' => 'date',
            'tanggal_kembali_rencana' => 'date',
        ];
    }

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Alat
     */
    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    /**
     * Relasi ke Pengembalian
     */
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}
