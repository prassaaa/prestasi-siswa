<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prestasi;

class Lomba extends Model
{
    use HasFactory;

    protected $table = 'lomba';

    protected $fillable = [
        'nama_lomba',
        'jenis_lomba',
        'tingkat',
        'tahun',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'deskripsi'
    ];

    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }
}
