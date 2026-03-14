<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ActiveMember
{
    public function handle($request, Closure $next)
    {
        $anggota = Auth::guard('anggota')->user();

        if (
            $anggota->status_anggota !== 'aktif' ||
            $anggota->status_validasi !== 'diterima'
        ) {
            Auth::guard('anggota')->logout();

            return redirect()->route('login.form')
                ->with('error', 'Akun Anda belum divalidasi admin.');
        }

        return $next($request);
    }
}
