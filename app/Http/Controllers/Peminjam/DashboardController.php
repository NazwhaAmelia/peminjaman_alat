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
        $alats = Alat::with('kategori')
            ->where('jumlah_tersedia', '>', 0)
            ->get();

        $peminjamans = Peminjaman::with('alat', 'pengembalian')
            ->where('user_id', auth()->id())
            ->where('status', 'disetujui')
            ->whereNull('pengembalian_id')
            ->latest()
            ->get();

        $kategoris = Kategori::all();

        // ✅ Cek peminjaman yang baru ditolak dan belum dilihat
        $penolakanBaru = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->where('status', 'ditolak')
            ->where('notif_dilihat', false)
            ->get();

        // ✅ Tandai semua sebagai sudah dilihat
        if ($penolakanBaru->isNotEmpty()) {
            Peminjaman::where('user_id', auth()->id())
                ->where('status', 'ditolak')
                ->where('notif_dilihat', false)
                ->update(['notif_dilihat' => true]);
        }

        return view('peminjam.dashboard', compact('alats', 'peminjamans', 'kategoris', 'penolakanBaru'));
    }
}