<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;

class LogAktifitasController extends Controller
{
    public function index()
    {
        $logs = LogAktifitas::with('user')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.log-aktivitas.index', compact('logs'));
    }
}
