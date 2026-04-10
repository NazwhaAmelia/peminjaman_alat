@extends('layouts.app')

@section('title', 'Memantau Pengembalian - Petugas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">
                <i class="fas fa-clipboard-list text-primary me-2"></i> Memantau Pengembalian
            </h3>
            <p class="text-muted mb-0">Pantau semua pengembalian alat yang telah dikembalikan oleh peminjam.</p>
        </div>
            <a href="{{ route('petugas.pengembalians.print') }}" target="_blank" class="btn btn-outline-secondary">
                <i class="fas fa-print me-1"></i> Cetak Laporan
            </a>
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
                                <th style="width: 50px">No</th>
                                <th>Peminjam</th>
                                <th>Alat</th>
                                <th>Tanggal Kembali</th>
                                <th>Kondisi Alat</th>
                                <th>Denda</th>
                                <th style="width: 80px">Aksi</th>
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
                                        <a href="{{ route('petugas.pengembalians.show', $pengembalian->id) }}"
                                            class="btn btn-sm btn-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <p class="text-muted mb-0">
                            <small>Menampilkan {{ $pengembalians->firstItem() ?? 0 }} -
                                {{ $pengembalians->lastItem() ?? 0 }}
                                dari {{ $pengembalians->total() }} data</small>
                        </p>
                    </div>
                    <div>
                        {{ $pengembalians->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Info Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </div>
                    <div>
                        <strong>Informasi:</strong>
                        <p class="mb-0">Halaman ini menampilkan semua alat yang telah dikembalikan oleh peminjam.
                            Pantau kondisi alat dan denda keterlambatan yang dikenakan. Jika ada pertanyaan mengenai
                            pengembalian, silakan lihat detail untuk informasi lebih lanjut.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
