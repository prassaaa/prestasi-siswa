<?php

namespace Database\Seeders;

use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user siswa (role_id = 2)
        $siswaUsers = User::where('role_id', 2)->get();

        $notifikasiData = [
            [
                'judul' => 'Selamat Datang di Sistem Prestasi Siswa',
                'pesan' => 'Selamat datang! Anda dapat mulai mendaftarkan prestasi Anda melalui sistem ini. Pastikan untuk melengkapi profil Anda terlebih dahulu.',
                'type' => 'info',
                'priority' => 'normal',
                'dibaca' => false
            ],
            [
                'judul' => 'Lomba Baru: Olimpiade Sains Nasional 2025',
                'pesan' => 'Pendaftaran Olimpiade Sains Nasional 2025 telah dibuka. Segera daftarkan diri Anda untuk mengikuti seleksi tingkat sekolah.',
                'type' => 'info',
                'priority' => 'high',
                'dibaca' => false
            ],
            [
                'judul' => 'Pengumuman Verifikasi Prestasi',
                'pesan' => 'Prestasi yang Anda daftarkan sedang dalam proses verifikasi. Mohon tunggu konfirmasi dari admin.',
                'type' => 'info',
                'priority' => 'normal',
                'dibaca' => true
            ],
            [
                'judul' => 'Tips Mengikuti Olimpiade Sains',
                'pesan' => 'Persiapkan diri dengan baik untuk mengikuti olimpiade sains. Pelajari materi dengan mendalam dan latihan soal secara rutin.',
                'type' => 'info',
                'priority' => 'low',
                'dibaca' => false
            ],
            [
                'judul' => 'Batas Waktu Pendaftaran Lomba',
                'pesan' => 'Batas waktu pendaftaran untuk beberapa lomba akan berakhir minggu depan. Pastikan Anda tidak melewatkan kesempatan ini.',
                'type' => 'warning',
                'priority' => 'high',
                'dibaca' => false
            ]
        ];

        // Buat notifikasi untuk setiap siswa
        foreach ($siswaUsers as $user) {
            foreach ($notifikasiData as $notif) {
                Notifikasi::create([
                    'user_id' => $user->id,
                    'judul' => $notif['judul'],
                    'pesan' => $notif['pesan'],
                    'type' => $notif['type'],
                    'priority' => $notif['priority'],
                    'dibaca' => $notif['dibaca']
                ]);
            }
        }

        // Notifikasi khusus untuk beberapa siswa yang berprestasi
        $specialNotifications = [
            [
                'user_id' => 2, // Ahmad Rizki Pratama
                'judul' => 'Selamat! Prestasi Anda Telah Diverifikasi',
                'pesan' => 'Prestasi "Medali Emas OSN Matematika 2024" Anda telah diverifikasi dan disetujui. Selamat atas pencapaian yang luar biasa!',
                'type' => 'success',
                'priority' => 'high',
                'dibaca' => false
            ],
            [
                'user_id' => 3, // Siti Nurhaliza
                'judul' => 'Prestasi Seni Tari Disetujui',
                'pesan' => 'Prestasi "Juara 2 Festival Seni Tari Nasional" Anda telah diverifikasi. Terima kasih telah melestarikan budaya Indonesia!',
                'type' => 'success',
                'priority' => 'normal',
                'dibaca' => false
            ],
            [
                'user_id' => 4, // Budi Santoso
                'judul' => 'Undangan Mengikuti Pelatihan Fisika',
                'pesan' => 'Berdasarkan prestasi Anda di OSN Fisika, Anda diundang untuk mengikuti pelatihan intensif fisika tingkat lanjut.',
                'type' => 'info',
                'priority' => 'high',
                'dibaca' => false
            ],
            [
                'user_id' => 12, // Dimas Prasetyo
                'judul' => 'Prestasi Menunggu Verifikasi',
                'pesan' => 'Prestasi "Peserta KSM Kimia Nasional 2024" Anda sedang dalam proses verifikasi. Mohon bersabar menunggu.',
                'type' => 'info',
                'priority' => 'normal',
                'dibaca' => false
            ],
            [
                'user_id' => 13, // Ayu Kartika
                'judul' => 'Prestasi Tidak Dapat Diverifikasi',
                'pesan' => 'Maaf, prestasi "Juara 1 Lomba Menyanyi Karaoke" tidak dapat diverifikasi karena tidak sesuai dengan kriteria prestasi akademik/resmi. Silakan daftarkan prestasi lain yang sesuai.',
                'type' => 'error',
                'priority' => 'high',
                'dibaca' => false
            ]
        ];

        foreach ($specialNotifications as $notif) {
            Notifikasi::create($notif);
        }
    }
}
