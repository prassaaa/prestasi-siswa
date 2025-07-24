@extends('layouts.siswa')

@section('page-title', 'Kirim Pesan ke Admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold mb-4">Kirim Pesan ke Admin</h2>
        
        <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Informasi</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Gunakan fitur ini untuk mengirim pesan, pertanyaan, atau laporan kepada admin.</p>
                        <p class="mt-1">Pesan akan dikirim ke semua admin yang tersedia.</p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('siswa.pesan.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Pesan</label>
                <input type="text" 
                       name="judul" 
                       id="judul" 
                       value="{{ old('judul') }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       placeholder="Contoh: Pertanyaan tentang verifikasi prestasi"
                       required>
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">Isi Pesan</label>
                <textarea name="pesan" 
                          id="pesan" 
                          rows="8" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                          placeholder="Tulis pesan Anda di sini..."
                          required>{{ old('pesan') }}</textarea>
                @error('pesan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Maksimal 1000 karakter</p>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-md p-4 mb-6">
                <h4 class="text-sm font-medium text-gray-800 mb-2">Informasi Pengirim:</h4>
                <div class="text-sm text-gray-600">
                    <p><strong>Nama:</strong> {{ Auth::user()->siswa->nama }}</p>
                    <p><strong>NISN:</strong> {{ Auth::user()->siswa->nisn }}</p>
                    <p><strong>Sekolah:</strong> {{ Auth::user()->siswa->sekolah->nama_sekolah }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('siswa.notifikasi.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Kirim Pesan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Character counter for textarea
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('pesan');
    const maxLength = 1000;
    
    // Create character counter element
    const counter = document.createElement('p');
    counter.className = 'text-gray-500 text-xs mt-1 text-right';
    counter.id = 'char-counter';
    textarea.parentNode.appendChild(counter);
    
    function updateCounter() {
        const remaining = maxLength - textarea.value.length;
        counter.textContent = `${textarea.value.length}/${maxLength} karakter`;
        
        if (remaining < 50) {
            counter.className = 'text-red-500 text-xs mt-1 text-right';
        } else if (remaining < 100) {
            counter.className = 'text-yellow-500 text-xs mt-1 text-right';
        } else {
            counter.className = 'text-gray-500 text-xs mt-1 text-right';
        }
    }
    
    textarea.addEventListener('input', updateCounter);
    updateCounter(); // Initial count
});
</script>
@endsection
