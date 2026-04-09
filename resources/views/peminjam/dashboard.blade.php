@extends('layouts.app')

@section('title', 'Peminjam Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 mb-4">
                <i class="fas fa-tachometer-alt"></i> Dashboard Peminjam
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-welcome"></i> Selamat Datang
                </div>
                <div class="card-body">
                    <p>Halo, <strong>{{ auth()->user()->name }}</strong>!</p>
                    <p>Anda login sebagai <strong>Peminjam</strong>.</p>
                    <hr>
                    <p>Navigasi menu di sebelah kiri untuk melihat daftar alat dan mengajukan peminjaman.</p>

                    <div class="mt-4">
                        <h5>Menu Utama:</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('peminjam.alats.index') }}">
                                    <i class="fas fa-tools"></i> Lihat Daftar Alat
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('peminjam.peminjamans.index') }}">
                                    <i class="fas fa-clipboard-list"></i> Riwayat Peminjaman
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
