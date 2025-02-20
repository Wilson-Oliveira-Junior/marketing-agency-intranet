<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\SetorUsuario;
use App\User;
use App\Lembrete;
use App\Tarefa;
Use App\Cliente;

class SetorController extends Controller
{
    
    public function index(){
        $setores = SetorUsuario::all();

        if( Gate::denies('listar_setores') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão listar os setores', 'class'=>'']);
            return redirect()->back();
        }

        // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

        /* Graças */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Fim das Graças*/

        return view('backend.setor.index',compact('setores', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function adicionar(){
        $setores = SetorUsuario::all();

        // ID Setor do usuário logado
        $usuario_id = auth()->user()->id;

        /* Graças */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Fim das Graças*/

        return view('backend.setor.adicionar', compact('setores', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function salvar(Request $request){
        $dados = $request->all();
        $setores = new SetorUsuario();

        $setores->nome            = $dados['nome'];    
        $setores->email           = $dados['email'];    
        $setores->descricao       = $dados['descricao'];    
        
        $setores->save();

        \Session::flash('flash_message', [
            'msg' => "Campanha Adicionada com sucesso !!!",
            'class' => "alert-success"
        ]);

        return redirect()->route('backend.setor');
    }

    public function editar($id){
        $setores = SetorUsuario::find($id);

        if( Gate::denies('editar_setores') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar o setor', 'class'=>'']);
            return redirect()->back();
        }

        // ID Setor do usuário logado
        $usuario_id = auth()->user()->id;

        /* Graças */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Fim das Graças*/

        return view('backend.setor.editar', compact('setores', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function atualizar(Request $request, $id){  

        $setores  	= SetorUsuario::find($id);
        $dados      = $request->all();
        
		$setores->nome            = $dados['nome'];    
        $setores->email           = $dados['email'];    
        $setores->descricao       = $dados['descricao'];    
        
        $setores->Update();
        return redirect()->route('backend.setor');
    }

    public function deletar($id){

        if( Gate::denies('deletar_setores') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para deletar o setor', 'class'=>'']);
            return redirect()->back();
        }

        $setores = SetorUsuario::find($id);
        $setores->delete();

        \Session::flash('flash_message', [
            'msg' => "Campanha Deletada com sucesso !!!",
            'class' => "alert-success"
        ]);

        return redirect()->route('backend.setor');
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
