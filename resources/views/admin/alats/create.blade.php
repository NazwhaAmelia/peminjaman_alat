@extends('layouts.app')

@section('title', 'Tambah Alat')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-plus"></i> Tambah Alat Baru
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.alats.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_alat" class="form-label">Nama Alat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_alat') is-invalid @enderror"
                                id="nama_alat" name="nama_alat" value="{{ old('nama_alat') }}" required>
                            @error('nama_alat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                                name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('kategori_id') is-invalid @enderror"
                                        id="kategori_id" name="kategori_id" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jumlah_tersedia" class="form-label">Jumlah <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('jumlah_tersedia') is-invalid @enderror"
                                        id="jumlah_tersedia" name="jumlah_tersedia" value="{{ old('jumlah_tersedia', 0) }}" required>
                                    @error('jumlah_tersedia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi <span class="text-danger">*</span></label>
                            <select class="form-select @error('kondisi') is-invalid @enderror" id="kondisi"
                                name="kondisi" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="baik" {{ old('kondisi') === 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="rusak" {{ old('kondisi') === 'rusak' ? 'selected' : '' }}>Rusak</option>
                                <option value="hilang" {{ old('kondisi') === 'hilang' ? 'selected' : '' }}>Hilang</option>
                            </select>
                            @error('kondisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.alats.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
