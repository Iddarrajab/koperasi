<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    protected $table = 'angsuran';

    protected $fillable = [
        'pinjaman_id',
        'jumlah_angsuran',
        'sisa_pinjaman',
        'status_pembayaran',
    ];

    /* ================= RELATION ================= */

    // Angsuran milik pinjaman
    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}
