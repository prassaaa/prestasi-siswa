<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prestasi;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nisn',
        'nama',
        'tempat_lahir',
        'tanggal',
        'alamat',
        'sekolah_id',
        'tingkat',
        'email',
        'password',
        'no_hp'
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }
}
