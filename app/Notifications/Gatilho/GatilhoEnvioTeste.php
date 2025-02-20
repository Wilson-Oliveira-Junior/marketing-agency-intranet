<?php

namespace App\Notifications\Gatilho;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Arr;

class GatilhoEnvioTeste extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //dd($notifiable);
        $url                = url('/backend/gatilhos/projeto/'.$notifiable->id_projeto.'');
        $id_gatilho         = $notifiable->id_gatilo;
        $nome               = $notifiable->gatilho;
        $cliente            = $notifiable->nome_fantasia;
        $projeto            = $notifiable->projeto;
        $data_conclusao     = $notifiable->data_conclusao;
        $data_limite        = $notifiable->data_limite;

            return (new MailMessage())
                ->subject('[LD] 🎉 AVISO '. $notifiable->gatilho .' - ['.$notifiable->nome_fantasia.'] '. $notifiable->projeto .'')
                ->view('backend.emails.gatilho.cliente.solicitar-conteudo', compact('nome', 'cliente', 'projeto', 'data_conclusao', 'data_limite', 'url'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
