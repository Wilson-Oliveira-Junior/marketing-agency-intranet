<?php

namespace App\Events;

use App\ToDoList;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FinalizaPauta
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $pauta;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ToDoList $pauta)
    {
        //
        $this->pauta = $pauta;
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
