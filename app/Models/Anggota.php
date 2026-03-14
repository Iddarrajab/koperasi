<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anggota extends Authenticatable
{
    use Notifiable;

    protected $table = 'anggota';

    protected $attributes = [
        'status_anggota' => 'nonaktif',
        'status_validasi' => 'pending',
    ];

    protected $fillable = [
        'kode_anggota',
        'nomor_anggota',
        'nama',
        'email',
        'password',
        'alamat',
        'no_hp',
        'status_anggota',
        'status_validasi',
        'validated_by',
    ];

    protected $hidden = [
        'password',
    ];

    // Login pakai email
    public function getAuthIdentifierName()
    {
        return 'email';
    }

    /* ================= RELATIONS ================= */

    public function adminValidator()
    {
        return $this->belongsTo(Admin::class, 'validated_by');
    }
}
