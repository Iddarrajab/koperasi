<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AnggotaController extends Controller
{
    /**
     * ===============================
     * FORM PENDAFTARAN (PUBLIK)
     * ===============================
     */
    public function daftar()
    {
        $page_meta = [
            'title'  => 'Pendaftaran Anggota',
            'url'    => route('anggota.daftar.store'),
            'method' => 'POST',
            'button' => 'Daftar',
        ];

        return view('anggota.form', compact('page_meta'));
    }

    /**
     * ===============================
     * SIMPAN PENDAFTARAN (PUBLIK)
     * ===============================
     */
    public function daftarStore(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:anggota,email',
            'password' => 'required|min:6',
            'alamat'   => 'required',
            'no_hp'    => 'required',
        ]);

        Anggota::create([
            'kode_anggota'    => strtoupper(Str::random(8)),
            'nomor_anggota'   => 'AGT-' . date('Y') . '-' . strtoupper(Str::random(5)),
            'nama'            => $request->nama,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'alamat'          => $request->alamat,
            'no_hp'           => $request->no_hp,
            'status_anggota'  => 'nonaktif',
            'status_validasi' => 'menunggu',
        ]);

        return redirect()->route('login.form')
            ->withErrors([
                'email' => 'Pendaftaran berhasil. Akun Anda menunggu verifikasi admin.'
            ]);
    }

    /**
     * ===============================
     * ADMIN - LIST ANGGOTA
     * ===============================
     */
    public function index()
    {
        $anggota = Anggota::latest()->get();
        return view('anggota.index', compact('anggota'));
    }

    /**
     * ===============================
     * ADMIN - EDIT ANGGOTA
     * ===============================
     */
    public function edit(Anggota $anggotum)
    {
        // $page_meta untuk memudahkan form reuse
        $page_meta = [
            'title'  => 'Edit Anggota',
            'url'    => route('anggota.update', $anggotum->id),
            'method' => 'PUT',
            'button' => 'Update',
        ];

        return view('anggota.form', compact('anggotum', 'page_meta'));
    }

    /**
     * ===============================
     * ADMIN - UPDATE ANGGOTA
     * ===============================
     */
    public function update(Request $request, Anggota $anggotum)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|unique:anggota,email,' . $anggotum->id,
            'alamat' => 'required',
            'no_hp'  => 'required',
        ]);

        $anggotum->update([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'alamat' => $request->alamat,
            'no_hp'  => $request->no_hp,
        ]);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * ===============================
     * ADMIN - VALIDASI ANGGOTA
     * ===============================
     */
    public function validasi(Anggota $anggota)
    {
        $anggota->update([
            'status_anggota'  => 'aktif',
            'status_validasi' => 'diterima',
            'validated_by'    => Auth::guard('admin')->id(),
        ]);

        return back()->with('success', 'Anggota berhasil divalidasi.');
    }

    /**
     * ===============================
     * ADMIN - HAPUS ANGGOTA
     * ===============================
     */
    public function destroy(Anggota $anggotum)
    {
        $anggotum->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
