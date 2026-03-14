<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $fillable = [
        'anggota_id',
        'jumlah_pinjaman',
        'tenor',
        'bunga',
        'total_pinjaman',
        'status_pinjaman',
    ];

    /* ================= RELATION ================= */

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function angsuran()
    {
        return $this->hasMany(Angsuran::class);
    }

    /* ================= ACCESSOR ================= */

    // Total angsuran dari pinjaman ini
    public function getTotalAngsuranAttribute()
    {
        return $this->angsuran()->sum('jumlah_angsuran');
    }

    // Sisa pinjaman = total pinjaman - total angsuran
    public function getSisaPinjamanAttribute()
    {
        return $this->total_pinjaman - $this->totalAngsuran;
    }
}
