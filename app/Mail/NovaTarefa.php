<?php

namespace App\Mail;

use App\Tarefa;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovaTarefa extends Mailable
{
    use Queueable, SerializesModels;
    public $titulo;
    public $responsavel;
    public $responsavel_sobrenome;
    public $setor;
    public $aberta;
    public $aberta_sobrenome;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $titulo, $responsavel, $setor, $responsavel_sobrenome,
                            string $aberta, string $aberta_sobrenome, string $url)
    {
        $this->titulo = $titulo;
        $this->responsavel = $responsavel;
        $this->responsavel_sobrenome = $responsavel_sobrenome;
        $this->setor = $setor;
        $this->aberta = $aberta;
        $this->aberta_sobrenome = $aberta_sobrenome;
        $this->url = $url;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.novatarefa');
    }
}
