@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user"></i> Detail Pengguna
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Username:</strong> {{ $user->username }}
                        </div>
                        <div class="col-md-6">
                            <strong>Nama:</strong> {{ $user->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Email:</strong> {{ $user->email }}
                        </div>
                        <div class="col-md-6">
                            <strong>No. HP:</strong> {{ $user->phone_number ?: '-' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Role:</strong>
                            @if ($user->role === 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($user->role === 'petugas')
                                <span class="badge bg-warning">Petugas</span>
                            @else
                                <span class="badge bg-info">Peminjam</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            @if ($user->status === 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Dibuat:</strong> {{ $user->created_at->format('d-m-Y H:i') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Terakhir Diubah:</strong> {{ $user->updated_at->format('d-m-Y H:i') }}
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Ubah
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
