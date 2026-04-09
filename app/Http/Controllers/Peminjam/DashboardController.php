<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('peminjam.dashboard');
    }
}
