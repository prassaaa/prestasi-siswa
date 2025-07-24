<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Siswa::with('sekolah');
        
        // Debugging
        Log::info('Search Term: ' . $search);
        
        // Apply search filter if search parameter exists
        if ($search) {
            $query->where('nama', 'LIKE', "%{$search}%");
        }
        
        $siswa = $query->paginate(10);
        
        if ($search) {
            $siswa->appends(['search' => $search]);
        }
        
        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sekolah = Sekolah::all();
        return view('admin.siswa.create', compact('sekolah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:20|unique:siswa',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'tingkat' => 'required|in:TK,SD,SMP,SMA',
            'sekolah_id' => 'required|exists:sekolah,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
        ]);
        
        // Buat user
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // Siswa
        ]);
        
        // Buat siswa
        $siswa = Siswa::create([
            'user_id' => $user->id,
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'tingkat' => $request->tingkat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal' => $request->tanggal,
            'alamat' => $request->alamat,
            'sekolah_id' => $request->sekolah_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
        ]);
        
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::with(['sekolah', 'prestasi'])->findOrFail($id);
        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $sekolah = Sekolah::all();
        return view('admin.siswa.edit', compact('siswa', 'sekolah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);
        
        $request->validate([
            'nisn' => 'required|string|max:20|unique:siswa,nisn,'.$siswa->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$siswa->user_id,
            'tingkat' => 'required|in:TK,SD,SMP,SMA',
            'sekolah_id' => 'required|exists:sekolah,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
        ]);
        
        // Update user
        $siswa->user->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);
        
        // Update password jika ada
        if ($request->filled('password')) {
            $siswa->user->update([
                'password' => Hash::make($request->password),
            ]);
            
            $siswa->update([
                'password' => Hash::make($request->password),
            ]);
        }
        
        // Update siswa
        $siswa->update([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'tingkat' => $request->tingkat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal' => $request->tanggal,
            'alamat' => $request->alamat,
            'sekolah_id' => $request->sekolah_id,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
        
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        
        // Hapus user (akan menghapus siswa karena relasi onDelete('cascade'))
        $siswa->user->delete();
        
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        
        // Debugging
        Log::info('Autocomplete search: ' . $search);
        
        if ($search) {
            $siswa = Siswa::where('nama', 'LIKE', "%{$search}%")
                ->select('id', 'nama')
                ->limit(10)
                ->get();
                
            return response()->json($siswa);
        }
        
        return response()->json([]);
    }
}