<?php

namespace App\Http\Controllers;

use App\Http\Requests\PinjamanRequest;
use App\Models\Pinjaman;
use App\Models\Anggota;

class PinjamanController extends Controller
{
    /**
     * Tampilkan semua pinjaman
     */
    public function index()
    {
        $pinjaman = Pinjaman::with('anggota')->latest()->get();
        return view('pinjaman.index', compact('pinjaman'));
    }

    /**
     * Form tambah pinjaman
     */
    public function create()
    {
        return view('pinjaman.form', [
            'pinjaman' => new Pinjaman(),
            'anggota'  => Anggota::where('status_anggota', 'aktif')->get(),
            'page_meta' => [
                'title'  => 'Tambah Pinjaman',
                'method' => 'POST',
                'url'    => route('pinjaman.store'),
                'button' => 'Simpan'
            ]
        ]);
    }

    /**
     * Simpan data pinjaman baru
     */
    public function store(PinjamanRequest $request)
    {
        $data = $request->validated();

        // Hitung total pinjaman = jumlah + bunga
        $data['total_pinjaman'] = $data['jumlah_pinjaman'] + ($data['jumlah_pinjaman'] * $data['bunga'] / 100);

        Pinjaman::create($data);

        return redirect()->route('pinjaman.index')
            ->with('success', 'Pinjaman berhasil ditambahkan');
    }

    /**
     * Form edit pinjaman
     */
    public function edit(Pinjaman $pinjaman)
    {
        return view('pinjaman.form', [
            'pinjaman' => $pinjaman,
            'anggota'  => Anggota::where('status_anggota', 'aktif')->get(),
            'page_meta' => [
                'title'  => 'Edit Pinjaman',
                'method' => 'PUT',
                'url'    => route('pinjaman.update', $pinjaman->id),
                'button' => 'Update'
            ]
        ]);
    }

    /**
     * Update pinjaman
     */
    public function update(PinjamanRequest $request, Pinjaman $pinjaman)
    {
        $data = $request->validated();
        $data['total_pinjaman'] = $data['jumlah_pinjaman'] + ($data['jumlah_pinjaman'] * $data['bunga'] / 100);

        $pinjaman->update($data);

        return redirect()->route('pinjaman.index')
            ->with('success', 'Pinjaman berhasil diperbarui');
    }

    /**
     * Hapus pinjaman
     */
    public function destroy(Pinjaman $pinjaman)
    {
        $pinjaman->delete();
        return back()->with('success', 'Pinjaman berhasil dihapus');
    }
}
