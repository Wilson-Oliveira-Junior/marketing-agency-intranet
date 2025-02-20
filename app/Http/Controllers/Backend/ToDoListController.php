<?php

namespace App\Http\Controllers\Backend;

use App\ComentarioProjeto;
use App\Events\FinalizaPauta;
use App\Events\NovaPauta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PautaObservacaoFormRequest;
use App\SetorUsuario;
use App\ToDoList;
use App\ToDoListCompartilhado;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ToDoListController extends Controller
{
    private $intPaginacao = 20;

    public function index(Request $request){

        $dados = $request->all();
        //dd($dados);
        //dd(empty($dados));
        if(empty($dados)){
            $vStatus = true;
            $vPraMim = false;
            $vQueCriei = false;
            $vMeuSetor = false;
            $vCompartilhado = false;
            $vTodos = false;
            $filtrar = false;
        }else{
            $vPraMim = ($dados['pramim'] === 'true');
            $vQueCriei = ($dados['quecriei'] === 'true');
            $vMeuSetor = ($dados['meusetor'] === 'true');
            $vTodos = ($dados['todos'] === 'true');
            $vCompartilhado = ($dados['compartilhado'] === 'true');
            $vStatus = ($dados['abertas'] === 'true')?true:false;
            $filtrar = true;
            /*print_r($dados);
            echo 'Status: ' . $vStatus . '<br/>';
            echo 'Pra mim: ' . $vPraMim . '<br/>';
            echo 'Que criei: ' . $vQueCriei . '<br/>';
            echo 'Setor: ' . $vMeuSetor . '<br/>';
            echo 'Todos: ' . $vTodos . '<br/>';*/
            //$vFinalizadas = (bool)$dados['finalizadas'];
            //dd($dados);
        }
        $setor = SetorUsuario::find(Auth::user()->setor);

        //if($filtro == "false"){ $filtro = false;}else{$filtro = true;}
        //if($status == "false" || $status === false){ $status = false;}else{$status = true;}
        if(!$vStatus){
            $orderby = 't.data_finalizado';
            $order = 'DESC';
            $orderby_2 = 't.idUrgencia';
            $order_2 = 'DESC';
        }else{
            $orderby = 't.idUrgencia';
            $order = 'ASC';
            $orderby_2 = 't.created_at';
            $order_2 = 'ASC';
        }
        //var_dump($status);
        //dd($filtro);
        //DB::connection()->enableQueryLog();
        $vPautas = ToDoList::from('tbToDoList as t')->where('t.excluido', 0)
                ->join('users as u','u.id', 't.idresponsavel')
                ->leftJoin('tbToDoList_Compartilhados as tdc', 't.id', 'tdc.id_todolist')
                ->when($vStatus, function ($vPautas) {
                    return $vPautas->where('t.status', 0);
                }, function($vPautas){
                    return $vPautas->where('t.status', 1);
                })
                ->when($vPraMim, function ($vPautas) {
                    return $vPautas->where('t.idresponsavel', Auth::id());
                }, function($vPautas) use ($vMeuSetor, $vTodos, $vQueCriei, $vCompartilhado){
                    if(!$vMeuSetor && !$vTodos && !$vQueCriei && !$vCompartilhado){
                        return $vPautas->where('t.idresponsavel', Auth::id());
                    }
                })
                ->when($vQueCriei, function ($vPautas) {
                    return $vPautas->where('t.idcriadopor', Auth::id());
                })
                ->when($vMeuSetor, function ($vPautas) {
                    return $vPautas->where('u.setor', Auth::user()->setor);
                })
                ->when($vCompartilhado, function($vPautas){
                    return $vPautas->where('tdc.id_usuario', Auth::id());
                })
                ->select('t.id', 't.idUrgencia', 't.titulo', 't.data_desejada',
                        't.status', 't.comentario', 't.idprojeto', 't.idcriadopor', 't.idresponsavel')
                ->groupBy('t.id', 't.idUrgencia', 't.titulo', 't.data_desejada',
                't.status', 't.comentario', 't.idprojeto', 't.idcriadopor', 't.idresponsavel', 't.created_at',
                't.data_finalizado')
                ->orderBy($orderby, $order)->orderBy($orderby_2, $order_2)->paginate($this->intPaginacao);
        if($request->ajax()){
            return view('backend.pautas.pautas', compact('vPautas'))->render();
        }
        if($filtrar){
            //$queries = DB::getQueryLog();
            //dd($queries);
            return view('backend.pautas.pautas', compact('vPautas'));
        }
        //dd($vPautas);
        return view('backend.pautas.pra_mim.index', compact('vPautas', 'setor'));
    }

    public function salvar(Request $request){
        $dados = $request->all();

        //dd($dados);

        $insPauta = new ToDoList();
        $insPauta->idUrgencia = $dados['urgencia'];
        $insPauta->titulo = $dados['titulo'];
        $insPauta->idprojeto = $dados['projetopauta'];
        $insPauta->idcriadopor = Auth::id();
        $insPauta->idresponsavel = $dados['idresponsavel_pauta'];
        $insPauta->data_desejada = (isset($dados['datadesejada-tarefa']))?$dados['datadesejada-tarefa']:date('Y-m-d');
        $insPauta->save();

		//if($dados['urgencia'] == 1 || $dados['urgencia'] == 2){
        $evento = new NovaPauta($insPauta);
        event($evento);
		//}

        if(isset($dados['idusuariocompartilhado'])){
            $arrUsuarios = $dados['idusuariocompartilhado'];
            if(in_array(Auth::id(), $arrUsuarios)){
                $chave = array_search(Auth::id(), $arrUsuarios);
                if($chave !== false){
                    unset($arrUsuarios[$chave]);
                }
            }
            foreach($arrUsuarios as $usuario){

                $usuarios = ToDoListCompartilhado::UpdateOrCreate(
                    ['id_todolist' => $insPauta->id,
                    'id_usuario' => $usuario],
                    ['id_usuario' => $usuario]
                );
            }

        }

        return $insPauta;
    }

    public function finalizar(int $id){

        //dd($id);

        $pauta = ToDoList::find($id);
        $pauta->status = true;
        $pauta->data_finalizado = date('Y-m-d H:i:s');
        $pauta->idfinalizadopor = Auth::id();
        $pauta->update();

        if($pauta->idcriadopor != Auth::id() ){
            $evento = new FinalizaPauta($pauta);
            event($evento);
        }

        return response()->json($pauta);
    }

    public function registrarProjeto(PautaObservacaoFormRequest $requestPauta){

        $dados = $requestPauta->all();

        $cbProjeto = isset($dados['ck_registrar_projeto'])?true:false;
        $pauta = ToDoList::find($dados['idpauta']);

        $pauta->status = true;
        $pauta->data_finalizado = date('Y-m-d H:i:s');
        $pauta->idfinalizadopor = Auth::id();
        $pauta->incluir_historico = $cbProjeto;
        $pauta->comentario = $dados['observacao'];
        $pauta->update();

        if($pauta->idcriadopor != Auth::id() ){
            $evento = new FinalizaPauta($pauta);
            event($evento);
        }

        if($cbProjeto){
            $comentarioProjeto = new ComentarioProjeto();
            $comentarioProjeto->id_usuario = Auth::id();
            $comentarioProjeto->id_projeto = $pauta->idprojeto;
            $comentarioProjeto->comentario = $dados['observacao'];
            $comentarioProjeto->created_at = date('Y-m-d H:i:s');
            $comentarioProjeto->updated_at = date('Y-m-d H:i:s');
            $comentarioProjeto->tipo = 'E';
            $comentarioProjeto->save();
        }

        return response()->json($pauta);
    }

	public function fnPautasCron(){

        $hoje = (new Carbon())->format('Y-m-d');

        $vPautas = ToDoList::where('status', 0)
            ->where('data_desejada', '<=', $hoje)
            ->get();
        //dd($vPautas);
        foreach($vPautas as $vpauta){
            //dd($pauta->responsavel->email);
            //echo 'Responsavel: ' . $vpauta->responsavel->name . '<br>';
            //echo 'Responsavel: ' . $vpauta->responsavel->sobrenome . '<br>';
            //echo 'Responsavel: ' . $vpauta->responsavel->email . '<br>';
            //echo 'ID: ' . $vpauta->id . '<br>';
            $eventopauta = new NovaPauta($vpauta);
            event($eventopauta);
        }
        //dd('ok');
    }
}
