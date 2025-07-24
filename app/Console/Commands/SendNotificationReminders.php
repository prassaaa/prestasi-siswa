<?php

namespace App\Console\Commands;

use App\Models\Lomba;
use App\Models\Notifikasi;
use App\Models\Prestasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendNotificationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder notifications for deadlines and pending actions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sending notification reminders...');

        // 1. Reminder untuk lomba yang akan berakhir dalam 3 hari
        $this->sendLombaDeadlineReminders();

        // 2. Reminder untuk admin tentang prestasi pending > 7 hari
        $this->sendPendingPrestasiReminders();

        // 3. Reminder untuk siswa tentang prestasi yang ditolak > 30 hari
        $this->sendRejectedPrestasiReminders();

        $this->info('Notification reminders sent successfully!');
    }

    private function sendLombaDeadlineReminders()
    {
        $upcomingLomba = Lomba::where('tanggal_selesai', '>=', now())
            ->where('tanggal_selesai', '<=', now()->addDays(3))
            ->get();

        foreach ($upcomingLomba as $lomba) {
            $siswa = User::where('role_id', 2)->get();

            foreach ($siswa as $s) {
                // Cek apakah sudah ada reminder untuk lomba ini
                $existingReminder = Notifikasi::where('user_id', $s->id)
                    ->where('judul', 'LIKE', '%Deadline Lomba%')
                    ->whereJsonContains('data->lomba_id', $lomba->id)
                    ->where('created_at', '>=', now()->subDays(1))
                    ->exists();

                if (!$existingReminder) {
                    $daysLeft = now()->diffInDays($lomba->tanggal_selesai);
                    
                    Notifikasi::create([
                        'user_id' => $s->id,
                        'judul' => 'Deadline Lomba Mendekat!',
                        'pesan' => 'Lomba "' . $lomba->nama_lomba . '" akan berakhir dalam ' . $daysLeft . ' hari (' . $lomba->tanggal_selesai->format('d M Y') . '). Jangan lewatkan kesempatan ini!',
                        'type' => 'warning',
                        'priority' => 'high',
                        'data' => [
                            'lomba_id' => $lomba->id,
                            'deadline' => $lomba->tanggal_selesai,
                            'action_url' => route('siswa.lomba.show', $lomba->id)
                        ],
                        'dibaca' => false,
                    ]);
                }
            }
        }

        $this->info('Sent ' . $upcomingLomba->count() . ' lomba deadline reminders');
    }

    private function sendPendingPrestasiReminders()
    {
        $oldPendingPrestasi = Prestasi::where('status_verifikasi', 'pending')
            ->where('created_at', '<=', now()->subDays(7))
            ->get();

        $admins = User::where('role_id', 1)->get();

        foreach ($admins as $admin) {
            if ($oldPendingPrestasi->count() > 0) {
                // Cek apakah sudah ada reminder hari ini
                $existingReminder = Notifikasi::where('user_id', $admin->id)
                    ->where('judul', 'LIKE', '%Prestasi Pending%')
                    ->where('created_at', '>=', now()->startOfDay())
                    ->exists();

                if (!$existingReminder) {
                    Notifikasi::create([
                        'user_id' => $admin->id,
                        'judul' => 'Prestasi Pending Memerlukan Verifikasi',
                        'pesan' => 'Terdapat ' . $oldPendingPrestasi->count() . ' prestasi yang menunggu verifikasi lebih dari 7 hari. Mohon segera diproses.',
                        'type' => 'warning',
                        'priority' => 'high',
                        'data' => [
                            'pending_count' => $oldPendingPrestasi->count(),
                            'action_url' => route('admin.prestasi.index', ['status' => 'pending'])
                        ],
                        'dibaca' => false,
                    ]);
                }
            }
        }

        $this->info('Sent pending prestasi reminders to ' . $admins->count() . ' admins');
    }

    private function sendRejectedPrestasiReminders()
    {
        $oldRejectedPrestasi = Prestasi::where('status_verifikasi', 'rejected')
            ->where('updated_at', '<=', now()->subDays(30))
            ->with('siswa.user')
            ->get();

        foreach ($oldRejectedPrestasi as $prestasi) {
            // Cek apakah sudah ada reminder untuk prestasi ini
            $existingReminder = Notifikasi::where('user_id', $prestasi->siswa->user_id)
                ->where('judul', 'LIKE', '%Prestasi Ditolak%')
                ->whereJsonContains('data->prestasi_id', $prestasi->id)
                ->where('created_at', '>=', now()->subDays(30))
                ->exists();

            if (!$existingReminder) {
                Notifikasi::create([
                    'user_id' => $prestasi->siswa->user_id,
                    'judul' => 'Prestasi Ditolak - Perbaiki dan Daftar Ulang',
                    'pesan' => 'Prestasi "' . $prestasi->nama_prestasi . '" yang ditolak sudah lebih dari 30 hari. Anda dapat memperbaiki dan mendaftarkan ulang prestasi tersebut.',
                    'type' => 'info',
                    'priority' => 'low',
                    'data' => [
                        'prestasi_id' => $prestasi->id,
                        'rejection_reason' => $prestasi->catatan_verifikasi,
                        'action_url' => route('siswa.prestasi.create')
                    ],
                    'dibaca' => false,
                ]);
            }
        }

        $this->info('Sent rejected prestasi reminders for ' . $oldRejectedPrestasi->count() . ' prestasi');
    }
}
