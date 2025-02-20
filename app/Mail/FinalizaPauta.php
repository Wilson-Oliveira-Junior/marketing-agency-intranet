<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FinalizaPauta extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $cliente;
    public $responsavel;
    public $criadopor;
    public $titulo;
    public $comentario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url, string $cliente,
    string $responsavel, string $criadopor, string $titulo, string $comentario)
    {
        $this->url = $url;
        $this->cliente = $cliente;
        $this->responsavel = $responsavel;
        $this->criadopor = $criadopor;
        $this->titulo = $titulo;
        $this->comentario = $comentario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.finalizapauta');
    }
}
