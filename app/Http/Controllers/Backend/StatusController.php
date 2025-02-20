<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Gate;
use App\Status;
use App\Cliente;
use App\Lembrete;
use App\Tarefa;
use App\User;
use Auth;

class StatusController extends Controller
{
    public function busca(Request $request){
        $nome = $_POST['busca-status'];
        $status = Status::where([
                ['nome', 'LIKE', '%' . $nome . '%'],
        ])->paginate(20);        
        $lembretes_entregue     = self::LembreteEntregue();
        $quantidade_clientes    = self::QuantidadeClientes();
        $quantidade_usuarios    = self::QuantidadeUsuarios();
        $quantidade_lembrete    = self::QuantidadeLembrete();

        return view('backend.status.index', compact('status', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function index(){        
        $status = Status::paginate(20);

        if( Gate::denies('listar_status') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para acessar a listagem de status', 'class'=>'']);
            return redirect()->back();
        } 

        $lembretes_entregue     = self::LembreteEntregue();
        $quantidade_clientes    = self::QuantidadeClientes();
        $quantidade_usuarios    = self::QuantidadeUsuarios();
        $quantidade_lembrete    = self::QuantidadeLembrete();

        return view('backend.status.index',compact('status', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function adicionar(){
        $status = Status::all();

        if( Gate::denies('adicionar_status') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar Status', 'class'=>'']);
            return redirect()->back();
        } 

        $lembretes_entregue     = self::LembreteEntregue();
        $quantidade_clientes    = self::QuantidadeClientes();
        $quantidade_usuarios    = self::QuantidadeUsuarios();
        $quantidade_lembrete    = self::QuantidadeLembrete();

        return view('backend.status.adicionar', compact('status' , 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function salvar(Request $request){
        $dados = $request->all();
        
        $status = new Status();
        
        $status->nome           = $dados['nome'];
        $status->descricao      = $dados['descricao'];
        $status->status         = $dados['status'];
        $status->save();

        return redirect()->route('backend.status');
    }

    public function editar($id){
        $status = Status::find($id);

        if( Gate::denies('editar_status') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar o Status', 'class'=>'']);
            return redirect()->back();
        } 

        $lembretes_entregue     = self::LembreteEntregue();
        $quantidade_clientes    = self::QuantidadeClientes();
        $quantidade_usuarios    = self::QuantidadeUsuarios();
        $quantidade_lembrete    = self::QuantidadeLembrete();
        return view('backend.status.editar', compact('status', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function atualizar(Request $request, $id){  
        $status  	            = Status::find($id);
        $dados                  = $request->all();
        $status->nome           = $dados['nome'];
        $status->descricao      = $dados['descricao'];
        $status->status         = $dados['status'];
        $status->Update();
        return redirect()->route('backend.status');
    }

    public function deletar($id){
        $status = Status::find($id);

        if( Gate::denies('deletar_status') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para excluir o Status', 'class'=>'']);
            return redirect()->back();
        } 

        $status->delete();
        return redirect()->route('backend.status');
    }

    /* Funções do Dashboard */
        function LembreteEntregue(){
            $usuario_id = auth()->user()->id;
            $lembretes_entregue = Tarefa::Where('id_responsavel', $usuario_id)->where('status', '=', 'Finalizado')->count();
            return $lembretes_entregue;
        }
        function QuantidadeClientes(){
            $quantidade_clientes = Cliente::count();
            return $quantidade_clientes;
        }
        function QuantidadeUsuarios(){
            $quantidade_usuarios = User::count();
            return $quantidade_usuarios;
        }
        function QuantidadeLembrete(){
            $usuario_id = auth()->user()->id;
            $quantidade_lembrete = Tarefa::Where('id_responsavel', $usuario_id)->count();
            return $quantidade_lembrete;
        }
    /* Fim Funções do Dashboard */

}
