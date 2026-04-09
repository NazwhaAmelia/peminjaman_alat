@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Edit Alat
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.alats.update', $alat) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_alat" class="form-label">Nama Alat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_alat') is-invalid @enderror"
                                id="nama_alat" name="nama_alat" value="{{ old('nama_alat', $alat->nama_alat) }}" required>
                            @error('nama_alat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                                name="deskripsi" rows="4">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
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
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
                                        id="jumlah_tersedia" name="jumlah_tersedia" value="{{ old('jumlah_tersedia', $alat->jumlah_tersedia) }}" required>
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
                                <option value="baik" {{ old('kondisi', $alat->kondisi) === 'baik' ? 'selected' : '' }}>
                                    Baik</option>
                                <option value="rusak" {{ old('kondisi', $alat->kondisi) === 'rusak' ? 'selected' : '' }}>
                                    Rusak</option>
                                <option value="hilang" {{ old('kondisi', $alat->kondisi) === 'hilang' ? 'selected' : '' }}>
                                    Hilang</option>
                            </select>
                            @error('kondisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
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
