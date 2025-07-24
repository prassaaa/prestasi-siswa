@extends('layouts.admin')

@section('page-title', 'Daftar Notifikasi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Daftar Notifikasi</h2>
            <div class="flex space-x-2 mt-4 md:mt-0">
                <a href="{{ route('admin.notifikasi.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah Notifikasi
                </a>
            </div>
        </div>

        <!-- Form Kirim Notifikasi ke Semua Siswa -->
        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="text-md font-semibold mb-3">Kirim Notifikasi ke Semua Siswa</h3>
            <form action="{{ route('admin.notifikasi.send-to-all') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>

                <div class="mb-4">
                    <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
                    <textarea name="pesan" id="pesan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Kirim ke Semua Siswa
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Notifikasi -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="hidden md:table-row">
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Untuk
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Judul
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pesan
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($notifikasi as $item)
                    <tr>
                        <!-- Versi Desktop -->
                        <td class="hidden md:table-cell px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->user->name ?? 'Tidak ada user' }}
                        </td>
                        <td class="hidden md:table-cell px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('admin.notifikasi.show', $item->id) }}"
                               class="text-blue-600 hover:text-blue-900 hover:underline">
                                {{ $item->judul }}
                            </a>
                        </td>
                        <td class="hidden md:table-cell px-4 py-4 whitespace-normal text-sm text-gray-500">
                            {{ \Illuminate\Support\Str::limit($item->pesan, 50) }}
                        </td>
                        <td class="hidden md:table-cell px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if ($item->dibaca)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Dibaca
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Belum Dibaca
                                </span>
                            @endif
                        </td>
                        <td class="hidden md:table-cell px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="hidden md:table-cell px-4 py-4 whitespace-nowrap text-sm font-medium">
                            <form class="inline-block" action="{{ route('admin.notifikasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>

                        <!-- Versi Mobile -->
                        <td class="md:hidden px-4 py-4 text-sm text-gray-900">
                            <div class="space-y-2">
                                <p><strong>Untuk:</strong> {{ $item->user->name ?? 'Tidak ada user' }}</p>
                                <p><strong>Judul:</strong>
                                    <a href="{{ route('admin.notifikasi.show', $item->id) }}"
                                       class="text-blue-600 hover:text-blue-900 hover:underline">
                                        {{ $item->judul }}
                                    </a>
                                </p>
                                <p><strong>Pesan:</strong> {{ \Illuminate\Support\Str::limit($item->pesan, 50) }}</p>
                                <p><strong>Status:</strong>
                                    @if ($item->dibaca)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Dibaca
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Belum Dibaca
                                        </span>
                                    @endif
                                </p>
                                <p><strong>Tanggal:</strong> {{ $item->created_at->format('d M Y, H:i') }}</p>
                                <form class="inline-block" action="{{ route('admin.notifikasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            Tidak ada data notifikasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $notifikasi->links() }}
        </div>
    </div>
</div>
@endsection
