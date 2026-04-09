@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3">
                <i class="fas fa-tools"></i> Kelola Alat
            </h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.alats.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Alat
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
                            <th>Nama Alat</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alats as $index => $alat)
                            <tr>
                                <td>{{ $alats->firstItem() + $index }}</td>
                                <td><strong>{{ $alat->nama_alat }}</strong></td>
                                <td>{{ $alat->kategori->nama_kategori }}</td>
                                <td><span class="badge bg-secondary">{{ $alat->jumlah_tersedia }}</span></td>
                                <td>
                                    @if ($alat->kondisi === 'baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($alat->kondisi === 'rusak')
                                        <span class="badge bg-warning">Rusak</span>
                                    @else
                                        <span class="badge bg-danger">Hilang</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.alats.show', $alat) }}" class="btn btn-sm btn-info"
                                        title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.alats.edit', $alat) }}" class="btn btn-sm btn-warning"
                                        title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.alats.destroy', $alat) }}" method="POST"
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
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox"></i> Tidak ada data alat
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $alats->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
