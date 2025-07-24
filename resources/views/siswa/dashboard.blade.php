@extends('layouts.siswa')

@section('page-title', 'Dashboard')

@section('content')
<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card Total Prestasi -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Prestasi</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $prestasiCount }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('siswa.prestasi.index') }}" class="text-sm text-blue-600 hover:text-blue-900">Lihat Semua &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card Prestasi Disetujui -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Prestasi Disetujui</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $prestasiApproved }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('siswa.prestasi.index') }}?status=approved" class="text-sm text-green-600 hover:text-green-900">Lihat Disetujui &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card Prestasi Pending -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-500 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Prestasi Pending</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $prestasiPending }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('siswa.prestasi.index') }}?status=pending" class="text-sm text-yellow-600 hover:text-yellow-900">Lihat Pending &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card Lomba Tersedia -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-500 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Lomba Tersedia</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $lombaCount }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('siswa.lomba.index') }}" class="text-sm text-purple-600 hover:text-purple-900">Lihat Lomba &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white overflow-hidden shadow-sm rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold mb-4">Selamat Datang, {{ $siswa->nama }}!</h2>
            <p class="text-gray-600">Gunakan dashboard ini untuk mengelola prestasi Anda, mengikuti informasi lomba terbaru, dan melihat notifikasi.</p>
            
            <div class="mt-6">
                <h3 class="text-md font-semibold">Aksi Cepat:</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('siswa.prestasi.create') }}" class="bg-blue-50 p-4 rounded-lg text-center hover:bg-blue-100">
                        <svg class="w-8 h-8 mx-auto text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="block mt-2">Tambah Prestasi</span>
                    </a>
                    <a href="{{ route('siswa.lomba.index') }}" class="bg-purple-50 p-4 rounded-lg text-center hover:bg-purple-100">
                        <svg class="w-8 h-8 mx-auto text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span class="block mt-2">Lihat Lomba</span>
                    </a>
                    <a href="{{ route('siswa.notifikasi.index') }}" class="bg-yellow-50 p-4 rounded-lg text-center hover:bg-yellow-100">
                        <svg class="w-8 h-8 mx-auto text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="block mt-2">Cek Notifikasi</span>
                    </a>
                </div>
            </div>
            
            <div class="mt-8">
                <h3 class="text-md font-semibold">Profil Saya:</h3>
                <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">NISN</p>
                            <p class="font-medium">{{ $siswa->nisn }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Sekolah</p>
                            <p class="font-medium">{{ $siswa->sekolah->nama_sekolah }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ $siswa->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">No. HP</p>
                            <p class="font-medium">{{ $siswa->no_hp ?? 'Belum diisi' }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('siswa.profil.edit') }}" class="text-sm text-blue-600 hover:text-blue-900">Edit Profil &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection