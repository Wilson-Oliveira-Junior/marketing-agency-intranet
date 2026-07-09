<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Notifications\Gatilho\GatilhoEnvioTeste;
use App\Notifications\Gatilho\GatilhoFeitoMail;
use App\Notifications\Gatilho\GatilhoEquipeAlertaMail;
use Illuminate\Support\Facades\Auth;
use App\Gatilho;
use App\GatilhoTemplate;
use App\GatilhoGrupo;
use App\TipoProjeto;
use App\ComentarioProjeto;
use App\GatilhoAdiamento;
use App\GatilhoProjeto;
use App\Http\Requests\GatilhoAdiamentoFormRequest;
use App\Http\Requests\GatilhoComentarioProjetoFormRequest;
use App\Mail\GatilhosAtrasados;
use App\Mail\GatilhosAvisos;
use App\Mail\RelatorioProjetos;
use App\Projeto;
use App\Services\Gatilho as ServicesGatilho;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class GatilhosController extends Controller{
    use Notifiable;

    /*============== CRUD ==============*/
        public function index(){

            if( Gate::denies('listar_gatilhos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            $gatilhos   =   DB::table('tb_gatilhos_templates')
                                ->leftJoin('tipo_projetos', 'tb_gatilhos_templates.id_tipo_projeto', '=', 'tipo_projetos.id')
                                ->select(
                                    'tipo_projetos.id as id_tipo_projeto',
                                    'tipo_projetos.nome as nome_tipo_projeto',
                                    DB::raw("(SELECT SUM(1) FROM tb_gatilhos_templates
                                        WHERE tb_gatilhos_templates.id_tipo_projeto = tipo_projetos.id) as num_gatilhos"),
                                    DB::raw("(SELECT SUM(1) FROM tb_gatilhos_templates
                                        WHERE tb_gatilhos_templates.id_tipo_projeto = tipo_projetos.id
                                        AND tb_gatilhos_templates.tipo_gatilho = 'Equipe') as num_equipe"),
                                    DB::raw("(SELECT SUM(1) FROM tb_gatilhos_templates
                                        WHERE tb_gatilhos_templates.id_tipo_projeto = tipo_projetos.id
                                        AND tb_gatilhos_templates.tipo_gatilho = 'Cliente') as num_cliente")
                                )
                                ->groupBy(
                                    'tipo_projetos.id',
                                    'tipo_projetos.nome'
                                )
                                ->get();
            //dd($gatilhos);

            //dd($gatilhos);
            return view('backend.gatilhos.index',compact('gatilhos'));
        }

        public function template($id){

            if( Gate::denies('listar_gatilhos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            $gatilhos   =   DB::table('tb_gatilhos_templates')
                ->where('tb_gatilhos_templates.id_tipo_projeto', '=', $id)
                ->leftJoin('tb_tipo_projetos', 'tb_gatilhos_templates.id_tipo_projeto', '=', 'tb_tipo_projetos.id')
                ->select(
                    'tb_gatilhos_templates.id',
                    'tb_gatilhos_templates.gatilho',

                    'tb_gatilhos_templates.dias_limite_padrao',
                    'tb_gatilhos_templates.dias_limite_50',
                    'tb_gatilhos_templates.dias_limite_40',
                    'tb_gatilhos_templates.dias_limite_30',

                    'tb_gatilhos_templates.tipo_gatilho',

                    'tb_tipo_projetos.id as id_tipo_projeto',
                    'tb_tipo_projetos.nome as nome_tipo_projeto'
                )
                ->paginate(20);

            return view('backend.gatilhos.template',compact('gatilhos'));
        }

        public function adicionar(){

            if( Gate::denies('adicionar_gatilhos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            $gatilhos           =   GatilhoTemplate::all();
            $id_ref             =   GatilhoTemplate::LeftJoin('tb_tipo_projetos', 'tb_gatilhos_templates.id_tipo_projeto', '=', 'tb_tipo_projetos.id')
                                        ->select(
                                            'tb_gatilhos_templates.id as id_gatilho_template',
                                            'tb_gatilhos_templates.gatilho as nome_gatilho',
                                            'tb_tipo_projetos.nome as nome_projeto'
                                        )
                                        ->get();

            $gatilhos_grupos    =   GatilhoGrupo::all();
            $tipos_projetos     =   TipoProjeto::orderby('nome', 'asc')->get();

            return view('backend.gatilhos.adicionar',compact('gatilhos', 'gatilhos_grupos','tipos_projetos', 'id_ref'));
        }

        public function salvar(Request $request){

            if( Gate::denies('adicionar_gatilhos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            $dados = $request->all();

            $gatilhos                       = new GatilhoTemplate();
            $gatilhos->gatilho              = $dados['gatilho'];
            $gatilhos->id_tipo_projeto      = $dados['id_tipo_projeto'];
            $gatilhos->tipo_gatilho         = $dados['tipo_gatilho'];
            $gatilhos->dias_limite_padrao   = $dados['dias_limite_padrao'];
            $gatilhos->dias_limite_50       = $dados['dias_limite_50'];
            $gatilhos->dias_limite_40       = $dados['dias_limite_40'];
            $gatilhos->dias_limite_30       = $dados['dias_limite_30'];
            $gatilhos->id_referente         = $dados['id_referente'];
            $gatilhos->id_grupo_gatilho     = $dados['id_grupo_gatilho'];
            $gatilhos->save();

            Session::flash('flash_mensagem', ['msg'=>'Gatiilho adicionado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.gatilhos');
        }

        public function editar($id){

            if( Gate::denies('editar_gatilhos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            $gatilhos           =   GatilhoTemplate::find($id);
            $id_ref             =   GatilhoTemplate::LeftJoin('tb_tipo_projetos', 'tb_gatilhos_templates.id_tipo_projeto', '=', 'tb_tipo_projetos.id')
            ->select(
                'tb_gatilhos_templates.id as id_gatilho_template',
                'tb_gatilhos_templates.gatilho as nome_gatilho',
                'tb_tipo_projetos.nome as nome_projeto'
            )
            ->get();
            $gatilhos_grupos    =   GatilhoGrupo::all();
            $tipos_projetos     =   TipoProjeto::orderby('nome', 'asc')->get();

            return view('backend.gatilhos.editar',compact('gatilhos', 'gatilhos_grupos', 'tipos_projetos', 'id_ref'));
        }

        public function atualizar(Request $request, $id){

            if( Gate::denies('editar_gatilhos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            $gatilhos       =   GatilhoTemplate::find($id);
            $dados = $request->all();

            $gatilhos->gatilho              = $dados['gatilho'];
            $gatilhos->id_tipo_projeto      = $dados['id_tipo_projeto'];
            $gatilhos->tipo_gatilho         = $dados['tipo_gatilho'];
            $gatilhos->dias_limite_padrao   = $dados['dias_limite_padrao'];
            $gatilhos->dias_limite_50       = $dados['dias_limite_50'];
            $gatilhos->dias_limite_40       = $dados['dias_limite_40'];
            $gatilhos->dias_limite_30       = $dados['dias_limite_30'];
            $gatilhos->id_referente         = $dados['id_referente'];
            $gatilhos->id_grupo_gatilho     = $dados['id_grupo_gatilho'];
            $gatilhos->Update();

            Session::flash('flash_mensagem', ['msg'=>'Gatiilho editado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.gatilhos.editar', $gatilhos->id);
        }

        public function deletar($id){

            if( Gate::denies('deletar_gatilhos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            GatilhoTemplate::find($id)->delete();
            return redirect()->route('backend.gatilhos');
        }
    /*============== FIM CRUD ==============*/

    /*============== CRUD GRUPOS GATILHOS ==============*/
        public function indexgrupo(){

            if( Gate::denies('listar_gatilhos_grupos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listar os grupos do gatilhos..', 'class'=>'']);
                return redirect()->back();
            }

            $gatilhos_grupos   =   GatilhoGrupo::paginate(20);

            //dd($gatilhos);
            return view('backend.gatilhos.grupo.index',compact('gatilhos_grupos'));
        }

        public function adicionargrupo(){

            if( Gate::denies('adicionar_gatilhos_grupos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos do grupo !!', 'class'=>'']);
                return redirect()->back();
            }

            $gatilhos_grupos       =   GatilhoGrupo::all();

            return view('backend.gatilhos.grupo.adicionar',compact('gatilhos_grupos'));
        }

        public function salvargrupo(Request $request){

            if( Gate::denies('adicionar_gatilhos_grupos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos do grupo !!', 'class'=>'']);
                return redirect()->back();
            }

            $dados = $request->all();

            $gatilhos_grupos                       = new GatilhoGrupo();
            $gatilhos_grupos->descricao            = $dados['descricao'];
            $gatilhos_grupos->email                = $dados['email'];
            $gatilhos_grupos->email_adicionais     = $dados['email_adicionais'];
            $gatilhos_grupos->save();

            Session::flash('flash_mensagem', ['msg'=>'Gatilho do Grupo adicionado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.gatilhos.grupo');
        }

        public function editargrupo($id){

            if( Gate::denies('editar_gatilhos_grupo') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            $gatilhos_grupos       =   GatilhoGrupo::find($id);

            return view('backend.gatilhos.grupo.editar',compact('gatilhos_grupos'));
        }

        public function atualizargrupo(Request $request, $id){

            if( Gate::denies('editar_gatilhos_grupo') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            $dados = $request->all();
            $gatilhos_grupos                        =   GatilhoGrupo::find($id);
            $gatilhos_grupos->descricao             = $dados['descricao'];
            $gatilhos_grupos->email                 = $dados['email'];
            $gatilhos_grupos->email_adicionais      = $dados['email_adicionais'];
            $gatilhos_grupos->Update();

            Session::flash('flash_mensagem', ['msg'=>'Gatiilho editado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.gatilhos.grupo');
        }

        public function deletargrupo($id){

            if( Gate::denies('deletar_gatilhos_grupo') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os gatilhos !!', 'class'=>'']);
                return redirect()->back();
            }

            GatilhoGrupo::find($id)->delete();
            return redirect()->route('backend.gatilhos.grupo');
        }
    /*============== FIM CRUD GRUPOS GATILHOS ==============*/

    /* Gatilho em Geral */
        public function geral(){


            //dd($arrGatilhos);
            $tipoprojetos = TipoProjeto::where('status', 'Ativo')->orderBy('nome', 'ASC')->get();
            $projetosgatilhos = GatilhoProjeto::with('projetos')->orderBy('id_projeto', 'ASC')->get();

            return view('backend.gatilhos.geral.index',compact('tipoprojetos', 'projetosgatilhos'));
        }

        public function atualizaStatusGatilhos(ServicesGatilho $g){
            $atu = $g->atualizaStatusGatilhos();
            dd($atu);
        }

        public function pausarProjeto(Request $request){
            $dados = $request->all();

            $projeto = GatilhoProjeto::where('id_projeto', $dados['id_projeto'])->first();

            if($projeto->status == 'E'){
                $projeto->status = 'P';
            }else{
                $projeto->status = 'E';
            }
            $projeto->save();

            return response()->json($projeto);
        }

        public function filtrarGatilhos(Request $request, ServicesGatilho $g){
            $dados = $request->all();

            //$blCliente = (is_null($dados['nome_cliente']))?false:$dados['nome_cliente'];
            $blIdTipoProjeto = (is_null($dados['idtipoprojeto']))?null:$dados['idtipoprojeto'];
            $blIdProjeto = (is_null($dados['idcliente']))?null:$dados['idcliente'];

            //dd($blIdTipoProjeto);

            $arrGatilhos = $g->fnListarGatilhos($blIdTipoProjeto, $blIdProjeto, $dados['status']);
            //dd($arrGatilhos);
            return view('backend.gatilhos.geral.filtro',compact('arrGatilhos'));
        }

        public function ultimoComentarioProjeto($id_projeto){


            $comentario = ComentarioProjeto::where('id_projeto', $id_projeto)
                ->orderBy('id', 'DESC')->first();

            //dd($comentario['comentario']);

            return response()->json(['mensagem' => $comentario],200);
        }

        public function registrarComentarioProjeto(GatilhoComentarioProjetoFormRequest $request){
            $dados = $request->all();

            $insComentario = new ComentarioProjeto();
            $insComentario->id_usuario = FacadesAuth::id();
            $insComentario->id_projeto = $dados['idprojeto'];
            $insComentario->comentario = $dados['comentario'];
            $insComentario->tipo = 'E';
            $insComentario->save();

            return response()->json($insComentario);
        }
    /* Fim */

    /* Projeto */
    public function projeto($id_projeto){

        // Gatilhos
            $projetoatual = Projeto::find($id_projeto);

            $gatilhos = DB::table('tb_gatilhos')
                ->where('tb_gatilhos.id_tipo_projeto',          '=', $id_projeto)

                // Puxando o nome do gatilho
                ->leftJoin('tb_gatilhos_templates',     'tb_gatilhos.id_gatilho_template',      '=', 'tb_gatilhos_templates.id')
                ->leftJoin('users',                     'tb_gatilhos.id_usuario',               '=', 'users.id')

                // Ordernando os gatilhos para exibição
                // ->orderBy('tb_gatilhos.status', 'asc')
                ->orderBy('tb_gatilhos.data_limite', 'asc')

                ->Select(
                    'tb_gatilhos.id',
                    'tb_gatilhos.id_tipo_projeto',
                    'tb_gatilhos.status',
                    'tb_gatilhos.data_conclusao',
                    'tb_gatilhos.data_limite',
                    'tb_gatilhos.created_at',
                    'tb_gatilhos.bkp_data_origem',

                    'tb_gatilhos_templates.gatilho',
                    'users.name',
                    'users.sobrenome'
                )
                ->orderby('tb_gatilhos.id', 'asc')
                ->get();
        //dd($gatilhos);

        // Números Lateral
            $numero_gatilho_aberto      = DB::table('tb_gatilhos')->where('tb_gatilhos.id_tipo_projeto',          '=', $id_projeto)->count();
            $numero_gatilho_entregue    = DB::table('tb_gatilhos')->where('tb_gatilhos.id_tipo_projeto',          '=', $id_projeto)->where('status', '=', 'Finalizado')->count();
            $data_gatilho_criado        = DB::table('tb_gatilhos')->where('tb_gatilhos.id_tipo_projeto',          '=', $id_projeto)->value('tb_gatilhos.created_at');

            // Formatando para o final do projeto
                    if($projetoatual->data_referencia){
                        $formatar_data              = date( 'Y-m-d' , strtotime( $projetoatual->data_referencia ));
                    }else{
                        $formatar_data              = date( 'Y-m-d' , strtotime( $data_gatilho_criado ));
                    }

                $prazo = ($projetoatual->prazo>0)?$projetoatual->prazo:65;
                $data_fim_projeto           = Carbon::parse($formatar_data)->addWeekdays($prazo);
            //dd($data_fim_projeto);

            // Total de dias do projeto
                $dias_passados = $data_fim_projeto->diffInWeekdays($formatar_data);
                //dd($dias_passados);

            // Total de Dias Passados
                $hoje               = Carbon::today();
                $auxiliar           = $data_fim_projeto->diffInWeekdays($hoje);
                //dd($auxiliar);
                $dias_passados_2    = $dias_passados - $auxiliar;
                if($projetoatual->data_referencia){
                    $dataInicio = Carbon::parse($projetoatual->data_referencia);
                }else{
                    $dataInicio = Carbon::parse($data_gatilho_criado);
                }
                //dd($dataInicio);
                $diasPassados = $dataInicio->diffInWeekdays($hoje);
                //dd($diasPassados);

        // Fim

        // Projeto
            $projeto = DB::table('tb_projetos')->where('tb_projetos.id', '=', $id_projeto)
                        ->leftJoin('clientes', 'tb_projetos.cliente_id', '=', 'clientes.cliente_id')
                    ->Select(
                        'tb_projetos.projeto',
                        'clientes.nome',
                        'clientes.nome_fantasia'
                    )
                    ->get();
        //dd($projeto);

        // Comentários
            $comentarios = ComentarioProjeto::Where('tb_comentario_projeto.id_projeto', '=', $id_projeto)
                ->leftjoin('users', 'users.id', '=', 'tb_comentario_projeto.id_usuario')
                ->select(
                    // Sobrenome
                    'users.id as id_usuario',
                    'users.name',
                    'users.sobrenome',
                    'users.image',

                    // Comentário
                    'tb_comentario_projeto.comentario as comentario',
                    'tb_comentario_projeto.tipo as tipo_comentario',
                    'tb_comentario_projeto.created_at as data_postagem'
                )
                ->orderBy(
                    'tb_comentario_projeto.created_at', 'desc'
                )
            ->get();
        //dd($comentarios);

        $id_projeto_oficial = $id_projeto;

        // Tipo de Projeto
            $id_tipo_projeto    =   DB::table('tb_projetos')->where('tb_projetos.id', '=', $id_projeto_oficial)
                                        ->join('tb_tipo_projetos', 'tb_projetos.projeto', '=', 'tb_tipo_projetos.nome')
                                        ->select(
                                            'tb_tipo_projetos.id'
                                        )
                                        ->first();
        // Tipo de Projeto

        // Dados de contato do Cliente
            $dados_cliente = DB::table('tb_projetos')
                            ->where('tb_projetos.id', '=', $id_projeto)
                            ->join('clientes', 'tb_projetos.cliente_id', '=', 'clientes.cliente_id')
                            ->join('tb_clientes_contatos', 'clientes.id', '=', 'tb_clientes_contatos.id_cliente')
                            ->whereIn('tb_clientes_contatos.tipo_contato', ['Responsável do Projeto', 'Responsável Projeto/Financeiro'])
                            ->select(
                                // Dados do Contato
                                'tb_clientes_contatos.nome_contato',
                                'tb_clientes_contatos.telefone',
                                'tb_clientes_contatos.ramal',
                                'tb_clientes_contatos.celular',
                                'tb_clientes_contatos.email',
                                'tb_clientes_contatos.tipo_contato'
                            )
                            ->get();
        //dd($dados_cliente);

        // Adiamentos
            $adiamentos = DB::table('tb_gatilho_adiamento')
                        ->where('tb_gatilho_adiamento.id_projeto', '=', $id_projeto)
                        ->join('users', 'tb_gatilho_adiamento.id_usuario', '=', 'users.id')
                        // Recuperando o nome do gatilho
                        ->join('tb_gatilhos', 'tb_gatilho_adiamento.id_gatilho', '=', 'tb_gatilhos.id')
                        ->join('tb_gatilhos_templates', 'tb_gatilhos.id_gatilho_template', '=', 'tb_gatilhos_templates.id')
                        ->select(
                            // Dados do Adiamentos
                            'tb_gatilho_adiamento.data_adiamento',
                            'tb_gatilho_adiamento.motivo',
                            'tb_gatilho_adiamento.created_at as postado_em',

                            // Dados do Gatilhos
                            'tb_gatilhos_templates.gatilho as nome_gatilho',
                            'tb_gatilhos_templates.tipo_gatilho',

                            // Dados do Adiamentos
                            'users.name',
                            'users.sobrenome',
                            'users.image'
                        )
                        ->orderby('tb_gatilho_adiamento.id', 'desc')
                        ->get();
        //dd($adiamentos);

        // Números do Adiamentos, Contatos Clientes e Comentários
            $numero_adiamentos  = DB::table('tb_gatilho_adiamento')->where('tb_gatilho_adiamento.id_projeto', '=', $id_projeto)->count();
            $numeros_cliente    = DB::table('tb_projetos')->where('tb_projetos.id', '=', $id_projeto)->join('clientes', 'tb_projetos.cliente_id', '=', 'clientes.cliente_id')->join('tb_clientes_contatos', 'clientes.id', '=', 'tb_clientes_contatos.id_cliente')->whereIn('tb_clientes_contatos.tipo_contato', ['Responsável do Projeto', 'Responsável Projeto/Financeiro'])->count();
            $numeros_comentario = ComentarioProjeto::Where('tb_comentario_projeto.id_projeto', '=', $id_projeto)->count();
        // Fim Números do Adiamentos, Contatos Clientes e Comentários

        return view('backend.gatilhos.projeto.index',compact(
            'comentarios','id_projeto_oficial','gatilhos', 'projeto',
            'numero_gatilho_aberto', 'numero_gatilho_entregue', 'data_gatilho_criado',
            'data_fim_projeto', 'dias_passados', 'dias_passados_2', 'formatar_data',
            'data_gatilho_criado', 'dados_cliente', 'adiamentos', 'numero_adiamentos',
            'numeros_cliente', 'numeros_comentario', 'auxiliar', 'id_tipo_projeto', 'prazo', 'diasPassados'
        ));
    }
    /* Fim */

    /* Controllers para mudança de Status */
        public function finalizar($id_gatilho, $id_usuario){

            // Pegando a data de hoje
                $hoje = Carbon::today();
            // Pegando a data de hoje

            // Fazendo um Update no banco de dados
                DB::table('tb_gatilhos')->where('tb_gatilhos.id', '=', $id_gatilho)
                    ->update([
                        'status'            => 'Finalizado',
                        'id_usuario'        => $id_usuario,
                        'data_conclusao'    => $hoje,
                    ]);
            // Fazendo um Update no banco de dados

            // Enviando a notificação

                // Recuperando o projeto
                    $projeto = DB::table('tb_gatilhos')->where('tb_gatilhos.id', '=', $id_gatilho)->value('id_tipo_projeto');
                // Recuperando o projeto

                // Recuperando o id do gatilho template
                    $id_template = DB::table('tb_gatilhos')->where('tb_gatilhos.id', '=', $id_gatilho)->value('id_gatilho_template');
                // Recuperando o id do gatilho template

                // Notificação
                    $notificacao = Gatilho::where('tb_gatilhos.id', '=', $id_gatilho)
                        // Trazendo a informação do Gatilho Template
                        ->leftJoin('tb_gatilhos_templates', 'tb_gatilhos.id_gatilho_template',          '=', 'tb_gatilhos_templates.id')

                        // Trazendo a informação do E-mail que vai ser enviado
                        ->leftJoin('tb_gatilhos_grupos',    'tb_gatilhos_templates.id_grupo_gatilho',   '=', 'tb_gatilhos_grupos.id')

                        // Trazendo as informações do Projeto
                        ->leftJoin('tb_projetos',           'tb_gatilhos.id_tipo_projeto',              '=', 'tb_projetos.id')

                        // Trazendo informções do Cliente
                        ->leftJoin('clientes', 'tb_projetos.cliente_id', '=', 'clientes.cliente_id')

                        ->select(
                            // Gatilhos Principal
                            'tb_gatilhos.id as id_gatilo',
                            'tb_gatilhos.data_conclusao',
                            'tb_gatilhos.data_limite',

                            // Gatilhos Templates
                            'tb_gatilhos_templates.gatilho',

                            // Informação do Projeto
                            'tb_projetos.id as id_projeto',
                            'tb_projetos.projeto',

                            // Informação do Cliente
                            'clientes.id as id_cliente',
                            'clientes.nome_fantasia',

                            // E-mail que vão receber a noticição
                            'tb_gatilhos_grupos.email',
                            'tb_gatilhos_grupos.email_adicionais'
                        )
                        ->first();
                // Notificação

                // Notificação E-mail
                    //$notificacao->notify(new GatilhoEnvioTeste());
                    // EMAIL REAL $notificacao->notify(new GatilhoFeitoMail());
                // Notificação

            // Enviando a notificação
        }

        public function aberto($id_gatilho, $id_usuario){
            DB::table('tb_gatilhos')->where('tb_gatilhos.id', '=', $id_gatilho)
                ->update([
                    'status'            => 'Aberto',
                    'id_usuario'        => NULL,
                    'data_conclusao'    => NULL,
                ]);
        }
    /* Fim */

    /* Status do Projetos */
        public function projetoaberto($id_projeto){

            $gatilhos  =   DB::table('tb_gatilhos')

                                ->join('tb_projetos',   'tb_gatilhos.id_tipo_projeto',  '=', 'tb_projetos.id')
                                ->join('clientes',      'tb_projetos.cliente_id',       '=', 'clientes.cliente_id')

                                ->where('tb_projetos.id_tipo_projeto', '=', $id_projeto)

                                ->select(
                                    'tb_gatilhos.id_tipo_projeto as id_projetos_gatilhos',
                                    'tb_projetos.id_tipo_projeto as id_tipo_projeto_oficial',
                                    'tb_projetos.projeto',
                                    'clientes.nome_fantasia',
                                    DB::raw("COALESCE( (SELECT SUM(1) FROM tb_gatilhos
                                    WHERE id_projetos_gatilhos = tb_gatilhos.id_tipo_projeto AND status = 'Aberto'), 0) as status_gatilho"),
                                    DB::raw("COALESCE( (SELECT SUM(1) FROM tb_gatilhos
                                    WHERE id_projetos_gatilhos = tb_gatilhos.id_tipo_projeto), 0) as qtd_total_status"),

                                    DB::raw("( SELECT ( CASE
                                                            WHEN DATEDIFF(
                                                                DATE_FORMAT( NOW() , '%Y-%m-%d' ) ,
                                                                DATE_FORMAT( tb_comentario_projeto.created_at, '%Y-%m-%d' )
                                                            ) > 8
                                                            THEN 'S'
                                                            ELSE 'N'
                                                            END
                                                        )
                                                    FROM tb_comentario_projeto
                                                    WHERE id_projeto = tb_gatilhos.id_tipo_projeto
                                                    ORDER BY id DESC
                                                    LIMIT 1
                                                ) as status_entrar_contato")
                                )

                                ->groupBy(
                                    'tb_gatilhos.id_tipo_projeto',
                                    'tb_projetos.id_tipo_projeto',
                                    'tb_projetos.projeto',
                                    'clientes.nome_fantasia',
                                    'status_gatilho'
                                )

                                ->get();
            //dd($gatilhos);

            $projeto = TipoProjeto::find($id_projeto);
            //dd($projeto);

            return view('backend.gatilhos.tipoprojeto.aberto',compact('gatilhos', 'projeto'));
        }

        public function projetofinalizado($id_projeto){

            $gatilhos  =   DB::table('tb_gatilhos')

                                ->join('tb_projetos',   'tb_gatilhos.id_tipo_projeto',  '=', 'tb_projetos.id')
                                ->join('clientes',      'tb_projetos.cliente_id',       '=', 'clientes.cliente_id')

                                ->where('tb_projetos.id_tipo_projeto', '=', $id_projeto)

                                ->select(
                                    'tb_gatilhos.id_tipo_projeto as id_projetos_gatilhos',
                                    'tb_projetos.id_tipo_projeto as id_tipo_projeto_oficial',
                                    'tb_projetos.projeto',
                                    'clientes.nome_fantasia',
                                    DB::raw("COALESCE( (SELECT SUM(1) FROM tb_gatilhos
                                    WHERE id_projetos_gatilhos = tb_gatilhos.id_tipo_projeto AND status = 'Aberto'), 0) as status_gatilho"),
                                    DB::raw("COALESCE( (SELECT SUM(1) FROM tb_gatilhos
                                    WHERE id_projetos_gatilhos = tb_gatilhos.id_tipo_projeto), 0) as qtd_total_status")
                                )

                                ->groupBy(
                                    'tb_gatilhos.id_tipo_projeto',
                                    'tb_projetos.id_tipo_projeto',
                                    'tb_projetos.projeto',
                                    'clientes.nome_fantasia',
                                    'status_gatilho'
                                )

                                ->get();
            //dd($gatilhos);

            $projeto = TipoProjeto::find($id_projeto);
            //dd($projeto);

            return view('backend.gatilhos.tipoprojeto.finalizado',compact('gatilhos', 'projeto'));
        }
    /* Status do Projetos */

    /* Comentário no Projeto */
        public function adicionar_comentario(Request $request, $id){

            $dados                      = $request->all();
            //dd($dados);
            $comentario                 = new ComentarioProjeto();
            $comentario->id_usuario     = $dados['id_usuario'];
            $comentario->id_projeto     = $id;
            $comentario->comentario     = $dados['comentario'];
            $comentario->tipo           = 'E';
            $comentario->save();

            return redirect()->route('backend.gatilhos.projeto',$id);
        }
    /* Fim Comentário no Projeto */

    /* Adiamento Salvar */
        public function adiamentosalvar(GatilhoAdiamentoFormRequest $request){
            $dados = $request->all();

            $gatilhoatual = Gatilho::find($dados['id_gatilho']);

            $ckAdiarProximos = isset($dados['ck_adiar_proximos'])?$dados['ck_adiar_proximos']:'N';
            //dd($ckAdiarProximo);

            // Adicionando o adiamento no banco de dados
            $adiamento = new GatilhoAdiamento();
            $adiamento->id_gatilho = $dados['id_gatilho'];
            $adiamento->id_projeto = $dados['id_projeto'];
            $adiamento->id_usuario = $dados['id_usuario'];
            $adiamento->data_adiamento = $dados['data_adiamento'];
            $adiamento->motivo = $dados['motivo'];
            $adiamento->save();
            // Fim da inserção

            // Recuperando a bkp data para verificar se ela está NULL
            $bkp_data = $gatilhoatual->bkp_data_origem;
            // Recuperando o valor da data de origem
            $data_origem = $gatilhoatual->data_limite;

            // Fazendo essa comparação para não trocar duas vezes o bkp data
            if(is_null($bkp_data)){
                $gatilhoatual->bkp_data_origem = $data_origem;
            }
            $gatilhoatual->data_limite = $dados['data_adiamento'];
            $gatilhoatual->save();



            if($ckAdiarProximos == 'S'){
                $diasuteis = date_diff(Carbon::today(), new \DateTime($dados['data_adiamento']))->format("%d");
                $diasuteis = (int)$diasuteis -1; //Tirei um por conta da data do momento. Quero que pegue sempre do dia seguinte adiante.
                //dd($diasuteis);
                $gatilhos = Gatilho::where('id', '>', $dados['id_gatilho'])->where('status', '!=', 'Finalizado')->get();
                //dd($gatilhos);

                foreach($gatilhos as $gatilho){
                    // Recuperando a bkp data para verificar se ela está NULL
                    $bkp_data       = $gatilho->bkp_data_origem;
                    // Recuperando o valor da data de origem
                    $data_origem    = $gatilho->data_limite;

                    $data_adiamento = Carbon::parse($gatilho->data_limite)->addDays($diasuteis);
                    //echo $gatilho->id . ' - ' . $data_origem . ' - ' . $data_adiamento . '<br/>';
                    $data_adiamento = $data_adiamento->format('Y-m-d');
                    //dd($data_adiamento);

                    // Fazendo essa comparação para não trocar duas vezes o bkp data
                    if(is_null($bkp_data)){
                        $gatilho->bkp_data_origem = $data_origem;
                    }
                    $gatilho->data_limite = $data_adiamento;
                    $gatilho->save();

                    // Adicionando o adiamento no banco de dados
                    $adiamento = new GatilhoAdiamento();
                    $adiamento->id_gatilho = $gatilho->id;
                    $adiamento->id_projeto = $dados['id_projeto'];
                    $adiamento->id_usuario = $dados['id_usuario'];
                    $adiamento->data_adiamento = $data_adiamento;
                    $adiamento->motivo = $dados['motivo'];
                    $adiamento->save();
                    // Fim da inserção

                }
                //dd('parou');
            }

            return redirect()->route('backend.gatilhos.projeto',$dados['id_projeto']);
        }
    /* Adiamento Salvar */

    public function testegatilhocron(){
        // Pegando a data de hoje
        $hoje = Carbon::today();
        $dtCompare = $hoje->addDays(3)->format('Y-m-d');
        $hojeFormatado = Carbon::today()->format('Y-m-d');
        DB::enableQueryLog();

        $gatilhocron = Gatilho::where('tb_gatilhos.status', '=', 'Aberto')

                    ->where(DB::raw("DATE_FORMAT( `tb_gatilhos`.`data_limite` , '%Y-%m-%d' )"), '<=', $dtCompare)
                    ->whereNotNull('tb_gatilhos_grupos.email')

                    // Trazendo a informação do Gatilho Template
                    ->leftJoin('tb_gatilhos_templates', 'tb_gatilhos.id_gatilho_template',          '=', 'tb_gatilhos_templates.id')

                    // Trazendo a informação do E-mail que vai ser enviado
                    ->leftJoin('tb_gatilhos_grupos',    'tb_gatilhos_templates.id_grupo_gatilho',   '=', 'tb_gatilhos_grupos.id')

                    // Trazendo as informações do Projeto
                    ->leftJoin('tb_projetos',           'tb_gatilhos.id_tipo_projeto',              '=', 'tb_projetos.id')

                    // Trazendo informções do Cliente
                    ->leftJoin('clientes', 'tb_projetos.cliente_id', '=', 'clientes.cliente_id')

                    ->select(
                        // Gatilhos Principal
                        'tb_gatilhos.id as id_gatilo',
                        'tb_gatilhos.data_limite',

                        // Gatilhos Templates
                        'tb_gatilhos_templates.id as id_template_gatilho',
                        'tb_gatilhos_templates.gatilho',
                        'tb_gatilhos_templates.tipo_gatilho',

                        // Informação do Projeto
                        'tb_projetos.id as id_projeto',
                        'tb_projetos.projeto',

                        // Informação do Cliente
                        'clientes.id as id_cliente',
                        'clientes.nome_fantasia',

                        // E-mail que vão receber a noticição
                        'tb_gatilhos_grupos.email',
                        'tb_gatilhos_grupos.email_adicionais',
                        DB::raw('(CASE
                            WHEN DATE_FORMAT(tb_gatilhos.data_limite,"%Y-%m-%d") <= "' . $hojeFormatado . '" THEN "atraso"
                            WHEN DATE_FORMAT(tb_gatilhos.data_limite,"%Y-%m-%d") > "' . $hojeFormatado . '" THEN "aviso"
                            ELSE ""
                            END) AS Alerta')
                    )->get();
                    //$gatilhocron->notify(new GatilhoEquipeAlertaMail());
                    //dd($gatilhocron);
                    //Notification::send($gatilhocron, new GatilhoEquipeAlertaMail());
                    //dd('ok1');
                    dd(DB::getQueryLog());
            //dd($gatilhocron);
            //


    }

    public function dispararEmailGatilhos(){
        //Premissas: Pegar os projetos em andamento
        //ver os gatilhos que estão para vencer.
        //ver os gatilhos que estão atrasados.
        //Enviar um email só, colocando estes gatilhos em tabela
        //Nome do Cliente, Data Limite, Projeto, Gatilho, Link para o gatilho(projeto). *Envolvidos(Atendimento, Dev e etc)
        //vai para staff

        $hoje = Carbon::today();
        $dtCompare = $hoje->addDays(5)->format('Y-m-d');
        $hojeFormatado = Carbon::today()->format('Y-m-d');
        $arrProjetosAvisos = [];
        $arrProjetosAtrasados = [];
        $gatilhosAvisos = [];
        $gatilhosAtrasados = [];
        $gav = 0;
        $gat = 0;
        //dd($dtCompare);

        $projetoGatilho = GatilhoProjeto::where('status', 'E')->get();

        foreach($projetoGatilho as $key => $projeto){
            //dd($projeto->id_projeto);
            $gatilhos = Gatilho::where('id_tipo_projeto', $projeto->id_projeto)
                                ->where('status', 'Aberto')
                                ->whereRaw('DATE_FORMAT(data_limite,"%Y-%m-%d") <= ?', [$dtCompare])
                                ->get();
            foreach($gatilhos as $g => $gatilho){
                //dd($gatilho->id_gatilho_template);
                //dd($gatilho->gatilhoTemplate->gatilhoGrupo->descricao);
                if(date('Y-m-d', strtotime($gatilho->data_limite)) <= $hojeFormatado){
                    $gatilhosAtrasados[$g] = [
                        'gatilho' => $gatilho->gatilhoTemplate->gatilho,
                        'data_limite' => $gatilho->data_limite,
                        'data_base' => is_null($gatilho->bkp_data_origem)?null:$gatilho->bkp_data_origem,
                        'envolvidos' => isset($gatilho->gatilhoTemplate->gatilhoGrupo->descricao)?$gatilho->gatilhoTemplate->gatilhoGrupo->descricao:''
                    ];
                    $gat++;
                }else if(date('Y-m-d', strtotime($gatilho->data_limite)) > $hojeFormatado){
                    $gatilhosAvisos[$g] = [
                        'gatilho' => $gatilho->gatilhoTemplate->gatilho,
                        'data_limite' => $gatilho->data_limite,
                        'data_base' => is_null($gatilho->bkp_data_origem)?null:$gatilho->bkp_data_origem,
                        'envolvidos' => isset($gatilho->gatilhoTemplate->gatilhoGrupo->descricao)?$gatilho->gatilhoTemplate->gatilhoGrupo->descricao:''
                    ];
                    $gav++;
                }

            }
            //dd($gatilhos);
            if($gav > 0){
                $arrProjetosAvisos[$key] = [
                    'id' => $projeto->id_projeto,
                    'projeto' => $projeto->projetos[0]->projeto,
                    'cliente' => $projeto->projetos[0]->cliente->nome_fantasia,
                    'qtdeGatAviso' => $gav,
                    'gatilhosAviso' => $gatilhosAvisos,
                ];
            }

            if($gat > 0){
                $arrProjetosAtrasados[$key] = [
                    'id' => $projeto->id_projeto,
                    'projeto' => $projeto->projetos[0]->projeto,
                    'cliente' => $projeto->projetos[0]->cliente->nome_fantasia,
                    'qtdeGatAtraso' => $gat,
                    'gatilhosAtrasados' => $gatilhosAtrasados,
                ];
            }


            $gatilhosAtrasados = [];
            $gatilhosAvisos = [];
            $gav=0;
            $gat=0;
        }

        //dd($arrProjetosAvisos);
        //teste

        if(count($arrProjetosAvisos) > 0){
            $email = new GatilhosAvisos($arrProjetosAvisos);
            $email->subject('[LD] ⚠️ AVISO GATILHO ' . Carbon::today()->format('d/m/Y'));
            Mail::to(env('MAIL_TO_ADDRESS','no-reply@example.com'))
                    ->send($email);
        }

        if(count($arrProjetosAtrasados) > 0){
            $email = new GatilhosAtrasados($arrProjetosAtrasados);
            $email->subject('[LD] 🚨 GATILHO ATRASADO ' . Carbon::today()->format('d/m/Y'));
            Mail::to(env('MAIL_TO_ADDRESS','no-reply@example.com'))
                            ->send($email);
        }
        dd('foi');

    }

    public function relatorioGatilhos(ServicesGatilho $g){
        $gatilhos = $g->fnListarGatilhos(null, null, 'E');
        //dd($gatilhos);

        $email = new RelatorioProjetos($gatilhos);
        $hoje_formatado     = (new Carbon())->format('d/m/Y');
        //dd($email);
        $email->subject('[LD] Relatório de Projetos - ' . $hoje_formatado);
        //Mail::to('usuario@example.com')->send($email);
        Mail::to(env('MAIL_TO_ADDRESS','no-reply@example.com'))->cc(env('MAIL_CC_ADDRESS', null))->send($email);

    }

    public function relatorioGatilhosPausados(ServicesGatilho $g){
        $gatilhos = $g->fnListarGatilhos(null, null, 'P');
        //dd($gatilhos);

        $email = new RelatorioProjetos($gatilhos);
        $hoje_formatado     = (new Carbon())->format('d/m/Y');
        //dd($email);
        $email->subject('[LD] Verificar Andamento - Projetos Pausados - ' . $hoje_formatado);
        //Mail::to(env('MAIL_ADMIN_ADDRESS','usuario@example.com'))->send($email);
        Mail::to(env('MAIL_TO_ADDRESS','no-reply@example.com'))->cc(env('MAIL_CC_ADDRESS', null))->send($email);

    }

}
