<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\User;
use App\Cliente;
use App\Tarefa;
use App\SetorUsuario;

class DevedoresMail extends Notification
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

        dd($notifiable);
        $devedores = '';
        foreach($notifiable as $registro){
            
            $devedores .= $registro['nome_fantasia'] . '<br/>';
        }

        dd($devedores);
        /*$url        = url('/backend/tarefas/'.$notifiable->id_tarefa.'');
        $titulo     = Tarefa::Where('id', $notifiable->id_tarefa)->value('titulo');
        $idCriadoPor = Tarefa::Where('id', $notifiable->id_tarefa)->value('id_criado_por');
        $idResponsavelDaTarefa = Tarefa::Where('id', $notifiable->id_tarefa)->value('id_responsavel');

        //Email de quem abriu e de quem esta fazendo
        $email_criado_por     = User::Where('id', $idCriadoPor)->value('email');
        $email_responsavel_da_tarefa     = User::Where('id', $idResponsavelDaTarefa)->value('email');

        //$aberta     = User::Where('id', $notifiable->id_criado_por)->value('name');
        //$aberta_sobrenome     = User::Where('id', $notifiable->id_criado_por)->value('sobrenome');
        $responsavel_comentairo     = User::Where('id', $notifiable->id_usuario)->value('name');
        $responsavel_comentario_sobrenome     = User::Where('id', $notifiable->id_usuario)->value('sobrenome');
        //$setor = SetorUsuario::Where('id', $notifiable->id_equipe)->value('nome');
        $comentario = $notifiable->comentario;

        $seguidor = DB::table('tb_seguidores_tarefas')->where('id_tarefa', $notifiable->id_tarefa)
        ->leftJoin('users', 'tb_seguidores_tarefas.id_usuario_seguidor', '=', 'users.id')
        ->select('users.email')
        ->get();
        //dd($email_responsavel_da_tarefa);
        $Arr = Arr::pluck($seguidor,'email');
        if($notifiable->id_usuario != $idResponsavelDaTarefa){
            $Arr = Arr::prepend($Arr, $email_responsavel_da_tarefa);
        }
        $Arr = Arr::prepend($Arr, $email_criado_por);
        //dd($Arr);
        return (new MailMessage())->bcc($Arr)
                ->subject('[LD] NOVO Comentário na Tarefa #'.$notifiable->id.' - ' . $titulo)
                  ->view('backend.emails.novocomentariotarefa', compact('url', 'titulo', 'responsavel_comentairo', 'responsavel_comentario_sobrenome', 'comentario'));
        */
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
