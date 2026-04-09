@php
    $role = auth()->user()->role;
@endphp

<div class="col-md-3">
    <div class="sidebar">
        <div class="sidebar-header p-3 border-bottom">
            <h5 class="mb-0" style="color: #17a2b8;">
                <i class="fas fa-tools me-2"></i> Peminjaman Alat
            </h5>
            <small class="text-muted">Sistem Informasi</small>
        </div>
        <div class="list-group list-group-flush">
            @if ($role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i> Manajemen Pengguna
                </a>
                <a href="{{ route('admin.alats.index') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('admin.alats.*') ? 'active' : '' }}">
                    <i class="fas fa-toolbox me-2"></i> Alat
                </a>
                <a href="{{ route('admin.kategoris.index') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('admin.kategoris.*') ? 'active' : '' }}">
                    <i class="fas fa-list me-2"></i> Kategori Alat
                </a>
                <a href="{{ route('admin.peminjamans.index') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('admin.peminjamans.*') ? 'active' : '' }}">
                    <i class="fas fa-handshake me-2"></i> Peminjaman
                </a>
                <a href="{{ route('admin.pengembalians.index') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('admin.pengembalians.*') ? 'active' : '' }}">
                    <i class="fas fa-undo me-2"></i> Pengembalian
                </a>
                <a href="{{ route('admin.log-aktivitas.index') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('admin.log-aktivitas.*') ? 'active' : '' }}">
                    <i class="fas fa-history me-2"></i> Log Aktivitas
                </a>
            @elseif ($role === 'petugas')
                <a href="{{ route('petugas.dashboard') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-2"></i> Dashboard
                </a>
                <a href="{{ route('petugas.peminjamans.index') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('petugas.peminjamans.*') ? 'active' : '' }}">
                    <i class="fas fa-handshake me-2"></i> Peminjaman
                </a>
                <a href="{{ route('petugas.pengembalians.index') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('petugas.pengembalians.*') ? 'active' : '' }}">
                    <i class="fas fa-undo me-2"></i> Pengembalian
                </a>
            @elseif ($role === 'peminjam')
                <a href="{{ route('peminjam.dashboard') }}"
                    class="list-group-item list-group-item-action nav-link {{ request()->routeIs('peminjam.dashboard') || request()->routeIs('peminjam.peminjamans.*') ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-heart me-2"></i> Peminjaman Alat
                </a>
            @endif
        </div>
    </div>
</div>
