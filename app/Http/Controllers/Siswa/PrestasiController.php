<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $siswa = Auth::user()->siswa;
        $status = $request->query('status');
        $tingkat = $request->query('tingkat');
        $jenjang_pendidikan = $request->query('jenjang_pendidikan');

        $query = Prestasi::where('siswa_id', $siswa->id)
            ->with('lomba')
            ->orderBy('created_at', 'desc');

        // Filter by status if status parameter is provided
        if ($status && in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status_verifikasi', $status);
        }

        // Filter by tingkat if tingkat parameter is provided
        if ($tingkat) {
            $query->where('tingkat', $tingkat);
        }

        $prestasi = $query->paginate(10)->withQueryString();

        return view('siswa.prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        $lomba = Lomba::all();
        return view('siswa.prestasi.create', compact('lomba'));
    }

    public function store(Request $request)
    {
        $siswa = Auth::user()->siswa;

        $request->validate([
            'lomba_id' => 'nullable|exists:lomba,id',
            'nama_prestasi' => 'required|string|max:255',
            'jenis_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|in:TK,SD,SMP,SMA',
            'tahun' => 'required|string|max:4',
            'bukti' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'penyelenggara' => 'nullable|string|max:255',
            'lokasi_kegiatan' => 'nullable|string|max:255',
            'tanggal_kegiatan' => 'nullable|date',
            'kategori_lomba' => 'nullable|string|max:255',
            'peringkat' => 'nullable|string|max:255',
        ]);

        $data = $request->except('bukti');
        $data['siswa_id'] = $siswa->id;
        $data['status_verifikasi'] = 'pending';

        // Handle file upload
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_prestasi', 'public');
            $data['bukti'] = $buktiPath;
        }

        Prestasi::create($data);

        return redirect()->route('siswa.prestasi.index')
            ->with('success', 'Data prestasi berhasil ditambahkan dan menunggu verifikasi.');
    }

    public function show(string $id)
    {
        $siswa = Auth::user()->siswa;
        $prestasi = Prestasi::where('siswa_id', $siswa->id)
            ->where('id', $id)
            ->with('lomba')
            ->firstOrFail();

        return view('siswa.prestasi.show', compact('prestasi'));
    }

    public function edit(string $id)
    {
        $siswa = Auth::user()->siswa;
        $prestasi = Prestasi::where('siswa_id', $siswa->id)
            ->where('id', $id)
            ->firstOrFail();

        // Jika prestasi sudah diverifikasi, tidak bisa diedit
        if ($prestasi->status_verifikasi != 'pending') {
            return redirect()->route('siswa.prestasi.index')
                ->with('error', 'Prestasi yang sudah diverifikasi tidak dapat diedit.');
        }

        $lomba = Lomba::all();

        return view('siswa.prestasi.edit', compact('prestasi', 'lomba'));
    }

    public function update(Request $request, string $id)
    {
        $siswa = Auth::user()->siswa;
        $prestasi = Prestasi::where('siswa_id', $siswa->id)
            ->where('id', $id)
            ->firstOrFail();

        // Jika prestasi sudah diverifikasi, tidak bisa diedit
        if ($prestasi->status_verifikasi != 'pending') {
            return redirect()->route('siswa.prestasi.index')
                ->with('error', 'Prestasi yang sudah diverifikasi tidak dapat diedit.');
        }

        $request->validate([
            'lomba_id' => 'nullable|exists:lomba,id',
            'nama_prestasi' => 'required|string|max:255',
            'jenis_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|in:TK,SD,SMP,SMA',
            'tahun' => 'required|string|max:4',
            'bukti' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'penyelenggara' => 'nullable|string|max:255',
            'lokasi_kegiatan' => 'nullable|string|max:255',
            'tanggal_kegiatan' => 'nullable|date',
            'kategori_lomba' => 'nullable|string|max:255',
            'peringkat' => 'nullable|string|max:255',
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

        // Reset status verifikasi ke pending
        $data['status_verifikasi'] = 'pending';
        $data['catatan_verifikasi'] = null;

        $prestasi->update($data);

        return redirect()->route('siswa.prestasi.index')
            ->with('success', 'Data prestasi berhasil diperbarui dan menunggu verifikasi ulang.');
    }

    public function destroy(string $id)
    {
        $siswa = Auth::user()->siswa;
        $prestasi = Prestasi::where('siswa_id', $siswa->id)
            ->where('id', $id)
            ->firstOrFail();

        // Jika prestasi sudah diverifikasi dan disetujui, tidak bisa dihapus
        if ($prestasi->status_verifikasi == 'approved') {
            return redirect()->route('siswa.prestasi.index')
                ->with('error', 'Prestasi yang sudah disetujui tidak dapat dihapus.');
        }

        // Hapus file bukti jika ada
        if ($prestasi->bukti) {
            Storage::disk('public')->delete($prestasi->bukti);
        }

        $prestasi->delete();

        return redirect()->route('siswa.prestasi.index')
            ->with('success', 'Data prestasi berhasil dihapus.');
    }

    public function printPDF($id)
    {
        $siswa = Auth::user()->siswa;
        $prestasi = Prestasi::where('siswa_id', $siswa->id)
            ->where('id', $id)
            ->where('status_verifikasi', 'approved')
            ->with(['lomba', 'siswa', 'siswa.sekolah'])
            ->firstOrFail();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('siswa.prestasi.pdf', compact('prestasi'));

        return $pdf->download('prestasi-' . $prestasi->id . '.pdf');
    }
}
