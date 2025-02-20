<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovoComentarioTarefa extends Mailable
{
    use Queueable, SerializesModels;
    public $titulo;
    public $responsavel_comentairo;
    public $responsavel_comentario_sobrenome;
    public $comentario;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ptitulo, $presponsavel_comentairo, $presponsavel_comentario_sobrenome, $pcomentario, $purl)
    {
        //
        $this->titulo = $ptitulo;
        $this->responsavel_comentairo = $presponsavel_comentairo;
        $this->responsavel_comentario_sobrenome = $presponsavel_comentario_sobrenome;
        $this->comentario = $pcomentario;
        $this->url = $purl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.novocomentariotarefa');
    }
}
