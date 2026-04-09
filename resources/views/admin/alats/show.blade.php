@extends('layouts.app')

@section('title', 'Detail Alat')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-tools"></i> Detail Alat
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Nama Alat:</strong>
                            <p>{{ $alat->nama_alat }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Kategori:</strong>
                            <p>{{ $alat->kategori->nama_kategori }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Jumlah Tersedia:</strong>
                            <p><span class="badge bg-info">{{ $alat->jumlah_tersedia }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Kondisi:</strong>
                            <p>
                                @if ($alat->kondisi === 'baik')
                                    <span class="badge bg-success">Baik</span>
                                @elseif($alat->kondisi === 'rusak')
                                    <span class="badge bg-warning">Rusak</span>
                                @else
                                    <span class="badge bg-danger">Hilang</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Deskripsi:</strong>
                        <p>{{ $alat->deskripsi ?: '-' }}</p>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.alats.edit', $alat) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Ubah
                        </a>
                        <a href="{{ route('admin.alats.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
