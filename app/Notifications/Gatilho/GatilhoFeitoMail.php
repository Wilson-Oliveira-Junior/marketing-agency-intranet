<?php

namespace App\Notifications\Gatilho;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Arr;

class GatilhoFeitoMail extends Notification
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

        // Configurando os e-mail;
        if($notifiable->email_adicionais == null){
            return (new MailMessage())
                ->subject('[LD] 🎉 GATILHO '. $notifiable->gatilho .' - ['.$notifiable->nome_fantasia.'] '. $notifiable->projeto .' - Finalizado')
                ->view('backend.emails.gatilho.finalizado', compact('nome', 'cliente', 'projeto', 'data_conclusao', 'data_limite', 'url'));
        }else{
            $emails = explode(";", $notifiable->email_adicionais);
            return (new MailMessage())->bcc($emails)
                ->subject('[LD] 🎉 GATILHO '. $notifiable->gatilho .' - ['.$notifiable->nome_fantasia.'] '. $notifiable->projeto .' - Finalizado')
                ->view('backend.emails.gatilho.finalizado', compact('nome', 'cliente', 'projeto', 'data_conclusao', 'data_limite', 'url'));
        }


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
