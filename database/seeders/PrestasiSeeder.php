<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Lomba;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data prestasi realistis yang terhubung dengan siswa dan lomba
        $prestasiData = [
            // Prestasi Ahmad Rizki Pratama (siswa_id: 1)
            [
                'siswa_id' => 1,
                'lomba_id' => 1, // OSN Matematika Nasional 2024
                'nama_prestasi' => 'Medali Emas OSN Matematika 2024',
                'jenis_prestasi' => 'Akademik',
                'penyelenggara' => 'Kementerian Pendidikan dan Kebudayaan',
                'lokasi_kegiatan' => 'Jakarta',
                'tanggal_kegiatan' => '2024-08-18',
                'kategori_lomba' => 'Matematika',
                'peringkat' => 'Juara 1',
                'tingkat' => 'Nasional',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_osn_matematika_2024.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Prestasi sangat membanggakan, dokumentasi lengkap'
            ],
            [
                'siswa_id' => 1,
                'lomba_id' => 9, // Olimpiade Matematika Kota Kediri
                'nama_prestasi' => 'Juara 1 Olimpiade Matematika Kota Kediri',
                'jenis_prestasi' => 'Akademik',
                'penyelenggara' => 'Dinas Pendidikan Kota Kediri',
                'lokasi_kegiatan' => 'Kota Kediri',
                'tanggal_kegiatan' => '2024-03-06',
                'kategori_lomba' => 'Matematika',
                'peringkat' => 'Juara 1',
                'tingkat' => 'Kabupaten/Kota',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_olimpiade_matematika_kediri.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Prestasi yang konsisten di bidang matematika'
            ],

            // Prestasi Siti Nurhaliza (siswa_id: 2)
            [
                'siswa_id' => 2,
                'lomba_id' => 4, // FLS2N Seni Tari
                'nama_prestasi' => 'Juara 2 Festival Seni Tari Nasional',
                'jenis_prestasi' => 'Seni',
                'penyelenggara' => 'Kementerian Pendidikan dan Kebudayaan',
                'lokasi_kegiatan' => 'Yogyakarta',
                'tanggal_kegiatan' => '2024-07-23',
                'kategori_lomba' => 'Seni Tari',
                'peringkat' => 'Juara 2',
                'tingkat' => 'Nasional',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_fls2n_tari_2024.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Penampilan tari tradisional yang memukau'
            ],
            [
                'siswa_id' => 2,
                'lomba_id' => 8, // Festival Seni Budaya Jawa Timur
                'nama_prestasi' => 'Juara 1 Tari Tradisional Jawa Timur',
                'jenis_prestasi' => 'Seni',
                'penyelenggara' => 'Dinas Kebudayaan Provinsi Jawa Timur',
                'lokasi_kegiatan' => 'Kediri',
                'tanggal_kegiatan' => '2024-03-11',
                'kategori_lomba' => 'Seni Musik',
                'peringkat' => 'Juara 1',
                'tingkat' => 'Provinsi',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_tari_jatim_2024.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Melestarikan budaya daerah dengan baik'
            ],

            // Prestasi Budi Santoso (siswa_id: 3)
            [
                'siswa_id' => 3,
                'lomba_id' => 2, // OSN Fisika Nasional 2024
                'nama_prestasi' => 'Medali Perunggu OSN Fisika 2024',
                'jenis_prestasi' => 'Akademik',
                'penyelenggara' => 'Kementerian Pendidikan dan Kebudayaan',
                'lokasi_kegiatan' => 'Jakarta',
                'tanggal_kegiatan' => '2024-08-19',
                'kategori_lomba' => 'Fisika',
                'peringkat' => 'Juara 3',
                'tingkat' => 'Nasional',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_osn_fisika_2024.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Pemahaman konsep fisika yang sangat baik'
            ],

            // Prestasi Dewi Lestari (siswa_id: 4)
            [
                'siswa_id' => 4,
                'lomba_id' => 5, // Lomba Karya Tulis Ilmiah Nasional
                'nama_prestasi' => 'Juara Harapan 1 Karya Tulis Ilmiah Nasional',
                'jenis_prestasi' => 'Akademik',
                'penyelenggara' => 'Kementerian Riset dan Teknologi',
                'lokasi_kegiatan' => 'Bandung',
                'tanggal_kegiatan' => '2024-06-25',
                'kategori_lomba' => 'Karya Tulis',
                'peringkat' => 'Juara Harapan 1',
                'tingkat' => 'Nasional',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_kti_nasional_2024.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Karya tulis dengan metodologi penelitian yang baik'
            ],
            [
                'siswa_id' => 4,
                'lomba_id' => 7, // Lomba Debat Bahasa Indonesia Provinsi
                'nama_prestasi' => 'Juara 2 Debat Bahasa Indonesia Provinsi',
                'jenis_prestasi' => 'Bahasa',
                'penyelenggara' => 'Dinas Pendidikan Provinsi Jawa Timur',
                'lokasi_kegiatan' => 'Malang',
                'tanggal_kegiatan' => '2024-04-21',
                'kategori_lomba' => 'Debat',
                'peringkat' => 'Juara 2',
                'tingkat' => 'Provinsi',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_debat_provinsi_2024.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Kemampuan berargumentasi yang sangat baik'
            ],

            // Prestasi Andi Wijaya (siswa_id: 5)
            [
                'siswa_id' => 5,
                'lomba_id' => 6, // Olimpiade Sains Provinsi Biologi
                'nama_prestasi' => 'Juara 1 Olimpiade Biologi Provinsi Jawa Timur',
                'jenis_prestasi' => 'Akademik',
                'penyelenggara' => 'Dinas Pendidikan Provinsi Jawa Timur',
                'lokasi_kegiatan' => 'Surabaya',
                'tanggal_kegiatan' => '2024-05-16',
                'kategori_lomba' => 'Biologi',
                'peringkat' => 'Juara 1',
                'tingkat' => 'Provinsi',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_biologi_provinsi_2024.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Penguasaan materi biologi yang komprehensif'
            ],

            // Prestasi Maya Sari (siswa_id: 6)
            [
                'siswa_id' => 6,
                'lomba_id' => 10, // Lomba Pidato Bahasa Inggris Kota Kediri
                'nama_prestasi' => 'Juara 1 Pidato Bahasa Inggris Kota Kediri',
                'jenis_prestasi' => 'Bahasa',
                'penyelenggara' => 'Dinas Pendidikan Kota Kediri',
                'lokasi_kegiatan' => 'Kota Kediri',
                'tanggal_kegiatan' => '2024-02-16',
                'kategori_lomba' => 'Pidato',
                'peringkat' => 'Juara 1',
                'tingkat' => 'Kabupaten/Kota',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_pidato_english_kediri.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Pronunciation dan fluency yang sangat baik'
            ],
            [
                'siswa_id' => 6,
                'lomba_id' => 11, // Lomba Fotografi Digital Kota Kediri
                'nama_prestasi' => 'Juara 3 Fotografi Digital Kota Kediri',
                'jenis_prestasi' => 'Seni',
                'penyelenggara' => 'Dinas Pariwisata Kota Kediri',
                'lokasi_kegiatan' => 'Kota Kediri',
                'tanggal_kegiatan' => '2024-01-21',
                'kategori_lomba' => 'Fotografi',
                'peringkat' => 'Juara 3',
                'tingkat' => 'Kabupaten/Kota',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_fotografi_kediri_2024.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Komposisi foto yang artistik dan bermakna'
            ],

            // Prestasi Reza Firmansyah (siswa_id: 7)
            [
                'siswa_id' => 7,
                'lomba_id' => 12, // Lomba Cerdas Cermat Antar Kelas
                'nama_prestasi' => 'Juara 1 Cerdas Cermat Antar Kelas',
                'jenis_prestasi' => 'Akademik',
                'penyelenggara' => 'SMA Negeri 4 Kota Kediri',
                'lokasi_kegiatan' => 'SMA Negeri 4 Kediri',
                'tanggal_kegiatan' => '2024-01-15',
                'kategori_lomba' => 'Cerdas Cermat',
                'peringkat' => 'Juara 1',
                'tingkat' => 'Sekolah',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_cerdas_cermat_sman4.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Pengetahuan umum yang luas'
            ],

            // Prestasi Indah Permata (siswa_id: 8)
            [
                'siswa_id' => 8,
                'lomba_id' => 13, // Festival Sains dan Teknologi Sekolah
                'nama_prestasi' => 'Juara 2 Festival Sains dan Teknologi',
                'jenis_prestasi' => 'Sains',
                'penyelenggara' => 'SMA Negeri 2 Kota Kediri',
                'lokasi_kegiatan' => 'SMA Negeri 2 Kediri',
                'tanggal_kegiatan' => '2024-02-11',
                'kategori_lomba' => 'Sains',
                'peringkat' => 'Juara 2',
                'tingkat' => 'Sekolah',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_sains_teknologi_sman2.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Inovasi teknologi yang kreatif'
            ],

            // Prestasi Fajar Nugroho (siswa_id: 9)
            [
                'siswa_id' => 9,
                'lomba_id' => 17, // OSN Matematika 2023
                'nama_prestasi' => 'Medali Perak OSN Matematika 2023',
                'jenis_prestasi' => 'Akademik',
                'penyelenggara' => 'Kementerian Pendidikan dan Kebudayaan',
                'lokasi_kegiatan' => 'Medan',
                'tanggal_kegiatan' => '2023-08-17',
                'kategori_lomba' => 'Matematika',
                'peringkat' => 'Juara 2',
                'tingkat' => 'Nasional',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2023',
                'bukti' => 'prestasi/sertifikat_osn_matematika_2023.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Prestasi konsisten di bidang matematika'
            ],

            // Prestasi Rina Wulandari (siswa_id: 10)
            [
                'siswa_id' => 10,
                'lomba_id' => 18, // Lomba Robotika Nasional 2023
                'nama_prestasi' => 'Juara 3 Robotika Nasional 2023',
                'jenis_prestasi' => 'Teknologi',
                'penyelenggara' => 'Kementerian Riset dan Teknologi',
                'lokasi_kegiatan' => 'Bandung',
                'tanggal_kegiatan' => '2023-10-07',
                'kategori_lomba' => 'Robotika',
                'peringkat' => 'Juara 3',
                'tingkat' => 'Nasional',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2023',
                'bukti' => 'prestasi/sertifikat_robotika_nasional_2023.pdf',
                'status_verifikasi' => 'approved',
                'catatan_verifikasi' => 'Inovasi robot yang fungsional dan kreatif'
            ],

            // Prestasi yang masih pending
            [
                'siswa_id' => 11, // Dimas Prasetyo
                'lomba_id' => 3, // KSM Kimia
                'nama_prestasi' => 'Peserta KSM Kimia Nasional 2024',
                'jenis_prestasi' => 'Akademik',
                'penyelenggara' => 'Kementerian Agama',
                'lokasi_kegiatan' => 'Surabaya',
                'tanggal_kegiatan' => '2024-09-12',
                'kategori_lomba' => 'Kimia',
                'peringkat' => 'Peserta',
                'tingkat' => 'Nasional',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/sertifikat_ksm_kimia_2024.pdf',
                'status_verifikasi' => 'pending',
                'catatan_verifikasi' => null
            ],

            // Prestasi yang ditolak
            [
                'siswa_id' => 12, // Ayu Kartika
                'lomba_id' => null,
                'nama_prestasi' => 'Juara 1 Lomba Menyanyi Karaoke',
                'jenis_prestasi' => 'Hiburan',
                'penyelenggara' => 'Mall Kediri',
                'lokasi_kegiatan' => 'Mall Kediri',
                'tanggal_kegiatan' => '2024-01-20',
                'kategori_lomba' => 'Menyanyi',
                'peringkat' => 'Juara 1',
                'tingkat' => 'Sekolah',
                'jenjang_pendidikan' => 'SMA',
                'tahun' => '2024',
                'bukti' => 'prestasi/foto_karaoke.jpg',
                'status_verifikasi' => 'rejected',
                'catatan_verifikasi' => 'Lomba tidak sesuai dengan kriteria prestasi akademik/resmi'
            ]
        ];

        foreach ($prestasiData as $data) {
            Prestasi::create($data);
        }
    }
}
