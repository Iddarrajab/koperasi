<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Tampilkan daftar admin.
     */
    public function index()
    {
        $query = Admin::latest();

        if (request()->filled('search')) {
            $search = request('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $admin = $query->get();

        return view('admin.index', compact('admin'));
    }

    /**
     * Form tambah admin baru.
     */
    public function create()
    {
        return view('admin.form', [
            'admin' => new Admin(),
            'page_meta' => [
                'title'  => 'Tambah Admin Baru',
                'method' => 'POST',
                'url'    => route('admin.store'),
                'button' => 'Simpan'
            ]
        ]);
    }

    /**
     * Simpan admin baru ke database.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->validated();

        // hash password
        $data['password'] = Hash::make($data['password']);

        Admin::create($data);

        return redirect()->route('admin.index')
            ->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Form edit admin.
     */
    public function edit(Admin $admin)
    {
        return view('admin.form', [
            'admin' => $admin,
            'page_meta' => [
                'title'  => 'Edit Admin ' . $admin->name,
                'method' => 'PUT',
                'url'    => route('admin.update', $admin),
                'button' => 'Update'
            ]
        ]);
    }

    /**
     * Update data admin.
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $data = $request->validated();

        // jika password diisi → update, jika tidak → abaikan
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $admin->update($data);

        return redirect()->route('admin.index')
            ->with('success', 'Admin berhasil diupdate');
    }

    /**
     * Hapus admin.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Admin berhasil dihapus');
    }
}
