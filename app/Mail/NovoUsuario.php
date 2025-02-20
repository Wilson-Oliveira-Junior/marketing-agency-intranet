<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovoUsuario extends Mailable
{
    use Queueable, SerializesModels;
    public $bemvindo;
    public $apelido;
    public $equipe;
    public $email;
    public $usuario_rede;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $bemvindo, string $apelido, object $equipe, string $email, string $usuario_rede)
    {
        //
        $this->bemvindo = $bemvindo;
        $this->apelido = $apelido;
        $this->equipe = $equipe;
        $this->email = $email;
        $this->usuario_rede = $usuario_rede;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.novousuario');
    }
}
