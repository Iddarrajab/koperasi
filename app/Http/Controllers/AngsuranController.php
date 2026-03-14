<?php

namespace App\Http\Controllers;

use App\Http\Requests\AngsuranRequest;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    /**
     * Tampilkan daftar angsuran
     * Hanya admin yang bisa mengakses
     */
    public function index()
    {
        $angsuran = Angsuran::with('pinjaman.anggota')->latest()->get();
        return view('angsuran.index', compact('angsuran'));
    }

    /**
     * Form tambah angsuran
     */
    public function create()
    {
        $pinjaman = Pinjaman::with('anggota')->where('status_pinjaman', 'aktif')->get();

        return view('angsuran.form', [
            'angsuran' => new Angsuran(),
            'pinjaman' => $pinjaman,
            'page_meta' => [
                'title'  => 'Tambah Angsuran',
                'method' => 'POST',
                'url'    => route('angsuran.store'),
                'button' => 'Simpan'
            ]
        ]);
    }

    /**
     * Simpan angsuran baru
     */
    public function store(AngsuranRequest $request)
    {
        $pinjaman = Pinjaman::findOrFail($request->pinjaman_id);

        // Hitung total angsuran sebelumnya + angsuran baru
        $totalBayar = $pinjaman->angsuran()->sum('jumlah_angsuran') + $request->jumlah_angsuran;
        $sisa = $pinjaman->total_pinjaman - $totalBayar;

        // Simpan angsuran baru
        $angsuran = Angsuran::create([
            'pinjaman_id'       => $pinjaman->id,
            'jumlah_angsuran'   => $request->jumlah_angsuran,
            'tanggal_bayar'     => $request->tanggal_bayar,
            'sisa_pinjaman'     => $sisa, // penting agar tidak error
            'status_pembayaran' => $sisa <= 0 ? 'lunas' : 'belum',
        ]);

        // Update sisa pinjaman & status pinjaman
        $pinjaman->update([
            'sisa_pinjaman'   => $sisa,
            'status_pinjaman' => $sisa <= 0 ? 'lunas' : 'aktif',
        ]);

        return redirect()->route('angsuran.index')
            ->with('success', 'Angsuran berhasil ditambahkan dan sisa pinjaman diperbarui.');
    }

    /**
     * Form edit angsuran
     */
    public function edit(Angsuran $angsuran)
    {
        $pinjaman = Pinjaman::with('anggota')->where('status_pinjaman', 'aktif')->get();

        return view('angsuran.form', [
            'angsuran' => $angsuran,
            'pinjaman' => $pinjaman,
            'page_meta' => [
                'title'  => 'Edit Angsuran',
                'method' => 'PUT',
                'url'    => route('angsuran.update', $angsuran->id),
                'button' => 'Update'
            ]
        ]);
    }

    /**
     * Update angsuran
     */
    public function update(AngsuranRequest $request, Angsuran $angsuran)
    {
        $pinjaman = Pinjaman::findOrFail($request->pinjaman_id);

        // Hitung total angsuran baru tanpa menghitung angsuran lama
        $totalBayar = $pinjaman->angsuran()->where('id', '!=', $angsuran->id)->sum('jumlah_angsuran')
            + $request->jumlah_angsuran;
        $sisa = $pinjaman->total_pinjaman - $totalBayar;

        // Update angsuran
        $angsuran->update([
            'pinjaman_id'       => $pinjaman->id,
            'jumlah_angsuran'   => $request->jumlah_angsuran,
            'tanggal_bayar'     => $request->tanggal_bayar,
            'sisa_pinjaman'     => $sisa,
            'status_pembayaran' => $sisa <= 0 ? 'lunas' : 'belum',
        ]);

        // Update sisa pinjaman & status pinjaman
        $pinjaman->update([
            'sisa_pinjaman'   => $sisa,
            'status_pinjaman' => $sisa <= 0 ? 'lunas' : 'aktif',
        ]);

        return redirect()->route('angsuran.index')
            ->with('success', 'Angsuran berhasil diperbarui dan sisa pinjaman diperbarui.');
    }

    /**
     * Hapus angsuran
     */
    public function destroy(Angsuran $angsuran)
    {
        $pinjaman = $angsuran->pinjaman;

        // Hapus angsuran
        $angsuran->delete();

        // Update sisa pinjaman setelah angsuran dihapus
        $totalBayar = $pinjaman->angsuran()->sum('jumlah_angsuran');
        $sisa = $pinjaman->total_pinjaman - $totalBayar;

        $pinjaman->update([
            'sisa_pinjaman'   => $sisa,
            'status_pinjaman' => $sisa <= 0 ? 'lunas' : 'aktif',
        ]);

        return redirect()->route('angsuran.index')
            ->with('success', 'Angsuran berhasil dihapus dan sisa pinjaman diperbarui.');
    }
}
