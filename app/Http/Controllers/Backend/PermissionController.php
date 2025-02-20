<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\User;
use App\Tarefa;
Use App\Cliente;

class PermissionController extends Controller{
    
    public function index(){
        $permissoes = Permission::all();

        // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

        /* Graças */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Fim das Graças*/

        return view('backend.permissao.index',compact('permissoes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function adicionar(){
        $permissoes = Permission::all();
        
        // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

        /* Graças */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Fim das Graças*/

        return view('backend.permissao.adicionar', compact('permissoes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }
    
    public function salvar(Request $request){
        $dados = $request->all();

        $permissoes = new Permission();
        $permissoes->name            = $dados['name'];
        $permissoes->label           = $dados['label'];
        $permissoes->save();

        return redirect()->route('backend.permissao');
    }

    public function editar($id){
        $permissoes = Permisson::find($id);

        // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

        /* Graças */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Fim das Graças*/

        return view('backend.permissao.editar', compact('permissoes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function atualizar(Request $request, $id){  
        $permissoes  	        = Permission::find($id);
        $dados                  = $request->all();
        $permissoes->name       = $dados['name'];
        $permissoes->label      = $dados['label'];
        $permissoes->Update();
        return redirect()->route('backend.permissao');
    }

    public function deletar($id){
        $permissoes = Permission::find($id);
        $permissoes->delete();
        return redirect()->route('backend.permissao');
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
