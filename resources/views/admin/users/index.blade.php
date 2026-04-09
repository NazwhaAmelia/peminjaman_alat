@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">
            <i class="fas fa-users text-primary me-2"></i> Manajemen Pengguna
        </h3>
        <p class="text-muted mb-0">Kelola data pengguna sistem</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Pengguna
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
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Cari nama, email, atau peran...">
                </div>
            </div>
            <div class="col-md-6 text-end">
                <select class="form-select form-select-sm d-inline-block" style="width: auto;">
                    <option value="">Semua Peran</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="peminjam">Peminjam</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        @if ($users->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">Tidak ada data pengguna</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Status</th>
                            <th>Terakhir Login</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td class="text-muted">{{ $users->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $user->username }}</small>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @elseif($user->role === 'petugas')
                                        <span class="badge bg-warning text-dark">Petugas</span>
                                    @else
                                        <span class="badge bg-info">Peminjam</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->status === 'aktif')
                                        <span class="badge bg-success">
                                            <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i> Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">24 Mei 2024, 10:30</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-primary"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-warning"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                                    <p class="mt-2">Tidak ada data pengguna</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @if ($users->hasPages())
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} data
                </small>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        {{ $users->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    @endif
</div>
@endsection
