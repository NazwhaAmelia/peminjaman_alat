@extends('layouts.app')

@section('title', 'Detail Pengembalian - Petugas')

@section('content')
    <div class="mb-4">
        <a href="{{ route('petugas.pengembalians.index') }}" class="btn btn-outline-secondary btn-sm">
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
                    <h5 class="mb-0">Informasi Peminjam</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Nama Peminjam</label>
                            <p class="h6">{{ $pengembalian->peminjaman->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Username</label>
                            <p class="h6">{{ $pengembalian->peminjaman->user->username }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Email</label>
                            <p class="h6">{{ $pengembalian->peminjaman->user->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Telepon</label>
                            <p class="h6">{{ $pengembalian->peminjaman->user->phone_number ?? '-' }}</p>
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
                            <p class="h6">{{ $pengembalian->peminjaman->alat->nama_alat }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Kategori</label>
                            <p class="h6">{{ $pengembalian->peminjaman->alat->kategori->nama_kategori }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Jumlah Pinjam</label>
                            <p class="h6"><span
                                    class="badge bg-info">{{ $pengembalian->peminjaman->jumlah_pinjam }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Kondisi Awal</label>
                            <p class="h6"><span
                                    class="badge bg-success">{{ ucfirst($pengembalian->peminjaman->alat->kondisi) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Informasi Pengembalian</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Tanggal Pinjam</label>
                            <p class="h6">{{ $pengembalian->peminjaman->tanggal_pinjam->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Tanggal Kembali Rencana</label>
                            <p class="h6">{{ $pengembalian->peminjaman->tanggal_kembali_rencana->format('d-m-Y') }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Tanggal Kembali Aktual</label>
                            <p class="h6">{{ $pengembalian->tanggal_kembali->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Keterlambatan</label>
                            <p class="h6">
                                <span class="badge bg-info">
                                    {{ $pengembalian->tanggal_kembali->greaterThan($pengembalian->peminjaman->tanggal_kembali_rencana) ? $pengembalian->tanggal_kembali->diffInDays($pengembalian->peminjaman->tanggal_kembali_rencana) . ' hari' : '0 hari' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Kondisi Saat Dikembalikan</label>
                            <p class="h6">
                                @if ($pengembalian->kondisi_alat === 'baik')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i> Baik
                                    </span>
                                @elseif ($pengembalian->kondisi_alat === 'rusak')
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-exclamation-triangle me-1"></i> Rusak
                                    </span>
                                @elseif ($pengembalian->kondisi_alat === 'hilang')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times me-1"></i> Hilang
                                    </span>
                                @else
                                    <span class="badge bg-secondary">{{ $pengembalian->kondisi_alat }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Denda</label>
                            <p class="h6">
                                @if ($pengembalian->denda > 0)
                                    <span class="badge bg-danger">
                                        Rp. {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="badge bg-success">Gratis (Rp 0)</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Ringkasan Status</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <small><i class="fas fa-check-circle me-1"></i> Pengembalian telah dicatat dalam sistem</small>
                    </div>

                    <div class="mb-3">
                        <h6>Status Kondisi:</h6>
                        <p class="mb-2">
                            @if ($pengembalian->kondisi_alat === 'baik')
                                <i class="fas fa-smile-wink text-success me-2"></i> <strong>Kondisi Baik</strong>
                            @elseif ($pengembalian->kondisi_alat === 'rusak')
                                <i class="fas fa-frown text-warning me-2"></i> <strong>Alat Rusak</strong>
                            @elseif ($pengembalian->kondisi_alat === 'hilang')
                                <i class="fas fa-exclamation-circle text-danger me-2"></i> <strong>Alat Hilang</strong>
                            @endif
                        </p>
                    </div>

                    <div>
                        <h6>Total Denda:</h6>
                        <p>
                            <strong class="h5">
                                @if ($pengembalian->denda > 0)
                                    <span class="text-danger">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-success">Rp 0 (Gratis)</span>
                                @endif
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
