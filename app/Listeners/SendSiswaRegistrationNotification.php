<?php

namespace App\Listeners;

use App\Events\SiswaRegistered;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSiswaRegistrationNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SiswaRegistered $event): void
    {
        $siswa = $event->siswa;
        
        // Kirim notifikasi ke semua admin
        $admins = User::where('role_id', 1)->get();
        
        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'judul' => 'Siswa Baru Terdaftar',
                'pesan' => 'Siswa baru "' . $siswa->nama . '" dari ' . $siswa->sekolah->nama_sekolah . ' telah mendaftar dan memerlukan verifikasi.',
                'type' => 'info',
                'priority' => 'normal',
                'data' => [
                    'siswa_id' => $siswa->id,
                    'action_url' => route('admin.siswa.show', $siswa->id)
                ],
                'dibaca' => false,
            ]);
        }
    }
}
