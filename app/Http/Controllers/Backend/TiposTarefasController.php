<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Gate;
use App\TiposTarefa;
use App\Cliente;
use App\Lembrete;
use App\Tarefa;
use App\User;
use Illuminate\Support\Facades\Input;
use Auth;


class TiposTarefasController extends Controller{
    
    public function busca(Request $request){
        $nome = $_POST['busca-tipotarefa'];
        $tipostarefas = TiposTarefa::where([
                ['nome', 'LIKE', '%' . $nome . '%'],
        ])->paginate(10);        
        
        return view('backend.tipotarefa.index', compact('tipostarefas'));
    }

    public function index(){
        $tipostarefas           = TiposTarefa::paginate(20);

        if( Gate::denies('listar_tipo_tarefa') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listar os tipos de usuários', 'class'=>'']);
            return redirect()->back();
        }

        
        
        return view('backend.tipotarefa.index',compact('tipostarefas'));
    }

    public function adicionar(){
        $tipostarefas           = TiposTarefa::all();

        if( Gate::denies('adicionar_tipo_tarefa') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar o tipo de usuário', 'class'=>'']);
            return redirect()->back();
        }

        
        return view('backend.tipotarefa.adicionar', compact('tipostarefas'));
    }

    public function salvar(Request $request){
        $dados                      = $request->all();
        $tipostarefas               = new TiposTarefa();
        $tipostarefas->nome         = $dados['nome'];
        $tipostarefas->estimativa   = $dados['estimativa'];
        $tipostarefas->save();
        return redirect()->route('backend.tipotarefa');
    }

    public function editar($id){
        $tipostarefas           = TiposTarefa::find($id);

        if( Gate::denies('editar_tipo_tarefa') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar o tipo de usuário', 'class'=>'']);
            return redirect()->back();
        }

        
        return view('backend.tipotarefa.editar', compact('tipostarefas'));
    }

    public function atualizar(Request $request, $id){  
        $tipostarefas  	            = TiposTarefa::find($id);
        $dados                      = $request->all();
        $tipostarefas->nome         = $dados['nome'];
        $tipostarefas->estimativa   = $dados['estimativa'];
        $tipostarefas->Update();
        return redirect()->route('backend.tipotarefa');
    }

    public function deletar($id){
        $tipostarefas = TiposTarefa::find($id);

        if( Gate::denies('deletar_tipo_tarefa') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para deletar o tipo de usuário', 'class'=>'']);
            return redirect()->back();
        }

        $tipostarefas->delete();
        return redirect()->route('backend.tipotarefa');
    }

    public function mudarStatus(){

        $id = Input::get('id');

        if( Gate::denies('mudar_status_tipotarefa') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para mudar o status do tipo da tarefa', 'class'=>'']);
            return redirect()->back();
        }

        $tipotarefa = TiposTarefa::findOrFail($id);
        $tipotarefa->status = !$tipotarefa->status;
        $tipotarefa->save();

        return response()->json($tipotarefa);
    }
}
