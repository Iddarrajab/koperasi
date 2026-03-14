<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimpananRequest;
use App\Models\Simpanan;
use App\Models\Anggota;

class SimpananController extends Controller
{
    /**
     * Tampilkan RIWAYAT simpanan
     * (saldo masuk + saldo setelah transaksi)
     */
    public function index()
    {
        $simpanan = Simpanan::with('anggota')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('simpanan.index', compact('simpanan'));
    }

    /**
     * Form tambah simpanan (TRANSAKSI BARU)
     */
    public function create()
    {
        return view('simpanan.form', [
            'simpanan' => new Simpanan(),
            'anggota'  => Anggota::where('status_anggota', 'aktif')->get(),
            'page_meta' => [
                'title'  => 'Tambah Simpanan',
                'method' => 'POST',
                'url'    => route('simpanan.store'),
                'button' => 'Simpan'
            ]
        ]);
    }

    /**
     * Simpan TRANSAKSI simpanan
     * (saldo dihitung & disimpan)
     */
    public function store(SimpananRequest $request)
    {
        $data = $request->validated();

        // Mapping jenis simpanan ke enum database
        $data['jenis_simpanan'] = match ($data['jenis_simpanan']) {
            'pokok'     => 'simpanan_pokok',
            'wajib'     => 'simpanan_wajib',
            'sukarela'  => 'simpanan_sukarela',
            default     => $data['jenis_simpanan'],
        };

        // Ambil saldo terakhir per anggota + jenis
        $saldoTerakhir = Simpanan::where('anggota_id', $data['anggota_id'])
            ->where('jenis_simpanan', $data['jenis_simpanan'])
            ->latest('id')
            ->value('saldo') ?? 0;

        // Hitung saldo baru
        $data['saldo'] = $saldoTerakhir + $data['jumlah_setoran'];

        // Simpan TRANSAKSI BARU (saldo lama tidak diubah)
        Simpanan::create($data);

        return redirect()
            ->route('simpanan.index')
            ->with('success', 'Simpanan berhasil ditambahkan');
    }

    /**
     * Form edit TRANSAKSI
     * (opsional – biasanya transaksi tidak diedit)
     */
    public function edit(Simpanan $simpanan)
    {
        return view('simpanan.form', [
            'simpanan' => $simpanan,
            'anggota'  => Anggota::where('status_anggota', 'aktif')->get(),
            'page_meta' => [
                'title'  => 'Edit Simpanan',
                'method' => 'PUT',
                'url'    => route('simpanan.update', $simpanan->id),
                'button' => 'Update'
            ]
        ]);
    }

    /**
     * Update TRANSAKSI
     * (HATI-HATI: bisa merusak histori)
     */
    public function update(SimpananRequest $request, Simpanan $simpanan)
    {
        $data = $request->validated();

        $data['jenis_simpanan'] = match ($data['jenis_simpanan']) {
            'pokok'     => 'simpanan_pokok',
            'wajib'     => 'simpanan_wajib',
            'sukarela'  => 'simpanan_sukarela',
            default     => $data['jenis_simpanan'],
        };

        // ❗ Jika update diizinkan, saldo disesuaikan ulang
        $saldoSebelumnya = Simpanan::where('anggota_id', $simpanan->anggota_id)
            ->where('jenis_simpanan', $data['jenis_simpanan'])
            ->where('id', '<', $simpanan->id)
            ->latest('id')
            ->value('saldo') ?? 0;

        $data['saldo'] = $saldoSebelumnya + $data['jumlah_setoran'];

        $simpanan->update($data);

        return redirect()
            ->route('simpanan.index')
            ->with('success', 'Simpanan berhasil diperbarui');
    }

    /**
     * Hapus TRANSAKSI
     * (biasanya lebih aman soft delete)
     */
    public function destroy(Simpanan $simpanan)
    {
        $simpanan->delete();

        return back()->with('success', 'Simpanan berhasil dihapus');
    }
}
