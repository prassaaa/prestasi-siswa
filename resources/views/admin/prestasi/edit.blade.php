@extends('layouts.admin')

@section('page-title', 'Edit Prestasi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold mb-4">Edit Prestasi</h2>

        <form action="{{ route('admin.prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="siswa_id" class="block text-sm font-medium text-gray-700">Siswa</label>
                <select name="siswa_id" id="siswa_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">- Pilih Siswa -</option>
                    @foreach($siswa as $item)
                        <option value="{{ $item->id }}" {{ old('siswa_id', $prestasi->siswa_id) == $item->id ? 'selected' : '' }}>{{ $item->nisn }} - {{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('siswa_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_prestasi" class="block text-sm font-medium text-gray-700">Nama Prestasi</label>
                <input type="text" name="nama_prestasi" id="nama_prestasi" value="{{ old('nama_prestasi', $prestasi->nama_prestasi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                @error('nama_prestasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jenis_prestasi" class="block text-sm font-medium text-gray-700">Jenis Prestasi</label>
                <select name="jenis_prestasi" id="jenis_prestasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">- Pilih Jenis Prestasi -</option>
                    <option value="Akademik" {{ old('jenis_prestasi', $prestasi->jenis_prestasi) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Non-Akademik" {{ old('jenis_prestasi', $prestasi->jenis_prestasi) == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                </select>
                @error('jenis_prestasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="penyelenggara" class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                <input type="text" name="penyelenggara" id="penyelenggara" value="{{ old('penyelenggara', $prestasi->penyelenggara) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('penyelenggara')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="lokasi_kegiatan" class="block text-sm font-medium text-gray-700">Lokasi Kegiatan</label>
                <input type="text" name="lokasi_kegiatan" id="lokasi_kegiatan" value="{{ old('lokasi_kegiatan', $prestasi->lokasi_kegiatan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('lokasi_kegiatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_kegiatan" class="block text-sm font-medium text-gray-700">Tanggal Kegiatan</label>
                <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $prestasi->tanggal_kegiatan ? date('Y-m-d', strtotime($prestasi->tanggal_kegiatan)) : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('tanggal_kegiatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kategori_lomba" class="block text-sm font-medium text-gray-700">Kategori Lomba</label>
                <input type="text" name="kategori_lomba" id="kategori_lomba" value="{{ old('kategori_lomba', $prestasi->kategori_lomba) }}" placeholder="Misalnya: Pidato, Matematika, Menggambar, dll" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('kategori_lomba')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="peringkat" class="block text-sm font-medium text-gray-700">Peringkat/Juara yang Diraih</label>
                <input type="text" name="peringkat" id="peringkat" value="{{ old('peringkat', $prestasi->peringkat) }}" placeholder="Misalnya: Juara 1, Medali Emas, Harapan 2, dll" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('peringkat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="lomba_id" class="block text-sm font-medium text-gray-700">Lomba Terkait (Jika Ada)</label>
                <select name="lomba_id" id="lomba_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">- Pilih Lomba (Opsional) -</option>
                    @foreach($lomba as $item)
                        <option value="{{ $item->id }}" {{ old('lomba_id', $prestasi->lomba_id) == $item->id ? 'selected' : '' }}>{{ $item->nama_lomba }} ({{ $item->tingkat }}, {{ $item->tahun }})</option>
                    @endforeach
                </select>
                @error('lomba_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tingkat" class="block text-sm font-medium text-gray-700">Tingkat</label>
                <select name="tingkat" id="tingkat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">- Pilih Tingkat -</option>
                    <option value="Sekolah" {{ old('tingkat', $prestasi->tingkat) == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                    <option value="Kecamatan" {{ old('tingkat', $prestasi->tingkat) == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                    <option value="Kabupaten/Kota" {{ old('tingkat', $prestasi->tingkat) == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                    <option value="Provinsi" {{ old('tingkat', $prestasi->tingkat) == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                    <option value="Nasional" {{ old('tingkat', $prestasi->tingkat) == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    <option value="Internasional" {{ old('tingkat', $prestasi->tingkat) == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                </select>
                @error('tingkat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jenjang_pendidikan" class="block text-sm font-medium text-gray-700">Jenjang Pendidikan</label>
                <select name="jenjang_pendidikan" id="jenjang_pendidikan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">- Pilih Jenjang Pendidikan -</option>
                    <option value="TK" {{ old('jenjang_pendidikan', $prestasi->jenjang_pendidikan) == 'TK' ? 'selected' : '' }}>TK</option>
                    <option value="SD" {{ old('jenjang_pendidikan', $prestasi->jenjang_pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ old('jenjang_pendidikan', $prestasi->jenjang_pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA" {{ old('jenjang_pendidikan', $prestasi->jenjang_pendidikan) == 'SMA' ? 'selected' : '' }}>SMA</option>
                </select>
                @error('jenjang_pendidikan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $prestasi->tahun) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                @error('tahun')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="bukti" class="block text-sm font-medium text-gray-700">Bukti Prestasi</label>
                @if($prestasi->bukti)
                    <div class="mb-2">
                        <p class="text-sm">Bukti saat ini:</p>
                        @php
                            $extension = pathinfo(storage_path('app/public/' . $prestasi->bukti), PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ asset('storage/' . $prestasi->bukti) }}" alt="Bukti Prestasi" class="mt-2 max-w-md h-auto rounded-lg border">
                        @else
                            <a href="{{ asset('storage/' . $prestasi->bukti) }}" target="_blank" class="text-blue-500 hover:text-blue-700 mt-2 inline-block">Lihat Dokumen Bukti</a>
                        @endif
                    </div>
                @endif
                <input type="file" name="bukti" id="bukti" class="mt-1 block w-full">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, atau PDF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah.</p>
                @error('bukti')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status_verifikasi" class="block text-sm font-medium text-gray-700">Status Verifikasi</label>
                <select name="status_verifikasi" id="status_verifikasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="pending" {{ old('status_verifikasi', $prestasi->status_verifikasi) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status_verifikasi', $prestasi->status_verifikasi) == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ old('status_verifikasi', $prestasi->status_verifikasi) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('status_verifikasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="catatan_verifikasi" class="block text-sm font-medium text-gray-700">Catatan Verifikasi</label>
                <textarea name="catatan_verifikasi" id="catatan_verifikasi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('catatan_verifikasi', $prestasi->catatan_verifikasi) }}</textarea>
                @error('catatan_verifikasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.prestasi.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
