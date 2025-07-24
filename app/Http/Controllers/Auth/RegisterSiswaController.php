<?php

namespace App\Http\Controllers\Auth;

use App\Events\SiswaRegistered;
use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterSiswaController extends Controller
{
    public function create()
    {
        $sekolah = Sekolah::all();
        return view('auth.register-siswa', compact('sekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:20|unique:siswa',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'alamat' => 'nullable|string',
            'tingkat' => 'required|in:TK,SD,SMP,SMA',
            'sekolah_id' => 'required|exists:sekolah,id',
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
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal' => $request->tanggal,
            'alamat' => $request->alamat,
            'tingkat' => $request->tingkat,
            'sekolah_id' => $request->sekolah_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
        ]);

        event(new Registered($user));
        event(new SiswaRegistered($siswa));

        Auth::login($user);

        return redirect()->route('siswa.dashboard');
    }
}
