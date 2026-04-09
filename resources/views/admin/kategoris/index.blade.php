@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3">
                <i class="fas fa-list"></i> Kelola Kategori
            </h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.kategoris.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Alat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $index => $kategori)
                            <tr>
                                <td>{{ $kategoris->firstItem() + $index }}</td>
                                <td><strong>{{ $kategori->nama_kategori }}</strong></td>
                                <td>{{ Str::limit($kategori->deskripsi, 50) }}</td>
                                <td><span class="badge bg-info">{{ $kategori->alats_count }}</span></td>
                                <td>
                                    <a href="{{ route('admin.kategoris.show', $kategori) }}" class="btn btn-sm btn-info"
                                        title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.kategoris.edit', $kategori) }}" class="btn btn-sm btn-warning"
                                        title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.kategoris.destroy', $kategori) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox"></i> Tidak ada data kategori
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $kategoris->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
