<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifikasi = Notifikasi::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.notifikasi.index', compact('notifikasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role_id', 2)->get(); // Hanya siswa
        return view('admin.notifikasi.create', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notifikasi = Notifikasi::with('user')->findOrFail($id);

        // Tandai sebagai dibaca jika notifikasi untuk admin yang sedang login
        if ($notifikasi->user_id == auth()->id() && !$notifikasi->dibaca) {
            $notifikasi->markAsRead();
        }

        return view('admin.notifikasi.show', compact('notifikasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        Notifikasi::create($request->all());

        return redirect()->route('admin.notifikasi.index')
            ->with('success', 'Notifikasi berhasil dikirim.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();

        return redirect()->route('admin.notifikasi.index')
            ->with('success', 'Notifikasi berhasil dihapus.');
    }

    /**
     * Send notification to all students
     */
    public function sendToAll(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $users = User::where('role_id', 2)->get(); // Hanya siswa

        foreach ($users as $user) {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => $request->judul,
                'pesan' => $request->pesan,
                'dibaca' => false,
            ]);
        }

        return redirect()->route('admin.notifikasi.index')
            ->with('success', 'Notifikasi berhasil dikirim ke semua siswa.');
    }
}
