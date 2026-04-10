<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
    $users = User::query()
        ->when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', "%{$request->search}%")
              ->orWhere('email', 'like', "%{$request->search}%")
              ->orWhere('username', 'like', "%{$request->search}%");
        })
        ->when($request->role, function ($q) use ($request) {
            $q->where('role', $request->role);
        })
        ->paginate(10)
        ->withQueryString();

    return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|min:3|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|email:rfc,dns',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,petugas,peminjam',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Tambah User',
            'deskripsi' => "Menambahkan user: {$validated['username']}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
            'phone_number' => 'nullable|string|max:20',
            'role' => 'required|in:admin,petugas,peminjam',
            'status' => 'required|in:aktif,nonaktif',
            'password' => 'nullable|min:6|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Edit User',
            'deskripsi' => "Mengedit user: {$user->username}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diubah');
    }

    public function destroy(User $user)
    {
        $user->delete();

        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Hapus User',
            'deskripsi' => "Menghapus user: {$user->username}",
            'waktu' => now()->toTimeString(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }
}
