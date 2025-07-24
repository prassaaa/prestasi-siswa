@extends('layouts.admin')

@section('page-title', 'Detail Notifikasi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">{{ $notifikasi->judul }}</h2>
                <div class="flex items-center mt-2 space-x-4">
                    <span class="text-sm text-gray-500">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $notifikasi->created_at->format('d M Y, H:i') }}
                    </span>

                    @if($notifikasi->type)
                        @php
                            $typeClasses = [
                                'success' => 'bg-green-100 text-green-800',
                                'error' => 'bg-red-100 text-red-800',
                                'warning' => 'bg-yellow-100 text-yellow-800',
                                'info' => 'bg-blue-100 text-blue-800'
                            ];
                            $typeClass = $typeClasses[$notifikasi->type] ?? $typeClasses['info'];
                        @endphp
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $typeClass }}">
                            {{ ucfirst($notifikasi->type) }}
                        </span>
                    @endif

                    @if($notifikasi->priority && $notifikasi->priority != 'normal')
                        @php
                            $priorityClasses = [
                                'high' => 'bg-orange-100 text-orange-800',
                                'urgent' => 'bg-red-100 text-red-800',
                                'low' => 'bg-gray-100 text-gray-800'
                            ];
                            $priorityClass = $priorityClasses[$notifikasi->priority] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $priorityClass }}">
                            Priority: {{ ucfirst($notifikasi->priority) }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('admin.notifikasi.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>

                <form action="{{ route('admin.notifikasi.destroy', $notifikasi->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Informasi Pengirim (jika ada) -->
        @if($notifikasi->data && isset($notifikasi->data['from_siswa_name']))
            <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Pesan dari Siswa</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p><strong>Nama:</strong> {{ $notifikasi->data['from_siswa_name'] }}</p>
                            <p><strong>Sekolah:</strong> {{ $notifikasi->data['from_sekolah'] ?? '-' }}</p>
                            @if(isset($notifikasi->data['action_url']))
                                <p class="mt-2">
                                    <a href="{{ $notifikasi->data['action_url'] }}"
                                       class="text-blue-600 hover:text-blue-800 underline">
                                        Lihat Profil Siswa →
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Isi Pesan -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Isi Pesan</h3>
            <div class="prose max-w-none">
                <p class="text-gray-700 whitespace-pre-line">{{ $notifikasi->pesan }}</p>
            </div>
        </div>

        <!-- Action Buttons (jika ada) -->
        @if($notifikasi->data && isset($notifikasi->data['action_url']))
            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Tindakan Diperlukan</h3>
                        <div class="mt-2">
                            <a href="{{ $notifikasi->data['action_url'] }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Metadata -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-500">
                <div>
                    <strong>Penerima:</strong> {{ $notifikasi->user->name }}
                </div>
                <div>
                    <strong>Status:</strong>
                    @if($notifikasi->dibaca)
                        <span class="text-green-600">Sudah dibaca</span>
                        @if($notifikasi->read_at)
                            <br><small>{{ $notifikasi->read_at->format('d M Y, H:i') }}</small>
                        @endif
                    @else
                        <span class="text-yellow-600">Belum dibaca</span>
                    @endif
                </div>
                <div>
                    <strong>ID Notifikasi:</strong> #{{ $notifikasi->id }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
