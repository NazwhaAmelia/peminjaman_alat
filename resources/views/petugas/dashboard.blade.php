@extends('layouts.app')

@section('title', 'Petugas Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 mb-2">
                <i class="fas fa-tachometer-alt"></i> Dashboard Petugas
            </h1>
            <p class="text-muted">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-clock text-warning" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title mt-3">Menunggu Persetujuan</h5>
                    <h2 class="text-warning">{{ $pendingCount }}</h2>
                    <small class="text-muted">Peminjaman</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-check-circle text-success" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title mt-3">Disetujui</h5>
                    <h2 class="text-success">{{ $approvedCount }}</h2>
                    <small class="text-muted">Peminjaman</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-times-circle text-danger" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title mt-3">Ditolak</h5>
                    <h2 class="text-danger">{{ $rejectedCount }}</h2>
                    <small class="text-muted">Peminjaman</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-undo text-info" style="font-size: 2.5rem;"></i>
                    <h5 class="card-title mt-3">Pengembalian</h5>
                    <h2 class="text-info">{{ $pengembalianCount }}</h2>
                    <small class="text-muted">Total</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-tasks"></i> Menu Utama
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Pilih menu di bawah untuk mengelola peminjaman dan pengembalian alat.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('petugas.peminjamans.index') }}" class="card text-decoration-none">
                                <div class="card-body text-center">
                                    <i class="fas fa-clipboard-check" style="font-size: 2.5rem; color: #17a2b8;"></i>
                                    <h5 class="card-title mt-3">Menyetujui Peminjaman</h5>
                                    <p class="card-text text-muted">Tinjau dan setujui permintaan peminjaman alat dari pengguna.</p>
                                    <span class="badge bg-warning text-dark">{{ $pendingCount }} Menunggu</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('petugas.pengembalians.index') }}" class="card text-decoration-none">
                                <div class="card-body text-center">
                                    <i class="fas fa-clipboard-list" style="font-size: 2.5rem; color: #17a2b8;"></i>
                                    <h5 class="card-title mt-3">Memantau Pengembalian</h5>
                                    <p class="card-text text-muted">Pantau pengembalian alat dan proses denda keterlambatan.</p>
                                    <span class="badge bg-info">{{ $pengembalianCount }} Tercatat</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
