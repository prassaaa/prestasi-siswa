@extends('layouts.siswa')

@section('page-title', 'Detail Lomba')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Detail Lomba</h2>
            <a href="{{ route('siswa.lomba.index') }}" class="text-blue-500 hover:text-blue-700">
                &larr; Kembali ke Informasi Lomba
            </a>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg mb-6">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $lomba->nama_lomba }}</h1>
                    <p class="text-sm text-gray-600 mt-1">{{ $lomba->jenis_lomba }} | {{ $lomba->tahun }}</p>

                    <div class="mt-4 inline-block px-3 py-1 rounded-full {{ $lomba->tingkat == 'Nasional' ? 'bg-red-100 text-red-800' : ($lomba->tingkat == 'Provinsi' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                        <span class="text-sm font-semibold">{{ $lomba->tingkat }}</span>
                    </div>
                </div>

                <div class="mt-4 md:mt-0">
                    <a href="{{ route('siswa.prestasi.create', ['lomba_id' => $lomba->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Daftar Prestasi untuk Lomba Ini
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-md font-semibold mb-3">Waktu dan Lokasi</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tanggal Mulai</p>
                        <p class="font-medium">
                            @if (is_string($lomba->tanggal_mulai))
                                {{ $lomba->tanggal_mulai }}
                            @elseif ($lomba->tanggal_mulai)
                                {{ $lomba->tanggal_mulai->format('d F Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tanggal Selesai</p>
                        <p class="font-medium">
                            @if (is_string($lomba->tanggal_selesai))
                                {{ $lomba->tanggal_selesai }}
                            @elseif ($lomba->tanggal_selesai)
                                {{ $lomba->tanggal_selesai->format('d F Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Lokasi</p>
                        <p class="font-medium">{{ $lomba->lokasi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-md font-semibold mb-3">Informasi Tambahan</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Ditambahkan Pada</p>
                        <p class="font-medium">{{ $lomba->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Terakhir Diperbarui</p>
                        <p class="font-medium">{{ $lomba->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Jumlah Prestasi</p>
                        <p class="font-medium">{{ $lomba->prestasi ? $lomba->prestasi->count() : '0' }} prestasi</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-md font-semibold mb-3">Deskripsi Lomba</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="whitespace-pre-line">{{ $lomba->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-md font-semibold mb-3">Prestasi Saya untuk Lomba Ini</h3>
            @if (Auth::user()->siswa && Auth::user()->siswa->prestasi && Auth::user()->siswa->prestasi->where('lomba_id', $lomba->id)->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prestasi
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->siswa->prestasi->where('lomba_id', $lomba->id) as $prestasi)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $prestasi->nama_prestasi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($prestasi->status_verifikasi == 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @elseif ($prestasi->status_verifikasi == 'approved')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Disetujui
                                            </span>
                                        @elseif ($prestasi->status_verifikasi == 'rejected')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $prestasi->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('siswa.prestasi.show', $prestasi->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-gray-50 p-6 rounded-lg text-center">
                    <p class="text-gray-500 mb-4">Anda belum memiliki prestasi untuk lomba ini.</p>
                    <a href="{{ route('siswa.prestasi.create', ['lomba_id' => $lomba->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Tambah Prestasi
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
