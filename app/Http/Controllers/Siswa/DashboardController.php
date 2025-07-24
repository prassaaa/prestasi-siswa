<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        
        $prestasiCount = Prestasi::where('siswa_id', $siswa->id)->count();
        $prestasiApproved = Prestasi::where('siswa_id', $siswa->id)
            ->where('status_verifikasi', 'approved')
            ->count();
        $prestasiPending = Prestasi::where('siswa_id', $siswa->id)
            ->where('status_verifikasi', 'pending')
            ->count();
        $lombaCount = Lomba::count();
        
        return view('siswa.dashboard', compact(
            'siswa',
            'prestasiCount',
            'prestasiApproved',
            'prestasiPending',
            'lombaCount'
        ));
    }
}