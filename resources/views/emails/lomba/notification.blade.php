<x-mail::message>
# Pemberitahuan Lomba Baru

Halo {{ $siswa->nama }},

Kami ingin memberitahukan bahwa ada lomba baru yang telah ditambahkan:

<x-mail::panel>
**{{ $lomba->nama_lomba }}**

**Jenis Lomba:** {{ $lomba->jenis_lomba }}  
**Tingkat:** {{ $lomba->tingkat }}  
**Tahun:** {{ $lomba->tahun }}  
**Tanggal:** {{ $lomba->tanggal_mulai ? $lomba->tanggal_mulai->format('d M Y') : '-' }} sampai {{ $lomba->tanggal_selesai ? $lomba->tanggal_selesai->format('d M Y') : '-' }}  
**Lokasi:** {{ $lomba->lokasi ?? '-' }}
</x-mail::panel>

{{ $lomba->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}

<x-mail::button :url="url('/lomba/' . $lomba->id)">
Lihat Detail Lomba
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>