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

class NovaTarefaMail extends Notification
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

        $url        = url('/backend/tarefas/'.$notifiable->id.'');
        $titulo     = $notifiable->titulo;
        $aberta     = User::Where('id', $notifiable->id_criado_por)->value('name');
        $aberta_sobrenome     = User::Where('id', $notifiable->id_criado_por)->value('sobrenome');
        $responsavel     = User::Where('id', $notifiable->id_responsavel)->value('name');
        $responsavel_sobrenome     = User::Where('id', $notifiable->id_responsavel)->value('sobrenome');
        $setor = SetorUsuario::Where('id', $notifiable->id_equipe)->value('nome');

        return (new MailMessage())
                ->subject('[LD] NOVA Tarefa #'.$notifiable->id.' - ' . $titulo)
                ->view('backend.emails.novatarefa', compact('url', 'titulo', 'aberta', 'responsavel', 'setor','aberta_sobrenome','responsavel_sobrenome'));
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
