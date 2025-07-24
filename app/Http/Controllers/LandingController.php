<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil data lomba terbaru (6 data)
        $lomba = Lomba::orderBy('created_at', 'desc')->take(6)->get();

        // Ambil data prestasi yang disetujui (6 data)
        $prestasi = Prestasi::with(['siswa', 'siswa.sekolah'])
            ->where('status_verifikasi', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Hitung statistik
        $siswaCount = Siswa::count();
        $prestasiCount = Prestasi::where('status_verifikasi', 'approved')->count();
        $lombaCount = Lomba::count();
        $sekolahCount = Sekolah::count();

        // Data untuk grafik prestasi
        // Prestasi berdasarkan jenis
        $prestasiByJenis = Prestasi::select('jenis_prestasi', DB::raw('count(*) as total'))
            ->where('status_verifikasi', 'approved')
            ->groupBy('jenis_prestasi')
            ->pluck('total', 'jenis_prestasi')
            ->toArray();

        // Prestasi berdasarkan tingkat
        $prestasiByTingkat = Prestasi::select('tingkat', DB::raw('count(*) as total'))
            ->where('status_verifikasi', 'approved')
            ->groupBy('tingkat')
            ->get();

        // Prestasi berdasarkan tahun
        $prestasiByTahun = Prestasi::select('tahun', DB::raw('count(*) as total'))
            ->where('status_verifikasi', 'approved')
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        // Prestasi berdasarkan jenjang pendidikan
        $prestasiByJenjang = Prestasi::select('jenjang_pendidikan', DB::raw('count(*) as total'))
            ->where('status_verifikasi', 'approved')
            ->whereNotNull('jenjang_pendidikan')
            ->groupBy('jenjang_pendidikan')
            ->pluck('total', 'jenjang_pendidikan')
            ->toArray();

        return view('landing', compact(
            'lomba',
            'prestasi',
            'siswaCount',
            'prestasiCount',
            'lombaCount',
            'sekolahCount',
            'prestasiByJenis',
            'prestasiByTingkat',
            'prestasiByTahun',
            'prestasiByJenjang'
        ));
    }

    public function showAllLomba(Request $request)
    {
        $query = Lomba::query();

        // Filter berdasarkan pencarian
        if ($request->has('query')) {
            $searchQuery = $request->query('query');
            $query->where(function($q) use ($searchQuery) {
                $q->where('nama_lomba', 'like', "%{$searchQuery}%")
                  ->orWhere('jenis_lomba', 'like', "%{$searchQuery}%")
                  ->orWhere('tingkat', 'like', "%{$searchQuery}%")
                  ->orWhere('tahun', 'like', "%{$searchQuery}%")
                  ->orWhere('lokasi', 'like', "%{$searchQuery}%")
                  ->orWhere('deskripsi', 'like', "%{$searchQuery}%");
            });
        }

        $lomba = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('lomba.index', compact('lomba'));
    }

    public function showAllPrestasi(Request $request)
    {
        $query = Prestasi::with(['siswa', 'siswa.sekolah', 'lomba'])
            ->where('status_verifikasi', 'approved');

        // Filter berdasarkan pencarian
        if ($request->has('query')) {
            $searchQuery = $request->query('query');
            $query->where(function($q) use ($searchQuery) {
                $q->where('nama_prestasi', 'like', "%{$searchQuery}%")
                  ->orWhere('jenis_prestasi', 'like', "%{$searchQuery}%")
                  ->orWhere('tingkat', 'like', "%{$searchQuery}%")
                  ->orWhere('tahun', 'like', "%{$searchQuery}%")
                  ->orWhereHas('siswa', function($sq) use ($searchQuery) {
                      $sq->where('nama', 'like', "%{$searchQuery}%");
                  })
                  ->orWhereHas('siswa.sekolah', function($sq) use ($searchQuery) {
                      $sq->where('nama_sekolah', 'like', "%{$searchQuery}%");
                  })
                  ->orWhereHas('lomba', function($sq) use ($searchQuery) {
                      $sq->where('nama_lomba', 'like', "%{$searchQuery}%");
                  });
            });
        }

        $prestasi = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('prestasi.index', compact('prestasi'));
    }

    // API untuk mendapatkan detail lomba
    public function getLombaDetail($id)
    {
        $lomba = Lomba::findOrFail($id);
        return response()->json($lomba);
    }

    // API untuk mendapatkan detail prestasi
    public function getPrestasiDetail($id)
    {
        $prestasi = Prestasi::with(['siswa', 'siswa.sekolah', 'lomba'])
            ->findOrFail($id);
        return response()->json($prestasi);
    }
}
