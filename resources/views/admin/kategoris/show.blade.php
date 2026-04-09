@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-list"></i> Detail Kategori
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Nama Kategori:</strong>
                        <p>{{ $kategori->nama_kategori }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Deskripsi:</strong>
                        <p>{{ $kategori->deskripsi ?: '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Jumlah Alat:</strong>
                        <p><span class="badge bg-info">{{ $kategori->alats()->count() }}</span></p>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.kategoris.edit', $kategori) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Ubah
                        </a>
                        <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
