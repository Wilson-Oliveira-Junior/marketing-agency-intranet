<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Seguidor extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $id_tarefa;
    public $titulo;
    public $nome;
    public $sobrenome;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url, int $id_tarefa, string $titulo, string $nome, string $sobrenome)
    {
        //
        $this->url = $url;
        $this->id_tarefa = $id_tarefa;
        $this->titulo = $titulo;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.novoseguidor');
    }
}
