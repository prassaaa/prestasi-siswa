<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('siswa.notifikasi.index', compact('notifikasi'));
    }

    public function show(string $id)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        // Tandai sebagai dibaca
        if (!$notifikasi->dibaca) {
            $notifikasi->markAsRead();
        }

        return view('siswa.notifikasi.show', compact('notifikasi'));
    }

    public function markAllAsRead()
    {
        Notifikasi::where('user_id', Auth::id())
            ->where('dibaca', false)
            ->update([
                'dibaca' => true,
                'read_at' => now()
            ]);

        return redirect()->route('siswa.notifikasi.index')
            ->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    public function destroy(string $id)
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $notifikasi->delete();

        return redirect()->route('siswa.notifikasi.index')
            ->with('success', 'Notifikasi berhasil dihapus.');
    }

    // Untuk menampilkan jumlah notifikasi yang belum dibaca
    public function count()
    {
        $count = Notifikasi::where('user_id', Auth::id())
            ->where('dibaca', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}
