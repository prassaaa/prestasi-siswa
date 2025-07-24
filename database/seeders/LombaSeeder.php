<?php

namespace Database\Seeders;

use App\Models\Lomba;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lomba = [
            // Lomba Nasional
            [
                'nama_lomba' => 'Olimpiade Sains Nasional (OSN)',
                'jenis_lomba' => 'Matematika',
                'tingkat' => 'Nasional',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-08-15',
                'tanggal_selesai' => '2024-08-20',
                'lokasi' => 'Jakarta',
                'deskripsi' => 'Kompetisi matematika tingkat nasional untuk siswa SMA terbaik di Indonesia'
            ],
            [
                'nama_lomba' => 'Olimpiade Sains Nasional (OSN)',
                'jenis_lomba' => 'Fisika',
                'tingkat' => 'Nasional',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-08-15',
                'tanggal_selesai' => '2024-08-20',
                'lokasi' => 'Jakarta',
                'deskripsi' => 'Kompetisi fisika tingkat nasional untuk siswa SMA terbaik di Indonesia'
            ],
            [
                'nama_lomba' => 'Kompetisi Sains Madrasah (KSM)',
                'jenis_lomba' => 'Kimia',
                'tingkat' => 'Nasional',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-09-10',
                'tanggal_selesai' => '2024-09-15',
                'lokasi' => 'Surabaya',
                'deskripsi' => 'Kompetisi kimia untuk siswa madrasah tingkat nasional'
            ],
            [
                'nama_lomba' => 'Festival Lomba Seni Siswa Nasional (FLS2N)',
                'jenis_lomba' => 'Seni Tari',
                'tingkat' => 'Nasional',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-07-20',
                'tanggal_selesai' => '2024-07-25',
                'lokasi' => 'Yogyakarta',
                'deskripsi' => 'Festival seni tari tradisional dan modern tingkat nasional'
            ],
            [
                'nama_lomba' => 'Lomba Karya Tulis Ilmiah Nasional',
                'jenis_lomba' => 'Karya Tulis',
                'tingkat' => 'Nasional',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-06-01',
                'tanggal_selesai' => '2024-06-30',
                'lokasi' => 'Bandung',
                'deskripsi' => 'Kompetisi karya tulis ilmiah untuk siswa SMA se-Indonesia'
            ],

            // Lomba Provinsi
            [
                'nama_lomba' => 'Olimpiade Sains Provinsi Jawa Timur',
                'jenis_lomba' => 'Biologi',
                'tingkat' => 'Provinsi',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-05-15',
                'tanggal_selesai' => '2024-05-17',
                'lokasi' => 'Surabaya',
                'deskripsi' => 'Seleksi olimpiade biologi tingkat Provinsi Jawa Timur'
            ],
            [
                'nama_lomba' => 'Lomba Debat Bahasa Indonesia Provinsi',
                'jenis_lomba' => 'Debat',
                'tingkat' => 'Provinsi',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-04-20',
                'tanggal_selesai' => '2024-04-22',
                'lokasi' => 'Malang',
                'deskripsi' => 'Kompetisi debat bahasa Indonesia tingkat provinsi'
            ],
            [
                'nama_lomba' => 'Festival Seni Budaya Jawa Timur',
                'jenis_lomba' => 'Seni Musik',
                'tingkat' => 'Provinsi',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-03-10',
                'tanggal_selesai' => '2024-03-12',
                'lokasi' => 'Kediri',
                'deskripsi' => 'Festival musik tradisional dan modern Jawa Timur'
            ],

            // Lomba Kabupaten/Kota
            [
                'nama_lomba' => 'Olimpiade Matematika Kota Kediri',
                'jenis_lomba' => 'Matematika',
                'tingkat' => 'Kabupaten/Kota',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-03-05',
                'tanggal_selesai' => '2024-03-06',
                'lokasi' => 'Kota Kediri',
                'deskripsi' => 'Seleksi olimpiade matematika tingkat Kota Kediri'
            ],
            [
                'nama_lomba' => 'Lomba Pidato Bahasa Inggris Kota Kediri',
                'jenis_lomba' => 'Pidato',
                'tingkat' => 'Kabupaten/Kota',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-02-15',
                'tanggal_selesai' => '2024-02-16',
                'lokasi' => 'Kota Kediri',
                'deskripsi' => 'Kompetisi pidato bahasa Inggris untuk siswa SMA Kota Kediri'
            ],
            [
                'nama_lomba' => 'Lomba Fotografi Digital Kota Kediri',
                'jenis_lomba' => 'Fotografi',
                'tingkat' => 'Kabupaten/Kota',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-01-20',
                'tanggal_selesai' => '2024-01-21',
                'lokasi' => 'Kota Kediri',
                'deskripsi' => 'Kompetisi fotografi digital dengan tema budaya lokal'
            ],

            // Lomba Sekolah
            [
                'nama_lomba' => 'Lomba Cerdas Cermat Antar Kelas',
                'jenis_lomba' => 'Cerdas Cermat',
                'tingkat' => 'Sekolah',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-01-15',
                'tanggal_selesai' => '2024-01-15',
                'lokasi' => 'SMA Negeri 1 Kediri',
                'deskripsi' => 'Kompetisi cerdas cermat antar kelas di SMA Negeri 1 Kediri'
            ],
            [
                'nama_lomba' => 'Festival Sains dan Teknologi Sekolah',
                'jenis_lomba' => 'Sains',
                'tingkat' => 'Sekolah',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-02-10',
                'tanggal_selesai' => '2024-02-11',
                'lokasi' => 'SMA Negeri 2 Kediri',
                'deskripsi' => 'Pameran dan kompetisi sains teknologi tingkat sekolah'
            ],

            // Lomba Internasional
            [
                'nama_lomba' => 'International Mathematical Olympiad (IMO)',
                'jenis_lomba' => 'Matematika',
                'tingkat' => 'Internasional',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-07-11',
                'tanggal_selesai' => '2024-07-22',
                'lokasi' => 'Bath, United Kingdom',
                'deskripsi' => 'Olimpiade matematika internasional untuk siswa terbaik dunia'
            ],
            [
                'nama_lomba' => 'International Physics Olympiad (IPhO)',
                'jenis_lomba' => 'Fisika',
                'tingkat' => 'Internasional',
                'tahun' => '2024',
                'tanggal_mulai' => '2024-07-21',
                'tanggal_selesai' => '2024-07-29',
                'lokasi' => 'Isfahan, Iran',
                'deskripsi' => 'Olimpiade fisika internasional untuk siswa SMA terbaik'
            ],

            // Lomba tahun 2023
            [
                'nama_lomba' => 'Olimpiade Sains Nasional (OSN)',
                'jenis_lomba' => 'Matematika',
                'tingkat' => 'Nasional',
                'tahun' => '2023',
                'tanggal_mulai' => '2023-08-15',
                'tanggal_selesai' => '2023-08-20',
                'lokasi' => 'Medan',
                'deskripsi' => 'Kompetisi matematika tingkat nasional tahun 2023'
            ],
            [
                'nama_lomba' => 'Lomba Robotika Nasional',
                'jenis_lomba' => 'Robotika',
                'tingkat' => 'Nasional',
                'tahun' => '2023',
                'tanggal_mulai' => '2023-10-05',
                'tanggal_selesai' => '2023-10-08',
                'lokasi' => 'Bandung',
                'deskripsi' => 'Kompetisi robotika untuk siswa SMA se-Indonesia'
            ],
            [
                'nama_lomba' => 'Lomba Desain Grafis Nasional',
                'jenis_lomba' => 'Desain Grafis',
                'tingkat' => 'Nasional',
                'tahun' => '2023',
                'tanggal_mulai' => '2023-09-15',
                'tanggal_selesai' => '2023-09-17',
                'lokasi' => 'Jakarta',
                'deskripsi' => 'Kompetisi desain grafis digital untuk siswa kreatif'
            ],

            // Lomba mendatang 2025
            [
                'nama_lomba' => 'Olimpiade Sains Nasional (OSN)',
                'jenis_lomba' => 'Kimia',
                'tingkat' => 'Nasional',
                'tahun' => '2025',
                'tanggal_mulai' => '2025-08-10',
                'tanggal_selesai' => '2025-08-15',
                'lokasi' => 'Semarang',
                'deskripsi' => 'Kompetisi kimia tingkat nasional tahun 2025'
            ],
            [
                'nama_lomba' => 'Lomba Inovasi Teknologi Pendidikan',
                'jenis_lomba' => 'Teknologi',
                'tingkat' => 'Nasional',
                'tahun' => '2025',
                'tanggal_mulai' => '2025-06-20',
                'tanggal_selesai' => '2025-06-25',
                'lokasi' => 'Yogyakarta',
                'deskripsi' => 'Kompetisi inovasi teknologi untuk pendidikan'
            ]
        ];

        foreach ($lomba as $data) {
            Lomba::create($data);
        }
    }
}
