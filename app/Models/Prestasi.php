<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'siswa_id',
        'lomba_id',
        'nama_prestasi',
        'jenis_prestasi',
        'penyelenggara',
        'lokasi_kegiatan',
        'tanggal_kegiatan',
        'kategori_lomba',
        'peringkat',
        'tingkat',
        'jenjang_pendidikan',
        'tahun',
        'bukti',
        'status_verifikasi',
        'catatan_verifikasi',
    ];

    protected $dates = [
        'tanggal_kegiatan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }
}
