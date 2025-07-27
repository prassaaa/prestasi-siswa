<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Lomba - Sistem Manajemen Prestasi Siswa</title>
    <meta name="description" content="Daftar lengkap lomba siswa">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <a href="{{ route('landing') }}" class="text-xl font-bold hover:underline">Sistem Manajemen Prestasi Siswa</a>
            </div>
            <div class="hidden md:flex space-x-4">
                <a href="{{ route('landing') }}#lomba" class="hover:underline">Data Lomba</a>
                <a href="{{ route('landing') }}#prestasi" class="hover:underline">Data Prestasi</a>
                <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-1 rounded-md font-medium hover:bg-blue-50 transition">Login</a>
            </div>
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="menu-toggle" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden px-4 py-3 bg-blue-700">
            <a href="{{ route('landing') }}#lomba" class="block py-2 hover:bg-blue-800 px-2 rounded">Data Lomba</a>
            <a href="{{ route('landing') }}#prestasi" class="block py-2 hover:bg-blue-800 px-2 rounded">Data Prestasi</a>
            <a href="{{ route('login') }}" class="block py-2 bg-white text-blue-600 px-2 rounded mt-2 font-medium">Login</a>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Informasi Lomba</h1>
            <p class="text-gray-600">Informasi lengkap tentang lomba-lomba yang tersedia.</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-8">
            <form action="{{ route('lomba.search') }}" method="GET">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <input type="text" name="query" placeholder="Cari lomba..."
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 px-4 py-2"
                               value="{{ request()->query('query') }}">
                    </div>
                    <div>
                        <button type="submit" class="w-full md:w-auto bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Filter Results Message -->
        @if(request()->has('query'))
            <div class="mb-4 bg-blue-50 p-3 rounded-md">
                <p>Hasil pencarian untuk: <span class="font-semibold">{{ request()->query('query') }}</span></p>
                <a href="{{ route('lomba.index') }}" class="text-blue-600 hover:underline">Reset pencarian</a>
            </div>
        @endif

        <!-- Lomba List -->
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
                                <button class="detail-lomba-btn inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" data-id="{{ $item->id }}">
                                    Detail Lomba
                                    <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10 bg-gray-50 rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="mt-2 text-gray-500">Tidak ada data lomba.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $lomba->links() }}
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-4">Sistem Manajemen Prestasi Siswa</h3>
                    <p class="text-gray-400 max-w-md">Platform untuk mengelola dan mempublikasikan prestasi dan lomba siswa dengan mudah dan efisien.</p>
                </div>

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-lg font-semibold mb-3">Tautan</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('landing') }}" class="text-gray-400 hover:text-white">Beranda</a></li>
                            <li><a href="{{ route('landing') }}#lomba" class="text-gray-400 hover:text-white">Data Lomba</a></li>
                            <li><a href="{{ route('landing') }}#prestasi" class="text-gray-400 hover:text-white">Data Prestasi</a></li>
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Login</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold mb-3">Kontak</h4>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-400">info@prestasisiswa.com</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-gray-400">(021) 1234-5678</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr class="border-gray-700 my-6">

            <div class="text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Sistem Manajemen Prestasi Siswa. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Modal for Lomba Detail -->
    <div id="lomba-detail-modal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold" id="modal-title">Detail Lomba</h3>
                    <button id="close-lomba-modal" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="lomba-detail-content">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Lomba Detail Modal
        const lombaModal = document.getElementById('lomba-detail-modal');
        const closeLombaModal = document.getElementById('close-lomba-modal');

        document.querySelectorAll('.detail-lomba-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const lombaId = this.dataset.id;
                // Fetch lomba detail and populate modal
                fetchLombaDetail(lombaId);
                lombaModal.classList.remove('hidden');
                lombaModal.classList.add('flex');
            });
        });

        closeLombaModal.addEventListener('click', function() {
            lombaModal.classList.add('hidden');
            lombaModal.classList.remove('flex');
        });

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target == lombaModal) {
                lombaModal.classList.add('hidden');
                lombaModal.classList.remove('flex');
            }
        });

        // Function to fetch lomba detail
        function fetchLombaDetail(id) {
            fetch(`/api/lomba/${id}`)
                .then(response => response.json())
                .then(data => {
                    const lomba = data;
                    let content = `
                        <div class="bg-blue-50 p-4 rounded-lg mb-4">
                            <h4 class="text-xl font-bold text-blue-800">${lomba.nama_lomba}</h4>
                            <p class="text-sm text-blue-600 mt-1">${lomba.jenis_lomba} | ${lomba.tahun}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <h5 class="font-semibold mb-2">Informasi Lomba</h5>
                                <p class="text-sm mb-1"><span class="font-medium">Tingkat:</span> ${lomba.tingkat}</p>
                                <p class="text-sm mb-1"><span class="font-medium">Tanggal:</span> ${formatDate(lomba.tanggal_mulai)}`;

                    if (lomba.tanggal_selesai && lomba.tanggal_mulai !== lomba.tanggal_selesai) {
                        content += ` - ${formatDate(lomba.tanggal_selesai)}`;
                    }

                    content += `</p>
                                <p class="text-sm mb-1"><span class="font-medium">Lokasi:</span> ${lomba.lokasi || '-'}</p>
                            </div>
                        </div>

                        <h5 class="font-semibold mb-2">Deskripsi</h5>
                        <p class="text-sm mb-4">
                            ${lomba.deskripsi || 'Tidak ada deskripsi'}
                        </p>
                    `;

                    document.getElementById('lomba-detail-content').innerHTML = content;
                })
                .catch(error => {
                    console.error('Error fetching lomba detail:', error);
                    document.getElementById('lomba-detail-content').innerHTML = `
                        <div class="bg-red-100 p-4 rounded-lg text-red-700">
                            Terjadi kesalahan saat memuat detail lomba. Silakan coba lagi.
                        </div>
                    `;
                });
        }

        // Format date helper function
        function formatDate(dateString) {
            if (!dateString) return '-';

            const date = new Date(dateString);
            if (isNaN(date.getTime())) return dateString; // Handle if date is invalid

            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
        }
    </script>
</body>
</html>
