<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $aktivitas
 * @property string $deskripsi
 * @property string $waktu
 */
class LogAktifitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'aktivitas',
        'deskripsi',
        'waktu',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
