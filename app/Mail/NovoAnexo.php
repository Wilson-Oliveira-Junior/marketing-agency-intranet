<?php

namespace App\Mail;

use App\Tarefa;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovoAnexo extends Mailable
{
    use Queueable, SerializesModels;
    public $tarefa;
    public $usuario;
    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.novoanexo');
    }
}
