<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use App\Comentario_Lembrete;
use App\User;
use App\Cliente;
use App\Lembrete;

class ComentarioLembrete extends Notification
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
        $url        = url('/backend/lembretes/editar/'.$notifiable->id_lembrete.'');
        $aberta     = User::Where('id', $notifiable->id_user)->value('name');
        $lembrete   = Lembrete::where('id', $notifiable->id_lembrete)->value('titulo');
        $mensagem   = $notifiable->comentario;

        return (new MailMessage())
                ->subject('[Lógica Digital] - Comentário Lembrete #'.$notifiable->id_lembrete.'')
                ->view('backend.emails.novocomentario', compact('url', 'aberta', 'mensagem', 'lembrete'));
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
