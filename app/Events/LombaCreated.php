<?php

namespace App\Events;

use App\Models\Lomba;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LombaCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lomba;

    /**
     * Create a new event instance.
     */
    public function __construct(Lomba $lomba)
    {
        $this->lomba = $lomba;
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