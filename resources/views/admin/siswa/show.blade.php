@extends('layouts.admin')

@section('page-title', 'Detail Siswa')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Detail Siswa</h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('admin.siswa.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-md font-semibold mb-3">Informasi Siswa</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">NISN</p>
                        <p class="font-medium">{{ $siswa->nisn }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="font-medium">{{ $siswa->nama }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ $siswa->email }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">No. HP</p>
                        <p class="font-medium">{{ $siswa->no_hp ?? '-' }}</p>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-md font-semibold mb-3">Informasi Tambahan</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Sekolah</p>
                        <p class="font-medium">{{ $siswa->sekolah->nama_sekolah ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tempat, Tanggal Lahir</p>
                        <p class="font-medium">
                            {{ $siswa->tempat_lahir ?? '-' }}
                            @if($siswa->tanggal)
                                @if(is_string($siswa->tanggal))
                                    , {{ $siswa->tanggal }}
                                @else
                                    , {{ $siswa->tanggal->format('d F Y') }}
                                @endif
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="font-medium">{{ $siswa->alamat ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Status Akun</p>
                        <p class="font-medium">
                            @if($siswa->user && $siswa->user->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Tidak Aktif
                            </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        @if($siswa->prestasi && $siswa->prestasi->count() > 0)
        <div class="mt-8">
            <h3 class="text-md font-semibold mb-3">Prestasi Siswa</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Prestasi
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tingkat
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tahun
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
                            @foreach($siswa->prestasi as $prestasi)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $prestasi->nama_prestasi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $prestasi->jenis_prestasi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $prestasi->tingkat }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $prestasi->tahun }}
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
        </div>
        @else
        <div class="mt-8 bg-gray-50 p-4 rounded-lg text-center text-gray-500">
            Siswa ini belum memiliki prestasi.
        </div>
        @endif
    </div>
</div>
@endsection