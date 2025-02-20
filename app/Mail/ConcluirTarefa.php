<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConcluirTarefa extends Mailable
{
    use Queueable, SerializesModels;
    public $titulo;
    public $responsavel;
    public $criadopor;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $titulo, string $responsavel, string $criadopor, string $url)
    {
        //
        $this->titulo = $titulo;
        $this->responsavel = $responsavel;
        $this->criadopor = $criadopor;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.tarefaentregue');
    }
}
