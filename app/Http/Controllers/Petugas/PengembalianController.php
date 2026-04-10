<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.alat')
            ->latest()
            ->paginate(10);

        return view('petugas.pengembalians.index', compact('pengembalians'));
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load('peminjaman.user', 'peminjaman.alat');

        return view('petugas.pengembalians.show', compact('pengembalian'));
    }
    public function print()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.alat')
            ->latest()
            ->get();

        return view('petugas.pengembalians.print', compact('pengembalians'));
    }
}
