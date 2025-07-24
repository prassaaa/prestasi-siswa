<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use App\Models\Notifikasi;
use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $tingkat = $request->query('tingkat');
        $jenjang_pendidikan = $request->query('jenjang_pendidikan');

        $query = Prestasi::with(['siswa.sekolah', 'lomba'])
            ->orderBy('created_at', 'desc');

        // Filter by status if status parameter is provided
        if ($status && in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status_verifikasi', $status);
        }

        // Filter by tingkat if tingkat parameter is provided
        if ($tingkat && in_array($tingkat, ['Sekolah', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'])) {
            $query->where('tingkat', $tingkat);
        }

        // Filter by jenjang pendidikan if jenjang_pendidikan parameter is provided
        if ($jenjang_pendidikan && in_array($jenjang_pendidikan, ['TK', 'SD', 'SMP', 'SMA'])) {
            $query->where('jenjang_pendidikan', $jenjang_pendidikan);
        }

        $prestasi = $query->paginate(10)->withQueryString();

        return view('admin.prestasi.index', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        $lomba = Lomba::all();
        return view('admin.prestasi.create', compact('siswa', 'lomba'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'lomba_id' => 'nullable|exists:lomba,id',
            'nama_prestasi' => 'required|string|max:255',
            'jenis_prestasi' => 'required|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'lokasi_kegiatan' => 'nullable|string|max:255',
            'tanggal_kegiatan' => 'nullable|date',
            'kategori_lomba' => 'nullable|string|max:255',
            'peringkat' => 'nullable|string|max:255',
            'tingkat' => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|in:TK,SD,SMP,SMA',
            'tahun' => 'required|string|max:4',
            'bukti' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        $data = $request->except('bukti');

        // Handle file upload
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_prestasi', 'public');
            $data['bukti'] = $buktiPath;
        }

        $prestasi = Prestasi::create($data);

        // Buat notifikasi untuk siswa
        $siswa = Siswa::findOrFail($request->siswa_id);
        Notifikasi::create([
            'user_id' => $siswa->user_id,
            'judul' => 'Prestasi Baru Ditambahkan',
            'pesan' => 'Admin telah menambahkan prestasi baru: ' . $request->nama_prestasi,
            'dibaca' => false,
        ]);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prestasi = Prestasi::with(['siswa.sekolah', 'lomba'])->findOrFail($id);
        return view('admin.prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prestasi = Prestasi::findOrFail($id);
        $siswa = Siswa::all();
        $lomba = Lomba::all();
        return view('admin.prestasi.edit', compact('prestasi', 'siswa', 'lomba'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'lomba_id' => 'nullable|exists:lomba,id',
            'nama_prestasi' => 'required|string|max:255',
            'jenis_prestasi' => 'required|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'lokasi_kegiatan' => 'nullable|string|max:255',
            'tanggal_kegiatan' => 'nullable|date',
            'kategori_lomba' => 'nullable|string|max:255',
            'peringkat' => 'nullable|string|max:255',
            'tingkat' => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|in:TK,SD,SMP,SMA',
            'tahun' => 'required|string|max:4',
            'bukti' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        $data = $request->except('bukti');

        // Handle file upload
        if ($request->hasFile('bukti')) {
            // Hapus file lama jika ada
            if ($prestasi->bukti) {
                Storage::disk('public')->delete($prestasi->bukti);
            }

            $buktiPath = $request->file('bukti')->store('bukti_prestasi', 'public');
            $data['bukti'] = $buktiPath;
        }

        $oldStatus = $prestasi->status_verifikasi;
        $prestasi->update($data);

        // Jika status verifikasi berubah, kirim notifikasi
        if ($oldStatus != $request->status_verifikasi) {
            $statusText = [
                'pending' => 'menunggu verifikasi',
                'approved' => 'disetujui',
                'rejected' => 'ditolak',
            ];

            Notifikasi::create([
                'user_id' => $prestasi->siswa->user_id,
                'judul' => 'Status Prestasi Diperbarui',
                'pesan' => 'Status prestasi "' . $prestasi->nama_prestasi . '" telah ' . $statusText[$request->status_verifikasi] . '.',
                'dibaca' => false,
            ]);
        }

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        // Hapus file bukti jika ada
        if ($prestasi->bukti) {
            Storage::disk('public')->delete($prestasi->bukti);
        }

        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil dihapus.');
    }

    /**
     * Verifikasi prestasi
     */
    public function verify(Request $request, string $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'status_verifikasi' => 'required|in:approved,rejected',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        $prestasi->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_verifikasi' => $request->catatan_verifikasi,
        ]);

        // Kirim notifikasi ke siswa
        $statusText = $request->status_verifikasi == 'approved' ? 'disetujui' : 'ditolak';

        Notifikasi::create([
            'user_id' => $prestasi->siswa->user_id,
            'judul' => 'Prestasi ' . ucfirst($statusText),
            'pesan' => 'Prestasi "' . $prestasi->nama_prestasi . '" telah ' . $statusText .
                     ($request->catatan_verifikasi ? '. Catatan: ' . $request->catatan_verifikasi : '.'),
            'dibaca' => false,
        ]);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil ' . $statusText . '.');
    }
}
