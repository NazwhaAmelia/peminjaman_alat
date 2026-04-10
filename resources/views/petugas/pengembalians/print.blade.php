<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h2 { text-align: center; margin-bottom: 4px; }
        p.subtitle { text-align: center; color: #555; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 6px 10px; text-align: left; }
        th { background: #f0f0f0; font-weight: bold; }
        tr:nth-child(even) { background: #fafafa; }
        .footer { margin-top: 20px; text-align: right; font-size: 11px; color: #888; }
        @media print { button { display: none; } }
    </style>
</head>
<body>
    <h2>Laporan Pengembalian Alat</h2>
    <p class="subtitle">Dicetak pada: {{ now()->format('d M Y, H:i') }}</p>

    <button onclick="window.print()"
        style="margin-bottom:12px; padding:6px 16px; cursor:pointer;">
        🖨️ Print
    </button>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Tgl Kembali</th>
                <th>Kondisi</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengembalians as $index => $pengembalian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $pengembalian->peminjaman->user->name }}<br>
                        <small>{{ $pengembalian->peminjaman->user->username }}</small>
                    </td>
                    <td>{{ $pengembalian->peminjaman->alat->nama_alat }}</td>
                    <td>{{ $pengembalian->tanggal_kembali->format('d M Y') }}</td>
                    <td>{{ ucfirst($pengembalian->kondisi_alat) }}</td>
                    <td>
                        @if ($pengembalian->denda > 0)
                            Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                        @else
                            Gratis
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Total: {{ $pengembalians->count() }} data</div>
</body>
</html>