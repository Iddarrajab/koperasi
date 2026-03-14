<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anggota;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        /**
         * ===============================
         * LOGIN ADMIN
         * ===============================
         */
        if (Auth::guard('admin')->attempt(
            $request->only('email', 'password')
        )) {
            $request->session()->regenerate();
            return redirect()->route('anggota.index');
        }

        /**
         * ===============================
         * LOGIN ANGGOTA (CEK VALIDASI)
         * ===============================
         */
        $anggota = Anggota::where('email', $request->email)->first();

        if (!$anggota) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar.'
            ]);
        }

        // ❌ BELUM DIVERIFIKASI
        if ($anggota->status_validasi !== 'diterima') {
            return back()->withErrors([
                'email' => 'Akun Anda belum diverifikasi oleh admin.'
            ]);
        }

        // ❌ STATUS NONAKTIF
        if ($anggota->status_anggota !== 'aktif') {
            return back()->withErrors([
                'email' => 'Akun Anda belum aktif.'
            ]);
        }

        // ✅ BARU BOLEH LOGIN
        if (Auth::guard('anggota')->attempt(
            $request->only('email', 'password')
        )) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'password' => 'Password salah.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Auth::guard('admin')->logout();
        Auth::guard('anggota')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
