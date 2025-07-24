@extends('layouts.siswa')

@section('page-title', 'Notifikasi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Notifikasi & Pesan</h2>
            <div class="flex space-x-2">
                <a href="{{ route('siswa.pesan.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Kirim Pesan ke Admin
                </a>
                <form action="{{ route('siswa.notifikasi.mark-all-as-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Tandai Semua Dibaca
                    </button>
                </form>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-8">
                <button onclick="showTab('notifikasi')" id="tab-notifikasi"
                        class="tab-button border-b-2 border-blue-500 text-blue-600 py-2 px-1 text-sm font-medium">
                    Notifikasi Diterima
                    @if($notifikasi->where('dibaca', false)->count() > 0)
                        <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                            {{ $notifikasi->where('dibaca', false)->count() }}
                        </span>
                    @endif
                </button>
                <button onclick="showTab('pesan')" id="tab-pesan"
                        class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-2 px-1 text-sm font-medium">
                    Pesan Dikirim
                    @if($pesanDikirim->where('dibaca', false)->count() > 0)
                        <span class="ml-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">
                            {{ $pesanDikirim->where('dibaca', false)->count() }} belum dibaca
                        </span>
                    @endif
                </button>
            </nav>
        </div>

        <!-- Tab Content: Notifikasi Diterima -->
        <div id="content-notifikasi" class="tab-content">
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

        <!-- Tab Content: Pesan Dikirim -->
        <div id="content-pesan" class="tab-content hidden">

        @if($pesanDikirim->count() > 0)
            <div class="space-y-4">
                @foreach($pesanDikirim as $pesan)
                    <div class="border border-gray-200 rounded-lg p-4 {{ $pesan->dibaca ? 'bg-green-50' : 'bg-yellow-50' }}">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-medium text-gray-900">
                                {{ str_replace('[Pesan Siswa] ', '', $pesan->judul) }}
                            </h3>
                            <div class="flex items-center space-x-2">
                                @if($pesan->dibaca)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Sudah Dibaca
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Belum Dibaca
                                    </span>
                                @endif
                                <span class="text-xs text-gray-500">
                                    {{ $pesan->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                        </div>

                        <div class="text-sm text-gray-600 mb-3">
                            @php
                                // Extract pesan asli dari format "Pesan dari siswa: nama (sekolah)\n\nisi pesan"
                                $pesanAsli = $pesan->pesan;
                                if (strpos($pesanAsli, "\n\n") !== false) {
                                    $pesanAsli = substr($pesanAsli, strpos($pesanAsli, "\n\n") + 2);
                                }
                            @endphp
                            <p class="whitespace-pre-line">{{ Str::limit($pesanAsli, 200) }}</p>
                        </div>

                        <div class="flex justify-between items-center text-xs text-gray-500">
                            <div>
                                <span>Dikirim ke: {{ $pesan->user->name }}</span>
                                @if($pesan->dibaca && $pesan->read_at)
                                    <span class="ml-2">• Dibaca: {{ $pesan->read_at->format('d M Y, H:i') }}</span>
                                @endif
                            </div>

                            @if($pesan->dibaca)
                                <div class="flex items-center text-green-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">Admin telah membaca pesan Anda</span>
                                </div>
                            @else
                                <div class="flex items-center text-yellow-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">Menunggu admin membaca</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pesan yang dikirim</h3>
                <p class="mt-1 text-sm text-gray-500">Anda belum pernah mengirim pesan ke admin.</p>
                <div class="mt-6">
                    <a href="{{ route('siswa.pesan.create') }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Kirim Pesan Pertama
                    </a>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });

    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });

    // Show selected tab content
    document.getElementById('content-' + tabName).classList.remove('hidden');

    // Add active class to selected tab button
    const activeButton = document.getElementById('tab-' + tabName);
    activeButton.classList.remove('border-transparent', 'text-gray-500');
    activeButton.classList.add('border-blue-500', 'text-blue-600');
}

// Initialize - show notifikasi tab by default
document.addEventListener('DOMContentLoaded', function() {
    showTab('notifikasi');
});
</script>
@endsection
