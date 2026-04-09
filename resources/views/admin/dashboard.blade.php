@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 mb-4">
                <i class="fas fa-tachometer-alt"></i> Dashboard Admin
            </h1>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-users" style="font-size: 2.5rem; color: #17a2b8;"></i>
                <div class="number">{{ $totalUsers }}</div>
                <p class="text-muted mb-0">Total Pengguna</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-tools" style="font-size: 2.5rem; color: #28a745;"></i>
                <div class="number">{{ $totalAlats }}</div>
                <p class="text-muted mb-0">Total Alat</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-list" style="font-size: 2.5rem; color: #ffc107;"></i>
                <div class="number">{{ $totalKategoris }}</div>
                <p class="text-muted mb-0">Kategori</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-clock" style="font-size: 2.5rem; color: #dc3545;"></i>
                <div class="number">{{ $pendingPeminjamans }}</div>
                <p class="text-muted mb-0">Peminjaman Pending</p>
            </div>
        </div>
    </div>

    <!-- User Distribution -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users-chart"></i> Distribusi Pengguna
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $roles = ['admin' => 'Admin', 'petugas' => 'Petugas', 'peminjam' => 'Peminjam'];
                            @endphp
                            @foreach ($roles as $roleValue => $roleName)
                                <tr>
                                    <td>{{ $roleName }}</td>
                                    <td><span class="badge bg-primary">{{ $peminjamsPerRole[$roleValue] ?? 0 }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Ringkasan Sistem
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <strong>Total Peminjaman:</strong> <span class="float-end">{{ $totalPeminjamans }}</span>
                        </div>
                        <div class="list-group-item">
                            <strong>Peminjaman Pending:</strong> <span
                                class="float-end badge bg-warning">{{ $pendingPeminjamans }}</span>
                        </div>
                        <div class="list-group-item">
                            <strong>Total Alat Tersedia:</strong> <span class="float-end badge bg-success">{{ $totalAlats }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-quick-links"></i> Akses Cepat
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary me-2 mb-2">
                        <i class="fas fa-users"></i> Kelola Pengguna
                    </a>
                    <a href="{{ route('admin.alats.index') }}" class="btn btn-outline-success me-2 mb-2">
                        <i class="fas fa-tools"></i> Kelola Alat
                    </a>
                    <a href="{{ route('admin.kategoris.index') }}" class="btn btn-outline-warning me-2 mb-2">
                        <i class="fas fa-list"></i> Kelola Kategori
                    </a>
                    <a href="{{ route('admin.log-aktivitas.index') }}" class="btn btn-outline-info mb-2">
                        <i class="fas fa-history"></i> Lihat Log Aktivitas
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
