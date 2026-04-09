<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Log aktivitas
        LogAktifitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Logout',
            'deskripsi' => 'User melakukan logout',
            'waktu' => now()->toTimeString(),
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
