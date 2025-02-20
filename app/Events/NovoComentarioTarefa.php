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

class NovoComentarioTarefa
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $vTarefa;
    public $vUsuario;
    public $vComentario;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tarefa $pTarefa, User $pUsuario, $pComentario)
    {
        //
        $this->vTarefa = $pTarefa;
        $this->vUsuario = $pUsuario;
        $this->vComentario = $pComentario;
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
