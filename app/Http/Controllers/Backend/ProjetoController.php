<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Gate;
use App\Projeto;
use App\Cliente;
use App\Lembrete;
use App\User;
use App\Tarefa;
use App\TipoProjeto;
use App\ClienteDominio;
use Auth;

class ProjetoController extends Controller{
    
    public function busca(Request $request){
        $nome = $_POST['busca-projeto'];

        $projetos = DB::table('tb_projetos')
            ->where([
                ['tb_projetos.projeto', 'LIKE', '%' . $nome . '%']
            ])->orWhere(
                [
                    ['clientes.nome', 'LIKE', '%' . $nome . '%']
                ]   
            )
            ->leftJoin('clientes', 'clientes.cliente_id', '=', 'tb_projetos.cliente_id')
            ->select(	
                'tb_projetos.id         as id',
                'tb_projetos.projeto    as projeto',
                'clientes.nome          as nome_cliente',		
                'tb_projetos.status     as status'
            )
        ->paginate(20);

        $lembretes_entregue     = self::LembreteEntregue();
        $quantidade_clientes    = self::QuantidadeClientes();
        $quantidade_usuarios    = self::QuantidadeUsuarios();
        $quantidade_lembrete    = self::QuantidadeLembrete();

        return view('backend.projeto.index', compact('projetos', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function index(){
        $projetos = DB::table('tb_projetos')
            ->leftJoin('clientes', 'clientes.cliente_id', '=', 'tb_projetos.cliente_id')
            ->select(	
                'tb_projetos.id         as id',
                'tb_projetos.projeto    as projeto',
                'clientes.nome          as nome_cliente',		
                'tb_projetos.status     as status'
            )
            ->paginate(20);  
            
        if( Gate::denies('listar_projetos') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listar os Projetos', 'class'=>'']);
            return redirect()->back();
        } 
        
        return view('backend.projeto.index',compact('projetos', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function adicionar(){
        $projetos = Projeto::all();
        $clientes = Cliente::all();
        $tipos_projetos = TipoProjeto::all();

        if( Gate::denies('adicionar_projetos') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar Projeto', 'class'=>'']);
            return redirect()->back();
        } 
        
        return view('backend.projeto.adicionar', compact('tipos_projetos','clientes' ,'projetos', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function salvar(Request $request){
        $dados = $request->all();
        $projetos = new Projeto();
        
        //dd($dados);

        $projetos->id_tipo_projeto  = $dados['id_tipo_projeto'];

        // Configurando o nome
        $nome_produto = TipoProjeto::Where('id', '=', $dados['id_tipo_projeto'])->value('nome');
        $projetos->projeto          = $nome_produto;

        $projetos->cliente_id       = $dados['cliente_id'];
        $projetos->status           = $dados['status'];
        
        $projetos->save();
        return redirect()->route('backend.projeto');
    }

    public function editar($id){
        $projetos = Projeto::find($id);
        
        $tipos_projetos = TipoProjeto::all();
        $clientes = Cliente::OrderBy('nome')->where('status', '=', true)->get();
        //Pegar os domínios relacionados ao cliente.
        $idCliente    =   Cliente::Where('cliente_id', '=', $projetos->cliente_id)->value('id');
        $idDominio    =    isset($projetos->id_dominio)?$projetos->id_dominio:0;

        $clientedominios = ClienteDominio::Where('id_cliente', '=', $idCliente)->get();
        //dd($clientedominios);

        if( Gate::denies('editar_projeto') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar um Projeto', 'class'=>'']);
            return redirect()->back();
        } 

        return view('backend.projeto.editar', compact('tipos_projetos','clientes' ,'projetos', 'clientedominios', 'idCliente','idDominio'));
    }

    public function atualizar(Request $request, $id){  
        $projetos  	            = Projeto::find($id);
        $dados                  = $request->all();

        $projetos->id_tipo_projeto  = $dados['id_tipo_projeto'];
        // Configurando o nome
        $nome_produto               = TipoProjeto::Where('id', '=', $dados['id_tipo_projeto'])->value('nome');
        $projetos->projeto          = $nome_produto;
        $projetos->cliente_id       = $dados['cliente_id'];
        $projetos->status           = $dados['status'];
        $projetos->id_dominio       = $dados['id_dominio'];
        $projetos->Update();

        \Session::flash('flash_mensagem', ['msg'=>'Projeto Atualizado com Sucesso', 'class'=>'background-color: #11d482;border-color: #11d482;']);
        
        return redirect()->route('backend.projeto');
    }

    public function deletar($id){
        $projetos = Projeto::find($id);

        if( Gate::denies('deletar_projeto') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para deletar um Projeto', 'class'=>'']);
            return redirect()->back();
        }

        $projetos->delete();
        return redirect()->route('backend.projeto');
    }

    /* Tipo de Projetos (CRUD + BUSCA) */

        public function indexTipoProjeto(){

            /* Funções do Dashboard */
                $lembretes_entregue     = self::LembreteEntregue();
                $quantidade_clientes    = self::QuantidadeClientes();
                $quantidade_usuarios    = self::QuantidadeUsuarios();
                $quantidade_lembrete    = self::QuantidadeLembrete();
            /* Fim Funções do Dashboard */

            /* Permissão */
                if( Gate::denies('listar_tipo_projeto') ){
                    \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listar os Tipos de Projetos', 'class'=>'']);
                    return redirect()->back();
                }
            /* Fim Permissão */

            $tipos_projetos = DB::table('tb_tipo_projetos')->paginate(20); 
            
            return view('backend.tipo-projeto.index',compact('tipos_projetos', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function adicionarTipoProjeto(){

            /* Funções do Dashboard */
                $lembretes_entregue     = self::LembreteEntregue();
                $quantidade_clientes    = self::QuantidadeClientes();
                $quantidade_usuarios    = self::QuantidadeUsuarios();
                $quantidade_lembrete    = self::QuantidadeLembrete();
            /* Fim Funções do Dashboard */

            /* Permissão */
                if( Gate::denies('adicionar_tipo_projeto') ){
                    \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar Tipo de Projeto', 'class'=>'']);
                    return redirect()->back();
                }
            /* Fim Permissão */

            $tipos_projetos = TipoProjeto::all();
            
            return view('backend.tipo-projeto.adicionar', compact('tipos_projetos', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function salvarTipoProjeto(Request $request){
            
            /* Permissão */
                if( Gate::denies('adicionar_tipo_projeto') ){
                    \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar Tipo de Projeto', 'class'=>'']);
                    return redirect()->back();
                }
            /* Fim Permissão */

            $dados = $request->all();
            $tipos_projetos = new TipoProjeto();

            $tipos_projetos->nome       = $dados['nome'];
            $tipos_projetos->descricao  = $dados['descricao'];
            $tipos_projetos->status     = $dados['status'];
            $tipos_projetos->save();

            return redirect()->route('backend.tipo-projeto');
        }

        public function editarTipoProjeto($id){

            /* Funções do Dashboard */
                $lembretes_entregue     = self::LembreteEntregue();
                $quantidade_clientes    = self::QuantidadeClientes();
                $quantidade_usuarios    = self::QuantidadeUsuarios();
                $quantidade_lembrete    = self::QuantidadeLembrete();
            /* Fim Funções do Dashboard */

            /* Permissão */
                if( Gate::denies('editar_tipo_projeto') ){
                    \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar um Projeto', 'class'=>'']);
                    return redirect()->back();
                } 
            /* Fim Permissão */
            
            $tipos_projetos = TipoProjeto::find($id);

            return view('backend.tipo-projeto.editar', compact('tipos_projetos', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function atualizarTipoProjeto(Request $request, $id){  
            
            /* Permissão */
                if( Gate::denies('editar_tipo_projeto') ){
                    \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar um Projeto', 'class'=>'']);
                    return redirect()->back();
                } 
            /* Fim Permissão */
            
            $dados                      = $request->all();
            $tipos_projetos  	        = TipoProjeto::find($id);

            $tipos_projetos->nome       = $dados['nome'];
            $tipos_projetos->descricao  = $dados['descricao'];
            $tipos_projetos->status     = $dados['status'];

            $tipos_projetos->Update();

            return redirect()->route('backend.tipo-projeto');
        }

        public function deletarTipoProjeto($id){

            $tipos_projetos = TipoProjeto::find($id);

            if( Gate::denies('deletar_tipo_projeto') ){
                \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para deletar um Tipo de Projeto', 'class'=>'']);
                return redirect()->back();
            }

            $projetos->delete();
            return redirect()->route('backend.tipo-projeto');
        }

    /* Tipo de Projetos (CRUD + BUSCA) */

    /* Json */
        public function listagemTipo(){
                
                $tipos_projetos  = TipoProjeto::Where('status', '=', 'Ativo')
                    ->select(
                        'tb_tipo_projetos.id as id_tipo_projeto',
                        'tb_tipo_projetos.nome as nome_tipo_projeto',
                        'tb_tipo_projetos.descricao as descricao_tipo_projeto',
                        'tb_tipo_projetos.status as status_tipo_projeto'
                    )
                    ->orderBy('tb_tipo_projetos.nome')
                    ->get();

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($tipos_projetos);
                
                return view('backend.tipo-projeto.json.listagemTipo', compact('tipos_projetos'));
            }
    /* Fim do Json */

    /* Fim de Tipo de Projetos */

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
