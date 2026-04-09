<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('user', 'alat')
            ->latest()
            ->paginate(10);

        return view('admin.peminjamans.index', compact('peminjamans'));
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load('user', 'alat', 'pengembalian');

        return view('admin.peminjamans.show', compact('peminjaman'));
    }

    public function approve(Peminjaman $peminjaman)
    {
        $peminjaman->update(['status' => 'disetujui']);

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Setujui Peminjaman',
            'deskripsi' => "Menyetujui peminjaman alat {$peminjaman->alat->nama_alat} oleh {$peminjaman->user->name}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil disetujui');
    }

    public function reject(Peminjaman $peminjaman)
    {
        $peminjaman->update(['status' => 'ditolak']);

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Tolak Peminjaman',
            'deskripsi' => "Menolak peminjaman alat {$peminjaman->alat->nama_alat} oleh {$peminjaman->user->name}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil ditolak');
    }
}
