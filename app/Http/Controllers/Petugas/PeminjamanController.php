<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('user', 'alat')
            ->when(request('status'), fn($q) => $q->where('status', request('status')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('petugas.peminjamans.index', compact('peminjamans'));
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load('user', 'alat', 'pengembalian');

        return view('petugas.peminjamans.show', compact('peminjaman'));
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

    public function reject(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'alasan_ditolak' => 'required|string|max:500',
        ]);

        $peminjaman->update([
            'status'        => 'ditolak',
            'alasan_ditolak' => $request->alasan_ditolak,
            'notif_dilihat' => false,
        ]);

        LogAktifitas::create([
            'user_id'   => auth()->id(),
            'aktivitas' => 'Tolak Peminjaman',
            'deskripsi' => "Menolak peminjaman alat {$peminjaman->alat->nama_alat} oleh {$peminjaman->user->name}",
            'waktu'     => now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil ditolak');
    }
        public function print()
    {
        $peminjamans = Peminjaman::with('user', 'alat')
            ->when(request('status'), fn($q) => $q->where('status', request('status')))
            ->latest()
            ->get();

        return view('petugas.peminjamans.print', compact('peminjamans'));
    }
}
