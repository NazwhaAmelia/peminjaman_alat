@extends('layouts.app')

@section('title', 'Menyetujui Peminjaman - Petugas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">
                <i class="fas fa-clipboard-check text-primary me-2"></i> Menyetujui Peminjaman
            </h3>
            <p class="text-muted mb-0">Tinjau dan setujui permintaan peminjaman alat dari pengguna.</p>
        </div>
            <a href="{{ route('petugas.peminjamans.print') }}" target="_blank" class="btn btn-outline-secondary">
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
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Peminjaman</h5>
                <div class="btn-group" role="group">
                    <a href="{{ route('petugas.peminjamans.index') }}"
                        class="btn btn-sm {{ request('status') == '' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Semua
                    </a>
                    <a href="{{ route('petugas.peminjamans.index', ['status' => 'pending']) }}"
                        class="btn btn-sm {{ request('status') == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">
                        Menunggu
                    </a>
                    <a href="{{ route('petugas.peminjamans.index', ['status' => 'disetujui']) }}"
                        class="btn btn-sm {{ request('status') == 'disetujui' ? 'btn-success' : 'btn-outline-success' }}">
                        Disetujui
                    </a>
                    <a href="{{ route('petugas.peminjamans.index', ['status' => 'ditolak']) }}"
                        class="btn btn-sm {{ request('status') == 'ditolak' ? 'btn-danger' : 'btn-outline-danger' }}">
                        Ditolak
                    </a>
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
                                <th style="width: 50px">No</th>
                                <th>ID Peminjaman</th>
                                <th>Peminjam</th>
                                <th>Alat</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Tujuan</th>
                                <th style="width: 80px">Status</th>
                                <th style="width: 100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $index => $peminjaman)
                                <tr>
                                    <td>{{ $peminjamans->firstItem() + $index }}</td>
                                    <td><strong>PMJ-{{ str_pad($peminjaman->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                                    <td>
                                        <strong>{{ $peminjaman->user->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $peminjaman->user->username }}</small>
                                    </td>
                                    <td>{{ $peminjaman->alat->nama_alat }}</td>
                                    <td>{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                                    <td>{{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}</td>
                                    <td>
                                        <small>
                                            @php
                                                $description = match ($peminjaman->alat->kategori->nama_kategori) {
                                                    'Perlengkapan Ruang' => 'Perbaikan Ruang Kelas',
                                                    'Peralatan Olahraga' => 'Acara Olahraga',
                                                    default => 'Kegiatan Sekolah',
                                                };
                                            @endphp
                                            {{ $description }}
                                        </small>
                                    </td>
                                    <td>
                                        @if ($peminjaman->status === 'pending')
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-clock me-1"></i> Menunggu
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
                                        @if ($peminjaman->status === 'pending')
                                            <form action="{{ route('petugas.peminjamans.approve', $peminjaman->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    title="Setujui">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('petugas.peminjamans.reject', $peminjaman->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#tolakModal"
                                                    data-peminjaman-id="{{ $peminjaman->id }}"
                                                    data-alat-name="{{ $peminjaman->alat->nama_alat }}"
                                                    title="Tolak">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('petugas.peminjamans.show', $peminjaman->id) }}"
                                                class="btn btn-sm btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
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
                            <small>Menampilkan {{ $peminjamans->firstItem() ?? 0 }} - {{ $peminjamans->lastItem() ?? 0 }}
                                dari {{ $peminjamans->total() }} data</small>
                        </p>
                    </div>
                    <div>
                        {{ $peminjamans->links() }}
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
                        <p class="mb-0">Setujui permintaan peminjaman alat jika alat tersedia dan memenuhi kriteria.
                            Tolak jika tidak memenuhi syarat atau alat tidak tersedia. Peminjaman yang disetujui akan
                            ditampilkan di halaman "Memantau Pengembalian".</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tolak -->
    <div class="modal fade" id="tolakModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="tolakForm" method="POST" action="">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">
                            <i class="fas fa-times-circle me-2"></i> Tolak Peminjaman
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tolak peminjaman alat <strong id="tolakAlatName"></strong>?</p>
                        <div class="mb-3">
                            <label class="form-label">
                                Alasan Penolakan <span class="text-danger">*</span>
                            </label>
                            <textarea name="alasan_ditolak" class="form-control" rows="3"
                                placeholder="Contoh: Alat sedang dalam perbaikan..." required></textarea>
                            <small class="text-muted">Alasan ini akan ditampilkan kepada peminjam.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times me-1"></i> Tolak Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('input[name="status-filter"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const status = this.value;
                if (status) {
                    window.location.href = `{{ route('petugas.peminjamans.index') }}?status=${status}`;
                } else {
                    window.location.href = `{{ route('petugas.peminjamans.index') }}`;
                }
            });
        });
        
        const tolakModal = document.getElementById('tolakModal');
        tolakModal.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            document.getElementById('tolakAlatName').textContent = button.dataset.alatName;
            document.getElementById('tolakForm').action = `/petugas/peminjamans/${button.dataset.peminjamanId}/reject`;
        });
    </script>
    @endpush
@endsection
