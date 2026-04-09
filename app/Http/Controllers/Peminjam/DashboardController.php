<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        // Get available equipment with availability > 0
        $alats = Alat::with('kategori')
            ->where('jumlah_tersedia', '>', 0)
            ->get();

        // Get current user's ongoing loans
        $peminjamans = Peminjaman::with('alat', 'pengembalian')
            ->where('user_id', auth()->id())
            ->where('status', 'disetujui')
            ->whereNull('pengembalian_id')
            ->latest()
            ->get();

        // Get categories for filter
        $kategoris = Kategori::all();

        return view('peminjam.dashboard', compact('alats', 'peminjamans', 'kategoris'));
    }
}
