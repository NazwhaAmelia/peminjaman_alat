<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAlats = Alat::count();
        $totalKategoris = Kategori::count();
        $totalPeminjamans = Peminjaman::count();
        $pendingPeminjamans = Peminjaman::where('status', 'pending')->count();
        $peminjamsPerRole = User::selectRaw('role, count(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAlats',
            'totalKategoris',
            'totalPeminjamans',
            'pendingPeminjamans',
            'peminjamsPerRole'
        ));
    }
}
