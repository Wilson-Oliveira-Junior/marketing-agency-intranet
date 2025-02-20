<?php

namespace App\Notifications\Gatilho;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class GatilhoEquipeAlertaMail extends Notification
{
    use Queueable;
    use Notifiable;

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
            dd($notifiable);
        // Recuperando campos da notificação e inserindo em uma variavel
            $url                = url('/backend/gatilhos/projeto/'.$notifiable->id_projeto.'');
            $id_gatilho         = $notifiable->id_gatilo;
            $nome               = $notifiable->gatilho;
            $cliente            = $notifiable->nome_fantasia;
            $projeto            = $notifiable->projeto;
            $data_limite        = $notifiable->data_limite;
        // Recuperando campos da notificação e inserindo em uma variavel

        // Verificando se existe mais de um e-mail no grupo de usuário
            if($notifiable->email_adicionais == null){

                // Verificando se a notificação é um aviso ou um alerta
                    if( $notifiable->Alerta == 'aviso' ) {
                        return (new MailMessage())
                                ->subject('[LD] ⚠️ AVISO GATILHO '. $notifiable->gatilho .' - ['.$notifiable->nome_fantasia.'] '. $notifiable->projeto .' ')
                                ->view('backend.emails.gatilho.alerta.aviso', compact('nome', 'cliente', 'projeto', 'data_conclusao', 'data_limite', 'url'));
                    }else{
                        return (new MailMessage())
                            ->subject('[LD] 🚨 GATILHO ATRASADO '. $notifiable->gatilho .' - ['.$notifiable->nome_fantasia.'] '. $notifiable->projeto .' ')
                            ->view('backend.emails.gatilho.alerta.atrasado', compact('nome', 'cliente', 'projeto', 'data_conclusao', 'data_limite', 'url'));
                    }
                // Verificando se a notificação é um aviso ou um alerta
                
            }else{
                        
                // Verificando se a notificação é um aviso ou um alerta
                    if( $notifiable->Alerta == 'aviso' ) {
                        $emails = explode(";", $notifiable->email_adicionais);
                        return (new MailMessage())->bcc($emails)
                                ->subject('[LD] ⚠️ AVISO GATILHO '. $notifiable->gatilho .' - ['.$notifiable->nome_fantasia.'] '. $notifiable->projeto .' ')
                                ->view('backend.emails.gatilho.alerta.aviso', compact('nome', 'cliente', 'projeto', 'data_conclusao', 'data_limite', 'url'));
                    }else{
                        $emails = explode(";", $notifiable->email_adicionais);
                        return (new MailMessage())->bcc($emails)
                            ->subject('[LD] 🚨 GATILHO ATRASADO '. $notifiable->gatilho .' - ['.$notifiable->nome_fantasia.'] '. $notifiable->projeto .' ')
                            ->view('backend.emails.gatilho.alerta.atrasado', compact('nome', 'cliente', 'projeto', 'data_conclusao', 'data_limite', 'url'));
                    }
                // Verificando se a notificação é um aviso ou um alerta

            }
        // Verificando se existe mais de um e-mail no grupo de usuário
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return ['ok'
            //
        ];
    }
}
