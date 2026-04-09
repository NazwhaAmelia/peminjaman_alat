@extends('layouts.app')

@section('title', 'Detail Peminjaman - Admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.peminjamans.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Informasi Peminjaman</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Nama Peminjam</label>
                        <p class="h6">{{ $peminjaman->user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Username</label>
                        <p class="h6">{{ $peminjaman->user->username }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Email</label>
                        <p class="h6">{{ $peminjaman->user->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Telepon</label>
                        <p class="h6">{{ $peminjaman->user->phone_number ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Informasi Alat</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Nama Alat</label>
                        <p class="h6">{{ $peminjaman->alat->nama_alat }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Kategori</label>
                        <p class="h6">{{ $peminjaman->alat->kategori->nama_kategori }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Jumlah Pinjam</label>
                        <p class="h6"><span class="badge bg-info">{{ $peminjaman->jumlah_pinjam }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Kondisi</label>
                        <p class="h6"><span class="badge bg-success">{{ ucfirst($peminjaman->alat->kondisi) }}</span></p>
                    </div>
                </div>
                <div>
                    <label class="form-label text-muted">Deskripsi</label>
                    <p>{{ $peminjaman->alat->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Jadwal Peminjaman</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Tanggal Pinjam</label>
                        <p class="h6">{{ $peminjaman->tanggal_pinjam->format('d-m-Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Tanggal Kembali Rencana</label>
                        <p class="h6">{{ $peminjaman->tanggal_kembali_rencana->format('d-m-Y') }}</p>
                    </div>
                </div>
                <div>
                    <label class="form-label text-muted">Durasi Peminjaman</label>
                    <p class="h6">
                        {{ $peminjaman->tanggal_pinjam->diffInDays($peminjaman->tanggal_kembali_rencana) }} hari
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Status & Aksi</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-muted">Status Saat Ini</label>
                    <div>
                        @if ($peminjaman->status === 'pending')
                            <span class="badge bg-warning text-dark p-2">
                                <i class="fas fa-clock me-1"></i> PENDING
                            </span>
                        @elseif ($peminjaman->status === 'disetujui')
                            <span class="badge bg-success p-2">
                                <i class="fas fa-check me-1"></i> DISETUJUI
                            </span>
                        @elseif ($peminjaman->status === 'ditolak')
                            <span class="badge bg-danger p-2">
                                <i class="fas fa-times me-1"></i> DITOLAK
                            </span>
                        @else
                            <span class="badge bg-secondary p-2">{{ strtoupper($peminjaman->status) }}</span>
                        @endif
                    </div>
                </div>

                @if ($peminjaman->status === 'pending')
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.peminjamans.approve', $peminjaman->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check me-2"></i> Setujui Peminjaman
                            </button>
                        </form>
                        <form action="{{ route('admin.peminjamans.reject', $peminjaman->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times me-2"></i> Tolak Peminjaman
                            </button>
                        </form>
                    </div>
                @else
                    <div class="alert alert-info p-2" role="alert">
                        <small><i class="fas fa-info-circle me-1"></i> Status tidak dapat diubah</small>
                    </div>
                @endif

                @if ($peminjaman->pengembalian)
                    <hr>
                    <div class="mt-3">
                        <label class="form-label text-muted">Pengembalian</label>
                        <div>
                            <a href="{{ route('admin.pengembalians.show', $peminjaman->pengembalian->id) }}"
                                class="btn btn-outline-primary btn-sm btn-block w-100">
                                <i class="fas fa-info-circle me-2"></i> Lihat Detail Pengembalian
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
