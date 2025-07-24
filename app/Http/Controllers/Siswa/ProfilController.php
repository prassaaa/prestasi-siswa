<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        return view('siswa.profil.index', compact('siswa'));
    }
    
    public function edit()
    {
        $siswa = Auth::user()->siswa;
        $sekolah = Sekolah::all();
        $tingkatOptions = ['TK', 'SD', 'SMP', 'SMA']; // Opsi tingkat untuk dropdown
        return view('siswa.profil.edit', compact('siswa', 'sekolah', 'tingkatOptions'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        $siswa = $user->siswa;
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'tingkat' => 'required|in:TK,SD,SMP,SMA',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'alamat' => 'nullable|string',
            'sekolah_id' => 'required|exists:sekolah,id',
            'no_hp' => 'nullable|string|max:15',
        ]);
        
        // Update user dengan DB Query Builder
        DB::table('users')->where('id', $user->id)->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);
        
        // Update siswa dengan DB Query Builder
        DB::table('siswa')->where('id', $siswa->id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'tingkat' => $request->tingkat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal' => $request->tanggal,
            'alamat' => $request->alamat,
            'sekolah_id' => $request->sekolah_id,
            'no_hp' => $request->no_hp,
        ]);
        
        return redirect()->route('siswa.profil.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
    
    public function changePassword()
    {
        return view('siswa.profil.change-password');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        $siswa = $user->siswa;
        
        // Cek password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }
        
        // Update password user dengan DB Query Builder
        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->password),
        ]);
        
        // Update password di tabel siswa dengan DB Query Builder
        DB::table('siswa')->where('id', $siswa->id)->update([
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('siswa.profil.index')
            ->with('success', 'Password berhasil diperbarui.');
    }
}