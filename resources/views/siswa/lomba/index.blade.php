@extends('layouts.siswa')

@section('page-title', 'Informasi Lomba')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Informasi Lomba</h2>
            <button id="toggle-filter" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter & Pencarian
            </button>
        </div>

        <!-- Filter Panel -->
        <div id="filter-panel" class="bg-gray-50 rounded-lg p-4 mb-6 hidden">
            <form action="{{ route('siswa.lomba.index') }}" method="GET" id="filter-form">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari nama lomba, deskripsi, lokasi..."
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-10 pr-4 py-2"
                                   value="{{ request()->search }}">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Jenis Lomba -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Lomba</label>
                        <select name="jenis_lomba" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisLomba as $jenis)
                                <option value="{{ $jenis }}" {{ request()->jenis_lomba == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tingkat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat</label>
                        <select name="tingkat" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Semua Tingkat</option>
                            @foreach($tingkatLomba as $tingkat)
                                <option value="{{ $tingkat }}" {{ request()->tingkat == $tingkat ? 'selected' : '' }}>
                                    {{ $tingkat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                        <select name="tahun" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Semua Tahun</option>
                            @foreach($tahunLomba as $tahun)
                                <option value="{{ $tahun }}" {{ request()->tahun == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request()->status == 'aktif' ? 'selected' : '' }}>Aktif/Akan Datang</option>
                            <option value="selesai" {{ request()->status == 'selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="md:col-span-3 flex items-end space-x-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        <a href="{{ route('siswa.lomba.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </a>
                        <button type="button" id="close-filter" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Tutup
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Active Filters Display -->
        @if(request()->hasAny(['search', 'jenis_lomba', 'tingkat', 'tahun', 'status']))
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span class="text-sm font-medium text-blue-800">Filter Aktif:</span>
                        <div class="flex flex-wrap gap-1">
                            @if(request()->search)
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    Pencarian: "{{ request()->search }}"
                                </span>
                            @endif
                            @if(request()->jenis_lomba)
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    Jenis: {{ request()->jenis_lomba }}
                                </span>
                            @endif
                            @if(request()->tingkat)
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    Tingkat: {{ request()->tingkat }}
                                </span>
                            @endif
                            @if(request()->tahun)
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    Tahun: {{ request()->tahun }}
                                </span>
                            @endif
                            @if(request()->status)
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    Status: {{ request()->status == 'aktif' ? 'Aktif/Akan Datang' : 'Sudah Selesai' }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('siswa.lomba.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        Hapus Semua Filter
                    </a>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($lomba as $item)
                @php
                    $isFinished = $item->tanggal_selesai && $item->tanggal_selesai < now()->format('Y-m-d');
                    $cardClass = $isFinished ? 'bg-gray-50 border-gray-300 opacity-75' : 'bg-white border-gray-200';
                @endphp
                <div class="rounded-lg border shadow-md overflow-hidden {{ $cardClass }}">
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">{{ $item->nama_lomba }}</h5>
                            <div class="flex flex-col space-y-1">
                                @php
                                    $tingkatClasses = [
                                        'Nasional' => 'bg-red-100 text-red-800',
                                        'Provinsi' => 'bg-yellow-100 text-yellow-800',
                                        'Kota/Kabupaten' => 'bg-green-100 text-green-800',
                                        'Sekolah' => 'bg-blue-100 text-blue-800'
                                    ];
                                    $tingkatClass = $tingkatClasses[$item->tingkat] ?? 'bg-gray-100 text-gray-800';

                                    // Check if lomba is finished
                                    $isFinished = $item->tanggal_selesai && $item->tanggal_selesai < now()->format('Y-m-d');
                                @endphp
                                <span class="px-2.5 py-0.5 rounded text-xs font-semibold {{ $tingkatClass }}">
                                    {{ $item->tingkat }}
                                </span>

                                @if($isFinished)
                                    <span class="px-2.5 py-0.5 rounded text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-300">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded text-xs font-semibold bg-green-100 text-green-700 border border-green-300">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Aktif
                                    </span>
                                @endif
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">{{ $item->jenis_lomba }} | {{ $item->tahun }}</p>

                        <div class="mt-3 space-y-1">
                            @if ($item->tanggal_mulai)
                                <p class="text-sm {{ $isFinished ? 'text-gray-500' : 'text-gray-700' }}">
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

                                    @if($isFinished)
                                        <span class="ml-2 text-xs text-red-600 font-medium">
                                            (Sudah berakhir)
                                        </span>
                                    @elseif($item->tanggal_selesai && $item->tanggal_selesai >= now()->format('Y-m-d'))
                                        @php
                                            $daysLeft = \Carbon\Carbon::parse($item->tanggal_selesai)->diffInDays(now());
                                        @endphp
                                        @if($daysLeft <= 7)
                                            <span class="ml-2 text-xs text-orange-600 font-medium">
                                                ({{ $daysLeft }} hari lagi)
                                            </span>
                                        @endif
                                    @endif
                                </p>
                            @endif

                            @if ($item->lokasi)
                                <p class="text-sm {{ $isFinished ? 'text-gray-500' : 'text-gray-700' }}">
                                    <span class="font-medium">Lokasi:</span> {{ $item->lokasi }}
                                </p>
                            @endif
                        </div>

                        <div class="mt-3">
                            <p class="text-sm {{ $isFinished ? 'text-gray-500' : 'text-gray-600' }}">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}
                            </p>
                        </div>

                        <div class="mt-4">
                            @if($isFinished)
                                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-500 bg-gray-100 rounded-lg cursor-not-allowed opacity-60"
                                     title="Lomba ini sudah berakhir dan tidak dapat diikuti lagi">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                    </svg>
                                    Lomba Selesai
                                </div>
                            @else
                                <a href="{{ route('siswa.lomba.show', $item->id) }}"
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Detail Lomba
                                    <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endif
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleFilterBtn = document.getElementById('toggle-filter');
    const closeFilterBtn = document.getElementById('close-filter');
    const filterPanel = document.getElementById('filter-panel');

    // Toggle filter panel
    if (toggleFilterBtn && filterPanel) {
        toggleFilterBtn.addEventListener('click', function() {
            filterPanel.classList.toggle('hidden');

            // Update button text
            const isHidden = filterPanel.classList.contains('hidden');
            const buttonText = isHidden ? 'Filter & Pencarian' : 'Tutup Filter';
            toggleFilterBtn.innerHTML = `
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                ${buttonText}
            `;
        });
    }

    // Close filter panel
    if (closeFilterBtn && filterPanel) {
        closeFilterBtn.addEventListener('click', function() {
            filterPanel.classList.add('hidden');
            toggleFilterBtn.innerHTML = `
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter & Pencarian
            `;
        });
    }

    // Auto-submit form when select changes (optional)
    const selectElements = document.querySelectorAll('#filter-form select');
    selectElements.forEach(select => {
        select.addEventListener('change', function() {
            // Uncomment the line below if you want auto-submit on select change
            // document.getElementById('filter-form').submit();
        });
    });

    // Show filter panel if there are active filters
    const hasActiveFilters = {{ request()->hasAny(['search', 'jenis_lomba', 'tingkat', 'tahun', 'status']) ? 'true' : 'false' }};
    if (hasActiveFilters && filterPanel) {
        filterPanel.classList.remove('hidden');
        toggleFilterBtn.innerHTML = `
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            Tutup Filter
        `;
    }
});
</script>
@endsection
