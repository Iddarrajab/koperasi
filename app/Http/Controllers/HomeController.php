<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Angsuran;

class HomeController extends Controller
{
    /**
     * Home publik (bisa diakses semua orang)
     */
    public function publicHome()
    {
        return view('Home');
    }

    /**
     * Dashboard admin
     */
    public function adminDashboard()
    {
        return view('home', [
            'totalAnggota'  => Anggota::count(),
            'totalSimpanan' => Simpanan::sum('jumlah_setoran'),
            'totalPinjaman' => Pinjaman::where('status_pinjaman', 'aktif')->sum('jumlah_pinjaman'),
            'totalAngsuran' => Angsuran::sum('jumlah_angsuran'),
            'anggotaAktif'  => Anggota::where('status_anggota', 'aktif')->count(),
            'pinjamanAktif' => Pinjaman::where('status_pinjaman', 'aktif')->count(),
            'pinjamanLunas' => Pinjaman::where('status_pinjaman', 'lunas')->count(),
        ]);
    }

    /**
     * Dashboard anggota
     */
    public function anggotaDashboard()
    {
        $anggota = Auth::guard('anggota')->user();

        $pinjamanAktifCollection = $anggota->pinjaman->where('status_pinjaman', 'aktif');

        $totalPinjaman = $pinjamanAktifCollection->sum(function ($p) {
            return $p->total_pinjaman - $p->angsuran->sum('jumlah_angsuran');
        });

        $totalAngsuran = 0;
        foreach ($pinjamanAktifCollection as $p) {
            if ($p->tenor > 0) {
                $totalAngsuran += $p->total_pinjaman / $p->tenor;
            }
        }

        return view('home', [
            'totalAnggota'  => $totalAngsuran, // ditampilkan di box total angsuran
            'totalSimpanan' => $anggota->simpanan->sum('jumlah_setoran'),
            'totalPinjaman' => $totalPinjaman,
            'totalAngsuran' => $totalAngsuran,
            'anggotaAktif'  => $anggota->status_anggota === 'aktif' ? 1 : 0,
            'pinjamanAktif' => $pinjamanAktifCollection->count(),
            'pinjamanLunas' => $anggota->pinjaman->where('status_pinjaman', 'lunas')->count(),
        ]);
    }
}
