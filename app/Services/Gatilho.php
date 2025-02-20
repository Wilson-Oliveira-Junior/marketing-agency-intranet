<?php

namespace App\Services;

use App\Gatilho as AppGatilho;
use App\GatilhoProjeto;
use App\GatilhoTemplate;
use App\TipoProjeto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Gatilho{

    public function fnAdicionarGatilho($idTipoProjeto, $dtReferencia, $idProjeto, int $tempoProjeto){



        $gatilhosTemplate   = GatilhoTemplate::Where('id_tipo_projeto',$idTipoProjeto)->orderby('id', 'asc')->get();


        //Cria o gatilho geral
        if(count($gatilhosTemplate)>0){
            //dd($gatilhosTemplate);
            $gatilhoProjeto = new GatilhoProjeto();
            $gatilhoProjeto->id_projeto = $idProjeto;
            $gatilhoProjeto->data_inicio = $dtReferencia;
            $gatilhoProjeto->data_fim = Carbon::parse($dtReferencia)->addWeekdays($tempoProjeto);
            $gatilhoProjeto->status = 'E';
            $gatilhoProjeto->save();
        }


        //dd("Passou");

        foreach($gatilhosTemplate as $gatilho){

            if(!is_null($gatilho->id_referente)){
                $limite = AppGatilho::where('id_tipo_projeto', $idProjeto)
                                    ->where('id_gatilho_template', $gatilho->id_referente)->value('data_limite');
                //dd('Limite:' . $limite);
                /*$limite = DB::table('tb_gatilhos')->where('id_tipo_projeto', '=', $idProjeto)
                            ->where('id_gatilho_template', '=', $gatilho->id_referente)
                            ->value('data_limite');*/

                $dtReferencia     = date( 'Y-m-d' , strtotime($limite) );
            }

            if($tempoProjeto == 30){
                $dias_para_adicionar = isset($gatilho->dias_limite_30)?$gatilho->dias_limite_30:$gatilho->dias_limite_padrao;

                if(is_null($dtReferencia)){
                    $data_limite    = Carbon::now()->addWeekdays($dias_para_adicionar);
                }else{
                    $data_limite     = Carbon::parse($dtReferencia)->addWeekdays($dias_para_adicionar);
                }


            }elseif($tempoProjeto == 40){
                $dias_para_adicionar = isset($gatilho->dias_limite_40)?$gatilho->dias_limite_40:$gatilho->dias_limite_padrao;

                if(is_null($dtReferencia)){
                    $data_limite = Carbon::now()->addWeekdays($dias_para_adicionar);
                }else{
                    $data_limite     = Carbon::parse($dtReferencia)->addWeekdays($dias_para_adicionar);
                }

            }elseif($tempoProjeto == 50){
                $dias_para_adicionar = isset($gatilho->dias_limite_50)?$gatilho->dias_limite_50:$gatilho->dias_limite_padrao;

                if(is_null($dtReferencia)){
                    $data_limite = Carbon::now()->addWeekdays($dias_para_adicionar);
                }else{
                    $data_limite     = Carbon::parse($dtReferencia)->addWeekdays($dias_para_adicionar);
                }

            }else{
                //65 dias - que é o padrão.
                if(is_null($dtReferencia)){
                    $data_limite = Carbon::now()->addWeekdays($gatilho->dias_limite_padrao);
                }else{
                    $data_limite     = Carbon::parse($dtReferencia)->addWeekdays($gatilho->dias_limite_padrao);
                }

            }

            $gatilhoIndividual = new AppGatilho();
            $gatilhoIndividual->id_tipo_projeto = $idProjeto;
            $gatilhoIndividual->id_gatilho_template = $gatilho->id;
            $gatilhoIndividual->data_limite = $data_limite;
            $gatilhoIndividual->status = 'Aberto';
            $gatilhoIndividual->save();
        }

    }

    public function fnListarGatilhos($idTipoProjeto, $idProjeto, $status = 'E'){

        $arrProjetos = [];

        $blTipoProjeto = (is_null($idTipoProjeto))?false:$idTipoProjeto;
        $blIdProjeto = (is_null($idProjeto))?false:true;
        //dd($blTipoProjeto);
        $projetos = GatilhoProjeto::where('status', $status)
                ->with('gatilhos', 'projetos', 'projetos.tipo_projeto')
                ->when($blIdProjeto, function($q) use($idProjeto){
                    $q->where('id_projeto', $idProjeto);
                })
                ->orderBy('data_fim', 'ASC')
                ->get();


        foreach($projetos as $key => $gatprojeto){
            //print $gatprojeto->id_projeto . '<br/>';
            $concluido = ($gatprojeto->gatilhos->count()-$gatprojeto->gatilhos[0]->finalizado($gatprojeto->id_projeto) ==0)?"S":"N";

            if($blTipoProjeto && $gatprojeto->projetos[0]->tipo_projeto->id == $blTipoProjeto){
                $arrProjetos[$key] = [
                    "id" => $gatprojeto->id_projeto,
                    "nome" => isset($gatprojeto->projetos[0]->cliente->nome_fantasia)?$gatprojeto->projetos[0]->cliente->nome_fantasia:'',
                    "entraremcontato" => $gatprojeto->comentario_projeto(),
                    "finalizados" => $gatprojeto->gatilhos[0]->finalizado($gatprojeto->id_projeto),
                    "gatilhos" => $gatprojeto->gatilhos->count(),
                    "concluido" => $concluido,
                    "tipo_projeto" => $gatprojeto->projetos[0]->tipo_projeto->nome,
                    "data_inicio" => $gatprojeto->data_inicio,
                    "data_fim" => $gatprojeto->data_fim,
                    "status" => $gatprojeto->status,
                    "ultimo_comentario" => $gatprojeto->ultimo_comentario_projeto(),
                    "ultimo_contato" => $gatprojeto->ultimo_contato_projeto()
                ];

            }else if(!$blTipoProjeto){
                if(isset($gatprojeto->projetos) && $gatprojeto->projetos[0]->status == 'Ativo'){
                    $arrProjetos[$key] = [
                        "id" => $gatprojeto->id_projeto,
                        "nome" => isset($gatprojeto->projetos[0]->cliente->nome_fantasia)?$gatprojeto->projetos[0]->cliente->nome_fantasia:'',
                        "entraremcontato" => $gatprojeto->comentario_projeto(),
                        "finalizados" => $gatprojeto->gatilhos[0]->finalizado($gatprojeto->id_projeto),
                        "gatilhos" => $gatprojeto->gatilhos->count(),
                        "concluido" => $concluido,
                        "tipo_projeto" => $gatprojeto->projetos[0]->tipo_projeto->nome,
                        "data_inicio" => $gatprojeto->data_inicio,
                        "data_fim" => $gatprojeto->data_fim,
                        "status" => $gatprojeto->status,
                        "ultimo_comentario" => $gatprojeto->ultimo_comentario_projeto(),
                        "ultimo_contato" => $gatprojeto->ultimo_contato_projeto()
                    ];
                }
            }


        }

        //dd($arrProjetos);


        //dd('ok');
        //dd($arrGatilhos);
        return $arrProjetos;
    }

    public function atualizaStatusGatilhos(){
        $projetos = GatilhoProjeto::where('status', 'E')
                ->with('gatilhos')
                ->get();

        foreach($projetos as $gatprojeto){
            $concluido = ($gatprojeto->gatilhos->count()-$gatprojeto->gatilhos[0]->finalizado($gatprojeto->id_projeto) ==0)?"S":"N";
            if($concluido === 'S'){
                $gatprojeto->status = 'F';
                $gatprojeto->save();
            }
        }

        return 'ok';
    }

    public function fnListarGatilhosBKP($idTipoProjeto, $f_concluido = 'N'){
        $arrGatilhos = [];
        $projetos = [];
        $p = 0;
        $i = 0;

        $blTipoProjeto = (is_null($idTipoProjeto))?false:true;

        $arrTipoProjetos = TipoProjeto::query()
            ->with('projetos', 'projetos.gatilhos')
            ->when($blTipoProjeto, function($q) use($idTipoProjeto){
                $q->where('id', $idTipoProjeto);
            })
            ->get();
        //dd($arrTipoProjetos);
        foreach($arrTipoProjetos as $key => $tipoprojeto){
            //dd(count($tipoprojeto->projetos));
            if(count($tipoprojeto->projetos)>0){
                //dd($tipoprojeto->projetos);
                foreach ($tipoprojeto->projetos as $key => $projeto ){
                    //dd(count($projeto->gatilhos));
                    if(count($projeto->gatilhos)>0){
                        $concluido = ($projeto->gatilhos->count()-$projeto->gatilhos[0]->finalizado($projeto->id) ==0)?"S":"N";
                        if($concluido == $f_concluido){
                            $projetos[$p] = [
                                "id" => $projeto->id,
                                "nome" => isset($projeto->cliente->nome_fantasia)?$projeto->cliente->nome_fantasia:'',
                                "entraremcontato" => $projeto->comentario_projeto(),
                                "finalizados" => $projeto->gatilhos[0]->finalizado($projeto->id),
                                "gatilhos" => $projeto->gatilhos->count(),
                                "concluido" => $concluido
                            ];

                            $p++;
                        }

                    }
                }
                if(count($projetos)>0){
                    $arrGatilhos[$i] = [
                        'tipo_projeto' => $tipoprojeto->nome,
                        'projetos' => $projetos
                    ];
                    $i++;
                }
                $p = 0;
                $projetos = [];

            }
        }
        //dd('ok');
        //dd($arrGatilhos);
        return $arrGatilhos;
    }

}
