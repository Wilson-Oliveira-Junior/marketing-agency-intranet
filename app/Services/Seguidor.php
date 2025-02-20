<?php

namespace App\Services;

use App\ClienteResponsavel;
use App\Events\Seguidor as EventsSeguidor;
use App\Notifications\NovoSeguidorTarefa;
use App\Projeto;
use App\SeguidorTarefa;
use App\Tarefa;
use Illuminate\Support\Facades\DB;

class Seguidor{
    public function adicionaSeguidor(Tarefa $tarefa, array $arrSeguidores){

        if( !in_array( "3" ,$arrSeguidores ) )
        {
            array_push($arrSeguidores, "3");
        }
        if(!in_array("27",$arrSeguidores)){
            array_push($arrSeguidores,"27");
        }
        if(!in_array("34",$arrSeguidores)){
            array_push($arrSeguidores,"34");
        }
        //
        if(in_array($tarefa->id_responsavel, $arrSeguidores)){
            $chave = array_search($tarefa->id_responsavel, $arrSeguidores);
            if($chave !== false){
                unset($arrSeguidores[$chave]);
            }
        }

        //dd($arrSeguidores);
        foreach($arrSeguidores as $seguidor){
            $insSeguidor = new SeguidorTarefa();
            $insSeguidor->id_usuario_postou = $tarefa->id_criado_por;
            $insSeguidor->id_usuario_seguidor = $seguidor;
            $insSeguidor->id_tarefa = $tarefa->id;
            $insSeguidor->save();
            //dd($objSeguidor);

            $this->enviaEmailSeguidor($insSeguidor, $tarefa, $seguidor);
        }

        return true;
    }

    public function adicionaResponsaveis(Tarefa $tarefa){

        $cliente = Projeto::join('clientes', 'clientes.cliente_id', 'tb_projetos.cliente_id')
                    ->where('tb_projetos.id', $tarefa->id_projeto)
                    ->select('clientes.id')
                    ->first();

        $responsaveis = ClienteResponsavel::Where('idcliente', $cliente['id'])
                        ->get();

        foreach($responsaveis as $responsavel){
            $atuSeguidor = SeguidorTarefa::UpdateOrCreate(
                ['id_tarefa' => $tarefa->id,
                 'id_usuario_seguidor' => $responsavel->idusuario],
                 ['id_usuario_postou' => $tarefa->id_criado_por]
            );
            if($atuSeguidor->wasRecentlyCreated){
                $this->enviaEmailSeguidor($atuSeguidor, $tarefa, $responsavel->idusuario);
            }
        }
        return true;
    }

    public function enviaEmailSeguidor(SeguidorTarefa $seguidor, Tarefa $tarefa, int $idseguidor){
        //dd($seguidor);
        $seguidor = $seguidor->join('tbTarefas',  'tb_seguidores_tarefas.id_tarefa', 'tbTarefas.id')
            ->join('users', 'tb_seguidores_tarefas.id_usuario_seguidor', 'users.id')
            ->where('id_tarefa', $tarefa->id)
            ->where('id_usuario_seguidor', $idseguidor)
            ->select(
                'users.name         as nome_usuario',
                'users.sobrenome    as sobrenome_usuario',
                'users.email',

                'tbTarefas.id       as id',
                'tbTarefas.titulo   as titulo'
                )
            ->first();
        //dd($seguidor);
            $seguidorObj = (object) $seguidor->toArray();
            $evento = new EventsSeguidor($seguidorObj);
            event($evento);


        return true;
    }
}
