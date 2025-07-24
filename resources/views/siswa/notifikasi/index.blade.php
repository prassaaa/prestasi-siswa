@extends('layouts.siswa')

@section('page-title', 'Notifikasi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Notifikasi</h2>
            <div class="flex space-x-2">
                <form action="{{ route('siswa.notifikasi.mark-all-as-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Tandai Semua Dibaca
                    </button>
                </form>
            </div>
        </div>
        
        <div class="divide-y divide-gray-200">
            @forelse ($notifikasi as $item)
                <div class="py-4 {{ $item->dibaca ? 'opacity-60' : '' }}">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-1">
                            @if (!$item->dibaca)
                                <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                            @else
                                <span class="inline-block w-3 h-3 bg-gray-300 rounded-full"></span>
                            @endif
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="flex justify-between">
                                <a href="{{ route('siswa.notifikasi.show', $item->id) }}" class="text-lg font-medium text-gray-900 hover:text-blue-500">
                                    {{ $item->judul }}
                                </a>
                                <div class="text-sm text-gray-500">
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ \Illuminate\Support\Str::limit($item->pesan, 100) }}
                            </p>
                            <div class="mt-2 flex">
                                <a href="{{ route('siswa.notifikasi.show', $item->id) }}" class="text-sm text-blue-500 hover:text-blue-700 mr-4">
                                    Baca selengkapnya
                                </a>
                                <form action="{{ route('siswa.notifikasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-500 hover:text-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-4 text-center text-gray-500">
                    Tidak ada notifikasi.
                </div>
            @endforelse
        </div>
        
        <div class="mt-4">
            {{ $notifikasi->links() }}
        </div>
    </div>
</div>
@endsection