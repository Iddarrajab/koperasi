<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'publicHome'])
    ->name('home');

Route::middleware('guest')->group(function () {

    // LOGIN
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login.form');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login');

    // DAFTAR ANGGOTA (PUBLIK)
    Route::get('/daftar-anggota', [AnggotaController::class, 'daftar'])
        ->name('anggota.daftar');

    Route::post('/daftar-anggota', [AnggotaController::class, 'daftarStore'])
        ->name('anggota.daftar.store');
});

// LOGOUT (SEMUA ROLE)
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:admin'])
    ->prefix('admin')
    ->group(function () {

        // ANGGOTA
        Route::resource('anggota', AnggotaController::class)
            ->except(['create', 'store', 'show']);

        Route::post('/anggota/{anggota}/validasi', [AnggotaController::class, 'validasi'])
            ->name('anggota.validasi');

        // PINJAMAN
        Route::resource('pinjaman', PinjamanController::class);

        // SIMPANAN
        Route::resource('simpanan', SimpananController::class);

        // ANGSURAN
        Route::resource('angsuran', AngsuranController::class);

        // ADMIN
        Route::get('admin', [AdminController::class, 'index'])
            ->name('admin.index');

        Route::get('admin/create', [AdminController::class, 'create'])
            ->name('admin.create');

        Route::post('admin', [AdminController::class, 'store'])
            ->name('admin.store');
    });
