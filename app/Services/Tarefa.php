<?php

namespace App\Services;

use App\Events\ConcluirTarefa;
use App\Notifications\EntregueTarefaMail;
use App\Tarefa as AppTarefa;
use App\User;
use Illuminate\Support\Facades\DB;

class Tarefa{
    public function concluirTarefa(int $id, Cronograma $c){

        $idResponsavel  = AppTarefa::where('id', '=', $id)->value('id_responsavel');
        if($idResponsavel == null){$idResponsavel = auth()->user()->id;}
        DB::table('tbTarefas')->where('tbTarefas.id', '=', $id)
                        ->update([
                            'data_fim' => date( 'Y-m-d' ),
                            'status' => 'Finalizado',
                            'id_status' => '150041',
                            'id_responsavel' => $idResponsavel,
                            'id_equipe' => null,
                        ]);

        DB::table('tb_comentarios_tarefas')
                    ->insert([
                        'id_usuario'    =>  '0',
                        'id_tarefa'     =>  $id,
                        'comentario'    =>  'A tarefa foi finalizada',
                        'created_at'    =>  date('Y-m-d H:i:s'),
                    ]);

        /*======= Enviando Notificação ao Destinário da Tarefa =======*/
        //$tarefa = DB::table('tbTarefas')->where('tbTarefas.id', '=', $id)->get();
        $tarefa  = AppTarefa::find($id);
        //dd($tarefa);
        $criadopor     = User::Where('id', $tarefa->id_criado_por)->first();
        $responsavel     = User::Where('id', $tarefa->id_responsavel)->first();
        $evento = new ConcluirTarefa($tarefa, $criadopor, $responsavel);
        event($evento);

        //$tarefa->notify(new EntregueTarefaMail());
        /*======= Fim Notificações =======*/
        $c->adicionarCronograma($id);

        return $tarefa;
    }
}
