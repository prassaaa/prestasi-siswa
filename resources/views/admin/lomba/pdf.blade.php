<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Informasi Lomba</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
            padding: 8px;
        }
        td {
            padding: 8px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h1>Informasi LOMBA</h1>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Lomba</th>
                <th width="15%">Jenis</th>
                <th width="10%">Tingkat</th>
                <th width="10%">Tahun</th>
                <th width="20%">Tanggal</th>
                <th width="15%">Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lomba as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_lomba }}</td>
                    <td>{{ $item->jenis_lomba }}</td>
                    <td>{{ $item->tingkat }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>
                        @if ($item->tanggal_mulai)
                            @if (is_string($item->tanggal_mulai))
                                {{ $item->tanggal_mulai }}
                            @else
                                {{ $item->tanggal_mulai->format('d/m/Y') }}
                            @endif

                            @if ($item->tanggal_selesai && $item->tanggal_mulai != $item->tanggal_selesai)
                                -
                                @if (is_string($item->tanggal_selesai))
                                    {{ $item->tanggal_selesai }}
                                @else
                                    {{ $item->tanggal_selesai->format('d/m/Y') }}
                                @endif
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->lokasi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" align="center">Tidak ada data lomba.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Sistem Manajemen Prestasi Siswa &copy; {{ date('Y') }}</p>
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
