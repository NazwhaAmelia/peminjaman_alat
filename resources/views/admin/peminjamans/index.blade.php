@extends('layouts.app')

@section('title', 'Kelola Peminjaman - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">
            <i class="fas fa-handshake text-primary me-2"></i> Manajemen Peminjaman
        </h3>
        <p class="text-muted mb-0">Kelola semua peminjaman alat sistem</p>
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
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peminjaman</h5>
            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="status-filter" id="status-all" value="" checked>
                <label class="btn btn-outline-primary btn-sm" for="status-all">Semua</label>

                <input type="radio" class="btn-check" name="status-filter" id="status-pending" value="pending">
                <label class="btn btn-outline-warning btn-sm" for="status-pending">Pending</label>

                <input type="radio" class="btn-check" name="status-filter" id="status-approved" value="disetujui">
                <label class="btn btn-outline-success btn-sm" for="status-approved">Disetujui</label>

                <input type="radio" class="btn-check" name="status-filter" id="status-rejected" value="ditolak">
                <label class="btn btn-outline-danger btn-sm" for="status-rejected">Ditolak</label>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if ($peminjamans->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">Tidak ada data peminjaman</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tgl Kembali Rencana</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamans as $index => $peminjaman)
                            <tr>
                                <td>{{ $peminjamans->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $peminjaman->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $peminjaman->user->username }}</small>
                                </td>
                                <td>{{ $peminjaman->alat->nama_alat }}</td>
                                <td><span class="badge bg-info">{{ $peminjaman->jumlah_pinjam }}</span></td>
                                <td>{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                                <td>{{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}</td>
                                <td>
                                    @if ($peminjaman->status === 'pending')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i> Pending
                                        </span>
                                    @elseif ($peminjaman->status === 'disetujui')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i> Disetujui
                                        </span>
                                    @elseif ($peminjaman->status === 'ditolak')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times me-1"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">{{ $peminjaman->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.peminjamans.show', $peminjaman->id) }}"
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
                    {{ $peminjamans->links() }}
                </ul>
            </nav>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        document.querySelectorAll('input[name="status-filter"]').forEach(radio => {
            radio.addEventListener('change', function () {
                const status = this.value;
                window.location.href = status ? `?status=${status}` : '?';
            });
        });
    </script>
@endpush
@endsection
