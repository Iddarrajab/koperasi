<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = 'simpanan';

    protected $fillable = [
        'anggota_id',
        'jenis_simpanan',
        'jumlah_setoran',
    ];

    /* ================= RELATION ================= */

    // Simpanan milik anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
