<?php

namespace App\Services;

use App\Cronograma as AppCronograma;
use App\ToDoList;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class Cronograma{
    public function fnMontaCronograma(int $id)
    {
        $hoje = (new Carbon())->format('Y-m-d');

        $segunda_atual = (new Carbon('last monday', 'America/Sao_Paulo'));
        //dd($segunda_atual);
        if($segunda_atual->addWeek(1)->format('Y-m-d') == $hoje){
            $segunda_atual = $hoje;
        }else{
            $segunda_atual = (new Carbon('last monday', 'America/Sao_Paulo'))->format('Y-m-d');
        }

        $sexta_atual = (new Carbon('next friday', 'America/Sao_Paulo'))->format('Y-m-d');
        //Solicitação de ver a semana anterior, mas já acho que pode ser do mes mesmo.
        $segunda1 = \Carbon\Carbon::now()->startOfMonth()->toDateString();
		//dd($dtInicio);
        $sexta10 = \Carbon\Carbon::now()->endOfMonth()->addWeek(1)->toDateString();

        $feriados = [
            '*-04-21',
            '*-05-01',
            '*-05-30',
            '*-09-07',
            '*-10-12',
            '*-11-02',
            '*-11-15',
            '*-11-20',
            '*-12-08',
            '*-04-07',
        ];
        $periodoData =  collect(CarbonPeriod::create($segunda1, $sexta10)->toArray())
          ->map(function($data) use($feriados){
            if($data->isWeekday() && !in_array($data->format('*-m-d'), $feriados)){
                return $data->format('Y-m-d');
            }
          });


        /*monta cronograma do usuário*/
        $arrCronograma = [];
        foreach($periodoData as $key => $data)
        {
            if(!is_null($data))
            {
                $tarefas = AppCronograma::from('tb_cronogramas as c')
                    ->join('tbTarefas as t', 'c.id_tarefa', 't.id')
                    ->join('tb_status as s','t.id_status', 's.id')
                    ->where('t.id_responsavel', $id)
                    ->where('c.data', $data)
                    ->select(
                        't.id',
                        't.titulo',
                        's.nome as status',
                        'c.id_cronograma',
                        'c.data'
                    )
                    ->orderBy('t.tarefa_ordem', 'DESC')
                    ->orderBy('t.id', 'ASC')
                    ->get();

                $pautas = ToDoList::where('status', 0)
                    ->where('excluido', 0)
                    ->where('idresponsavel', $id)
                    ->where('data_desejada', $data)
                    ->get();

                $arrCronograma[$data] = [
                    'tarefas' => $tarefas,
                    'pautas' => $pautas,
                    'collapse' => ($data >= $segunda_atual && $data <= $sexta_atual)
                ];
            }
        }

        return $arrCronograma;
    }

    public function fnMontaCronogramaEquipe(int $idsetor){

        $usuarios = User::where('setor', $idsetor)->where('ativo', 1)->orderBy('name')->get();
        $arrCronogramaEquipe = [];
        foreach($usuarios as $key => $usuario){
            $arrCronogramaEquipe[$key] = [
                'id' => $usuario->id,
                'nome' => $usuario->name . ' ' . $usuario->sobrenome,
                'cronograma' => $this->fnMontaCronograma($usuario->id)
            ];
        }

        return $arrCronogramaEquipe;
    }

    public function adicionarCronograma($idtarefa){
        $hoje = (new Carbon())->format('Y-m-d');
        $cronograma = AppCronograma::firstOrCreate(
            ['id_tarefa' =>  $idtarefa, 'data' => $hoje],
            ['id_tarefa' =>  $idtarefa, 'data' => $hoje]
        );
        //dd($cronograma);
        return $cronograma;
    }
}
