<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h2 { text-align: center; margin-bottom: 4px; }
        p.subtitle { text-align: center; color: #555; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 6px 10px; text-align: left; }
        th { background: #f0f0f0; font-weight: bold; }
        tr:nth-child(even) { background: #fafafa; }
        .badge-pending  { color: #856404; }
        .badge-disetujui { color: #155724; }
        .badge-ditolak  { color: #721c24; }
        .footer { margin-top: 20px; text-align: right; font-size: 11px; color: #888; }
        @media print { button { display: none; } }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman Alat</h2>
    <p class="subtitle">Dicetak pada: {{ now()->format('d M Y, H:i') }}</p>

    <button onclick="window.print()" 
        style="margin-bottom:12px; padding:6px 16px; cursor:pointer;">
        🖨️ Print
    </button>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamans as $index => $peminjaman)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>PMJ-{{ str_pad($peminjaman->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $peminjaman->user->name }}<br><small>{{ $peminjaman->user->username }}</small></td>
                    <td>{{ $peminjaman->alat->nama_alat }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                    <td>{{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}</td>
                    <td class="badge-{{ $peminjaman->status }}">
                        {{ ucfirst($peminjaman->status) }}
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Total: {{ $peminjamans->count() }} data</div>
</body>
</html>