<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Notifikasi yang diterima siswa
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Riwayat pesan yang dikirim siswa ke admin
        $pesanDikirim = Notifikasi::where('judul', 'LIKE', '[Pesan Siswa]%')
            ->whereJsonContains('data->from_siswa_id', Auth::user()->siswa->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.notifikasi.index', compact('notifikasi', 'pesanDikirim'));
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

    /**
     * Show form to create message to admin
     */
    public function create()
    {
        return view('siswa.pesan.create');
    }

    /**
     * Send message to all admins
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string|max:1000',
        ]);

        // Kirim pesan ke semua admin
        $admins = User::where('role_id', 1)->get();
        $siswa = Auth::user()->siswa;

        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'judul' => '[Pesan Siswa] ' . $request->judul,
                'pesan' => 'Pesan dari siswa: ' . $siswa->nama . ' (' . $siswa->sekolah->nama_sekolah . ')' . "\n\n" . $request->pesan,
                'type' => 'info',
                'priority' => 'normal',
                'data' => [
                    'from_siswa_id' => $siswa->id,
                    'from_siswa_name' => $siswa->nama,
                    'from_sekolah' => $siswa->sekolah->nama_sekolah,
                    'action_url' => route('admin.siswa.show', $siswa->id)
                ],
                'dibaca' => false,
            ]);
        }

        return redirect()->route('siswa.notifikasi.index')
            ->with('success', 'Pesan berhasil dikirim ke admin.');
    }
}
