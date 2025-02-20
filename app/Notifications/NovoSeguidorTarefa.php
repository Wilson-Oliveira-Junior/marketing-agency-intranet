<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Cliente;
use App\Tarefa;
use App\SetorUsuario;

class NovoSeguidorTarefa extends Notification
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
        $url        = url('/backend/tarefas/'.$notifiable->id.'');
        $id_tarefa  = $notifiable->id;
        $titulo     = $notifiable->titulo;
        $nome       = $notifiable->nome_usuario;
        $sobrenome  = $notifiable->sobrenome_usuario;

        return (new MailMessage())
                ->subject('[LD] Você agora está seguindo a tarefa #'.$notifiable->id.' - ' . $titulo)
                ->view('backend.emails.novoseguidor', compact('url', 'titulo', 'id_tarefa', 'nome', 'sobrenome'));
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
