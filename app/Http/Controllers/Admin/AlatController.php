<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->paginate(10);

        return view('admin.alats.index', compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view('admin.alats.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah_tersedia' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak,hilang',
        ]);

        Alat::create($validated);

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Tambah Alat',
            'deskripsi' => "Menambahkan alat: {$validated['nama_alat']}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.alats.index')->with('success', 'Alat berhasil ditambahkan');
    }

    public function show(Alat $alat)
    {
        return view('admin.alats.show', compact('alat'));
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();

        return view('admin.alats.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah_tersedia' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak,hilang',
        ]);

        $alat->update($validated);

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Edit Alat',
            'deskripsi' => "Mengedit alat: {$alat->nama_alat}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.alats.index')->with('success', 'Alat berhasil diubah');
    }

    public function destroy(Alat $alat)
    {
        $alat->delete();

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Hapus Alat',
            'deskripsi' => "Menghapus alat: {$alat->nama_alat}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.alats.index')->with('success', 'Alat berhasil dihapus');
    }
}
