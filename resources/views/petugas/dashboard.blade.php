@extends('layouts.app')

@section('title', 'Petugas Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 mb-4">
                <i class="fas fa-tachometer-alt"></i> Dashboard Petugas
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
                    <p>Anda login sebagai <strong>Petugas</strong>.</p>
                    <hr>
                    <p>Navigasi menu di sebelah kiri untuk mengelola peminjaman dan pengembalian alat.</p>

                    <div class="mt-4">
                        <h5>Menu Utama:</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('petugas.peminjamans.index') }}">
                                    <i class="fas fa-handshake"></i> Kelola Peminjaman
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('petugas.pengembalians.index') }}">
                                    <i class="fas fa-undo"></i> Kelola Pengembalian
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
