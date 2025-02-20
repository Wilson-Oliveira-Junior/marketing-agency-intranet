<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Gate;
use App\Tarefa;
use App\ClienteFTPDominio;
use App\Cliente;
use App\ClienteDominio;
use App\SetorUsuario;
use Carbon\Carbon;

class RelatorioClienteController extends Controller
{
    //
    public function listarFTPs(){

        $arrFTPs = ClienteDominio::with(['clientes','ClientesDominios'])
                ->where('tipo_hospedagem', '!=', 'Redirecionamento')
                ->where('status', '=', 'Ativo')->orderBy('dominio','ASC')->get();
        //dd($arrFTPs);

        return view('backend.relatorio.cliente.ftps.index',compact('arrFTPs'));
    }

    public function listarCronogramas(){

        if( Gate::denies('listar_relatorio_cronograma') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listagem de relatórios de Cronograma', 'class'=>'']);
            return redirect()->back();
        } 

        $tmpCronograma = DB::unprepared(
            DB::raw("
                CREATE TEMPORARY TABLE tmpCronogramas 
                                AS (
                                    SELECT t.id_responsavel, tc.id_tarefa,count(distinct 1) as qtdeAssociada, COUNT(DISTINCT CASE 
                            WHEN t.status = 'Finalizado' THEN 1 END) AS qtdeFinalizada
                            FROM tb_cronogramas AS tc
                            INNER JOIN tbTarefas AS t ON tc.id_tarefa = t.id
                            GROUP BY t.id_responsavel, tc.id_tarefa);")
                );

        //dd($tmpCronograma);

        $arrCronogramas = DB::table('tmpCronogramas')
                    ->join('users', 'tmpCronogramas.id_responsavel', 'users.id')
                    ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                    ->select(
                        'tmpCronogramas.id_responsavel',
                        DB::raw('SUM(tmpCronogramas.qtdeAssociada) as qtdeAssociada'),
                        \DB::raw('SUM(tmpCronogramas.qtdeFinalizada) AS qtdeFinalizada'),
                        'users.name',
                        'setor_usuarios.nome'
                    )->groupBy('tmpCronogramas.id_responsavel','users.name','setor_usuarios.nome')
                    ->orderBy('setor_usuarios.nome','ASC')
                    ->orderBy('users.name','ASC')
                    ->get();
        
        //dd($arrCronogramas);   
        // Configurando a Segunda-Feira
        $hoje = (new Carbon())->format('Y-m-d');        
        $proxima_segunda = (new Carbon('last monday', 'America/Sao_Paulo'))->addWeek(1)->format('Y-m-d');

        if($proxima_segunda == $hoje){
            $segunda = $proxima_segunda;
            $vSegunda = (new Carbon('last monday', 'America/Sao_Paulo'))->addWeek(1)->format('d/m/Y');
            $vSexta = (new Carbon('last monday', 'America/Sao_Paulo'))->addWeek(1)->addDay(4)->format('d/m/Y');
        }else{
            $segunda = (new Carbon('last monday', 'America/Sao_Paulo'));
            $vSegunda = (new Carbon('last monday', 'America/Sao_Paulo'))->format('d/m/Y');
            $vSexta = (new Carbon('last monday', 'America/Sao_Paulo'))->addDay(4)->format('d/m/Y');
        }

        foreach($arrCronogramas as $dado):
            $registroExiste = DB::table('tb_relatorio_cronogramas')
                                ->select('idRelatorioCronograma')
                                ->where('dtSemana', '=', $segunda)
                                ->where('id_responsavel', '=', $dado->id_responsavel)
                                ->count();
            //dd($registroExiste);
            if($registroExiste == 0){
                //insere

                DB::table('tb_relatorio_cronogramas')->insert(
                    ['id_responsavel' => $dado->id_responsavel,
                     'qtdeAssociada' => $dado->qtdeAssociada,
                     'qtdeFinalizada' => $dado->qtdeFinalizada,
                     'dtSemana' => $segunda]);

            }else{
                //atualiza
                DB::table('tb_relatorio_cronogramas')
                    ->where('dtSemana', '=', $segunda)
                    ->where('id_responsavel', '=', $dado->id_responsavel)
                    ->update(['qtdeAssociada' => $dado->qtdeAssociada,
                                'qtdeFinalizada' => $dado->qtdeFinalizada,
                                'dtAtualizada' => (new Carbon())->format('Y-m-d H:i:s')]);
            }                    
        endforeach;

        //print $segunda . '<br/>';
        //print $proxima_segunda . '<br/>';
        //exit;
        return view('backend.relatorio.tarefa.cronograma.index',compact('arrCronogramas','vSegunda','vSexta'));
    }

    public function listarCronogramasGrafico($id){

        if( Gate::denies('listar_relatorio_cronograma') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listagem de relatórios de Cronograma', 'class'=>'']);
            return redirect()->back();
        } 

        /* Semanas no Mês referente */
            $Dt_primeira        = (new Carbon('first monday of this month', 'America/Sao_Paulo'))->format('Y-m-d');
            $Dt_1_comparacao    = (new Carbon('first monday of this month', 'America/Sao_Paulo'))->addWeek(1)->subDays(3)->format('Y-m-d');
            
            $Dt_segunda         = (new Carbon('first monday of this month', 'America/Sao_Paulo'))->addWeek(1)->format('Y-m-d');
            $Dt_2_comparacao    = (new Carbon('first monday of this month', 'America/Sao_Paulo'))->addWeek(2)->subDays(3)->format('Y-m-d');

            $Dt_terceira        = (new Carbon('first monday of this month', 'America/Sao_Paulo'))->addWeek(2)->format('Y-m-d');
            $Dt_3_comparacao    = (new Carbon('first monday of this month', 'America/Sao_Paulo'))->addWeek(3)->subDays(3)->format('Y-m-d');

            $Dt_quarta          = (new Carbon('first monday of this month', 'America/Sao_Paulo'))->addWeek(3)->format('Y-m-d');
            $Dt_4_comparacao    = (new Carbon('first monday of this month', 'America/Sao_Paulo'))->addWeek(4)->subDays(3)->format('Y-m-d');
        /* Fim Semanas no Mês referente */

        // Trazendo informações do gráfico pizza
            
            // Primeira Semana do Mês
                $cronograma_primeira_semana = DB::table('tb_relatorio_cronogramas')
                    ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                    ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', date('m'))
                    ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', date('Y'))
                    ->whereBetween('tb_relatorio_cronogramas.dtSemana', [$Dt_primeira, $Dt_1_comparacao])
                    ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                    ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                    ->select(
                        'tb_relatorio_cronogramas.idRelatorioCronograma',
                        'tb_relatorio_cronogramas.id_responsavel',
                        'tb_relatorio_cronogramas.qtdeAssociada',
                        'tb_relatorio_cronogramas.qtdeFinalizada',
                        'tb_relatorio_cronogramas.dtSemana',
                        'tb_relatorio_cronogramas.dtAtualizada'
                    )
                    ->orderBy('tb_relatorio_cronogramas.dtSemana')
                    ->first();

                    $tarefas_primeira_abertas = Tarefa::Where('id_responsavel', $id)
                        ->whereMonth('created_at', '=', date('m'))
                        ->whereYear('created_at', '=', date('Y'))
                        ->whereBetween('created_at', [$Dt_primeira, $Dt_1_comparacao])
                        ->count();
                    //dd($tarefas_primeira_abertas);
            //dd($cronograma_primeira_semana);
    
            // Segunda Semana do Mês
                $cronograma_segunda_semana = DB::table('tb_relatorio_cronogramas')
                    ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                    ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', date('m'))
                    ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', date('Y'))
                    ->whereBetween('tb_relatorio_cronogramas.dtSemana', [$Dt_segunda, $Dt_2_comparacao])
                    ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                    ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                    ->select(
                        'tb_relatorio_cronogramas.idRelatorioCronograma',
                        'tb_relatorio_cronogramas.id_responsavel',
                        'tb_relatorio_cronogramas.qtdeAssociada',
                        'tb_relatorio_cronogramas.qtdeFinalizada',
                        'tb_relatorio_cronogramas.dtSemana',
                        'tb_relatorio_cronogramas.dtAtualizada'
                    )
                    ->orderBy('tb_relatorio_cronogramas.dtSemana')
                    ->first();

                $tarefas_segunda_abertas = Tarefa::Where('id_responsavel', $id)
                    ->whereMonth('created_at', '=', date('m'))
                    ->whereYear('created_at', '=', date('Y'))
                    ->whereBetween('created_at', [$Dt_segunda, $Dt_2_comparacao])
                    ->count();
                //dd($tarefas_segunda_abertas);
            //dd($cronograma_segunda_semana); 

            // Terceira Semana do Mês
                $cronograma_terceira_semana = DB::table('tb_relatorio_cronogramas')
                    ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                    ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', date('m'))
                    ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', date('Y'))
                    ->whereBetween('tb_relatorio_cronogramas.dtSemana', [$Dt_terceira, $Dt_3_comparacao])
                    ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                    ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                    ->select(
                        'tb_relatorio_cronogramas.idRelatorioCronograma',
                        'tb_relatorio_cronogramas.id_responsavel',
                        'tb_relatorio_cronogramas.qtdeAssociada',
                        'tb_relatorio_cronogramas.qtdeFinalizada',
                        'tb_relatorio_cronogramas.dtSemana',
                        'tb_relatorio_cronogramas.dtAtualizada'
                    )
                    ->orderBy('tb_relatorio_cronogramas.dtSemana')
                ->first();

                $tarefas_terceira_abertas = Tarefa::Where('id_responsavel', $id)
                    ->whereMonth('created_at', '=', date('m'))
                    ->whereYear('created_at', '=', date('Y'))
                    ->whereBetween('created_at', [$Dt_terceira, $Dt_3_comparacao])
                    ->count();
                //dd($tarefas_terceira_abertas);
            //dd($cronograma_terceira_semana); 

            // Quarta Semana do Mês
                $cronograma_quarta_semana = DB::table('tb_relatorio_cronogramas')
                        ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                        ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', date('m'))
                        ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', date('Y'))
                        ->whereBetween('tb_relatorio_cronogramas.dtSemana', [$Dt_quarta, $Dt_4_comparacao])
                        ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                        ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                        ->select(
                            'tb_relatorio_cronogramas.idRelatorioCronograma',
                            'tb_relatorio_cronogramas.id_responsavel',
                            'tb_relatorio_cronogramas.qtdeAssociada',
                            'tb_relatorio_cronogramas.qtdeFinalizada',
                            'tb_relatorio_cronogramas.dtSemana',
                            'tb_relatorio_cronogramas.dtAtualizada'
                        )
                        ->orderBy('tb_relatorio_cronogramas.dtSemana')
                    ->first();

                $tarefas_quarta_abertas = Tarefa::Where('id_responsavel', $id)
                    ->whereMonth('created_at', '=', date('m'))
                    ->whereYear('created_at', '=', date('Y'))
                    ->whereBetween('created_at', [$Dt_quarta, $Dt_4_comparacao])
                    ->count();
                //dd($tarefas_quarta_abertas);
            //dd($cronograma_quarta_semana); 

        // Fim

        // Trazendo informações do Usuário
            $users = DB::table('users')->where('id', '=', $id)->first();
        // Fim

        // Trazendo informações do Gráfico Grande
            $relatorio_cronograma = DB::table('tb_relatorio_cronogramas')
                ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', date('m'))
                ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', date('Y'))
                ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                ->orderBy('tb_relatorio_cronogramas.dtSemana')
            ->get();
        //dd($relatorio_cronograma); 

        $mes_date = date('F');
        $nome_mes = retornarNomeMes(date('m'));

        return view('backend.relatorio.tarefa.cronograma.grafico',compact(
            'users','relatorio_cronograma',
            'mes_date',
            'tarefas_primeira_abertas', 'tarefas_segunda_abertas',  
            'tarefas_terceira_abertas', 'tarefas_quarta_abertas', 
            'Dt_primeira', 'Dt_segunda', 'Dt_terceira', 'Dt_quarta', 
            'Dt_1_comparacao', 'Dt_2_comparacao', 'Dt_3_comparacao', 'Dt_4_comparacao',
            'cronograma_primeira_semana', 'cronograma_segunda_semana', 
            'cronograma_terceira_semana', 'cronograma_quarta_semana', 'nome_mes'
        ));
    }
    
    public function buscarCronograma(Request $request, $id){
        
        if( Gate::denies('listar_relatorio_cronograma') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listagem de relatórios de Cronograma', 'class'=>'']);
            return redirect()->back();
        }
        
        $mes = $_POST['mes'];
        $ano = $_POST['ano'];
        $mes_date = retornarNomeMesIngles($mes);
        $nome_mes = retornarNomeMes($mes);

        /* Semanas no Mês referente */
            $Dt_primeira        = (new Carbon('first day of '. $mes_date .''. $ano .'', 'America/Sao_Paulo'))->format('Y-m-d');
            $Dt_1_comparacao    = (new Carbon('first monday of '. $mes_date .''. $ano .'', 'America/Sao_Paulo'))->addWeek(1)->subDays(3)->format('Y-m-d');

            $Dt_segunda         = (new Carbon('first monday of '. $mes_date .''. $ano .'', 'America/Sao_Paulo'))->addWeek(1)->format('Y-m-d');
            $Dt_2_comparacao    = (new Carbon('first monday of '. $mes_date .''. $ano .'', 'America/Sao_Paulo'))->addWeek(2)->subDays(3)->format('Y-m-d');
            
            $Dt_terceira        = (new Carbon('first monday of '. $mes_date .''. $ano .'', 'America/Sao_Paulo'))->addWeek(2)->format('Y-m-d');
            $Dt_3_comparacao    = (new Carbon('first monday of '. $mes_date .''. $ano .'', 'America/Sao_Paulo'))->addWeek(3)->subDays(3)->format('Y-m-d');
            
            $Dt_quarta          = (new Carbon('first monday of '. $mes_date .''. $ano .'', 'America/Sao_Paulo'))->addWeek(3)->format('Y-m-d');
            $Dt_4_comparacao    = (new Carbon('last day of '. $mes_date .''. $ano .'', 'America/Sao_Paulo'))->format('Y-m-d');
            //dd($Dt_4_comparacao);
        /* Fim Semanas no Mês referente */

        // Trazendo informações do gráfico pizza
            
            // Primeira Semana do Mês
                $cronograma_primeira_semana = DB::table('tb_relatorio_cronogramas')
                    ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                    ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', $mes)
                    ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', $ano)
                    ->whereBetween('tb_relatorio_cronogramas.dtSemana', [$Dt_primeira, $Dt_1_comparacao])
                    ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                    ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                    ->select(
                        'tb_relatorio_cronogramas.idRelatorioCronograma',
                        'tb_relatorio_cronogramas.id_responsavel',
                        'tb_relatorio_cronogramas.qtdeAssociada',
                        'tb_relatorio_cronogramas.qtdeFinalizada',
                        'tb_relatorio_cronogramas.dtSemana',
                        'tb_relatorio_cronogramas.dtAtualizada'
                    )
                    ->orderBy('tb_relatorio_cronogramas.dtSemana')
                    ->first();

                    $tarefas_primeira_abertas = Tarefa::Where('id_responsavel', $id)
                        ->whereMonth('created_at', '=', $mes)
                        ->whereYear('created_at', '=', $ano)
                        ->whereBetween('created_at', [$Dt_primeira, $Dt_1_comparacao])
                        ->count();
                    //dd($tarefas_primeira_abertas);
            //dd($cronograma_primeira_semana);
    
            // Segunda Semana do Mês
                $cronograma_segunda_semana = DB::table('tb_relatorio_cronogramas')
                    ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                    ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', $mes)
                    ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', $ano)
                    ->whereBetween('tb_relatorio_cronogramas.dtSemana', [$Dt_segunda, $Dt_2_comparacao])
                    ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                    ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                    ->select(
                        'tb_relatorio_cronogramas.idRelatorioCronograma',
                        'tb_relatorio_cronogramas.id_responsavel',
                        'tb_relatorio_cronogramas.qtdeAssociada',
                        'tb_relatorio_cronogramas.qtdeFinalizada',
                        'tb_relatorio_cronogramas.dtSemana',
                        'tb_relatorio_cronogramas.dtAtualizada'
                    )
                    ->orderBy('tb_relatorio_cronogramas.dtSemana')
                    ->first();

                $tarefas_segunda_abertas = Tarefa::Where('id_responsavel', $id)
                    ->whereMonth('created_at', '=', $mes)
                    ->whereYear('created_at', '=', $ano)
                    ->whereBetween('created_at', [$Dt_segunda, $Dt_2_comparacao])
                    ->count();
                //dd($tarefas_segunda_abertas);
            //dd($cronograma_segunda_semana); 

            // Terceira Semana do Mês
                $cronograma_terceira_semana = DB::table('tb_relatorio_cronogramas')
                    ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                    ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', $mes)
                    ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', $ano)
                    ->whereBetween('tb_relatorio_cronogramas.dtSemana', [$Dt_terceira, $Dt_3_comparacao])
                    ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                    ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                    ->select(
                        'tb_relatorio_cronogramas.idRelatorioCronograma',
                        'tb_relatorio_cronogramas.id_responsavel',
                        'tb_relatorio_cronogramas.qtdeAssociada',
                        'tb_relatorio_cronogramas.qtdeFinalizada',
                        'tb_relatorio_cronogramas.dtSemana',
                        'tb_relatorio_cronogramas.dtAtualizada'
                    )
                    ->orderBy('tb_relatorio_cronogramas.dtSemana')
                ->first();

                $tarefas_terceira_abertas = Tarefa::Where('id_responsavel', $id)
                    ->whereMonth('created_at', '=', $mes)
                    ->whereYear('created_at', '=', $ano)
                    ->whereBetween('created_at', [$Dt_terceira, $Dt_3_comparacao])
                    ->count();
                //dd($tarefas_terceira_abertas);
            //dd($cronograma_terceira_semana); 

            // Quarta Semana do Mês
                $cronograma_quarta_semana = DB::table('tb_relatorio_cronogramas')
                        ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                        ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', $mes)
                        ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', $ano)
                        ->whereBetween('tb_relatorio_cronogramas.dtSemana', [$Dt_quarta, $Dt_4_comparacao])
                        ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                        ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                        ->select(
                            'tb_relatorio_cronogramas.idRelatorioCronograma',
                            'tb_relatorio_cronogramas.id_responsavel',
                            'tb_relatorio_cronogramas.qtdeAssociada',
                            'tb_relatorio_cronogramas.qtdeFinalizada',
                            'tb_relatorio_cronogramas.dtSemana',
                            'tb_relatorio_cronogramas.dtAtualizada'
                        )
                        ->orderBy('tb_relatorio_cronogramas.dtSemana')
                    ->first();

                $tarefas_quarta_abertas = Tarefa::Where('id_responsavel', $id)
                    ->whereMonth('created_at', '=', $mes)
                    ->whereYear('created_at', '=', $ano)
                    ->whereBetween('created_at', [$Dt_quarta, $Dt_4_comparacao])
                    ->count();
                //dd($tarefas_quarta_abertas);
            //dd($cronograma_quarta_semana); 

        // Fim

        // Trazendo informações do Gráfico Grande
            $relatorio_cronograma = DB::table('tb_relatorio_cronogramas')
                ->where('tb_relatorio_cronogramas.id_responsavel', '=', $id)
                ->whereMonth('tb_relatorio_cronogramas.dtSemana', '=', $mes)
                ->whereYear('tb_relatorio_cronogramas.dtSemana', '=', $ano)
                ->join('users', 'tb_relatorio_cronogramas.id_responsavel', 'users.id')
                ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                ->orderBy('tb_relatorio_cronogramas.dtSemana')
            ->get();
        //dd($relatorio_cronograma); 
        
        // Trazendo informações do Usuário
            $users = DB::table('users')->where('id', '=', $id)->first();
        // Fim

        return view('backend.relatorio.tarefa.cronograma.grafico',compact(
            'users','relatorio_cronograma',
            'tarefas_primeira_abertas', 'tarefas_segunda_abertas',  
            'mes_date',
            'tarefas_terceira_abertas', 'tarefas_quarta_abertas', 
            'Dt_primeira', 'Dt_segunda', 'Dt_terceira', 'Dt_quarta', 
            'Dt_1_comparacao', 'Dt_2_comparacao', 'Dt_3_comparacao', 'Dt_4_comparacao',
            'cronograma_primeira_semana', 'cronograma_segunda_semana', 
            'cronograma_terceira_semana', 'cronograma_quarta_semana', 'nome_mes'
        ));

    }

    public function listarDocumentos($idequipe){
        
        //dd(array($idequipe));
        $vSetor = SetorUsuario::Where('id', $idequipe)->value('nome');

        $arrDocumentos = DB::table('tb_documentos')
                    ->join('tb_documentos_setores', 'tb_documentos_setores.idDocumento', 'tb_documentos.idDocumento')
                    ->select(
                        'tb_documentos.idDocumento',
                        'tb_documentos.NomeDocumento',
                        'tb_documentos.Descricao',
                        'tb_documentos.Arquivo'
                    )->where('tb_documentos.status', '=', '1')
                    ->where('tb_documentos_setores.idSetor', '=', $idequipe)
                    ->orderBy('tb_documentos.idDocumento', 'ASC')
                    ->get();
        //dd($arrDocumentos);
        return view('backend.relatorio.documentos.index',compact('arrDocumentos','vSetor'));
    }
}
