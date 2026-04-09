<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Store login credentials
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // Log aktivitas
            LogAktifitas::create([
                'user_id' => auth()->id(),
                'aktivitas' => 'Login',
                'deskripsi' => 'User melakukan login',
                'waktu' => now()->toTimeString(),
            ]);

            // Redirect berdasarkan role
            return $this->redirectByRole();
        }

        return back()->withErrors([
            'login' => 'Username atau password salah',
        ])->onlyInput('username');
    }

    /**
     * Redirect user berdasarkan role
     */
    private function redirectByRole()
    {
        $user = auth()->user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'petugas' => redirect()->route('petugas.dashboard'),
            'peminjam' => redirect()->route('peminjam.dashboard'),
            default => redirect('/'),
        };
    }
}
