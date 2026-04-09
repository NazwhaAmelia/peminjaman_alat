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
use App\Http\Controllers\Peminjam\AlatController as PeminjamAlatController;
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
    Route::resource('peminjamans', PetugasPeminjamanController::class);

    // Pengembalian Management
    Route::resource('pengembalians', PengembalianController::class);
});

// Peminjam Routes
Route::middleware(['auth', 'peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('dashboard', [PeminjamDashboard::class, 'index'])->name('dashboard');

    // Daftar Alat
    Route::get('alats', [PeminjamAlatController::class, 'index'])->name('alats.index');
    Route::get('alats/{alat}', [PeminjamAlatController::class, 'show'])->name('alats.show');

    // Peminjaman
    Route::get('peminjamans', [PeminjamPeminjamanController::class, 'index'])->name('peminjamans.index');
    Route::get('peminjamans/create', [PeminjamPeminjamanController::class, 'create'])->name('peminjamans.create');
    Route::post('peminjamans', [PeminjamPeminjamanController::class, 'store'])->name('peminjamans.store');
    Route::get('peminjamans/{peminjaman}', [PeminjamPeminjamanController::class, 'show'])->name('peminjamans.show');
});
