@extends('layouts.admin')

@section('page-title', 'Tambah Sekolah')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold mb-4">Tambah Sekolah Baru</h2>
        
        <form action="{{ route('admin.sekolah.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="nama_sekolah" class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                <input type="text" name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('nama_sekolah')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.sekolah.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection