<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Prestasi - Sistem Manajemen Prestasi Siswa</title>
    <meta name="description" content="Daftar lengkap prestasi siswa">
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
            <h1 class="text-3xl font-bold mb-2">Daftar Prestasi</h1>
            <p class="text-gray-600">Kumpulan prestasi terbaik dari siswa-siswa berbakat.</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-8">
            <form action="{{ route('prestasi.search') }}" method="GET">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <input type="text" name="query" placeholder="Cari prestasi..." 
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
                <a href="{{ route('prestasi.index') }}" class="text-blue-600 hover:underline">Reset pencarian</a>
            </div>
        @endif

        <!-- Prestasi List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($prestasi as $item)
                <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">{{ $item->nama_prestasi }}</h5>
                            <span class="px-2.5 py-0.5 rounded text-xs font-semibold 
                                @if($item->status_verifikasi == 'approved')
                                    bg-green-100 text-green-800
                                @elseif($item->status_verifikasi == 'rejected')
                                    bg-red-100 text-red-800
                                @else
                                    bg-yellow-100 text-yellow-800
                                @endif
                            ">
                                @if($item->status_verifikasi == 'approved')
                                    Disetujui
                                @elseif($item->status_verifikasi == 'rejected')
                                    Ditolak
                                @else
                                    Pending
                                @endif
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">{{ $item->siswa->nama ?? 'Tidak ada siswa' }} | {{ $item->siswa->sekolah->nama_sekolah ?? 'Tidak ada sekolah' }}</p>
                        
                        <div class="mt-3 space-y-1">
                            <p class="text-sm">
                                <span class="font-medium">Jenis:</span> {{ $item->jenis_prestasi }}
                            </p>
                            <p class="text-sm">
                                <span class="font-medium">Tingkat:</span> {{ $item->tingkat }}
                            </p>
                            <p class="text-sm">
                                <span class="font-medium">Tahun:</span> {{ $item->tahun }}
                            </p>
                            @if($item->lomba)
                                <p class="text-sm">
                                    <span class="font-medium">Lomba:</span> {{ $item->lomba->nama_lomba }}
                                </p>
                            @endif
                        </div>
                        
                        <div class="mt-4">
                            <button class="detail-prestasi-btn inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" data-id="{{ $item->id }}">
                                Detail Prestasi
                                <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10 bg-gray-50 rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="mt-2 text-gray-500">Tidak ada data prestasi.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $prestasi->links() }}
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

    <!-- Modal for Prestasi Detail -->
    <div id="prestasi-detail-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-screen overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold" id="modal-title">Detail Prestasi</h3>
                    <button id="close-prestasi-modal" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="prestasi-detail-content">
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

        // Prestasi Detail Modal
        const prestasiModal = document.getElementById('prestasi-detail-modal');
        const closePrestasiModal = document.getElementById('close-prestasi-modal');
        
        document.querySelectorAll('.detail-prestasi-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const prestasiId = this.dataset.id;
                // Fetch prestasi detail and populate modal
                fetchPrestasiDetail(prestasiId);
                prestasiModal.classList.remove('hidden');
            });
        });
        
        closePrestasiModal.addEventListener('click', function() {
            prestasiModal.classList.add('hidden');
        });

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target == prestasiModal) {
                prestasiModal.classList.add('hidden');
            }
        });

        // Function to fetch prestasi detail
        function fetchPrestasiDetail(id) {
            fetch(`/api/prestasi/${id}`)
                .then(response => response.json())
                .then(data => {
                    const prestasi = data;
                    let statusClass = '';
                    let statusText = '';
                    
                    if (prestasi.status_verifikasi === 'approved') {
                        statusClass = 'text-green-600';
                        statusText = 'Disetujui';
                    } else if (prestasi.status_verifikasi === 'rejected') {
                        statusClass = 'text-red-600';
                        statusText = 'Ditolak';
                    } else {
                        statusClass = 'text-yellow-600';
                        statusText = 'Pending';
                    }
                    
                    let content = `
                        <div class="bg-green-50 p-4 rounded-lg mb-4">
                            <h4 class="text-xl font-bold text-green-800">${prestasi.nama_prestasi}</h4>
                            <p class="text-sm text-green-600 mt-1">${prestasi.siswa ? prestasi.siswa.nama : 'Tidak ada siswa'} | ${prestasi.siswa && prestasi.siswa.sekolah ? prestasi.siswa.sekolah.nama_sekolah : 'Tidak ada sekolah'}</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <h5 class="font-semibold mb-2">Informasi Prestasi</h5>
                                <p class="text-sm mb-1"><span class="font-medium">Jenis:</span> ${prestasi.jenis_prestasi}</p>
                                <p class="text-sm mb-1"><span class="font-medium">Tingkat:</span> ${prestasi.tingkat}</p>
                                <p class="text-sm mb-1"><span class="font-medium">Tahun:</span> ${prestasi.tahun}</p>
                                <p class="text-sm mb-1"><span class="font-medium">Status:</span> <span class="${statusClass}">${statusText}</span></p>
                            </div>`;
                    
                    if (prestasi.lomba) {
                        content += `
                            <div>
                                <h5 class="font-semibold mb-2">Informasi Lomba</h5>
                                <p class="text-sm mb-1"><span class="font-medium">Lomba:</span> ${prestasi.lomba.nama_lomba}</p>
                                <p class="text-sm mb-1"><span class="font-medium">Tingkat:</span> ${prestasi.lomba.tingkat}</p>
                                <p class="text-sm mb-1"><span class="font-medium">Tahun:</span> ${prestasi.lomba.tahun}</p>
                            </div>`;
                    }
                    
                    content += `</div>`;
                    
                    if (prestasi.bukti) {
                        const fileExtension = prestasi.bukti.split('.').pop().toLowerCase();
                        const isImage = ['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension);
                        
                        content += `
                            <div class="mb-4">
                                <h5 class="font-semibold mb-2">Bukti Prestasi</h5>
                                <div class="border rounded-lg overflow-hidden">`;
                        
                        if (isImage) {
                            content += `<img src="/storage/${prestasi.bukti}" alt="Bukti Prestasi" class="w-full">`;
                        } else {
                            content += `
                                <div class="p-4 bg-gray-50 flex items-center">
                                    <svg class="h-10 w-10 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <a href="/storage/${prestasi.bukti}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen Bukti</a>
                                </div>`;
                        }
                        
                        content += `</div></div>`;
                    }
                    
                    document.getElementById('prestasi-detail-content').innerHTML = content;
                })
                .catch(error => {
                    console.error('Error fetching prestasi detail:', error);
                    document.getElementById('prestasi-detail-content').innerHTML = `
                        <div class="bg-red-100 p-4 rounded-lg text-red-700">
                            Terjadi kesalahan saat memuat detail prestasi. Silakan coba lagi.
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