<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaAktif
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            Auth::guard('anggota')->check() &&
            Auth::guard('anggota')->user()->status_anggota !== 'aktif'
        ) {
            Auth::guard('anggota')->logout();

            return redirect()
                ->route('login.form')
                ->withErrors([
                    'email' => 'Akun Anda belum diverifikasi oleh admin.'
                ]);
        }

        return $next($request);
    }
}
