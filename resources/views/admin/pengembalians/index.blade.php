@extends('layouts.app')

@section('title', 'Kelola Pengembalian - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">
            <i class="fas fa-undo text-primary me-2"></i> Manajemen Pengembalian
        </h3>
        <p class="text-muted mb-0">Kelola semua pengembalian alat sistem</p>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header bg-light border-bottom">
        <h5 class="mb-0">Daftar Pengembalian</h5>
    </div>

    <div class="card-body">
        @if ($pengembalians->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">Tidak ada data pengembalian</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Tanggal Kembali</th>
                            <th>Kondisi Alat</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalians as $index => $pengembalian)
                            <tr>
                                <td>{{ $pengembalians->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $pengembalian->peminjaman->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $pengembalian->peminjaman->user->username }}</small>
                                </td>
                                <td>{{ $pengembalian->peminjaman->alat->nama_alat }}</td>
                                <td>{{ $pengembalian->tanggal_kembali->format('d M Y') }}</td>
                                <td>
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
                                </td>
                                <td>
                                    @if ($pengembalian->denda > 0)
                                        <span class="badge bg-danger">
                                            Rp. {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="badge bg-success">Gratis</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.pengembalians.show', $pengembalian->id) }}"
                                        class="btn btn-sm btn-info" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav class="mt-4" aria-label="Page navigation">
                <ul class="pagination justify-content-end">
                    {{ $pengembalians->links() }}
                </ul>
            </nav>
        @endif
    </div>
</div>
@endsection
