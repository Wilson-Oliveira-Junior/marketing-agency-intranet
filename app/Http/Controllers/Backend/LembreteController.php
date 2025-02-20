<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Notifications\LembreteMail;
use App\Lembrete;
use App\Cliente;
use App\SetorUsuario;
use App\Comentario_Lembrete;
use App\User;
use Auth;

class LembreteController extends Controller{

    use Notifiable;

    public function busca(Request $request){
        
        $busca = $_POST['busca-lembrete'];

        $lembretes = Lembrete::where([['titulo', 'LIKE', '%' . $busca . '%'],])->paginate(10);

        $usuario_setor = auth()->user()->setor_usuario_id;
        
        $usuario_id = auth()->user()->id;
            
        /* Graças */
            $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
            $quantidade_clientes = Cliente::count();
            $quantidade_usuarios = User::count();
            $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
        /* Fim das Graças*/
        
        return view('backend.lembrete.index',compact('lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    /*================== COMEÇO DO CRUD ==================*/
        public function index(){    
            
            date_default_timezone_set('America/Sao_Paulo');

            // ID Setor do usuário logado
            $usuario_setor = auth()->user()->setor;
            
            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

            $lembretes = Lembrete::Where('usuario_id', $usuario_id)
                ->where('concluido', '=', 'N')
                ->leftJoin('clientes', 'lembretes.cliente_id', '=', 'clientes.id')
                ->select(
                    'lembretes.id',
                    'lembretes.concluido',
                    'lembretes.titulo',
                    'lembretes.data',
                    'clientes.nome as nome_cliente'
                )
                ->orderBy('lembretes.id', 'DESC')
                ->paginate(15);
            
            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/

            return view('backend.lembrete.index',compact('lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function adicionar(){
            
            date_default_timezone_set('America/Sao_Paulo');
            
            $clientes = Cliente::orderBy('nome')->get();
            $setores = SetorUsuario::all();
            $usuarios = User::all();
            $lembretes = Lembrete::all();
            
            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/

            return view('backend.lembrete.adicionar', compact('clientes', 'setores', 'usuarios', 'lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function salvar(Request $request){
            $dados = $request->all();
            $lembretes = new Lembrete();
            $lembretes->postou_id     = $dados['postou_id'];
            $lembretes->setor_id      = $dados['setor_id'];
            $lembretes->usuario_id    = $dados['usuario_id'];
            $lembretes->cliente_id    = $dados['cliente_id'];
            $lembretes->data          = $dados['data'];
            $lembretes->hora          = $dados['hora'];
            $lembretes->notificar     = $dados['notificar'];
            $lembretes->importancia   = $dados['importancia'];
            $lembretes->titulo        = $dados['titulo'];
            $lembretes->mensagem      = $dados['mensagem'];            

            /*======= Selecionando somente o Usuário =======*/
                if($lembretes->setor_id == null){
                    $lembretes->setor_id = DB::table('users')->where('id', '=', $lembretes->usuario_id)->value('setor');
                }
            /*======= Fim Selecionando somente o Usuário =======*/

            /*======= Configurando o e-mail caso o usuário é NULL =======*/
                if($lembretes->usuario_id == null){
                    $lembretes->email     = DB::table('setor_usuarios')->where('id', $lembretes->setor_id)->value('email');
                }else{
                    $lembretes->email     = DB::table('users')->where('id', $lembretes->usuario_id)->value('email');
                }
            /*======= Fim Configurando o e-mail caso o usuário é NULL =======*/

            /*======= Verificando a data e hora =======*/                
                if($lembretes->data == null){
                    $lembretes->data  = date( 'Y-m-d');
                    $lembretes->hora  = date( 'H:i');
                }else{
                    $lembretes->data  = $dados['data'];
                    $lembretes->hora  = $dados['hora'];
                }
                //dd($lembretes->data);
            /*======= Fim Verificando a data e hora =======*/
            
            $lembretes->save();

            /*======= Enviando Notificação ao Destinário do Lembrete =======*/
                if($lembretes->notificar == 'e-mail'){
                    $lembretes->notify(new LembreteMail());
                }else{
        
                }
            /*======= Fim Notificações =======*/

            return redirect()->route('backend.lembrete');
        }

        public function editar($id){
            $clientes 	= Cliente::orderBy('nome')->get();
            $setores 	= SetorUsuario::all();
            $usuarios 	= User::all();
            $lembretes 	= Lembrete::find($id);
            
            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;
            
            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/
          
            $responsavel = Lembrete::Where('lembretes.id', '=', $id)
                ->leftJoin('users', 'lembretes.postou_id', '=', 'users.id')
                ->select('users.name')
                ->get();
            //dd($responsavel);

            $comentarios = Comentario_Lembrete::Where('id_lembrete', '=', $id)
            ->leftJoin('users', 'comentario_lembrete.id_user', '=', 'users.id')
            ->select(
                'comentario_lembrete.id',
                'comentario_lembrete.id_user',
                'comentario_lembrete.id_lembrete',
                'comentario_lembrete.comentario',
                'comentario_lembrete.created_at',
                'users.name',
                'users.image'
            )
			->orderBy('comentario_lembrete.id', 'DESC')
            ->get();
            //dd($comentarios);

            return view('backend.lembrete.editar', compact('responsavel', 'comentarios', 'clientes', 'setores', 'usuarios', 'lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        
    /*================== FIM DO CRUD ==================*/

    /*================== CONTROLE DO LEMBRETE ==================*/
        public function concluir(Request $request, $id){

            $lembretes  = Lembrete::find($id);
            $dados      = $request->all();

            $idLembrete = $lembretes->id;
            DB::table('lembretes')
                        ->where('id', $idLembrete)
                        ->update(['concluido' => 'S']);

            $lembretes->Update();
            
            return redirect()->route('backend.lembrete');
        }
        public function reabrir(Request $request, $id){

            $lembretes = Lembrete::find($id);
            $dados      = $request->all();

            $idLembrete = $lembretes->id;
            DB::table('lembretes')
                        ->where('id', $idLembrete)
                        ->update(['concluido' => 'N']);

            $lembretes->Update();
            
            return redirect()->route('backend.lembrete');
        }
    /*================== FIM CONTROLE DO LEMBRETE ==================*/

    /*================== ÁREA DO PAINEL ==================*/
        public function area(){
            // ID Setor do usuário logado
            $usuario_setor = auth()->user()->setor;
            //dd($usuario_setor);

            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

            $lembretes = Lembrete::Where('setor_id', $usuario_setor)
                ->where('usuario_id', '=', null)
                ->where('concluido', '=', 'N')
                ->leftJoin('clientes', 'lembretes.cliente_id', '=', 'clientes.id')
                ->select(
                    'lembretes.id',
                    'lembretes.concluido',
                    'lembretes.titulo',
                    'lembretes.data',
                    'clientes.nome as nome_cliente'
                )
                ->paginate(20);
            
            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/

            return view('backend.lembrete.index',compact('lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function criei(){
            // ID Setor do usuário logado
            $usuario_setor = auth()->user()->setor;
            //dd($usuario_setor);

            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

            $lembretes = Lembrete::Where('postou_id', $usuario_id)
                ->leftJoin('clientes', 'lembretes.cliente_id', '=', 'clientes.id')
                ->select(
                    'lembretes.id',
                    'lembretes.concluido',
                    'lembretes.titulo',
                    'lembretes.data',
                    'clientes.nome as nome_cliente'
                )
                ->paginate(20);
            
            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/

            return view('backend.lembrete.index',compact('lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function abertos(){    
        
            // ID Setor do usuário logado
            $usuario_setor = auth()->user()->setor;
            
            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;
    
            $lembretes = Lembrete::Where('usuario_id', $usuario_id)
                ->where('setor_id', '=', $usuario_setor)
                ->where('concluido', '=', 'N')
                ->leftJoin('clientes', 'lembretes.cliente_id', '=', 'clientes.id')
                ->select(
                    'lembretes.id',
                    'lembretes.concluido',
                    'lembretes.titulo',
                    'lembretes.data',
                    'clientes.nome as nome_cliente'
                )
                ->paginate(20);

            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/

            return view('backend.lembrete.index',compact('lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function pendentes(){

        }

        public function fechados(){
            
            // ID Setor do usuário logado
            $usuario_setor = auth()->user()->setor;
        
            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

            $lembretes = Lembrete::Where('usuario_id', $usuario_id)
                ->where('concluido', '=', 'S')
                ->leftJoin('clientes', 'lembretes.cliente_id', '=', 'clientes.id')
                ->select(
                    'lembretes.id',
                    'lembretes.concluido',
                    'lembretes.titulo',
                    'lembretes.data',
                    'clientes.nome as nome_cliente'
                )
                ->paginate(20);

            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/

            return view('backend.lembrete.index',compact('lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }
    /*================== FIM ÁREA DO PAINEL ==================*/

    /*================== NÍVEL DE IMPORTÂNCIA ==================*/
        public function alta(){    
            
            // ID Setor do usuário logado
            $usuario_setor = auth()->user()->setor;
            
            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

            $lembretes = Lembrete::Where('usuario_id', $usuario_id)
                ->where('concluido', '=', 'N')
                ->where('importancia', '=', 'Alta')
                ->leftJoin('clientes', 'lembretes.cliente_id', '=', 'clientes.id')
                ->select(
                    'lembretes.id',
                    'lembretes.concluido',
                    'lembretes.titulo',
                    'lembretes.data',
                    'clientes.nome as nome_cliente'
                )
                ->paginate(20);

            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/

            return view('backend.lembrete.index',compact('lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function media(){    
            
            // ID Setor do usuário logado
            $usuario_setor = auth()->user()->setor;
            
            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

            $lembretes = Lembrete::Where('usuario_id', $usuario_id)
                ->where('concluido', '=', 'N')
                ->where('importancia', '=', 'Média')
                ->leftJoin('clientes', 'lembretes.cliente_id', '=', 'clientes.id')
                ->select(
                    'lembretes.id',
                    'lembretes.concluido',
                    'lembretes.titulo',
                    'lembretes.data',
                    'clientes.nome as nome_cliente'
                )
                ->paginate(20);

            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/

            return view('backend.lembrete.index',compact('lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function baixa(){    
            
            // ID Setor do usuário logado
            $usuario_setor = auth()->user()->setor;
            
            // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

            $lembretes = Lembrete::Where('usuario_id', $usuario_id)
                ->where('concluido', '=', 'N')
                ->where('importancia', '=', 'Baixa')
                ->leftJoin('clientes', 'lembretes.cliente_id', '=', 'clientes.id')
                ->select(
                    'lembretes.id',
                    'lembretes.concluido',
                    'lembretes.titulo',
                    'lembretes.data',
                    'clientes.nome as nome_cliente'
                )
                ->paginate(20);

            /* Graças */
                $lembretes_entregue = Lembrete::Where('usuario_id', $usuario_id)->where('concluido', '=', 'S')->count();
                $quantidade_clientes = Cliente::count();
                $quantidade_usuarios = User::count();
                $quantidade_lembrete = Lembrete::Where('usuario_id', $usuario_id)->count();
            /* Fim das Graças*/

            return view('backend.lembrete.index',compact('lembretes', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }
    /*================== FIM NÍVEL DE IMPORTÂNCIA ==================*/


}