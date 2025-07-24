<?php

namespace App\Events;

use App\Models\Siswa;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SiswaRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $siswa;

    /**
     * Create a new event instance.
     */
    public function __construct(Siswa $siswa)
    {
        $this->siswa = $siswa;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
