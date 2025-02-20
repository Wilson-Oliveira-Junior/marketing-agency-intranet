<?php

namespace App\Events;

use App\Tarefa;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NovaTarefa
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $tarefa;
    public $responsavel;
    public $responsavel_sobrenome;
    public $setor;
    public $aberta;
    public $aberta_sobrenome;
    public $responsavel_email;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tarefa $tarefa, $responsavel = '', $setor = '', $responsavel_sobrenome = '',
                                string $aberta, string $aberta_sobrenome, string $responsavel_email)
    {
        //
        $this->tarefa = $tarefa;
        $this->responsavel = $responsavel;
        $this->responsavel_sobrenome = $responsavel_sobrenome;
        $this->setor = $setor;
        $this->aberta = $aberta;
        $this->aberta_sobrenome = $aberta_sobrenome;
        $this->responsavel_email = $responsavel_email;
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
