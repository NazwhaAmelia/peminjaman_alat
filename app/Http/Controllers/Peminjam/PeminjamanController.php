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

        // Calculate denda based on condition and lateness
        $denda = 0;
        $kondisiAlat = $validated['kondisi_alat'];

        // Denda berdasarkan kondisi x jumlah alat
        if ($kondisiAlat === 'rusak') {
            $denda = 100000 * $peminjaman->jumlah_pinjam;
        } elseif ($kondisiAlat === 'hilang') {
            $denda = 500000 * $peminjaman->jumlah_pinjam;
        }

        // Tambahkan denda keterlambatan jika ada
        if ($peminjaman->tanggal_kembali_rencana < now()->toDateString()) {
            $late_days = now()->diffInDays($peminjaman->tanggal_kembali_rencana);
            $denda += $late_days * 50000; // Rp 50.000 per hari
        }

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_kembali' => now()->toDateString(),
            'kondisi_alat' => $kondisiAlat,
            'denda' => $denda,
        ]);

        // Update peminjaman status
        $peminjaman->update([
            'status' => 'selesai',
            'pengembalian_id' => $pengembalian->id,
        ]);

        // Update alat availability
        if ($kondisiAlat === 'baik') {
            $peminjaman->alat->increment('jumlah_tersedia', $peminjaman->jumlah_pinjam);
        } elseif ($kondisiAlat === 'rusak') {
            $peminjaman->alat->update(['kondisi' => 'rusak']);
        } elseif ($kondisiAlat === 'hilang') {
            $peminjaman->alat->decrement('jumlah_tersedia', $peminjaman->jumlah_pinjam);
        }

        // Log aktivitas untuk semua kasus
        $logDeskripsi = "Mengembalikan {$peminjaman->alat->nama_alat} dalam kondisi {$kondisiAlat}";

        // Tambahkan info denda dan notifikasi jika rusak/hilang
        if ($kondisiAlat === 'rusak' || $kondisiAlat === 'hilang') {
            $logDeskripsi .= ' | Denda: Rp '.number_format($denda, 0, ',', '.');

            if ($kondisiAlat === 'rusak') {
                $logDeskripsi .= ' | [ALERT] Alat rusak - perlu diperiksa oleh petugas';
            } elseif ($kondisiAlat === 'hilang') {
                $logDeskripsi .= ' | [ALERT PENTING] Alat HILANG - perlu penyelidikan segera';
            }
        }

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Kembalikan Peminjaman',
            'deskripsi' => $logDeskripsi,
            'waktu' => now()->toTimeString(),
        ]);

        // Log khusus untuk admin/petugas jika ada kendala
        if ($kondisiAlat === 'rusak' || $kondisiAlat === 'hilang') {
            LogAktifitas::create([
                'user_id' => auth()->id(),
                'aktivitas' => $kondisiAlat === 'rusak' ? '⚠ ALERT: Alat Rusak' : '✕ ALERT PENTING: Alat Hilang',
                'deskripsi' => "Peminjam: {$peminjaman->user->name} | Alat: {$peminjaman->alat->nama_alat} | Denda: Rp ".number_format($denda, 0, ',', '.'),
                'waktu' => now()->toTimeString(),
            ]);
        }

        $message = 'Alat berhasil dikembalikan';
        if ($denda > 0) {
            $message .= ' | Denda: Rp '.number_format($denda, 0, ',', '.');
        }

        return redirect()->route('peminjam.dashboard')->with('success', $message);
    }
}
