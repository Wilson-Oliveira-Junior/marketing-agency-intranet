<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use App\Notifications\NewUser;
use App\Notifications\UsuarioCriado;
use Illuminate\Support\Facades\DB;
use Gate;
use Auth;
use App\User;
use App\Tarefa;
use App\Cliente;
use App\Sugestao;

class SugestaoController extends Controller{
    

    public function index(){
        $sugestoes = DB::table('tb_sugestoes')
            ->leftJoin('users', 'tb_sugestoes.id_usuario', '=', 'users.id')
            ->select(
                'users.id           as id_usuario',
                'users.name         as nome_usuario',
                'users.email        as email_usuario',	
                'users.image        as imagem_usuario',
                
                'tb_sugestoes.id    as id',
                'tb_sugestoes.id_usuario',
                'tb_sugestoes.titulo as titlo_sugestao',
                'tb_sugestoes.titulo as descricao_sugestao'
            )
            ->paginate(20);

        /* Funções do Dashboard */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Funções do Dashboard */ 

        return view('backend.sugestao.index',compact('sugestoes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function adicionar(){
        $sugestoes = Sugestao::all();
        $usuarios = User::all();

        /* Funções do Dashboard */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Funções do Dashboard */

        return view('backend.sugestao.adicionar', compact('usuarios', 'sugestoes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function salvar(Request $request){
        $dados = $request->all();

        $sugestao = new Sugestao();
        $sugestao->id_usuario       = $dados['id_usuario'];
        $sugestao->descricao        = $dados['descricao'];
        $sugestao->save();

        \Session::flash('flash_mensagem', ['msg'=>'Sugestão adicionada com sucesso. Você faz parte da evolução da intranet !', 'class'=>'border-color: #009c5b;background-color: #009c5b;']);

        return redirect()->route('backend.principal');
    }

    public function editar($id){
        $sugestoes = Sugestao::find($id);
        $usuarios = User::all();

        // Definindo a política
        $this->authorize('editar_sugestao', $sugestoes);

        /* Funções do Dashboard */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Funções do Dashboard */ 

        return view('backend.sugestao.editar', compact('sugestoes' ,'usuarios', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function atualizar(Request $request, $id){  
        $sugestoes  	        = Sugestao::find($id);

        $dados                  = $request->all();

        $sugestoes->id_usuario       = $dados['id_usuario'];
        $sugestoes->titulo           = $dados['titulo'];
        $sugestoes->descricao        = $dados['descricao'];

        $sugestoes->Update();

        return redirect()->route('backend.sugestao');
    }

    public function deletar($id){
        $sugestoes = Sugestao::find($id);
        $sugestoes->delete();
        return redirect()->route('backend.sugestao');
    }

    public function rolesPermission(){

        $nameUser = auth()->user()->name;
        var_dump("<h1>{$nameUser}</h1>");

        foreach( auth()->user()->roles as $role ){
            echo $role->name;
            $permissions = $role->permissions;
            foreach( $permissions as $permission ){
                echo "<hr>";
                echo $permission->name;
            }
        }
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
