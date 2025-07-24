@extends('layouts.admin')

@section('page-title', 'Detail Lomba')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Detail Lomba</h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.lomba.edit', $lomba->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('admin.lomba.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-md font-semibold mb-3">Informasi Umum</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Nama Lomba</p>
                        <p class="font-medium">{{ $lomba->nama_lomba }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Jenis Lomba</p>
                        <p class="font-medium">{{ $lomba->jenis_lomba }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tingkat</p>
                        <p class="font-medium">{{ $lomba->tingkat }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tahun</p>
                        <p class="font-medium">{{ $lomba->tahun }}</p>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-md font-semibold mb-3">Detail Pelaksanaan</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tanggal Mulai</p>
                        <p class="font-medium">
                            @if(is_string($lomba->tanggal_mulai))
                                {{ $lomba->tanggal_mulai }}
                            @elseif($lomba->tanggal_mulai)
                                {{ $lomba->tanggal_mulai->format('d F Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tanggal Selesai</p>
                        <p class="font-medium">
                            @if(is_string($lomba->tanggal_selesai))
                                {{ $lomba->tanggal_selesai }}
                            @elseif($lomba->tanggal_selesai)
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
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tanggal Dibuat</p>
                        <p class="font-medium">{{ $lomba->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-6">
            <h3 class="text-md font-semibold mb-3">Deskripsi Lomba</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="whitespace-pre-line">{{ $lomba->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
        </div>
        
        @if($lomba->prestasi && $lomba->prestasi->count() > 0)
        <div class="mt-6">
            <h3 class="text-md font-semibold mb-3">Prestasi Terkait</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Prestasi
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Siswa
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($lomba->prestasi as $prestasi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $prestasi->nama_prestasi }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $prestasi->siswa->nama ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($prestasi->status_verifikasi == 'pending')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                                @elseif($prestasi->status_verifikasi == 'approved')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                                @elseif($prestasi->status_verifikasi == 'rejected')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.prestasi.show', $prestasi->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="mt-6 bg-gray-50 p-4 rounded-lg text-center text-gray-500">
            Belum ada prestasi yang terkait dengan lomba ini.
        </div>
        @endif
    </div>
</div>
@endsection