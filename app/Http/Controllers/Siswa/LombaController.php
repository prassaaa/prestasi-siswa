<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function index(Request $request)
    {
        $query = Lomba::query();

        // Filter berdasarkan search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lomba', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan jenis lomba
        if ($request->filled('jenis_lomba')) {
            $query->where('jenis_lomba', $request->jenis_lomba);
        }

        // Filter berdasarkan tingkat
        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // Filter berdasarkan status (aktif/tidak aktif berdasarkan tanggal)
        if ($request->filled('status')) {
            $today = now()->format('Y-m-d');
            if ($request->status === 'aktif') {
                $query->where(function($q) use ($today) {
                    $q->where('tanggal_selesai', '>=', $today)
                      ->orWhereNull('tanggal_selesai');
                });
            } elseif ($request->status === 'selesai') {
                $query->where('tanggal_selesai', '<', $today);
            }
        }

        $lomba = $query->orderBy('created_at', 'desc')->paginate(12);

        // Data untuk filter dropdown
        $jenisLomba = Lomba::distinct()->pluck('jenis_lomba')->filter()->sort();
        $tingkatLomba = Lomba::distinct()->pluck('tingkat')->filter()->sort();
        $tahunLomba = Lomba::distinct()->pluck('tahun')->filter()->sortDesc();

        return view('siswa.lomba.index', compact('lomba', 'jenisLomba', 'tingkatLomba', 'tahunLomba'));
    }

    public function show(string $id)
    {
        $lomba = Lomba::findOrFail($id);
        return view('siswa.lomba.show', compact('lomba'));
    }
}
