<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\LogAktifitas;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_kembali_rencana' => 'required|date|after:today',
        ]);

        $alat = Alat::findOrFail($validated['alat_id']);

        // Check availability
        if ($alat->jumlah_tersedia < $validated['jumlah_pinjam']) {
            return redirect()->back()->with('error', 'Jumlah alat tidak tersedia');
        }

        // Create peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $validated['alat_id'],
            'jumlah_pinjam' => $validated['jumlah_pinjam'],
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali_rencana' => $validated['tanggal_kembali_rencana'],
            'status' => 'pending',
        ]);

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Ajukan Peminjaman',
            'deskripsi' => "Mengajukan peminjaman {$validated['jumlah_pinjam']} unit {$alat->nama_alat}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('peminjam.dashboard')->with('success', 'Peminjaman berhasil diajukan');
    }

    public function return(Peminjaman $peminjaman, Request $request)
    {
        // Check if user owns this peminjaman
        if ($peminjaman->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses');
        }

        // Check if not already returned
        if ($peminjaman->pengembalian_id) {
            return redirect()->back()->with('error', 'Alat sudah dikembalikan');
        }

        $validated = $request->validate([
            'kondisi_alat' => 'required|in:baik,rusak,hilang',
        ]);

        // Create pengembalian
        $denda = 0;
        if ($peminjaman->tanggal_kembali_rencana < now()->toDateString()) {
            $late_days = now()->diffInDays($peminjaman->tanggal_kembali_rencana);
            $denda = $late_days * 50000; // Rp 50.000 per hari
        }

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_kembali' => now()->toDateString(),
            'kondisi_alat' => $validated['kondisi_alat'],
            'denda' => $denda,
        ]);

        // Update peminjaman status
        $peminjaman->update([
            'status' => 'selesai',
            'pengembalian_id' => $pengembalian->id,
        ]);

        // Update alat availability
        if ($validated['kondisi_alat'] === 'baik') {
            $peminjaman->alat->increment('jumlah_tersedia', $peminjaman->jumlah_pinjam);
        } elseif ($validated['kondisi_alat'] === 'rusak') {
            $peminjaman->alat->update(['kondisi' => 'rusak']);
        } elseif ($validated['kondisi_alat'] === 'hilang') {
            $peminjaman->alat->decrement('jumlah_tersedia', $peminjaman->jumlah_pinjam);
        }

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Kembalikan Peminjaman',
            'deskripsi' => "Mengembalikan {$peminjaman->alat->nama_alat} dalam kondisi {$validated['kondisi_alat']}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('peminjam.dashboard')->with('success', 'Alat berhasil dikembalikan');
    }
}
