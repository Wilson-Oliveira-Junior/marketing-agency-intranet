<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovaPauta extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $cliente;
    public $urgencia;
    public $responsavelnome;
    public $criadopor;
    public $titulo;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url, string $cliente, string $urgencia,
            string $responsavelnome, string $criadopor, string $titulo, string $data)
    {
        //
        $this->url = $url;
        $this->cliente = $cliente;
        $this->urgencia = $urgencia;
        $this->responsavelnome = $responsavelnome;
        $this->criadopor = $criadopor;
        $this->titulo = $titulo;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.novapauta');
    }
}
