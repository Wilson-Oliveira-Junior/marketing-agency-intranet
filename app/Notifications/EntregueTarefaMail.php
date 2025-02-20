<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\User;
use App\Cliente;
use App\Tarefa;

class EntregueTarefaMail extends Notification
{
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
        //dd($notifiable);
        $url        = url('/backend/tarefas/'.$notifiable->id.'');
        $titulo     = $notifiable->titulo;
        $entregue   = User::Where('id', $notifiable->id_responsavel)->value('name');
        $entregue_sobrenome   = User::Where('id', $notifiable->id_responsavel)->value('sobrenome');
        $aberta     = User::Where('id', $notifiable->id_criado_por)->value('name');
        $aberta_sobrenome     = User::Where('id', $notifiable->id_criado_por)->value('sobrenome');
        $aberta_email     = User::Where('id', $notifiable->id_criado_por)->value('email');

        $seguidor = DB::table('tb_seguidores_tarefas')->where('id_tarefa', $notifiable->id)
        ->leftJoin('users', 'tb_seguidores_tarefas.id_usuario_seguidor', '=', 'users.id')
        ->select('users.email')
        ->get();

        $Arr = Arr::pluck($seguidor,'email');
        //$Arr = array_fetch($seguidor[0]->emails);
        //dd($Arr);

        return (new MailMessage())->bcc($Arr)
                ->subject('[LD] Tarefa ENTREGUE #'.$notifiable->id.' - '. $titulo .'')
                ->view('backend.emails.tarefaentregue', compact('url', 'titulo', 'aberta', 'entregue','entregue_sobrenome','aberta_sobrenome'));
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
