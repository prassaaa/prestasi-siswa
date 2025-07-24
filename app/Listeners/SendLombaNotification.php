<?php

namespace App\Listeners;

use App\Events\LombaCreated;
use App\Mail\LombaNotificationMail;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log; // Tambahkan import Log
use Illuminate\Support\Facades\Mail;

class SendLombaNotification implements ShouldQueue
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
    public function handle(LombaCreated $event): void
    {
        $lomba = $event->lomba;
        
        // Ambil semua siswa yang terverifikasi (dengan user aktif)
        $siswa = Siswa::whereHas('user', function($query) {
            $query->where('is_active', true);
        })->get();
        
        // Kirim email ke setiap siswa
        foreach($siswa as $s) {
            // Perbaikan: Gunakan try-catch untuk menghindari error jika ada masalah dengan email
            try {
                Mail::to($s->email)->send(new LombaNotificationMail($lomba, $s));
            } catch (\Exception $e) {
                Log::error('Error sending email to ' . $s->email . ': ' . $e->getMessage());
            }
        }
    }
}