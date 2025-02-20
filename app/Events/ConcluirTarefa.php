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

class ConcluirTarefa
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $tarefa;
    public $criadopor;
    public $responsavel;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tarefa $tarefa, User $criadopor, User $responsavel)
    {
        //
        $this->tarefa = $tarefa;
        $this->criadopor = $criadopor;
        $this->responsavel = $responsavel;
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
