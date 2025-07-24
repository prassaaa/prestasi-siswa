<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sekolah = [
            [
                'nama_sekolah' => 'SMA Negeri 1 Kota Kediri',
                'alamat' => 'Jl. Veteran No. 1, Kota Kediri',
            ],
            [
                'nama_sekolah' => 'SMA Negeri 2 Kota Kediri',
                'alamat' => 'Jl. Mayjend Sungkono No. 2, Kota Kediri',
            ],
            [
                'nama_sekolah' => 'SMA Negeri 3 Kota Kediri',
                'alamat' => 'Jl. PK Bangsa No. 3, Kota Kediri',
            ],
            [
                'nama_sekolah' => 'SMA Negeri 4 Kota Kediri',
                'alamat' => 'Jl. KH. Agus Salim No. 4, Kota Kediri',
            ],
            [
                'nama_sekolah' => 'SMA Negeri 5 Kota Kediri',
                'alamat' => 'Jl. Joyoboyo No. 5, Kota Kediri',
            ],
            [
                'nama_sekolah' => 'SMA Negeri 6 Kota Kediri',
                'alamat' => 'Jl. Diponegoro No. 6, Kota Kediri',
            ],
            [
                'nama_sekolah' => 'SMA Negeri 7 Kota Kediri',
                'alamat' => 'Jl. Jaksa Agung Suprapto No. 7, Kota Kediri',
            ],
            [
                'nama_sekolah' => 'SMA Negeri 8 Kota Kediri',
                'alamat' => 'Jl. Pahlawan Kusuma Bangsa No. 8, Kota Kediri',
            ],
        ];

        foreach ($sekolah as $data) {
            Sekolah::create($data);
        }
    }
}
