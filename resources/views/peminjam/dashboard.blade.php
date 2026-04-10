@extends('layouts.app')

@section('title', 'Daftar Alat & Peminjaman - Peminjam')

@section('content')

{{-- ✅ Toast notifikasi penolakan --}}
@if($penolakanBaru->isNotEmpty())
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        @foreach($penolakanBaru as $tolak)
            <div class="toast show align-items-center text-bg-danger border-0 mb-2" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-times-circle me-2"></i>
                        <strong>Peminjaman Ditolak</strong><br>
                        Alat: <strong>{{ $tolak->   alat->nama_alat }}</strong><br>
                        Alasan: {{ $tolak->alasan_ditolak }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endforeach
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">
            <i class="fas fa-hand-holding-heart text-primary me-2"></i> Daftar Alat & Peminjaman
        </h3>
        <p class="text-muted mb-0">Lihat alat yang tersedia, ajukan peminjaman, dan kembalikan alat tepat waktu.</p>
    </div>
</div>

<!-- Info Alert -->
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Catatan Penting:</strong> Pastikan alat yang dipinjam dalam kondisi baik saat dikembalikan untuk menghindari denda keterlambatan.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i> Daftar Alat Tersedia
                </h5>
                <small class="text-muted d-block mt-1">Pilih alat yang ingin Anda pinjam.</small>
            </div>

            <div class="card-body p-0">
                <div class="mb-3 px-3 pt-3">
                    <input type="text" class="form-control form-control-sm" id="searchAlat"
                        placeholder="Cari nama alat...">
                </div>

                <div class="mb-3 px-3">
                    <select class="form-select form-select-sm" id="filterKategori">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary btn-sm mb-3 mx-3" id="btnSegarkan">
                    <i class="fas fa-sync me-1"></i> Segarkan
                </button>

                <div class="table-responsive px-3 pb-3">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th>Jml Tersedia</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alats as $index => $alat)
                                <tr data-kategori="{{ $alat->kategori->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $alat->nama_alat }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $alat->kategori->nama_kategori }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $alat->jumlah_tersedia }}</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#pinjamModal" data-alat-id="{{ $alat->id }}"
                                            data-alat-name="{{ $alat->nama_alat }}">
                                            Pinjam
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox"></i> Tidak ada alat yang tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-clipboard-list me-2"></i> Ajukan Peminjaman
                </h5>
                <small class="text-muted d-block mt-1">Isi form dibawah setelah memilih alat.</small>
            </div>

            <div class="card-body">
                <form id="pinjamForm" action="{{ route('peminjam.peminjamans.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="namaPinjam" class="form-label">Nama Alat</label>
                        <select class="form-select" id="namaPinjam" name="alat_id" required>
                            <option value="">Pilih alat</option>
                            @foreach ($alats as $alat)
                                <option value="{{ $alat->id }}">{{ $alat->nama_alat }}</option>
                            @endforeach
                        </select>
                        @error('alat_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggalPinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tanggalPinjam"
                            value="{{ now()->toDateString() }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="jumlahAlat" class="form-label">Jumlah Alat</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="btnKurang">-</button>
                            <input type="number" class="form-control text-center" id="jumlahAlat"
                                name="jumlah_pinjam" value="1" min="1" required>
                            <button class="btn btn-outline-secondary" type="button" id="btnTambah">+</button>
                        </div>
                        <small class="text-muted d-block mt-1">Maksimal sesuai jumlah tersedia.</small>
                        @error('jumlah_pinjam')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggalKembaliRencana" class="form-label">Tanggal Kembali Rencana</label>
                        <input type="date" class="form-control" id="tanggalKembaliRencana"
                            name="tanggal_kembali_rencana" required>
                        <small class="text-muted d-block mt-1">Perkiraan kapan alat akan dikembalikan.</small>
                        @error('tanggal_kembali_rencana')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i> Ajukan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Alat yang Sedang Dipinjam -->
<div class="card">
    <div class="card-header bg-light">
        <h5 class="mb-0">
            <i class="fas fa-hourglass-half me-2"></i> Alat yang Sedang Dipinjam
        </h5>
        <small class="text-muted d-block mt-1">Daftar alat yang sedang Anda pinjam. Kembalikan jika sudah selesai digunakan.</small>
    </div>

    <div class="card-body">
        @if ($peminjamans->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                <p class="text-muted mt-3">Anda tidak ada alat yang sedang dipinjam</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Alat</th>
                            <th>Kategori</th>
                            <th>Tanggal Pinjam</th>
                            <th>Batas Pengembalian</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamans as $index => $peminjaman)
                            @php
                                $isLate = $peminjaman->tanggal_kembali_rencana < now()->toDateString();
                                $daysLeft = max(0, now()->parse($peminjaman->tanggal_kembali_rencana)->diffInDays(now(), false));
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $peminjaman->alat->nama_alat }}</strong></td>
                                <td>
                                    <span class="badge bg-secondary">{{ $peminjaman->alat->kategori->nama_kategori }}</span>
                                </td>
                                <td>{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                                <td>
                                    {{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}
                                    @if ($isLate)
                                        <br>
                                        <span class="text-danger" style="font-size: 0.8rem;">
                                            <i class="fas fa-exclamation-triangle"></i> {{ $daysLeft }} hari terlambat
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $peminjaman->jumlah_pinjam }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Dipinjam</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#kembalikanModal"
                                        data-peminjaman-id="{{ $peminjaman->id }}"
                                        data-alat-name="{{ $peminjaman->alat->nama_alat }}">
                                        <i class="fas fa-undo"></i> Kembalikan Alat
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Modal Peminjaman -->
<div class="modal fade" id="pinjamModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Alat <strong id="modalAlatName"></strong> akan dipinjam untuk jangka waktu sesuai tanggal yang Anda tentukan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('pinjamForm').submit();">Ajukan Peminjaman</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pengembalian -->
<div class="modal fade" id="kembalikanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="kembalikanForm" method="POST" action="" onsubmit="return handleKembaliSubmit(event)">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Kembalikan Alat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Kembalikan alat <strong id="modalKembaliAlatName"></strong> dan laporkan kondisinya.</p>

                    <div class="mb-3">
                        <label for="kondisiAlat" class="form-label">Kondisi Alat</label>
                        <select class="form-select" id="kondisiAlat" name="kondisi_alat" required onchange="updateDendaInfo()">
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="baik">✓ Baik (Tidak ada kerusakan) - Rp 0</option>
                            <option value="rusak">⚠ Rusak (Ada kerusakan) - Rp 100.000</option>
                            <option value="hilang">✕ Hilang (Alat tidak ditemukan) - Rp 500.000</option>
                        </select>
                        <small class="text-muted d-block mt-2" id="dendaInfo"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-undo me-1"></i> Nominalkan Pengembalian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Modal untuk peminjaman
    const pinjamModal = document.getElementById('pinjamModal');
    pinjamModal.addEventListener('show.bs.modal', function(e) {
        const button = e.relatedTarget;
        document.getElementById('namaPinjam').value = button.dataset.alatId;
        document.getElementById('modalAlatName').textContent = button.dataset.alatName;
    });

    // Modal untuk pengembalian
    const kembalikanModal = document.getElementById('kembalikanModal');
    kembalikanModal.addEventListener('show.bs.modal', function(e) {
        const button = e.relatedTarget;
        const peminjamanId = button.dataset.peminjamanId;
        document.getElementById('modalKembaliAlatName').textContent = button.dataset.alatName;
        
        // Set action langsung saat modal dibuka
        document.getElementById('kembalikanForm').action = `/peminjam/peminjamans/${peminjamanId}/return`;
        
        // Reset kondisi
        document.getElementById('kondisiAlat').value = '';
        updateDendaInfo();
    });

    // Handle submit - HANYA untuk konfirmasi dialog
    function handleKembaliSubmit(event) {
        if (!confirm('Pastikan kondisi alat sudah benar. Perubahan status tidak dapat dibatalkan.')) {
            event.preventDefault();
            return false;
        }
        // Biarkan form submit normal, action sudah di-set saat modal dibuka
        return true;
    }

    // Update denda info
    function updateDendaInfo() {
        const kondisi = document.getElementById('kondisiAlat').value;
        const dendaInfo = document.getElementById('dendaInfo');
        
        switch(kondisi) {
            case 'baik':
                dendaInfo.textContent = '✓ Tidak ada denda. Terima kasih telah mengembalikan alat dalam kondisi baik!';
                dendaInfo.className = 'text-success d-block mt-2';
                break;
            case 'rusak':
                dendaInfo.textContent = '⚠ Denda Rp 100.000 untuk kerusakan. Alat akan dicatat sebagai rusak dan tidak tersedia sementara waktu.';
                dendaInfo.className = 'text-warning d-block mt-2';
                break;
            case 'hilang':
                dendaInfo.textContent = '✕ Denda Rp 500.000 untuk alat yang hilang. Petugas akan menghubungi Anda untuk verifikasi lebih lanjut.';
                dendaInfo.className = 'text-danger d-block mt-2';
                break;
            default:
                dendaInfo.textContent = '';
                dendaInfo.className = 'text-muted d-block mt-2';
        }
    }

    // Button tambah/kurang
    document.getElementById('btnTambah').addEventListener('click', function() {
        const input = document.getElementById('jumlahAlat');
        input.value = parseInt(input.value) + 1;
    });

    document.getElementById('btnKurang').addEventListener('click', function() {
        const input = document.getElementById('jumlahAlat');
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
    });

    // Set minimum date
    document.getElementById('tanggalKembaliRencana').min = new Date().toISOString().split('T')[0];

    // Search dan filter alat
    const searchInput = document.getElementById('searchAlat');
    const filterKategori = document.getElementById('filterKategori');
    const tableRows = document.querySelectorAll('tbody tr[data-kategori]');

    function filterAlat() {
        const keyword = searchInput.value.toLowerCase();
        const kategori = filterKategori.value;

        tableRows.forEach(row => {
            const namaAlat = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const rowKategori = row.dataset.kategori;

            const matchSearch = namaAlat.includes(keyword);
            const matchKategori = kategori === '' || rowKategori === kategori;

            row.style.display = matchSearch && matchKategori ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterAlat);
    filterKategori.addEventListener('change', filterAlat);

    document.getElementById('btnSegarkan').addEventListener('click', function() {
        searchInput.value = '';
        filterKategori.value = '';
        filterAlat();
    });
</script>
@endpush
@endsection
