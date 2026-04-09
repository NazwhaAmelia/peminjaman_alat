<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('alats')->paginate(10);

        return view('admin.kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategoris.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|unique:kategoris|max:255',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        Kategori::create($validated);

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Tambah Kategori',
            'deskripsi' => "Menambahkan kategori: {$validated['nama_kategori']}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Kategori $kategori)
    {
        return view('admin.kategoris.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,'.$kategori->id.'|max:255',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        $kategori->update($validated);

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Edit Kategori',
            'deskripsi' => "Mengedit kategori: {$kategori->nama_kategori}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil diubah');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Hapus Kategori',
            'deskripsi' => "Menghapus kategori: {$kategori->nama_kategori}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil dihapus');
    }
}
