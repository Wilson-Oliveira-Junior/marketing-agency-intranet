<?php

namespace App\Events;

use App\Tarefa;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NovoAnexo
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tarefa;
    public $usuario;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tarefa $tarefa, User $usuario)
    {
        //
        $this->tarefa = $tarefa;
        $this->usuario = $usuario;
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
