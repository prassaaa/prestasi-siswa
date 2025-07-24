<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'type',
        'priority',
        'data',
        'dibaca',
        'read_at'
    ];

    protected $casts = [
        'data' => 'array',
        'dibaca' => 'boolean',
        'read_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk notifikasi berdasarkan prioritas
    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['high', 'urgent']);
    }

    public function scopeUnread($query)
    {
        return $query->where('dibaca', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Method untuk mark as read
    public function markAsRead()
    {
        $this->update([
            'dibaca' => true,
            'read_at' => now()
        ]);
    }
}
