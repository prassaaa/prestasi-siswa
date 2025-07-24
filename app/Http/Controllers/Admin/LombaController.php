<?php

namespace App\Http\Controllers\Admin;

use App\Events\LombaCreated;
use App\Http\Controllers\Controller;
use App\Models\Lomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class LombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lomba = Lomba::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.lomba.index', compact('lomba'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lomba.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'jenis_lomba' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'tahun' => 'required|string|max:4',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        
        $lomba = Lomba::create($request->all());
        
        // Trigger event untuk kirim email notifikasi
        Event::dispatch(new LombaCreated($lomba));
        
        return redirect()->route('admin.lomba.index')
            ->with('success', 'Data lomba berhasil ditambahkan dan notifikasi telah dikirim ke siswa.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lomba = Lomba::findOrFail($id);
        return view('admin.lomba.show', compact('lomba'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lomba = Lomba::findOrFail($id);
        return view('admin.lomba.edit', compact('lomba'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lomba = Lomba::findOrFail($id);
        
        $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'jenis_lomba' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'tahun' => 'required|string|max:4',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        
        $lomba->update($request->all());
        
        return redirect()->route('admin.lomba.index')
            ->with('success', 'Data lomba berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lomba = Lomba::findOrFail($id);
        $lomba->delete();
        
        return redirect()->route('admin.lomba.index')
            ->with('success', 'Data lomba berhasil dihapus.');
    }

    /**
     * Export data lomba to PDF.
     */
    public function exportPDF()
    {
        $lomba = Lomba::all();
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.lomba.pdf', compact('lomba'));
        
        return $pdf->download('daftar-lomba.pdf');
    }
}