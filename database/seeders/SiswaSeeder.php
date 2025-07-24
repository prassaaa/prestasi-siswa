<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Sekolah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Data siswa realistis
        $siswaData = [
            [
                'nama' => 'Ahmad Rizki Pratama',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2006-03-15',
                'alamat' => 'Jl. Mawar No. 12, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567890',
                'sekolah_id' => 1, // SMA Negeri 1 Kota Kediri
                'email' => 'ahmad.rizki@student.com'
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2006-07-22',
                'alamat' => 'Jl. Melati No. 8, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567891',
                'sekolah_id' => 1,
                'email' => 'siti.nurhaliza@student.com'
            ],
            [
                'nama' => 'Budi Santoso',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2006-01-10',
                'alamat' => 'Jl. Anggrek No. 5, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567892',
                'sekolah_id' => 2, // SMA Negeri 2 Kota Kediri
                'email' => 'budi.santoso@student.com'
            ],
            [
                'nama' => 'Dewi Lestari',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2006-11-05',
                'alamat' => 'Jl. Kenanga No. 15, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567893',
                'sekolah_id' => 2,
                'email' => 'dewi.lestari@student.com'
            ],
            [
                'nama' => 'Andi Wijaya',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2007-04-18',
                'alamat' => 'Jl. Dahlia No. 20, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567894',
                'sekolah_id' => 3, // SMA Negeri 3 Kota Kediri
                'email' => 'andi.wijaya@student.com'
            ],
            [
                'nama' => 'Maya Sari',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2007-09-12',
                'alamat' => 'Jl. Tulip No. 7, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567895',
                'sekolah_id' => 3,
                'email' => 'maya.sari@student.com'
            ],
            [
                'nama' => 'Reza Firmansyah',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2008-02-28',
                'alamat' => 'Jl. Sakura No. 3, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567896',
                'sekolah_id' => 4, // SMA Negeri 4 Kota Kediri
                'email' => 'reza.firmansyah@student.com'
            ],
            [
                'nama' => 'Indah Permata',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2008-06-14',
                'alamat' => 'Jl. Cempaka No. 11, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567897',
                'sekolah_id' => 4,
                'email' => 'indah.permata@student.com'
            ],
            [
                'nama' => 'Fajar Nugroho',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2006-12-03',
                'alamat' => 'Jl. Flamboyan No. 9, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567898',
                'sekolah_id' => 5, // SMA Negeri 5 Kota Kediri
                'email' => 'fajar.nugroho@student.com'
            ],
            [
                'nama' => 'Rina Wulandari',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2006-08-25',
                'alamat' => 'Jl. Bougenville No. 16, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567899',
                'sekolah_id' => 5,
                'email' => 'rina.wulandari@student.com'
            ],
            [
                'nama' => 'Dimas Prasetyo',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2007-01-17',
                'alamat' => 'Jl. Kamboja No. 4, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567800',
                'sekolah_id' => 6, // SMA Negeri 6 Kota Kediri
                'email' => 'dimas.prasetyo@student.com'
            ],
            [
                'nama' => 'Ayu Kartika',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2007-05-30',
                'alamat' => 'Jl. Teratai No. 13, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567801',
                'sekolah_id' => 6,
                'email' => 'ayu.kartika@student.com'
            ],
            [
                'nama' => 'Bayu Setiawan',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2008-10-08',
                'alamat' => 'Jl. Seroja No. 6, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567802',
                'sekolah_id' => 7, // SMA Negeri 7 Kota Kediri
                'email' => 'bayu.setiawan@student.com'
            ],
            [
                'nama' => 'Citra Dewi',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2008-03-21',
                'alamat' => 'Jl. Lily No. 18, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567803',
                'sekolah_id' => 7,
                'email' => 'citra.dewi@student.com'
            ],
            [
                'nama' => 'Eko Prasetyo',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2006-09-16',
                'alamat' => 'Jl. Lavender No. 10, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567804',
                'sekolah_id' => 8, // SMA Negeri 8 Kota Kediri
                'email' => 'eko.prasetyo@student.com'
            ],
            [
                'nama' => 'Fitri Handayani',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2006-04-07',
                'alamat' => 'Jl. Gardenia No. 14, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567805',
                'sekolah_id' => 8,
                'email' => 'fitri.handayani@student.com'
            ],
            [
                'nama' => 'Galih Pratama',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2007-11-23',
                'alamat' => 'Jl. Jasmine No. 2, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567806',
                'sekolah_id' => 1,
                'email' => 'galih.pratama@student.com'
            ],
            [
                'nama' => 'Hana Safitri',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2007-08-11',
                'alamat' => 'Jl. Violet No. 19, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567807',
                'sekolah_id' => 2,
                'email' => 'hana.safitri@student.com'
            ],
            [
                'nama' => 'Ivan Kurniawan',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2008-12-04',
                'alamat' => 'Jl. Azalea No. 1, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567808',
                'sekolah_id' => 3,
                'email' => 'ivan.kurniawan@student.com'
            ],
            [
                'nama' => 'Julia Ramadhani',
                'tempat_lahir' => 'Kediri',
                'tanggal' => '2008-07-19',
                'alamat' => 'Jl. Peony No. 17, Kediri',
                'tingkat' => 'SMA',
                'no_hp' => '081234567809',
                'sekolah_id' => 4,
                'email' => 'julia.ramadhani@student.com'
            ]
        ];

        foreach ($siswaData as $data) {
            // Buat user terlebih dahulu
            $user = User::create([
                'name' => $data['nama'],
                'email' => $data['email'],
                'password' => Hash::make('password123'),
                'role_id' => 2, // Role siswa
                'is_active' => true
            ]);

            // Generate NISN yang unik
            $nisn = '00' . str_pad($user->id, 8, '0', STR_PAD_LEFT);

            // Buat data siswa
            Siswa::create([
                'user_id' => $user->id,
                'nisn' => $nisn,
                'nama' => $data['nama'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal' => $data['tanggal'],
                'alamat' => $data['alamat'],
                'sekolah_id' => $data['sekolah_id'],
                'tingkat' => $data['tingkat'],
                'email' => $data['email'],
                'password' => Hash::make('password123'),
                'no_hp' => $data['no_hp']
            ]);
        }
    }
}
