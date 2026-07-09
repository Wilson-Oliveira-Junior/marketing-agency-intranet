<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Cliente;

class LembreteMail extends Notification
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

        
        $url        = url('/backend/lembretes/editar/'.$notifiable->id.'');
        $titulo     = $notifiable->titulo;
        $aberta     = User::Where('id', $notifiable->postou_id)->value('name');   
        $cliente    = Cliente::Where('id', $notifiable->cliente_id)->value('nome');   

        return (new MailMessage())
                ->subject('['.config('app.name', 'Intranet').'] - Lembrete #'.$notifiable->id.'')
                ->view('backend.emails.novolembrete', compact('url', 'titulo', 'aberta', 'cliente'));
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
