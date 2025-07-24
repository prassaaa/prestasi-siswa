@extends('layouts.siswa')

@section('page-title', 'Informasi Lomba')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Informasi Lomba</h2>
            <div class="relative">
                <form action="{{ route('siswa.lomba.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari lomba..."
                               class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-10 pr-4 py-2 w-full"
                               value="{{ request()->search }}">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($lomba as $item)
                <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">{{ $item->nama_lomba }}</h5>
                            <span class="px-2.5 py-0.5 rounded text-xs font-semibold {{ $item->tingkat == 'Nasional' ? 'bg-red-100 text-red-800' : ($item->tingkat == 'Provinsi' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ $item->tingkat }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">{{ $item->jenis_lomba }} | {{ $item->tahun }}</p>

                        <div class="mt-3 space-y-1">
                            @if ($item->tanggal_mulai)
                                <p class="text-sm">
                                    <span class="font-medium">Tanggal:</span>
                                    @if (is_string($item->tanggal_mulai))
                                        {{ $item->tanggal_mulai }}
                                    @else
                                        {{ $item->tanggal_mulai->format('d M Y') }}
                                    @endif

                                    @if ($item->tanggal_selesai && $item->tanggal_mulai != $item->tanggal_selesai)
                                        -
                                        @if (is_string($item->tanggal_selesai))
                                            {{ $item->tanggal_selesai }}
                                        @else
                                            {{ $item->tanggal_selesai->format('d M Y') }}
                                        @endif
                                    @endif
                                </p>
                            @endif

                            @if ($item->lokasi)
                                <p class="text-sm">
                                    <span class="font-medium">Lokasi:</span> {{ $item->lokasi }}
                                </p>
                            @endif
                        </div>

                        <div class="mt-3">
                            <p class="text-sm text-gray-600">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}
                            </p>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('siswa.lomba.show', $item->id) }}"
                               class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Detail Lomba
                                <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500">Tidak ada data lomba.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $lomba->links() }}
        </div>
    </div>
</div>
@endsection
