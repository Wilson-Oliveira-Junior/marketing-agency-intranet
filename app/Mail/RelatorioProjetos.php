<?php

namespace App\Mail;

use App\Gatilho;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;

class RelatorioProjetos extends Mailable
{
    use Queueable, SerializesModels;
    public $gatilhos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($gatilhos)
    {
        //
        $this->gatilhos = $gatilhos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.emails.gatilho.relatorio');

    }
}
