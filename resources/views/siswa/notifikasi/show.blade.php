@extends('layouts.siswa')

@section('page-title', 'Detail Notifikasi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Detail Notifikasi</h2>
            <a href="{{ route('siswa.notifikasi.index') }}" class="text-blue-500 hover:text-blue-700">
                &larr; Kembali ke Notifikasi
            </a>
        </div>
        
        <div class="mb-4">
            <h1 class="text-2xl font-bold">{{ $notifikasi->judul }}</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $notifikasi->created_at->format('d M Y, H:i') }}</p>
        </div>
        
        <div class="bg-gray-50 p-6 rounded-lg">
            <p class="text-gray-700 whitespace-pre-line">{{ $notifikasi->pesan }}</p>
        </div>
        
        <div class="mt-6">
            <form action="{{ route('siswa.notifikasi.destroy', $notifikasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Hapus Notifikasi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection