<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\User;
use App\Segmento;
use App\Tarefa;
Use App\Cliente;

class SegmentoController extends Controller
{
    
    public function index(){
        $segmentos = Segmento::all();

        if( Gate::denies('listar_segmentos') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão listar os segmentos', 'class'=>'']);
            return redirect()->back();
        }

        // ID segmento do usuário logado
            $usuario_id = auth()->user()->id;

        /* Graças */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Fim das Graças*/

        return view('backend.segmento.index',compact('segmentos', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function adicionar(){
        $segmentos = Segmento::all();

        if( Gate::denies('adicionar_segmento') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão listar os segmentos', 'class'=>'']);
            return redirect()->back();
        }

        // ID segmento do usuário logado
        $usuario_id = auth()->user()->id;

        /* Graças */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Fim das Graças*/

        return view('backend.segmento.adicionar', compact('segmentos', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function salvar(Request $request){
        $dados = $request->all();

        if( Gate::denies('adicionar_segmento') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão listar os segmentos', 'class'=>'']);
            return redirect()->back();
        }

        $segmentos = new Segmento();

        $segmentos->nome            = $dados['nome'];     
        $segmentos->save();

        return redirect()->route('backend.segmento');
    }

    public function editar($id){
        $segmentos = Segmento::find($id);

        if( Gate::denies('editar_segmento') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão listar os segmentos', 'class'=>'']);
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

        return view('backend.segmento.editar', compact('segmentos', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function atualizar(Request $request, $id){  

        $segmentos  	= Segmento::find($id);
        $dados      = $request->all();
        
        if( Gate::denies('editar_segmento') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão listar os segmentos', 'class'=>'']);
            return redirect()->back();
        }

		$segmentos->nome            = $dados['nome'];
        $segmentos->Update();

        return redirect()->route('backend.segmento');
    }

    public function deletar($id){

        $segmentos = Segmento::find($id);

        if( Gate::denies('deletar_segmento') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão listar os segmentos', 'class'=>'']);
            return redirect()->back();
        }

        $segmentos->delete();

        return redirect()->route('backend.segmento');
    }

    /* Segmentos (Json) */
        public function segmentosAtuais(){
                
            $segmentos  = Segmento::orderBy('nome')
            ->select(
                'tb_segmentos.id as segmento_id',
                'tb_segmentos.nome as segmento_nome'
            )
            ->get();

            header('Content-Type: text/html; charset=utf-8');
            echo json_encode($segmentos);
            
            return view('backend.segmento.json.segmentoTotal', compact('tiposArray'));
        }
    /* Fim Segmentos */

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
