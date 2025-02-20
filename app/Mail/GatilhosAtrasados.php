<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GatilhosAtrasados extends Mailable
{
    use Queueable, SerializesModels;
    public $arrProjetos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($arrProjetos)
    {
        //
        $this->arrProjetos = $arrProjetos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.gatilho.alerta.atrasado-geral');
    }
}
