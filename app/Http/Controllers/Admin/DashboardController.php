<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $siswaCount = Siswa::count();
        $prestasiCount = Prestasi::count();
        $lombaCount = Lomba::count();
        $prestasiPending = Prestasi::where('status_verifikasi', 'pending')->count();

        // Data untuk grafik
        $prestasiAkademik = Prestasi::where('jenis_prestasi', 'Akademik')
            ->where('status_verifikasi', 'approved')
            ->count();
        $prestasiNonAkademik = Prestasi::where('jenis_prestasi', 'Non-Akademik')
            ->where('status_verifikasi', 'approved')
            ->count();

        // Data prestasi berdasarkan tingkat
        $prestasiByTingkat = Prestasi::select('tingkat', DB::raw('count(*) as total'))
            ->where('status_verifikasi', 'approved')
            ->groupBy('tingkat')
            ->get();

        // Ambil data prestasi berdasarkan jenjang pendidikan
        $prestasiByJenjangQuery = Prestasi::select('jenjang_pendidikan', DB::raw('count(*) as total'))
            ->whereNotNull('jenjang_pendidikan')
            ->groupBy('jenjang_pendidikan')
            ->get();

        // Konversi hasil query ke array asosiatif untuk memudahkan akses di view
        $prestasiByJenjang = [];
        foreach ($prestasiByJenjangQuery as $item) {
            $prestasiByJenjang[$item->jenjang_pendidikan] = $item->total;
        }

        // Ambil data prestasi berdasarkan tahun
        $prestasiByTahun = Prestasi::select('tahun', DB::raw('count(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        // Ambil data prestasi berdasarkan tahun dan jenjang pendidikan
        $prestasiByTahunJenjangQuery = Prestasi::select('tahun', 'jenjang_pendidikan', DB::raw('count(*) as total'))
            ->whereNotNull('jenjang_pendidikan')
            ->groupBy('tahun', 'jenjang_pendidikan')
            ->orderBy('tahun', 'asc')
            ->get();

        // Konversi hasil query ke array asosiatif untuk mudah diakses di view
        $prestasiByTahunJenjang = [];
        foreach ($prestasiByTahunJenjangQuery as $item) {
            if (!isset($prestasiByTahunJenjang[$item->tahun])) {
                $prestasiByTahunJenjang[$item->tahun] = [];
            }
            $prestasiByTahunJenjang[$item->tahun][$item->jenjang_pendidikan] = $item->total;
        }

        return view('admin.dashboard', compact(
            'siswaCount',
            'prestasiCount',
            'lombaCount',
            'prestasiPending',
            'prestasiAkademik',
            'prestasiNonAkademik',
            'prestasiByTingkat',
            'prestasiByJenjang',
            'prestasiByTahun',
            'prestasiByTahunJenjang'
        ));
    }
}
