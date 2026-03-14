<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /* ================= RELATION ================= */

    // Admin dapat memvalidasi banyak anggota
    public function validatedAnggota()
    {
        return $this->hasMany(Anggota::class, 'validated_by');
    }
}
