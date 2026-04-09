<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.alat')
            ->latest()
            ->paginate(10);

        return view('admin.pengembalians.index', compact('pengembalians'));
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load('peminjaman.user', 'peminjaman.alat');

        return view('admin.pengembalians.show', compact('pengembalian'));
    }
}
