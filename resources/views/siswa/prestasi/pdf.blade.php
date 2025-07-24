<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Prestasi - {{ $prestasi->nama_prestasi }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 14px;
            margin: 0;
        }
        .container {
            width: 100%;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 5px;
            vertical-align: top;
        }
        .info-table td:first-child {
            width: 30%;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 10px;
        }
        .bukti-image {
            max-width: 100%;
            margin-top: 20px;
        }
        .approval-box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 40px;
            text-align: center;
        }
        .approved {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SERTIFIKAT PRESTASI</h1>
        <p>Sistem Manajemen Prestasi Siswa</p>
    </div>

    <div class="container">
        <div class="section">
            <div class="section-title">DATA PRESTASI</div>
            <table class="info-table">
                <tr>
                    <td>Nama Prestasi</td>
                    <td>: {{ $prestasi->nama_prestasi }}</td>
                </tr>
                <tr>
                    <td>Jenis Prestasi</td>
                    <td>: {{ $prestasi->jenis_prestasi }}</td>
                </tr>
                @if($prestasi->peringkat)
                <tr>
                    <td>Peringkat/Juara</td>
                    <td>: {{ $prestasi->peringkat }}</td>
                </tr>
                @endif
                <tr>
                    <td>Tingkat</td>
                    <td>: {{ $prestasi->tingkat }}</td>
                </tr>
                <tr>
                    <td>Jenjang Pendidikan</td>
                    <td>: {{ $prestasi->jenjang_pendidikan }}</td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>: {{ $prestasi->tahun }}</td>
                </tr>
                @if($prestasi->lomba)
                <tr>
                    <td>Lomba</td>
                    <td>: {{ $prestasi->lomba->nama_lomba }}</td>
                </tr>
                @endif
            </table>
        </div>

        <div class="section">
            <div class="section-title">INFORMASI LOMBA/KEGIATAN</div>
            <table class="info-table">
                @if($prestasi->penyelenggara)
                <tr>
                    <td>Penyelenggara</td>
                    <td>: {{ $prestasi->penyelenggara }}</td>
                </tr>
                @endif
                @if($prestasi->lokasi_kegiatan)
                <tr>
                    <td>Lokasi Kegiatan</td>
                    <td>: {{ $prestasi->lokasi_kegiatan }}</td>
                </tr>
                @endif
                @if($prestasi->tanggal_kegiatan)
                <tr>
                    <td>Tanggal Kegiatan</td>
                    <td>: {{ \Carbon\Carbon::parse($prestasi->tanggal_kegiatan)->format('d F Y') }}</td>
                </tr>
                @endif
                @if($prestasi->kategori_lomba)
                <tr>
                    <td>Kategori Lomba</td>
                    <td>: {{ $prestasi->kategori_lomba }}</td>
                </tr>
                @endif
                @if(!$prestasi->penyelenggara && !$prestasi->lokasi_kegiatan && !$prestasi->tanggal_kegiatan && !$prestasi->kategori_lomba)
                <tr>
                    <td colspan="2">: Tidak ada informasi lomba/kegiatan.</td>
                </tr>
                @endif
            </table>
        </div>

        <div class="section">
            <div class="section-title">DATA SISWA</div>
            <table class="info-table">
                <tr>
                    <td>Nama Siswa</td>
                    <td>: {{ $prestasi->siswa->nama }}</td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>: {{ $prestasi->siswa->nisn }}</td>
                </tr>
                <tr>
                    <td>Sekolah</td>
                    <td>: {{ $prestasi->siswa->sekolah->nama_sekolah ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <div class="approval-box">
            <p>Status Verifikasi:</p>
            <p class="approved">DISETUJUI</p>
            <p>Tanggal Verifikasi: {{ $prestasi->updated_at->format('d F Y') }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Dokumen ini dicetak dari Sistem Manajemen Prestasi Siswa</p>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>
</body>
</html>
