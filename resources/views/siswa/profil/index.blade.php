@extends('layouts.siswa')

@section('page-title', 'Profil Saya')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Profil Saya</h2>
            <div class="flex space-x-2">
                <a href="{{ route('siswa.profil.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Profil
                </a>
                <a href="{{ route('siswa.profil.change-password') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Ubah Password
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-md font-semibold mb-3">Informasi Dasar</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">NISN</p>
                        <p class="font-medium">{{ $siswa->nisn }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="font-medium">{{ $siswa->nama }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ $siswa->email }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">No. HP</p>
                        <p class="font-medium">{{ $siswa->no_hp ?? 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-md font-semibold mb-3">Informasi Tambahan</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tingkat Sekolah</p>
                        <p class="font-medium">{{ $siswa->tingkat ?? 'Belum diisi' }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Sekolah</p>
                        <p class="font-medium">{{ $siswa->sekolah->nama_sekolah ?? 'Belum dipilih' }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tempat, Tanggal Lahir</p>
                        <p class="font-medium">
                            {{ $siswa->tempat_lahir ?? 'Belum diisi' }}
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
                        <p class="font-medium">{{ $siswa->alamat ?? 'Belum diisi' }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tanggal Bergabung</p>
                        <p class="font-medium">{{ $siswa->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-8">
            <h3 class="text-md font-semibold mb-3">Prestasi Saya</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                @if($siswa->prestasi && $siswa->prestasi->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow">
                            <p class="text-2xl font-bold text-blue-600">{{ $siswa->prestasi->count() }}</p>
                            <p class="text-sm text-gray-500">Total Prestasi</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <p class="text-2xl font-bold text-green-600">{{ $siswa->prestasi->where('status_verifikasi', 'approved')->count() }}</p>
                            <p class="text-sm text-gray-500">Prestasi Disetujui</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <p class="text-2xl font-bold text-yellow-600">{{ $siswa->prestasi->where('status_verifikasi', 'pending')->count() }}</p>
                            <p class="text-sm text-gray-500">Prestasi Pending</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('siswa.prestasi.index') }}" class="text-blue-600 hover:text-blue-900 font-medium">Lihat Semua Prestasi &rarr;</a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">Anda belum memiliki prestasi.</p>
                        <a href="{{ route('siswa.prestasi.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Prestasi Baru
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection