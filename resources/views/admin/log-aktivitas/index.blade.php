@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3">
                <i class="fas fa-history"></i> Log Aktivitas Sistem
            </h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Aktivitas</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $index => $log)
                            <tr>
                                <td>{{ $logs->firstItem() + $index }}</td>
                                <td>
                                    <small>{{ $log->created_at->format('d-m-Y H:i:s') }}</small>
                                </td>
                                <td>
                                    <strong>{{ $log->user->name }}</strong><br>
                                    <small class="text-muted">{{ $log->user->username }}</small>
                                </td>
                                <td>
                                    @php
                                        $colors = [
                                            'Login' => 'info',
                                            'Logout' => 'secondary',
                                            'Tambah' => 'success',
                                            'Edit' => 'warning',
                                            'Hapus' => 'danger',
                                        ];
                                        $color = 'primary';
                                        foreach ($colors as $key => $value) {
                                            if (strpos($log->aktivitas, $key) !== false) {
                                                $color = $value;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <span class="badge bg-{{ $color }}">{{ $log->aktivitas }}</span>
                                </td>
                                <td>{{ $log->deskripsi }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox"></i> Tidak ada log aktivitas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $logs->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
