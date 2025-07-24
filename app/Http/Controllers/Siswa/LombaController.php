<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function index()
    {
        $lomba = Lomba::orderBy('created_at', 'desc')->paginate(10);
        return view('siswa.lomba.index', compact('lomba'));
    }
    
    public function show(string $id)
    {
        $lomba = Lomba::findOrFail($id);
        return view('siswa.lomba.show', compact('lomba'));
    }
}