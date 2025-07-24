@extends('layouts.siswa')

@section('page-title', 'Detail Prestasi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Detail Prestasi</h2>
            <a href="{{ route('siswa.prestasi.index') }}" class="text-blue-500 hover:text-blue-700">
                &larr; Kembali
            </a>
        </div>

        <div class="mb-6">
            <div class="flex items-center">
                <h3 class="text-xl font-bold">{{ $prestasi->nama_prestasi }}</h3>
                <div class="ml-4">
                    @if ($prestasi->status_verifikasi == 'pending')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    @elseif ($prestasi->status_verifikasi == 'approved')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Disetujui
                        </span>
                    @elseif ($prestasi->status_verifikasi == 'rejected')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                            Ditolak
                        </span>
                    @endif
                </div>
            </div>

            @if ($prestasi->peringkat)
                <div class="mt-2">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-lg">
                        {{ $prestasi->peringkat }}
                    </span>
                </div>
            @endif

            @if ($prestasi->catatan_verifikasi)
                <div class="mt-2 p-3 bg-gray-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-700">Catatan Verifikasi:</p>
                    <p class="text-sm text-gray-600">{{ $prestasi->catatan_verifikasi }}</p>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-md font-semibold mb-3">Informasi Prestasi</h4>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Jenis Prestasi</p>
                        <p class="font-medium">{{ $prestasi->jenis_prestasi }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tingkat</p>
                        <p class="font-medium">{{ $prestasi->tingkat }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Jenjang Pendidikan</p>
                        <p class="font-medium">{{ $prestasi->jenjang_pendidikan }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tahun</p>
                        <p class="font-medium">{{ $prestasi->tahun }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm text-gray-500">Tanggal Input</p>
                        <p class="font-medium">{{ $prestasi->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <h4 class="text-md font-semibold mb-3 mt-5">Informasi Lomba/Kegiatan</h4>
                <div class="bg-gray-50 p-4 rounded-lg">
                    @if ($prestasi->penyelenggara)
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Penyelenggara</p>
                            <p class="font-medium">{{ $prestasi->penyelenggara }}</p>
                        </div>
                    @endif

                    @if ($prestasi->lokasi_kegiatan)
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Lokasi Kegiatan</p>
                            <p class="font-medium">{{ $prestasi->lokasi_kegiatan }}</p>
                        </div>
                    @endif

                    @if ($prestasi->tanggal_kegiatan)
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Tanggal Kegiatan</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($prestasi->tanggal_kegiatan)->format('d M Y') }}</p>
                        </div>
                    @endif

                    @if ($prestasi->kategori_lomba)
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Kategori Lomba</p>
                            <p class="font-medium">{{ $prestasi->kategori_lomba }}</p>
                        </div>
                    @endif

                    @if ($prestasi->peringkat)
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Peringkat/Juara</p>
                            <p class="font-medium">{{ $prestasi->peringkat }}</p>
                        </div>
                    @endif

                    @if ($prestasi->lomba)
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Terkait Lomba</p>
                            <p class="font-medium">{{ $prestasi->lomba->nama_lomba }}</p>
                        </div>
                    @endif

                    @if (!$prestasi->penyelenggara && !$prestasi->lokasi_kegiatan && !$prestasi->tanggal_kegiatan && !$prestasi->kategori_lomba && !$prestasi->peringkat && !$prestasi->lomba)
                        <p class="text-gray-500 italic">Tidak ada informasi lomba/kegiatan.</p>
                    @endif
                </div>
            </div>

            <div>
                <h4 class="text-md font-semibold mb-3">Bukti Prestasi</h4>
                <div class="bg-gray-50 p-4 rounded-lg">
                    @if ($prestasi->bukti)
                        <div class="mb-3">
                            @php
                                $extension = pathinfo(storage_path('app/public/' . $prestasi->bukti), PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('storage/' . $prestasi->bukti) }}" alt="Bukti Prestasi" class="max-w-full h-auto rounded-lg border">
                            @else
                                <a href="{{ asset('storage/' . $prestasi->bukti) }}" target="_blank" class="text-blue-500 hover:text-blue-700 flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    Lihat Dokumen Bukti
                                </a>
                            @endif
                        </div>
                    @else
                        <p class="text-gray-500 italic">Tidak ada bukti yang diunggah.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            @if ($prestasi->status_verifikasi == 'pending')
                <a href="{{ route('siswa.prestasi.edit', $prestasi->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit Prestasi
                </a>
                <form action="{{ route('siswa.prestasi.destroy', $prestasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Hapus Prestasi
                    </button>
                </form>
            @endif

            @if ($prestasi->status_verifikasi == 'approved')
                <a href="{{ route('siswa.prestasi.print', $prestasi->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Cetak PDF
                </a>
                @endif
            </div>
        </div>
    </div>
@endsection
