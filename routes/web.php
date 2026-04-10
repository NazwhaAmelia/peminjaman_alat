<?php

use App\Http\Controllers\Admin\AlatController as AdminAlatController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LogAktifitasController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\PengembalianController as AdminPengembalianController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboard;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController;
use Illuminate\Support\Facades\Route;

// Login Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::get('/', function () {
    return view('welcome');
});

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class);

    // Alat Management
    Route::resource('alats', AdminAlatController::class);

    // Kategori Management
    Route::resource('kategoris', KategoriController::class);

    // Peminjaman Management
    Route::get('peminjamans', [AdminPeminjamanController::class, 'index'])->name('peminjamans.index');
    Route::get('peminjamans/{peminjaman}', [AdminPeminjamanController::class, 'show'])->name('peminjamans.show');
    Route::post('peminjamans/{peminjaman}/approve', [AdminPeminjamanController::class, 'approve'])->name('peminjamans.approve');
    Route::post('peminjamans/{peminjaman}/reject', [AdminPeminjamanController::class, 'reject'])->name('peminjamans.reject');

    // Pengembalian Management
    Route::get('pengembalians', [AdminPengembalianController::class, 'index'])->name('pengembalians.index');
    Route::get('pengembalians/{pengembalian}', [AdminPengembalianController::class, 'show'])->name('pengembalians.show');

    // Log Aktivitas
    Route::get('log-aktivitas', [LogAktifitasController::class, 'index'])->name('log-aktivitas.index');
});

// Petugas Routes
Route::middleware(['auth', 'petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');

    // Peminjaman Management
    Route::get('peminjamans/print', [PetugasPeminjamanController::class, 'print'])->name('peminjamans.print'); // ✅ TAMBAH DI SINI
    Route::get('peminjamans', [PetugasPeminjamanController::class, 'index'])->name('peminjamans.index');
    Route::get('peminjamans/{peminjaman}', [PetugasPeminjamanController::class, 'show'])->name('peminjamans.show');
    Route::post('peminjamans/{peminjaman}/approve', [PetugasPeminjamanController::class, 'approve'])->name('peminjamans.approve');
    Route::post('peminjamans/{peminjaman}/reject', [PetugasPeminjamanController::class, 'reject'])->name('peminjamans.reject');

    // Pengembalian Management
    Route::get('pengembalians/print', [PengembalianController::class, 'print'])->name('pengembalians.print'); // ✅ TAMBAH DI SINI
    Route::get('pengembalians', [PengembalianController::class, 'index'])->name('pengembalians.index');
    Route::get('pengembalians/{pengembalian}', [PengembalianController::class, 'show'])->name('pengembalians.show');
});

// Peminjam Routes
Route::middleware(['auth', 'peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('dashboard', [PeminjamDashboard::class, 'index'])->name('dashboard');

    // Peminjaman
    Route::post('peminjamans', [PeminjamPeminjamanController::class, 'store'])->name('peminjamans.store');
    Route::post('peminjamans/{peminjaman}/return', [PeminjamPeminjamanController::class, 'return'])->name('peminjamans.return');
});
