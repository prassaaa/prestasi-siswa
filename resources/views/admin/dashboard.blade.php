@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card Siswa -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-500 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $siswaCount }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.siswa.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">Lihat Semua &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card Prestasi -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500 text-white">
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
                    <a href="{{ route('admin.prestasi.index') }}" class="text-sm text-green-600 hover:text-green-900">Lihat Semua &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card Lomba -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-500 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Lomba</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $lombaCount }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.lomba.index') }}" class="text-sm text-yellow-600 hover:text-yellow-900">Lihat Semua &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card Prestasi Pending -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-500 text-white">
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
                    <a href="{{ route('admin.prestasi.index', ['status' => 'pending']) }}" class="text-sm text-red-600 hover:text-red-900">Verifikasi Sekarang &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Prestasi -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Grafik Jenis Prestasi (Pie Chart) -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Jenis Prestasi</h2>
                <div class="w-full" style="height: 300px;">
                    <canvas id="prestasiJenisChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Tingkat Prestasi (Bar Chart) -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Prestasi Berdasarkan Tingkat</h2>
                <div class="w-full" style="height: 300px;">
                    <canvas id="prestasiTingkatChart"></canvas>
                </div>
                <div class="mt-4">
                    <div class="flex flex-wrap justify-center gap-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-1 bg-blue-500 rounded"></div>
                            <span class="text-xs">Sekolah</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-1 bg-teal-500 rounded"></div>
                            <span class="text-xs">Kecamatan</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-1 bg-orange-400 rounded"></div>
                            <span class="text-xs">Kabupaten/Kota</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-1 bg-purple-500 rounded"></div>
                            <span class="text-xs">Provinsi</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-1 bg-pink-500 rounded"></div>
                            <span class="text-xs">Nasional</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 mr-1 bg-yellow-400 rounded"></div>
                            <span class="text-xs">Internasional</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Jenjang Pendidikan dan Prestasi Berdasarkan Tahun -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Grafik Jenjang Pendidikan (Doughnut Chart) -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Prestasi Berdasarkan Jenjang Pendidikan</h2>
                <div class="w-full" style="height: 300px;">
                    <canvas id="prestasiJenjangChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Prestasi Berdasarkan Tahun (Line Chart) -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Prestasi Berdasarkan Tahun</h2>
                <div class="w-full" style="height: 300px;">
                    <canvas id="prestasiTahunChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white overflow-hidden shadow-sm rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold mb-4">Selamat Datang di Dashboard Admin</h2>
            <p class="text-gray-600">Gunakan panel admin ini untuk mengelola data prestasi siswa, melakukan verifikasi prestasi, dan mengelola informasi lomba.</p>

            <div class="mt-6">
                <h3 class="text-md font-semibold">Aksi Cepat:</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('admin.siswa.create') }}" class="bg-indigo-50 p-4 rounded-lg text-center hover:bg-indigo-100">
                        <svg class="w-8 h-8 mx-auto text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        <span class="block mt-2">Tambah Siswa</span>
                    </a>
                    <a href="{{ route('admin.lomba.create') }}" class="bg-yellow-50 p-4 rounded-lg text-center hover:bg-yellow-100">
                        <svg class="w-8 h-8 mx-auto text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="block mt-2">Tambah Lomba</span>
                    </a>
                    <a href="{{ route('admin.prestasi.create') }}" class="bg-green-50 p-4 rounded-lg text-center hover:bg-green-100">
                        <svg class="w-8 h-8 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="block mt-2">Tambah Prestasi</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data untuk grafik jenis prestasi
    const prestasiJenisCtx = document.getElementById('prestasiJenisChart').getContext('2d');
    const prestasiJenisChart = new Chart(prestasiJenisCtx, {
        type: 'pie',
        data: {
            labels: ['Akademik', 'Non-Akademik'],
            datasets: [{
                data: [{{ $prestasiAkademik }}, {{ $prestasiNonAkademik }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 99, 132, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Data untuk grafik tingkat prestasi
    const prestasiTingkatCtx = document.getElementById('prestasiTingkatChart').getContext('2d');
    const prestasiTingkatChart = new Chart(prestasiTingkatCtx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($prestasiByTingkat as $item)
                    '{{ $item->tingkat }}',
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Prestasi',
                data: [
                    @foreach($prestasiByTingkat as $item)
                        {{ $item->total }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach($prestasiByTingkat as $index => $item)
                        @if($item->tingkat == 'Sekolah')
                            'rgba(54, 162, 235, 0.8)', // Biru untuk tingkat Sekolah
                        @elseif($item->tingkat == 'Kecamatan')
                            'rgba(75, 192, 192, 0.8)', // Hijau tosca untuk tingkat Kecamatan
                        @elseif($item->tingkat == 'Kabupaten/Kota')
                            'rgba(255, 159, 64, 0.8)', // Oranye untuk tingkat Kabupaten/Kota
                        @elseif($item->tingkat == 'Provinsi')
                            'rgba(153, 102, 255, 0.8)', // Ungu untuk tingkat Provinsi
                        @elseif($item->tingkat == 'Nasional')
                            'rgba(255, 99, 132, 0.8)', // Merah muda untuk tingkat Nasional
                        @elseif($item->tingkat == 'Internasional')
                            'rgba(255, 205, 86, 0.8)', // Kuning untuk tingkat Internasional
                        @else
                            'rgba(201, 203, 207, 0.8)', // Abu-abu untuk tingkat lainnya
                        @endif
                    @endforeach
                ],
                borderColor: [
                    @foreach($prestasiByTingkat as $index => $item)
                        @if($item->tingkat == 'Sekolah')
                            'rgba(54, 162, 235, 1)',
                        @elseif($item->tingkat == 'Kecamatan')
                            'rgba(75, 192, 192, 1)',
                        @elseif($item->tingkat == 'Kabupaten/Kota')
                            'rgba(255, 159, 64, 1)',
                        @elseif($item->tingkat == 'Provinsi')
                            'rgba(153, 102, 255, 1)',
                        @elseif($item->tingkat == 'Nasional')
                            'rgba(255, 99, 132, 1)',
                        @elseif($item->tingkat == 'Internasional')
                            'rgba(255, 205, 86, 1)',
                        @else
                            'rgba(201, 203, 207, 1)',
                        @endif
                    @endforeach
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Menghilangkan legend chart bawaan
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} prestasi`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Data untuk grafik jenjang pendidikan
    const prestasiJenjangCtx = document.getElementById('prestasiJenjangChart').getContext('2d');
    const prestasiJenjangChart = new Chart(prestasiJenjangCtx, {
        type: 'doughnut',
        data: {
            labels: ['TK', 'SD', 'SMP', 'SMA'],
            datasets: [{
                data: [
                    {{ $prestasiByJenjang['TK'] ?? 0 }},
                    {{ $prestasiByJenjang['SD'] ?? 0 }},
                    {{ $prestasiByJenjang['SMP'] ?? 0 }},
                    {{ $prestasiByJenjang['SMA'] ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(255, 159, 64, 0.8)',   // Orange for TK
                    'rgba(255, 205, 86, 0.8)',   // Yellow for SD
                    'rgba(54, 162, 235, 0.8)',   // Blue for SMP
                    'rgba(153, 102, 255, 0.8)'   // Purple for SMA
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Data untuk grafik prestasi berdasarkan tahun dan jenjang pendidikan
    const prestasiTahunCtx = document.getElementById('prestasiTahunChart').getContext('2d');
    const prestasiTahunChart = new Chart(prestasiTahunCtx, {
        type: 'line',
        data: {
            labels: [
                @foreach($prestasiByTahun as $item)
                    '{{ $item->tahun }}',
                @endforeach
            ],
            datasets: [
                {
                    label: 'TK',
                    data: [
                        @foreach($prestasiByTahun as $item)
                            {{ $prestasiByTahunJenjang[$item->tahun]['TK'] ?? 0 }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2,
                    tension: 0.1
                },
                {
                    label: 'SD',
                    data: [
                        @foreach($prestasiByTahun as $item)
                            {{ $prestasiByTahunJenjang[$item->tahun]['SD'] ?? 0 }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    borderColor: 'rgba(255, 205, 86, 1)',
                    borderWidth: 2,
                    tension: 0.1
                },
                {
                    label: 'SMP',
                    data: [
                        @foreach($prestasiByTahun as $item)
                            {{ $prestasiByTahunJenjang[$item->tahun]['SMP'] ?? 0 }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.1
                },
                {
                    label: 'SMA',
                    data: [
                        @foreach($prestasiByTahun as $item)
                            {{ $prestasiByTahunJenjang[$item->tahun]['SMA'] ?? 0 }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    tension: 0.1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>
@endsection
