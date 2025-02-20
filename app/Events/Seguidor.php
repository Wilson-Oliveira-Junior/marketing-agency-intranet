<?php

namespace App\Events;

use App\SeguidorTarefa;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Seguidor
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $seguidor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($evtseguidor)
    {
        //
        $this->seguidor = $evtseguidor;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
