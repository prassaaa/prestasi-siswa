@extends('layouts.admin')

@section('page-title', 'Daftar Prestasi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-4 sm:p-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h2 class="text-lg font-semibold">Daftar Prestasi</h2>
            <a href="{{ route('admin.prestasi.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center">
                Tambah Prestasi
            </a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.prestasi.index') }}" class="mb-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status:</label>
                    <select id="status" name="status" class="w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request()->query('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request()->query('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request()->query('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Tingkat Filter -->
                <div>
                    <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-1">Tingkat:</label>
                    <select id="tingkat" name="tingkat" class="w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                        <option value="">Semua Tingkat</option>
                        <option value="Sekolah" {{ request()->query('tingkat') == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                        <option value="Kecamatan" {{ request()->query('tingkat') == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                        <option value="Kabupaten/Kota" {{ request()->query('tingkat') == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                        <option value="Provinsi" {{ request()->query('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                        <option value="Nasional" {{ request()->query('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                        <option value="Internasional" {{ request()->query('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                    </select>
                </div>

                <!-- Jenjang Filter -->
                <div>
                    <label for="jenjang_pendidikan" class="block text-sm font-medium text-gray-700 mb-1">Jenjang Pendidikan:</label>
                    <select id="jenjang_pendidikan" name="jenjang_pendidikan" class="w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                        <option value="">Semua Jenjang</option>
                        <option value="TK" {{ request()->query('jenjang_pendidikan') == 'TK' ? 'selected' : '' }}>TK</option>
                        <option value="SD" {{ request()->query('jenjang_pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ request()->query('jenjang_pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ request()->query('jenjang_pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex items-end space-x-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Filter
                    </button>
                    <a href="{{ route('admin.prestasi.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="hidden sm:table-row">
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Prestasi
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Siswa
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Asal Sekolah
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jenis
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tingkat
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jenjang
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($prestasi as $item)
                    <tr class="flex flex-col sm:table-row mb-4 sm:mb-0">
                        <td class="px-4 py-2 sm:py-4 text-sm font-medium text-gray-900 flex sm:table-cell">
                            <span class="font-bold sm:hidden mr-2">Nama:</span>
                            {{ $item->nama_prestasi }}
                        </td>
                        <td class="px-4 py-2 sm:py-4 text-sm text-gray-500 flex sm:table-cell">
                            <span class="font-bold sm:hidden mr-2">Siswa:</span>
                            {{ $item->siswa->nama ?? 'Tidak ada siswa' }}
                        </td>
                        <td class="px-4 py-2 sm:py-4 text-sm text-gray-500 flex sm:table-cell">
                            <span class="font-bold sm:hidden mr-2">Asal Sekolah:</span>
                            {{ $item->siswa->sekolah->nama_sekolah ?? 'Tidak ada data' }}
                        </td>
                        <td class="px-4 py-2 sm:py-4 text-sm text-gray-500 flex sm:table-cell">
                            <span class="font-bold sm:hidden mr-2">Jenis:</span>
                            {{ $item->jenis_prestasi }}
                        </td>
                        <td class="px-4 py-2 sm:py-4 text-sm text-gray-500 flex sm:table-cell">
                            <span class="font-bold sm:hidden mr-2">Tingkat:</span>
                            {{ $item->tingkat }}
                        </td>
                        <td class="px-4 py-2 sm:py-4 text-sm text-gray-500 flex sm:table-cell">
                            <span class="font-bold sm:hidden mr-2">Jenjang:</span>
                            {{ $item->jenjang_pendidikan }}
                        </td>
                        <td class="px-4 py-2 sm:py-4 text-sm text-gray-500 flex sm:table-cell">
                            <span class="font-bold sm:hidden mr-2">Status:</span>
                            @if ($item->status_verifikasi == 'pending')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif ($item->status_verifikasi == 'approved')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                            @elseif ($item->status_verifikasi == 'rejected')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-2 sm:py-4 text-sm font-medium flex sm:table-cell space-x-2">
                            <span class="font-bold sm:hidden mr-2">Aksi:</span>
                            <a href="{{ route('admin.prestasi.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                            <a href="{{ route('admin.prestasi.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                            <form class="inline-block" action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-sm text-gray-500 text-center">
                            Tidak ada data prestasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-center sm:justify-end">
            {{ $prestasi->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
