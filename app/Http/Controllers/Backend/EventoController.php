<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use App\Notifications\NewUser;
use App\Notifications\UsuarioCriado;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Gate;
use Auth;
use App\Gatilho;
use App\GatilhoTemplate;
use App\GatilhoGrupo;
use App\Evento;
use App\EventoTarefa;
use App\Tarefa;
use App\User;
use App\SetorUsuario;
use App\DataComemorativa;

class EventoController extends Controller{

    public function index(){

        $usuario_id                 = auth()->user()->id;
        $id_setor_usuario_logado    = auth()->user()->setor;

        $email_setor = SetorUsuario::Where('id', $id_setor_usuario_logado)->value('email');

        // Evento Individual
            $eventos            = Evento::Where('tb_eventos.id_usuario', $usuario_id)
                                    ->leftjoin('users', 'tb_eventos.id_usuario', '=', 'users.id')
                                    ->select(
                                        'tb_eventos.id',
                                        'tb_eventos.nome',
                                        'tb_eventos.descricao',
                                        'tb_eventos.evento_data_inicio',
                                        'tb_eventos.evento_data_fim',
                                        'tb_eventos.id_usuario',
                                        'tb_eventos.id_setor',
                                        'tb_eventos.tag',

                                        'users.name',
                                        'users.sobrenome'
                                    )
                                    ->get();
            //dd($eventos);
        // Evento Individual

        // Evento de Seguidor
            $eventos_convidados = DB::table('tb_convidado_evento')
                                ->where('tb_convidado_evento.id_usuario_convidado', '=', $usuario_id)
                                ->leftJoin('tb_eventos', 'tb_convidado_evento.id_evento', '=', 'tb_eventos.id')
                                ->get();
        // Evento de Seguidor

        // Tarefa
            $tarefas_eventos    = EventoTarefa::Where('tb_tarefa_eventos.id_usuario', $usuario_id)
                                ->leftJoin('tbTarefas', 'tb_tarefa_eventos.id_tarefa', '=', 'tbTarefas.id')
                                ->Select(
                                    // Evento
                                    'tb_tarefa_eventos.tarefa_evento_data_inicio',
                                    'tb_tarefa_eventos.tarefa_evento_data_fim',
                                    'tb_tarefa_eventos.tag',

                                    // Tarefa
                                    'tbTarefas.id as id_tarefa',
                                    'tbTarefas.titulo'
                                )
                            ->get();
        // Tarefa

        // Gatilho
            $gatilhos = Gatilho::Where('tb_gatilhos.status', 'Aberto')
                            ->Join('tb_gatilhos_templates', 'tb_gatilhos.id_gatilho_template',          '=', 'tb_gatilhos_templates.id')
                            ->Join('tb_gatilhos_grupos',    'tb_gatilhos_templates.id_grupo_gatilho',   '=', 'tb_gatilhos_grupos.id')
                            ->Join('tb_projetos',           'tb_gatilhos.id_tipo_projeto',              '=', 'tb_projetos.id')
                            ->Join('clientes',              'tb_projetos.cliente_id',                   '=', 'clientes.cliente_id')
                            ->select(
                                'tb_gatilhos.id',
                                'tb_gatilhos.id_tipo_projeto',
                                'tb_gatilhos.id_gatilho_template',
                                'tb_gatilhos.data_limite as data_incio',
                                'tb_gatilhos.data_limite as data_fim',

                                'tb_projetos.projeto',

                                'clientes.nome_fantasia',

                                'tb_gatilhos_templates.gatilho as nome_gatilho',
                                'tb_gatilhos_templates.id_grupo_gatilho',

                                'tb_gatilhos_grupos.email',
                                'tb_gatilhos_grupos.email_adicionais'
                            )
                            ->where(function ($query) use ($email_setor) {
                                    $query->where('tb_gatilhos_grupos.email',           '=', $email_setor)
                                    ->orWhere('tb_gatilhos_grupos.email_adicionais',    '=', $email_setor);
                            })
                            ->get();
            //dd($gatilhos);
        // Gatilho

        // DATAS
            $hoje_formatado     = (new Carbon())->format('d/m/Y');
            $hoje               = (new Carbon())->format('Y-m-d');
            $segunda            = (new Carbon('last monday', 'America/Sao_Paulo'))->format('Y-m-d');
            $sexta              = (new Carbon('next friday', 'America/Sao_Paulo'))->format('Y-m-d');

            /*$evento_hoje        = Evento::Where('id_usuario', $usuario_id)
                                    ->Where('evento_data_inicio', $hoje)
                                    ->get();*/
            //DB::connection()->enableQueryLog();

            $evento_hoje = Evento::Where('id_usuario', $usuario_id)
                                    ->Where('evento_data_inicio', '<=', $hoje)
                                    ->Where('evento_data_fim', '>=', $hoje)
                                    /*->Where(function ($query) use ($hoje){
                                        $query->where('evento_data_inicio', '=', $hoje)
                                        ->orWhere('evento_data_inicio', '!=', 'evento_data_fim');
                                    })*/
                                    ->get();
            //dd(DB::getQueryLog());

            $evento_seguidor    = Evento::Where('tb_eventos.evento_data_inicio', '=', $hoje)
                                        ->leftJoin('tb_convidado_evento', 'tb_eventos.id', '=', 'tb_convidado_evento.id_evento')
                                        ->where('tb_convidado_evento.id_usuario_convidado', $usuario_id)
                                        ->get();
            //dd($evento_seguidor);
			$arrDtComemorativas = DataComemorativa::where('status', 1)
            ->select('data', 'nome')
            ->get();

        // DATAS

        return view('backend.eventos.index', compact('hoje_formatado', 'evento_seguidor', 'gatilhos', 'eventos', 'evento_hoje', 'eventos_convidados', 'tarefas_eventos', 'arrDtComemorativas'));
    }

    public function adicionar(){
        return view('backend.eventos.adicionar');
    }

    public function salvar(Request $request){
        $dados      = $request->all();
        $eventos    = new Evento();

        $eventos->nome                  = $dados['nome'];
        $eventos->descricao             = $dados['descricao'];
        $eventos->evento_data_inicio    = $dados['evento_data_inicio'];
        $eventos->evento_data_fim       = $dados['evento_data_fim'];
        $eventos->id_usuario            = $dados['id_usuario'];
        $eventos->id_setor              = $dados['id_setor'];
        $eventos->tag                   = $dados['event-tag'];
        $eventos->save();

        // Listando o último evento para a inserção da tabela convidado
        $ultimo_id          = Evento::Select('id')->orderBy('id', 'desc')->first();
        $id_ultimo_evento   = $ultimo_id->id;

        /* Configurando o Convidado */
            $id_usuarios = User::all();
            foreach($id_usuarios as $registro){
                $id = $registro->id;
                if( isset($dados['idconvidado'.$id.'']) ){
                    DB::table('tb_convidado_evento')->insert([
                            'id_usuario_postou'      =>  $dados['id_usuario'],
                            'id_usuario_convidado'   =>  $dados['idconvidado'.$id.''],
                            'id_evento'              =>  $id_ultimo_evento
                        ]
                    );
                }
            }
        /* Fim das Configurações de Convidade */

        return redirect()->route('backend.evento');
    }

    public function visualizar(Request $request){
        $dados      = $request->all();

        // Evento
            $evento     = Evento::Where('tb_eventos.id', $dados['id_evento'])
                            ->leftjoin('users', 'tb_eventos.id_usuario', '=', 'users.id')
                            ->Select(
                                'tb_eventos.id as id_evento',
                                'tb_eventos.nome as nome_evento',
                                'tb_eventos.descricao as descricao_evento',
                                'tb_eventos.evento_data_inicio as evento_data_inicio',
                                'tb_eventos.evento_data_fim as evento_data_fim',

                                'users.id as id_usuario',
                                'users.image as image',
                                'users.name as nome_usuario',
                                'users.sobrenome as sobrenome_usuario'
                            )
                            ->get();
        // Evento

        // Seguidores
            $seguidores = DB::table('tb_convidado_evento')->where('tb_convidado_evento.id_evento', '=', $dados['id_evento'])
                ->leftJoin('users', 'tb_convidado_evento.id_usuario_convidado', '=', 'users.id')
                ->select(
                    'tb_convidado_evento.id as id_convidado_evento',
                    'tb_convidado_evento.id_usuario_postou',
                    'tb_convidado_evento.id_usuario_convidado',
                    'tb_convidado_evento.id_evento',
                    'users.name',
                    'users.image',
                    'users.sobrenome'
                )
                ->orderBy('tb_convidado_evento.id', 'DESC')
            ->get();
        // Seguidores

        return view('backend.eventos.visualizar', compact('evento', 'seguidores'));
    }

    public function visualizarGatilho(Request $request){
        $dados      = $request->all();

        // Gatilho
            $id_setor_usuario_logado    = auth()->user()->setor;
            $email_setor = SetorUsuario::Where('id', $id_setor_usuario_logado)->value('email');
            $gatilhos = Gatilho::Where('tb_gatilhos.id', $dados['id_evento'])
                        ->Join('tb_gatilhos_templates', 'tb_gatilhos.id_gatilho_template',          '=', 'tb_gatilhos_templates.id')
                        ->Join('tb_gatilhos_grupos',    'tb_gatilhos_templates.id_grupo_gatilho',   '=', 'tb_gatilhos_grupos.id')
                        ->Join('tb_projetos',           'tb_gatilhos.id_tipo_projeto',              '=', 'tb_projetos.id')
                        ->Join('clientes',              'tb_projetos.cliente_id',                   '=', 'clientes.cliente_id')
                        ->select(
                            'tb_gatilhos.id',
                            'tb_gatilhos.id_tipo_projeto',
                            'tb_gatilhos.id_gatilho_template',
                            'tb_gatilhos.data_limite as data_incio',
                            'tb_gatilhos.data_limite as data_fim',

                            'tb_projetos.projeto',

                            'clientes.nome_fantasia',

                            'tb_gatilhos_templates.gatilho as nome_gatilho',
                            'tb_gatilhos_templates.id_grupo_gatilho',

                            'tb_gatilhos_grupos.email',
                            'tb_gatilhos_grupos.email_adicionais'
                        )
                        ->where(function ($query) use ($email_setor) {
                                $query->where('tb_gatilhos_grupos.email',           '=', $email_setor)
                                ->orWhere('tb_gatilhos_grupos.email_adicionais',    '=', $email_setor);
                        })
                        ->get();
            //dd($gatilhos);
        // Gatilho

        return view('backend.eventos.visualizarGatilho', compact('gatilhos'));
    }

    public function atualizar(Request $request){
        $dados      = $request->all();
        //dd($dados);

        Evento::Where('id', $dados['id_evento_oficial'])
            ->update([
                'nome'                  => $dados['nome'],
                'descricao'             => $dados['descricao'],
                'evento_data_inicio'    => $dados['evento_data_inicio'],
                'evento_data_fim'       => $dados['evento_data_fim'],
                'tag'                   => '#5e72e4'
            ]);

        return redirect()->route('backend.evento');
    }

    /* USUÁRIO */
        public function individual($id){

            $usuario_id                 = $id;
            $id_setor_usuario_logado    = User::Where('id', $id)->value('setor');

            $email_setor = SetorUsuario::Where('id', $id_setor_usuario_logado)->value('email');

            $usuario_info = User::Where('id', $id)->first();

            // Evento Individual
                $eventos            = Evento::Where('tb_eventos.id_usuario', $usuario_id)
                                        ->leftjoin('users', 'tb_eventos.id_usuario', '=', 'users.id')
                                        ->select(
                                            'tb_eventos.id',
                                            'tb_eventos.nome',
                                            'tb_eventos.descricao',
                                            'tb_eventos.evento_data_inicio',
                                            'tb_eventos.evento_data_fim',
                                            'tb_eventos.id_usuario',
                                            'tb_eventos.id_setor',
                                            'tb_eventos.tag',
                                            'users.name',
                                            'users.sobrenome'
                                        )
                                        ->get();
                //dd($eventos);
            // Evento Individual

            // Evento de Seguidor
                $eventos_convidados = DB::table('tb_convidado_evento')
                                    ->where('tb_convidado_evento.id_usuario_convidado', '=', $usuario_id)
                                    ->leftJoin('tb_eventos', 'tb_convidado_evento.id_evento', '=', 'tb_eventos.id')
                                    ->get();
            // Evento de Seguidor

            // Tarefa
                $tarefas_eventos    = EventoTarefa::Where('tb_tarefa_eventos.id_usuario', $usuario_id)
                                    ->leftJoin('tbTarefas', 'tb_tarefa_eventos.id_tarefa', '=', 'tbTarefas.id')
                                    ->Select(
                                        // Evento
                                        'tb_tarefa_eventos.tarefa_evento_data_inicio',
                                        'tb_tarefa_eventos.tarefa_evento_data_fim',
                                        'tb_tarefa_eventos.tag',

                                        // Tarefa
                                        'tbTarefas.id as id_tarefa',
                                        'tbTarefas.titulo'
                                    )
                                ->get();
            // Tarefa

            // Gatilho
                $gatilhos = Gatilho::Where('tb_gatilhos.status', 'Aberto')
                                ->Join('tb_gatilhos_templates', 'tb_gatilhos.id_gatilho_template',          '=', 'tb_gatilhos_templates.id')
                                ->Join('tb_gatilhos_grupos',    'tb_gatilhos_templates.id_grupo_gatilho',   '=', 'tb_gatilhos_grupos.id')
                                ->Join('tb_projetos',           'tb_gatilhos.id_tipo_projeto',              '=', 'tb_projetos.id')
                                ->Join('clientes',              'tb_projetos.cliente_id',                   '=', 'clientes.cliente_id')
                                ->select(
                                    'tb_gatilhos.id',
                                    'tb_gatilhos.id_tipo_projeto',
                                    'tb_gatilhos.id_gatilho_template',
                                    'tb_gatilhos.data_limite as data_incio',
                                    'tb_gatilhos.data_limite as data_fim',
                                    'tb_projetos.projeto',
                                    'clientes.nome_fantasia',
                                    'tb_gatilhos_templates.gatilho as nome_gatilho',
                                    'tb_gatilhos_templates.id_grupo_gatilho',
                                    'tb_gatilhos_grupos.email',
                                    'tb_gatilhos_grupos.email_adicionais'
                                )
                                ->where(function ($query) use ($email_setor) {
                                        $query->where('tb_gatilhos_grupos.email',           '=', $email_setor)
                                        ->orWhere('tb_gatilhos_grupos.email_adicionais',    '=', $email_setor);
                                })
                                ->get();
                //dd($gatilhos);
            // Gatilho

            // DATAS
                $hoje_formatado     = (new Carbon())->format('d/m/Y');
                $hoje               = (new Carbon())->format('Y-m-d');

                /*$evento_hoje        = Evento::Where('id_usuario', $usuario_id)
                                        ->Where('evento_data_inicio', $hoje)
                                        ->get();*/
                $evento_hoje = Evento::Where('id_usuario', $usuario_id)
                                    ->Where('evento_data_inicio', '<=', $hoje)
                                    ->Where('evento_data_fim', '>=', $hoje)
                                    ->get();
                $evento_seguidor    = Evento::Where('tb_eventos.evento_data_inicio', '<=', $hoje)
                                            ->Where('evento_data_fim', '>=', $hoje)
                                            ->leftJoin('tb_convidado_evento', 'tb_eventos.id', '=', 'tb_convidado_evento.id_evento')
                                            ->where('tb_convidado_evento.id_usuario_convidado', $usuario_id)
                                            ->get();
                //dd($evento_seguidor);

            // DATAS

            return view('backend.eventos.individual', compact('hoje_formatado', 'usuario_info', 'evento_seguidor', 'gatilhos', 'eventos', 'evento_hoje', 'eventos_convidados', 'tarefas_eventos'));
        }
    /* USUÁRIO */

    /* EVENTO TAREFA */
        public function salvarEventoTarefa(Request $request){
            $dados              = $request->all();
            $eventotarefa       = new EventoTarefa();

            // Buscando o id setor
            $id_setor = User::Where('id', $dados['id_usuario'])->value('setor');

            $eventotarefa->id_tarefa                    = $dados['id_tarefa'];
            $eventotarefa->tarefa_evento_data_inicio    = $dados['tarefa_evento_data_inicio'];
            $eventotarefa->tarefa_evento_data_fim       = $dados['tarefa_evento_data_fim'];
            $eventotarefa->id_usuario                   = $dados['id_usuario'];
            $eventotarefa->id_setor                     = $id_setor;
            $eventotarefa->tag                          = $dados['event-tag'];
            $eventotarefa->save();

            return redirect()->route('backend.evento');
        }
    /* EVENTO TAREFA */
}
