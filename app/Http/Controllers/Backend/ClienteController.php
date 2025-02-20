<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Cliente;
use App\Segmento;
use App\Projeto;
use App\Clientes_Vencidas;
use App\Tarefa;
use App\User;
use App\ClienteContato;
use App\GatilhoTemplate;
use App\ClienteDominio;
use App\TipoProjeto;
use App\Notifications\DevedoresMail;
use App\Services\Discord;
use App\Services\Gatilho;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{

    use Notifiable;
    protected $pagina = 30;

	public function index(){
        //$clientes = Cliente::paginate(10);

        $clientes = Cliente::where('clientes.status',true)
                ->select(
                    'clientes.id',
                    'clientes.nome',
                    'clientes.cliente_id',
                    'clientes.nome_fantasia',
                    'clientes.razao_social',
                    'clientes.status_financeiro',
                    'clientes.status',
                    DB::raw("(SELECT COUNT(tb_projetos.id) FROM tb_projetos
                            WHERE tb_projetos.cliente_id = clientes.cliente_id) as num_projetos"),
                    DB::raw("(SELECT COUNT(tb_cliente_dominios.id_dominio) FROM tb_cliente_dominios
                    WHERE tb_cliente_dominios.id_cliente = clientes.id) as num_dominios"),
                    DB::raw("(SELECT COUNT(tb_clientes_contatos.id) FROM tb_clientes_contatos
                    WHERE tb_clientes_contatos.id_cliente = clientes.id) as num_contatos")
                )->orderBy('clientes.nome_fantasia', 'ASC')
                ->paginate(50);



        //dd($clientes);

        if( Gate::denies('listar_cliente') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para acessar a listagem de clientes', 'class'=>'']);
            return redirect()->back();
        }



        return view('backend.cliente.index',compact('clientes'));
    }

	public function listagem(){

	        // Trazendo os dados do Cliente
	            $clientes = Cliente::where('clientes.status',  '=',  '1')
	                ->select(
	                    'clientes.id',
	                    'clientes.nome',
	                    'clientes.nome_fantasia',
	                    'clientes.status_financeiro',
	                    'clientes.cliente_id'
	                    )
	                ->orderBy(
	                    'clientes.nome_fantasia'
	                    )
	                ->paginate(20);
	        // Fim
	        $tipoprojetos = TipoProjeto::where('status', 'Ativo')->orderBy('nome', 'ASC')->get();


	        return view('backend.cliente.listagem.index', compact('clientes', 'tipoprojetos'));
	}

	public function filtrarListagem(Request $request){
	        $dados = $request->all();

	        $blCliente = (is_null($dados['nome_cliente']))?false:$dados['nome_cliente'];
	        $blIdTipoProjeto = (is_null($dados['idtipoprojeto']))?false:$dados['idtipoprojeto'];
	        $blContato = (is_null($dados['nome_contato']))?false:$dados['nome_contato'];


	            $clientes = Cliente::from('clientes as c')
	                ->where('c.status',  '1')
	                ->where('p.status',  'Ativo')
	                ->where('tp.status',  'Ativo')
	                ->leftJoin('tb_projetos as p', 'p.cliente_id', 'c.cliente_id')
	                ->leftJoin('tb_tipo_projetos as tp', 'tp.id', 'p.id_tipo_projeto')
	                ->leftJoin('tb_clientes_contatos as tc', 'tc.id_cliente', 'c.id')
	                ->when($blCliente, function ($clientes, $blCliente) {
	                    //return $clientes->where('c.nome_fantasia', 'like', '%' . $blCliente . '%');
                        return $clientes->whereRaw('LOWER(c.nome_fantasia) like ?', "%" . strtolower($blCliente) . "%");
	                })
	                ->when($blIdTipoProjeto, function ($clientes, $blIdTipoProjeto) {
	                    return $clientes->where('tp.id', $blIdTipoProjeto);
	                })
	                ->when($blContato, function ($clientes, $blContato) {
	                    return $clientes->where('tc.nome_contato', 'like', '%' . $blContato . '%');
	                })
	                ->select(
	                    'c.id',
	                    'c.nome',
	                    'c.nome_fantasia',
	                    'c.status_financeiro',
	                    'c.cliente_id'
	                    )
	                ->groupBy('c.id',
	                'c.nome',
	                'c.nome_fantasia',
	                'c.status_financeiro',
	                'c.cliente_id')
	                ->orderBy(
	                    'c.nome_fantasia'
	                    )
	                ->get();
	                //dd($clientes);

	            return view('backend.cliente.listagem.filtrado', compact('clientes'));
	    }

    public function mudarStatus(){

        $id = Input::get('id');

        if( Gate::denies('mudar_status_cliente') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para acessar a mudança de status', 'class'=>'']);
            return redirect()->back();
        }
        $cliente = Cliente::findOrFail($id);
        $cliente->status = !$cliente->status;
        $cliente->save();

        return response()->json($cliente);
    }

    public function busca(Request $request){
        //$nome = $_POST['busca-cliente'];
        $nome = Input::get ( 'busca-cliente' );
        $vStatus = '';
        //dd($teste);
        switch ($nome) {
            case 'devedores':
                $vStatus = 2;
                break;
            case 'atencao':
                $vStatus = 1;
                break;
            case 'em dia':
                $vStatus = 0;
                break;
        }
        //$clientes = Cliente::where([
        //        ['nome', 'LIKE', '%' . $nome . '%'],
        //])->paginate(10);
        if($vStatus != ''){
        $clientes = Cliente::where([
                    ['nome', 'LIKE', '%' . $nome . '%'],
                ])
                ->orWhere('nome_fantasia', 'LIKE', '%' . $nome . '%')
                ->orWhere('razao_social', 'LIKE', '%' . $nome . '%')
                ->orWhere('status_financeiro', '=', $vStatus)->orderBy('clientes.nome_fantasia', 'ASC')
                ->select(
                    'clientes.id',
                    'clientes.nome',
                    'clientes.cliente_id',
                    'clientes.nome_fantasia',
                    'clientes.razao_social',
                    'clientes.status_financeiro',
                    'clientes.status',
                    DB::raw("(SELECT COUNT(tb_projetos.id) FROM tb_projetos
                            WHERE tb_projetos.cliente_id = clientes.cliente_id) as num_projetos"),
                    DB::raw("(SELECT COUNT(tb_cliente_dominios.id_dominio) FROM tb_cliente_dominios
                    WHERE tb_cliente_dominios.id_cliente = clientes.id) as num_dominios"),
                    DB::raw("(SELECT COUNT(tb_clientes_contatos.id) FROM tb_clientes_contatos
                    WHERE tb_clientes_contatos.id_cliente = clientes.id) as num_contatos")
                )
                ->paginate(50);
            }else{
                $clientes = Cliente::where([
                    ['nome', 'LIKE', '%' . $nome . '%'],
                    ])->orWhere('nome_fantasia', 'LIKE', '%' . $nome . '%')
                    ->orWhere('razao_social', 'LIKE', '%' . $nome . '%')->orderBy('clientes.nome_fantasia', 'ASC')
                ->select(
                    'clientes.id',
                    'clientes.nome',
                    'clientes.cliente_id',
                    'clientes.nome_fantasia',
                    'clientes.razao_social',
                    'clientes.status_financeiro',
                    'clientes.status',
                    DB::raw("(SELECT COUNT(tb_projetos.id) FROM tb_projetos
                            WHERE tb_projetos.cliente_id = clientes.cliente_id) as num_projetos"),
                    DB::raw("(SELECT COUNT(tb_cliente_dominios.id_dominio) FROM tb_cliente_dominios
                    WHERE tb_cliente_dominios.id_cliente = clientes.id) as num_dominios"),
                    DB::raw("(SELECT COUNT(tb_clientes_contatos.id) FROM tb_clientes_contatos
                    WHERE tb_clientes_contatos.id_cliente = clientes.id) as num_contatos")
                )
                ->paginate(20);
            }

        $clientes->appends ( array (
            'busca-cliente' => Input::get ( 'busca-cliente' )
                ) );

        return view('backend.cliente.index', compact('clientes'))->withQuery($nome);
    }

    public function adicionar(){
        $clientes = Cliente::all();
        $segmentos = Segmento::all();

        if( Gate::denies('adicionar_cliente') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar os clientes', 'class'=>'']);
            return redirect()->back();
        }

        return view('backend.cliente.adicionar', compact('segmentos' ,'clientes'));
    }

    public function salvar(Request $request){
        $dados = $request->all();
        $clientes = new Cliente();

        $cliente_max = Cliente::max('cliente_id');

        $clientes->nome                     = $dados['nome'];
        $clientes->cliente_id               = $cliente_max + 1;
        $clientes->dominio                  = $dados['nome'];
        $clientes->razao_social             = $dados['razao_social'];
        $clientes->nome_fantasia            = $dados['nome_fantasia'];
        $clientes->CNPJ                     = $dados['CNPJ'];
        $clientes->dia_boleto               = $dados['dia_boleto'];
        $clientes->perfil_cliente           = $dados['perfil_cliente'];
        $clientes->inscricao_estadual       = $dados['inscricao_estadual'];
        $clientes->id_segmento              = $dados['id_segmento'];

        // Endereço
        $clientes->cep                      = $dados['cep'];
        $clientes->endereco                 = $dados['endereco'];
        $clientes->bairro                   = $dados['bairro'];
        $clientes->cidade                   = $dados['cidade'];
        $clientes->estado                   = $dados['estado'];
        $clientes->numero                   = $dados['numero'];
        $clientes->complemento              = $dados['complemento'];

        $clientes->save();

        return redirect()->route('backend.cliente');
    }

    public function editar($id){
        $clientes = Cliente::find($id);
        $segmentos = Segmento::all();
        //dd($segmentos);
		$segmentoCliente = Segmento::find($clientes->id_segmento);

		if(Auth::user()->isAdmin()){
            $usuarios = User::Where('ativo',1)->whereNotIn('id', [3,27,34])->whereNotIn('id',function($q) use($id){
                $q->select('idusuario')
                ->from('clientes_responsaveis')
                ->where('idcliente', $id);
            })->orderBy('name')->orderBy('sobrenome')->get();
        }else{
            $usuarios = User::Where('ativo',1)->where('setor', Auth::user()->setor)->whereNotIn('id',function($q) use($id){
                $q->select('idusuario')
                ->from('clientes_responsaveis')
                ->where('idcliente', $id);
            })->orderBy('name')->orderBy('sobrenome')->get();
        }

        $clientes_contatos = ClienteContato::Where('id_cliente', '=', $id)->get();
        $clientes_dominios = ClienteDominio::Where('id_cliente', '=', $id)->with('ClientesDominios')->get();
        //$clientes_projetos = Projeto::Where('cliente_id', '=', $clientes_id)->get();
        $clientes_projetos = DB::table('tb_projetos')
                ->leftJoin('tb_cliente_dominios', 'tb_projetos.id_dominio', 'tb_cliente_dominios.id_dominio')
                ->where('cliente_id', '=', $clientes->cliente_id)
                ->select(
                    'tb_projetos.id',
                    'tb_projetos.projeto',
                    'tb_projetos.status',
                    'tb_cliente_dominios.dominio'
                )
            ->get();
        //dd($clientes_projetos);

		$registros_senhas = DB::table('tbRegistroSenhas')
            ->join('tbAuxTipoRegistro', 'tbAuxTipoRegistro.idTipoRegistro','tbRegistroSenhas.idTipoRegistro')
            ->leftJoin('tb_cliente_dominios', 'tb_cliente_dominios.id_dominio','tbRegistroSenhas.idDominio')
            ->select('tbRegistroSenhas.idRegistroSenha','tbRegistroSenhas.strURL','tbRegistroSenhas.strLogin','tbRegistroSenhas.strSenha',
                    'tbAuxTipoRegistro.nome','tb_cliente_dominios.dominio', 'tbRegistroSenhas.admin')
            ->where('idCliente', '=', $id);
            if(!Auth::user()->isAdmin()){
                $registros_senhas = $registros_senhas->where('tbRegistroSenhas.admin',0);

            }
            $registros_senhas = $registros_senhas->orderBy('tbRegistroSenhas.idRegistroSenha', 'desc')->get();
        //Fim

        if( Gate::denies('editar_cliente') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar clientes !!', 'class'=>'']);
            return redirect()->back();
        }

        return view('backend.cliente.editar', compact('clientes_projetos','clientes_dominios' ,'segmentos', 'clientes_contatos' ,'clientes','registros_senhas', 'segmentoCliente', 'usuarios'));
    }

    public function atualizar(Request $request, $id){

        $clientes  	= Cliente::find($id);
        $dados      = $request->all();
        $clientes->nome                     = $dados['nome'];
        $clientes->dominio                  = $dados['nome'];
        $clientes->razao_social             = $dados['razao_social'];
        $clientes->nome_fantasia            = $dados['nome_fantasia'];
        $clientes->CNPJ                     = $dados['CNPJ'];
        $clientes->dia_boleto               = $dados['dia_boleto'];
        $clientes->perfil_cliente           = $dados['perfil_cliente'];
        $clientes->inscricao_estadual       = $dados['inscricao_estadual'];
        $clientes->id_segmento              = $dados['id_segmento'];

        // Endereço
        $clientes->cep                      = $dados['cep'];
        $clientes->endereco                 = $dados['endereco'];
        $clientes->bairro                   = $dados['bairro'];
        $clientes->cidade                   = $dados['cidade'];
        $clientes->estado                   = $dados['estado'];
        $clientes->numero                   = $dados['numero'];
        $clientes->complemento              = $dados['complemento'];

        $clientes->Update();

        Session::flash('flash_mensagem', ['msg'=>'Cliente Atualizado com Sucesso', 'class'=>'background-color: #11d482;border-color: #11d482;']);

        return redirect()->route('backend.cliente.editar', $id);
    }

    public function deletar($id){


        if( Gate::denies('deletar_cliente') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar clientes !!', 'class'=>'']);
            return redirect()->back();
        }

        $clientes = Cliente::find($id);
        $clientes->delete();
        return redirect()->route('backend.cliente');
    }

    public function tranferirCliente($id,$id_projeto){
        $cliente = Cliente::find($id);
        $projeto = Projeto::find($id_projeto);
        $todas_clientes = Cliente::orderBy('nome')->where('status', '=', true)->get();
        return view('backend.cliente.projeto.transferir', compact('cliente','todas_clientes','projeto'));
    }

    public function dominiosCliente($id){
        $dominios   = DB::table('tb_cliente_dominios')
            ->where('id_cliente', '=', $id)
            ->select(
                'tb_cliente_dominios.id_dominio',
                'tb_cliente_dominios.id_cliente',
                'tb_cliente_dominios.dominio'
            )
        ->get();

        header('Content-Type: text/html; charset=utf-8');
        echo json_encode($dominios);

        return view('backend.cliente.json.DominioClientes', compact('tiposArray'));
    }

    public function dominioAdicionarCliente(){
    }

    public function tranferirSalvarCliente(Request $request, $id,$id_projeto){

        $dados = $request->all();

        $vProjeto  = Projeto::find($id_projeto);

        $vProjeto->cliente_id = $dados['cliente_id'];
        $vProjeto->id_dominio = isset($dados['dominio'])?$dados['dominio']:null;
        $vProjeto->Update();

        Session::flash('flash_mensagem', ['msg'=>'Projeto transferido com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

        return redirect()->route('backend.cliente.editar', $id);

    }

    /* Vencidos */
        public function vencidos(){
            $clientes = Clientes_Vencidas::all();

            if( Gate::denies('listar_boletos_vencidos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            return view('backend.cliente.vencidos',compact('clientes'));
        }

        /* Nome */
            public function vencidos_nome_maior(){
                $clientes = Clientes_Vencidas::OrderBy('nome', 'DESC')->paginate(300);

                return view('backend.cliente.vencidos',compact('clientes'));
            }

            public function vencidos_nome_menor(){
                $clientes = Clientes_Vencidas::OrderBy('nome', 'ASC')->paginate(300);

                return view('backend.cliente.vencidos',compact('clientes'));
            }

        /* Data */
            public function vencidos_data_maior(){
                $clientes = Clientes_Vencidas::OrderBy('vencimento', 'DESC')->paginate(300);

                return view('backend.cliente.vencidos',compact('clientes'));
            }

            public function vencidos_data_menor(){
                $clientes = Clientes_Vencidas::OrderBy('vencimento', 'ASC')->paginate(300);

                return view('backend.cliente.vencidos',compact('clientes'));
            }

        /* Valor*/
            public function vencidos_valor_maior(){
                $clientes = Clientes_Vencidas::OrderBy('valor', 'DESC')->paginate(300);

                return view('backend.cliente.vencidos',compact('clientes'));
            }

            public function vencidos_valor_menor(){
                $clientes = Clientes_Vencidas::OrderBy('valor', 'ASC')->paginate(300);

                return view('backend.cliente.vencidos',compact('clientes'));
            }

        /* Atualizar Banco */
            public function atualizar_vencidos(){


                Clientes_Vencidas::query()->truncate();

                /* Montando a autenticação do Sistema */
                    $urlLogin = 'https://www.asaas.com/api/v3/payments?status=OVERDUE&limit=100';
                    $apikey = 'bdc8085c1ef24587525a014056cc7c7d0bde593adfa637523ca9b8e565068d50';
                    $urlLoginCliente = 'https://www.asaas.com/api/v3/customers/';

                /* Cabelhaço das autenticação */
                    $headers = array(
                        "access_token: " . $apikey,
                        "Content-type: application/json",
                        "Connection: close",
                    );

                /* Browser para acesso (User Agent) */
                    $userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';

                /* Executando a autentição */
                    $ch = curl_init();
                    curl_setopt( $ch, CURLOPT_URL, $urlLogin );
                    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                    $data = curl_exec($ch);

                if(!curl_errno($ch)){
                    $resultado = json_decode($data, true);

                    foreach($resultado['data'] as $registro):

                        /* Puxar o nome do Cliente */
                            $chcliente = curl_init();
                            curl_setopt( $chcliente, CURLOPT_URL, $urlLoginCliente . $registro['customer']);
                            curl_setopt( $chcliente, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt( $chcliente, CURLOPT_RETURNTRANSFER, true );
                            $dataCliente = curl_exec($chcliente);
                            $resultadoCliente = json_decode($dataCliente, true);



                        /* Inserindo no banco de dados */
                            Clientes_Vencidas::insert([
                                ['nome' => html_entity_decode($resultadoCliente['name']), 'valor' => $registro['value'], 'vencimento' => $registro['dueDate'],'idCustomerAsaas' => $registro['customer']]
                            ]);

                    endforeach;

                    //Atualiza Status Financeiro - 0 Em dia, 1 Atencao e 2 nao fazer nada.
                    /*
                        SELECT c.id, c.nome, c.nome_fantasia, COUNT( cv.idCustomerAsaas )
                        FROM clientes AS c
                        LEFT JOIN `clientes_vencidas` AS cv ON c.idCustomerAsaas = cv.idCustomerAsaas
                        GROUP BY c.nome, c.cliente_id, c.nome_fantasia
                        HAVING COUNT( cv.idCustomerAsaas ) >0
                    */
                    $arrClientesVencidos = DB::table('clientes')
                    ->leftJoin('clientes_vencidas', 'clientes.idCustomerAsaas', 'clientes_vencidas.idCustomerAsaas')
                    ->select(
                        'clientes.id',
                        DB::raw('COUNT( clientes_vencidas.idCustomerAsaas ) as QtdeBoletos')
                    )->groupBy('clientes.id')
                    ->havingRaw('COUNT( clientes_vencidas.idCustomerAsaas ) > ?', [0])
                    ->get();

                    foreach($arrClientesVencidos as $financeiro):
                        $clienteFin  	= Cliente::find($financeiro->id);
                        if($financeiro->QtdeBoletos == 1){
                            $clienteFin->status_financeiro  = 1;
                        }else{
                            $clienteFin->status_financeiro  = 2;
                        }

                        $clienteFin->Update();
                    endforeach;

                    //Manda email com os devedores
                    //Implantado dia 19/07/19
                    //Atualizado em 04/11/19
                    $arrClientesDevedores = DB::table('clientes')
                    ->Where('clientes.status_financeiro', '!=' , '0')
                    ->Where('clientes.status', true)
                    ->orderBy('clientes.nome_fantasia','ASC')
                    ->select(
                        'clientes.id',
                        'clientes.nome_fantasia',
                        'clientes.nome',
                        'clientes.status_financeiro',
                        DB::raw('(CASE
                            WHEN clientes.status_financeiro = "1" THEN "Atenção"
                            WHEN clientes.status_financeiro = "2" THEN "Devedor"
                        END) AS status_financeiro_escrito')
                    )->get();
                    //dd($arrClientesDevedores);
                    $discord = new Discord();
                    foreach($arrClientesDevedores as $key => $stCliente){

                        $mensagem = date("d/m/Y") . ' - ' . $stCliente->nome_fantasia . ' - ' . $stCliente->status_financeiro_escrito;

                        if($stCliente->status_financeiro == 1){
                            //mandar no discord atençao
                            $discord->disparar('1280964447262740510', '2tyWPSM6rhMfo9oHUrBEYjUqHOV781hlbhbKVO6j09GX3y3sYjyIt60RMNMg_BZo82nI', $mensagem);
                        }elseif($stCliente->status_financeiro == 2){

                            $discord->disparar('1280966816751161428', '-2CqHuxcLnhhH7OJDAt1-MlVe-w3JPGzFyXxvrXVlrhzk9fcSLD6zqgcN67xvcqwygfk', $mensagem);
                        }
                    }

                    $arrClientesDevedores = $arrClientesDevedores->toArray();
                    $hoje_formatado     = (new Carbon())->format('d/m/Y');


                    Mail::send('backend.emails.devedoresemail', ['arrClientesDevedores' => $arrClientesDevedores], function ($m) use($hoje_formatado) {
                        $m->from('financeiro@logicadigital.info', 'Financeiro - Logica Digital');
                        $m->to('marketing@logicadigital.info', 'Todos')
                        ->cc('comercial@logicadigital.info', 'Todos')->subject('[Logica Digital] Devedores - ' . $hoje_formatado);
                    });
                }

				//return redirect()->route('backend.cliente.vencidos');

            }

        /* Busca */
            public function buscavencidos(Request $request){
                $nome = $_POST['busca-cliente'];
                $clientes = Clientes_Vencidas::where([
                        ['nome', 'LIKE', '%' . $nome . '%'],
                ])->paginate($this->pagina);

                return view('backend.cliente.vencidos', compact('clientes'));
            }
    /* FIM VENCIDOS */

    /* Contato Cliente */
        public function adicionarContato($id){

            if( Gate::denies('adicionar_contato_cliente') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar contato ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes = Cliente::find($id);
            $clientes_contatos = ClienteContato::all();

            //dd($clientes_contatos);

            return view('backend.cliente.contato.adicionar',compact('clientes_contatos','clientes'));
        }

        public function salvarContato(Request $request){
            $dados = $request->all();
            $clientes_contatos = new ClienteContato();

            if( Gate::denies('adicionar_contato_cliente') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar contato ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            ///dd($dados);

            $clientes_contatos->id_cliente               = $dados['id_cliente'];
            $clientes_contatos->nome_contato             = $dados['nome_contato'];
            $clientes_contatos->telefone                 = $dados['telefone'];
            $clientes_contatos->celular                  = $dados['celular'];
            $clientes_contatos->email                    = $dados['email'];
            $clientes_contatos->tipo_contato             = $dados['tipo_contato'];
            $clientes_contatos->ramal             = $dados['ramal'];

            $clientes_contatos->save();

            Session::flash('flash_mensagem', ['msg'=>'Contato do cliente alterado com sucesso.', 'class'=>'']);

            return redirect()->route('backend.cliente.editar', $dados['id_cliente']);
        }

        public function editarContato($id, $id_contato){



            if( Gate::denies('editar_contato_cliente') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar contato ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes = Cliente::find($id);
            $clientes_contatos = ClienteContato::find($id_contato);
            //dd($clientes_contatos);

            return view('backend.cliente.contato.editar',compact('clientes_contatos','clientes'));
        }

        public function atualizarContato(Request $request, $id, $id_contato){

            $clientes_contatos  = ClienteContato::find($id_contato);
            $dados              = $request->all();

            if( Gate::denies('editar_contato_cliente') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar contato ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes_contatos->id_cliente               = $dados['id_cliente'];
            $clientes_contatos->nome_contato             = $dados['nome_contato'];
            $clientes_contatos->telefone                 = $dados['telefone'];
            $clientes_contatos->celular                  = $dados['celular'];
            $clientes_contatos->email                    = $dados['email'];
            $clientes_contatos->tipo_contato             = $dados['tipo_contato'];
            $clientes_contatos->ramal                    = $dados['ramal'];
            $clientes_contatos->Update();

            Session::flash('flash_mensagem', ['msg'=>'Contato atualizado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.cliente.editar', $dados['id_cliente']);
        }

        public function deletarContato($id,$id_contato){

            if( Gate::denies('deletar_cliente_contato') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar contato ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes_contatos = ClienteContato::find($id_contato);
            $clientes_contatos->delete();

            Session::flash('flash_mensagem', ['msg'=>'Contato deletado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.cliente.editar', $id);
        }
    /* Fim Contato */

    /* Domínio Cliente */
        public function adicionarDominio($id){

            if( Gate::denies('adicionar_dominio_cliente') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar dominio ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes = Cliente::find($id);
            $clientes_dominios = ClienteDominio::all();
            //dd($clientes_dominios);

            return view('backend.cliente.dominio.adicionar',compact('clientes_dominios','clientes'));
        }

        public function salvarDominio(Request $request){
            $dados = $request->all();
            $clientes_dominios = new ClienteDominio();

            if( Gate::denies('adicionar_dominio_cliente') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar dominio ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes_dominios->id_cliente          = $dados['id_cliente'];
            $clientes_dominios->dominio             = $dados['dominio'];
            $clientes_dominios->tipo_hospedagem     = $dados['tipo_hospedagem'];
            $clientes_dominios->dominio_principal   = $dados['dominio_principal'];
            $clientes_dominios->status              = $dados['status'];
            $clientes_dominios->ssl              = $dados['ssl'];
            $clientes_dominios->cdn              = $dados['cdn'];
            $clientes_dominios->save();

            Session::flash('flash_mensagem', ['msg'=>'Dominio do cliente salvo com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.cliente.editar', $dados['id_cliente']);
        }

        public function salvarDominioTransferir(Request $request,$id,$id_projeto){
            //dd($id_projeto);
            $dados = $request->all();
            //dd($dados);
            $clientes_dominios = new ClienteDominio();

            if( Gate::denies('adicionar_dominio_cliente') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar dominio ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes_dominios->id_cliente          = $dados['pcliente_selecionado'];
            $clientes_dominios->dominio             = $dados['dominio'];
            $clientes_dominios->tipo_hospedagem     = $dados['tipo_hospedagem'];
            $clientes_dominios->dominio_principal   = $dados['dominio_principal'];
            $clientes_dominios->status              = $dados['status'];
            $clientes_dominios->ssl              = $dados['ssl'];
            $clientes_dominios->cdn              = $dados['cdn'];
            $clientes_dominios->save();

            Session::flash('flash_mensagem', ['msg'=>'Dominio do cliente criado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.cliente.transferir', [$id,$id_projeto]);
        }

        public function editarDominio($id, $id_dominio){

            if( Gate::denies('editar_dominio_cliente') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar dominio ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes = Cliente::find($id);
            $clientes_dominios = ClienteDominio::Where('id_dominio', '=', $id_dominio)->first();
            //dd($clientes_dominios);

            return view('backend.cliente.dominio.editar',compact('clientes_dominios','clientes'));
        }

        public function atualizarDominio(Request $request, $id, $id_dominio){

            if( Gate::denies('editar_dominio_cliente') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar dominio ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }
            $dados              = $request->all();

            DB::table('tb_cliente_dominios')->where('id_dominio', $id_dominio)->update(
                [
                    'id_cliente'            => $dados['id_cliente'],
                    'dominio'               => $dados['dominio'],
                    'tipo_hospedagem'       => $dados['tipo_hospedagem'],
                    'dominio_principal'     => $dados['dominio_principal'],
                    'status'                => $dados['status'],
                    'ssl'                => $dados['ssl'],
                    'cdn'                => $dados['cdn']
                ]
            );

            Session::flash('flash_mensagem', ['msg'=>'Dominio atualizado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.cliente.editar', $dados['id_cliente']);

        }

        public function deletarDominio($id, $id_dominio){

            if( Gate::denies('deletar_dominio') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para deletar dominio do clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            DB::table('tb_cliente_dominios')->where('id_dominio', $id_dominio)->delete();

            Session::flash('flash_mensagem', ['msg'=>'Dominio deletado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.cliente.editar', $id);
        }
    /* Fim Dominio */

    /* Projeto Cliente */
        public function adicionarProjeto($id){

            if( Gate::denies('adicionar_projetos') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar projeto ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes = Cliente::find($id);
            $projetos = Projeto::all();
            $tipos_projetos = TipoProjeto::all();
            $idDominio    =    isset($projetos->id_dominio)?$projetos->id_dominio:0;
            $clientedominios = ClienteDominio::Where('id_cliente', '=', $id)->get();

            return view('backend.cliente.projeto.adicionar',compact('tipos_projetos','projetos','clientes','clientedominios','idDominio'));
        }

        public function salvarProjeto(Request $request, Gatilho $g){

            // Verificando se o usuário tem permissão para efetuar essa ação
                if( Gate::denies('adicionar_projetos') ){
                    Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar projeto ao clientes !!', 'class'=>'']);
                    return redirect()->back();
                }
            // Fim



            // Recuperando os dados enviadas pelo formulário
                $dados = $request->all();
                //dd($dados);
            // Fim

            // Buscando o id do cliente para voltar para a mesma tela (Só para redirecionamento)
                $id_cliente_voltar = Cliente::Where('cliente_id', '=', $dados['cliente_id'])->value('id');
            // Fim

                $rules_projeto =
                [
                    'id_tipo_projeto' => 'required',
                    'tempo_projeto' => 'required|not_in:0'
                ];

                $messages_projeto = [
                    'tempo_projeto.required' => 'O campo PRAZO precisa ser preenchido corretamente.',
                    'tempo_projeto.not_in' => 'O campo PRAZO precisa ser preenchido corretamente.',
                    'id_tipo_projeto.required'    => 'O campo TIPO do PROJETO precisa ser preenchido corretamente.',
                ];

                $validator_projetos = Validator::make($dados, $rules_projeto, $messages_projeto);

                if ($validator_projetos->fails()) {
                    return redirect()->route('backend.cliente.adicionarProjeto',$id_cliente_voltar)
                                        ->withErrors($validator_projetos)
                                        ->withInput();
                }else{

                    // Criando mais uma linha no banco de dados
                        $projeto = new Projeto();
                    // Fim

                    // Inserindo os dados no banco de dados
                        $projeto->id_tipo_projeto   = $dados['id_tipo_projeto'];
                        $nome_produto               = TipoProjeto::Where('id', '=', $dados['id_tipo_projeto'])->value('nome');
                        $projeto->projeto           = $nome_produto;
                        $projeto->cliente_id        = $dados['cliente_id'];
                        $projeto->id_dominio        = $dados['id_dominio'];
                        $projeto->status            = $dados['status'];
                        $projeto->prazo             = isset($dados['tempo_projeto'])?(int)$dados['tempo_projeto']:null;
                        $projeto->data_referencia   = isset($dados['data-referencia'])?date( 'Y-m-d' , strtotime($dados['data-referencia']) ):null;
                        $projeto->save();

                    // Fim
                    $g->fnAdicionarGatilho($projeto->id_tipo_projeto, $dados['data-referencia'], $projeto->id, $dados['tempo_projeto']);
                }

            // Notificação para avisar que o projeto do cliente foi salvo com sucesso
                Session::flash('flash_mensagem', ['msg'=>'Projeto do cliente salvo com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);
            // Fim

            return redirect()->route('backend.cliente.editar', $id_cliente_voltar);
        }

        public function editarProjeto($id, $id_projeto){

            if( Gate::denies('editar_projeto') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar projeto ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $clientes   = Cliente::find($id);
            $projetos    = Projeto::Where('id', '=', $id_projeto)->first();
            //dd($projetos);
            $idDominio    =    isset($projetos->id_dominio)?$projetos->id_dominio:0;
            $clientedominios = ClienteDominio::Where('id_cliente', '=', $id)->get();

            return view('backend.cliente.projeto.editar',compact('projetos','clientes','clientedominios','idDominio'));
        }

        public function atualizarProjeto(Request $request, $id, $id_projeto){

            if( Gate::denies('editar_projeto') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar projeto ao clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $dados                      = $request->all();
            //dd($dados);
            $projeto  	                = Projeto::find($id_projeto);
            if($dados['id_tipo_projeto'] == null){

            }else{
                $projeto->id_tipo_projeto   = $dados['id_tipo_projeto'];
                $nome_produto               = TipoProjeto::Where('id', '=', $dados['id_tipo_projeto'])->value('nome');
                $projeto->projeto           = $nome_produto;
            }
            $projeto->cliente_id        = $dados['cliente_id'];
            $projeto->status            = $dados['status'];
            $projeto->id_dominio        = $dados['id_dominio'];
            $projeto->prazo             = isset($dados['tempo_projeto'])?(int)$dados['tempo_projeto']:null;
            $projeto->data_referencia   = isset($dados['data-referencia'])?date( 'Y-m-d' , strtotime($dados['data-referencia']) ):null;
            $projeto->Update();

            Session::flash('flash_mensagem', ['msg'=>'Projeto atualizado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

            return redirect()->route('backend.cliente.editar', $id);

        }

        public function deletarProjeto($id, $id_projeto){

            if( Gate::denies('deletar_projeto') ){
                Session::flash('flash_mensagem', ['msg'=>'Sem permissão para deletar projeto do clientes !!', 'class'=>'']);
                return redirect()->back();
            }

            $projetos = Projeto::find($id_projeto);
            $projetos->delete();

            Session::flash('flash_mensagem', ['msg'=>'Projeto deletado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);
            return redirect()->route('backend.cliente.editar', $id);
        }
    /* Fim Dominio */

    /*REGISTRO DE SENHAS */
    public function adicionarRegistroSenha($id){

        // Verificando se o usuário tem permissão para efetuar essa ação
        if( Gate::denies('adicionar_registro_senhas') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar registro de senha ao clientes !!', 'class'=>'']);
            return redirect()->back();
        }
        // Fim

        $clientes = Cliente::find($id);
        $clientes_dominios = ClienteDominio::Where('id_cliente', $id)->get();
        $tipos_registros = DB::table('tbAuxTipoRegistro')->select('idTipoRegistro','nome')->where('ativo',1)->orderBy('idTipoRegistro', 'desc')->get();
        $registro_senhas = '';

        return view('backend.cliente.registro-senha.adicionar',compact('clientes','clientes_dominios','tipos_registros','registro_senhas'));
    }

    public function salvarRegistroSenha(Request $request){

        // Verificando se o usuário tem permissão para efetuar essa ação
        if( Gate::denies('adicionar_registro_senhas') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar registro de senha ao clientes !!', 'class'=>'']);
            return redirect()->back();
        }
        // Fim

        $dados = $request->all();
        //dd($dados);

        $rules =
        [
            'login' => 'required|min:2|max:128',
            'senha' => 'required|min:2|max:128',
            'tipo_registro' => 'required|not_in:--'
        ];

        $messages = [
            'tipo_registro.required' => 'O campo TIPO REGISTRO precisa ser preenchido corretamente.',
            'tipo_registro.not_in' => 'O campo TIPO REGISTRO precisa ser preenchido corretamente.',
            'login.required'    => 'O campo LOGIN precisa ser preenchido corretamente.',
            'login.min'    => 'O campo LOGIN precisa ser preenchido corretamente.',
            'senha.required'    => 'O campo SENHA precisa ser preenchido corretamente.',
            'senha.min'    => 'O campo SENHA precisa ser preenchido corretamente.',
        ];

        $validator = Validator::make($dados, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('backend.cliente.adicionarRegistroSenha',$dados['id_cliente'])
		                        ->withErrors($validator)
		                        ->withInput();
        }else{
            //dd($dados);
            DB::table('tbRegistroSenhas')->insert([
                [
                    'strURL'               => $dados['url'],
                    'strLogin'           => $dados['login'],
                    'strSenha'    => $dados['senha'],
                    'observacao'                   => $dados['observacao'],
                    'admin'                        => $dados['admin'],
                    'idTipoRegistro'                    => $dados['tipo_registro'],
                    'idDominio'                => $dados['id_dominio'],
                    'idCliente'                    => $dados['id_cliente'],
                    'created_at'                => date( 'Y-m-d H:i:s')
                ]
            ]);

             // Notificação para avisar que o projeto do cliente foi salvo com sucesso
             Session::flash('flash_mensagem', ['msg'=>'Registro de Senha salvo com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);
             // Fim

             return redirect()->route('backend.cliente.editar', $dados['id_cliente']);
        }
    }

    public function deletarRegistroSenha($id, $idRegistroSenha){
        //dd($id);
        // Verificando se o usuário tem permissão para efetuar essa ação
        if( Gate::denies('deletar_registro_senhas') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para apagar registro de senha!!', 'class'=>'']);
            return redirect()->back();
        }
        // Fim
        $registroSenha = DB::table('tbRegistroSenhas')->where('idRegistroSenha', '=', $idRegistroSenha)->delete();


        Session::flash('flash_mensagem', ['msg'=>'Registro de Senha deletado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);
        return redirect()->route('backend.cliente.editar', $id);
    }

    public function editarRegistroSenha($id, $idRegistroSenha){

        // Verificando se o usuário tem permissão para efetuar essa ação
        if( Gate::denies('editar_registro_senhas') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para atualizar registro de senha !!', 'class'=>'']);
            return redirect()->back();
        }
        // Fim

        $clientes   = Cliente::find($id);
        $registro_senhas = DB::table('tbRegistroSenhas')->select('idRegistroSenha','strURL','strLogin',
                    'strSenha','observacao','admin','idTipoRegistro','idDominio','urlPendente',
                    'loginPendente','senhaPendente','pendente')
                    ->where('idRegistroSenha', $idRegistroSenha)->first();
        //dd($registro_senhas);

        $tipos_registros = DB::table('tbAuxTipoRegistro')->select('idTipoRegistro','nome')->where('ativo',1)->orderBy('idTipoRegistro', 'desc')->get();

        //dd($clientes_dominios);
        //$idDominio    =    isset($projetos->id_dominio)?$projetos->id_dominio:0;
        $clientes_dominios = ClienteDominio::Where('id_cliente', '=', $id)->get();

        return view('backend.cliente.registro-senha.editar',compact('registro_senhas','clientes','clientes_dominios','tipos_registros'));
    }

    public function atualizarRegistroSenha(Request $request, $id, $idRegistroSenha){

        // Verificando se o usuário tem permissão para efetuar essa ação
        if( Gate::denies('editar_registro_senhas') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para atualizar registro de senha !!', 'class'=>'']);
            return redirect()->back();
        }
        // Fim

        $dados = $request->all();
        $vmotivo = isset($dados['motivo'])?$dados['motivo']:'';
        //dd($dados);

        $solicitadopor = DB::table('tbRegistroSenhas')
                        ->leftJoin('users', 'users.id','tbRegistroSenhas.idsolicitadopor')
                        ->join('clientes', 'clientes.id', 'tbRegistroSenhas.idcliente')
                        ->join('tbAuxTipoRegistro', 'tbAuxTipoRegistro.idTipoRegistro', 'tbRegistroSenhas.idTipoRegistro')
                        ->where("tbRegistroSenhas.idRegistroSenha",$idRegistroSenha)
                        ->select('users.email','users.name','users.sobrenome','tbRegistroSenhas.idsolicitadopor', 'clientes.nome_fantasia',
                                'tbAuxTipoRegistro.nome as nometipo')
                            ->first();
        //dd($solicitadopor);

        $data = array(
            'solicitadopor' => $solicitadopor->name,
            'solicitadopor_sobrenome' => $solicitadopor->sobrenome,
            'cliente' => $solicitadopor->nome_fantasia,
            'tipo' => $solicitadopor->nometipo,
            'motivo' => $vmotivo
        );

        //dd($data);
        //dd($dadosRegistroSenha[0]->nome_fantasia);


        if(isset($dados['aprovado'])){


        if($dados['aprovado'] == 1){
            $registroSenha = DB::table('tbRegistroSenhas')->where('idRegistroSenha', '=', $idRegistroSenha)->update(
                array(
                    'idTipoRegistro' => $dados['tipo_registro'],
                    'idDominio' => $dados['id_dominio'],
                    'strURL' => $dados['urlpendente'],
                    'strLogin' => $dados['loginpendente'],
                    'strSenha' => $dados['senhapendente'],
                    'admin' => $dados['admin'],
                    'observacao' => $dados['observacao'],
                    'updated_at' => date( 'Y-m-d H:i:s'),
                    'urlPendente' => '',
                    'loginPendente' => '',
                    'senhaPendente' => '',
                    'pendente' => 0,
                    'idsolicitadopor' => null

                )
            );

            Mail::send('backend.emails.aprovadasolicitacao', ['arrDados' => $data], function ($m) use($solicitadopor) {
            $m->from('intranet@logicadigital.info', 'LD Intranet');
            $m->to($solicitadopor->email, $solicitadopor->name)->subject('[LD] Solicitação de Senha APROVADA - ' . $solicitadopor->nome_fantasia . ' - ' . $solicitadopor->nometipo);
            });

        }elseif($dados['aprovado'] == 0){
            $registroSenha = DB::table('tbRegistroSenhas')->where('idRegistroSenha', '=', $idRegistroSenha)->update(
                array(
                    'idTipoRegistro' => $dados['tipo_registro'],
                    'idDominio' => $dados['id_dominio'],
                    'strURL' => $dados['url'],
                    'strLogin' => $dados['login'],
                    'strSenha' => $dados['senha'],
                    'admin' => $dados['admin'],
                    'observacao' => $dados['observacao'],
                    'updated_at' => date( 'Y-m-d H:i:s'),
                    'urlPendente' => '',
                    'loginPendente' => '',
                    'senhaPendente' => '',
                    'pendente' => 0,
                    'idsolicitadopor' => null
                )
            );

            Mail::send('backend.emails.reprovadasolicitacao', ['arrDados' => $data], function ($m) use($solicitadopor) {
                $m->from('intranet@logicadigital.info', 'LD Intranet');
                $m->to($solicitadopor->email, $solicitadopor->name)->subject('[LD] Solicitação de Senha REPROVADA - ' . $solicitadopor->nome_fantasia . ' - ' . $solicitadopor->nometipo);
                });
        }else{
            $registroSenha = DB::table('tbRegistroSenhas')->where('idRegistroSenha', '=', $idRegistroSenha)->update(
                array(
                    'idTipoRegistro' => $dados['tipo_registro'],
                    'idDominio' => $dados['id_dominio'],
                    'strURL' => $dados['url'],
                    'strLogin' => $dados['login'],
                    'strSenha' => $dados['senha'],
                    'admin' => $dados['admin'],
                    'observacao' => $dados['observacao'],
                    'updated_at' => date( 'Y-m-d H:i:s')
                )
            );
        }
    }else{
        $registroSenha = DB::table('tbRegistroSenhas')->where('idRegistroSenha', '=', $idRegistroSenha)->update(
            array(
                'idTipoRegistro' => $dados['tipo_registro'],
                'idDominio' => $dados['id_dominio'],
                'strURL' => $dados['url'],
                'strLogin' => $dados['login'],
                'strSenha' => $dados['senha'],
                'admin' => $dados['admin'],
                'observacao' => $dados['observacao'],
                'updated_at' => date( 'Y-m-d H:i:s')
            )
        );

    }


        Session::flash('flash_mensagem', ['msg'=>'Registro de Senha atualizado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

        return redirect()->route('backend.cliente.editar', $id);

    }

    public function listagemRegistroDeSenhas(){

        // Trazendo os dados do Cliente
        $clientes = DB::table('tbRegistroSenhas')
                        ->join('clientes', 'clientes.id','tbRegistroSenhas.idCliente')
                        ->where("clientes.status",1)
                        ->select('clientes.nome_fantasia','clientes.id','clientes.nome',
                                    'tbRegistroSenhas.idCliente')
                        ->groupBy('clientes.nome_fantasia','clientes.id','clientes.nome',
                        'tbRegistroSenhas.idCliente')
                            ->get();


		$registro_senhas = DB::table('tbRegistroSenhas')
		                        ->join('clientes', 'clientes.id','tbRegistroSenhas.idCliente')
		                        ->join('tbAuxTipoRegistro','tbAuxTipoRegistro.idTipoRegistro', 'tbRegistroSenhas.idTipoRegistro')
		                        ->leftJoin('tb_cliente_dominios','tb_cliente_dominios.id_dominio', 'tbRegistroSenhas.idDominio')
		                        ->where("clientes.status",1);
		                        if(!Auth::user()->isAdmin()){
		                            $registro_senhas = $registro_senhas->where('tbRegistroSenhas.admin',0);

		                        }
        $registro_senhas = $registro_senhas->select('tbRegistroSenhas.idRegistroSenha','tbRegistroSenhas.strURL',
                'tbRegistroSenhas.strLogin',
            'tbRegistroSenhas.strSenha','tbRegistroSenhas.observacao',
            'tbRegistroSenhas.admin','tbRegistroSenhas.idTipoRegistro','tbRegistroSenhas.idDominio',
            'clientes.nome_fantasia','clientes.id','clientes.nome','tbRegistroSenhas.idCliente',
            'tbAuxTipoRegistro.nome as nometipo','tb_cliente_dominios.dominio', 'tbRegistroSenhas.pendente')
            ->get();
        // Fim

        //dd($registro_senhas);


        return view('backend.cliente.registro-senha.listagem', compact('registro_senhas','clientes'));
    }

    public function editarRegistroSenhaAprovacao(Request $request){

        $dados      = $request->all();
        //return 'oi';
        // Verificando se o usuário tem permissão para efetuar essa ação
        //if( Gate::denies('editar_registro_senhas') ){
        //    Session::flash('flash_mensagem', ['msg'=>'Sem permissão para atualizar registro de senha !!', 'class'=>'']);
        //    return redirect()->back();
        //}
        // Fim

        //$clientes   = Cliente::find($id);
        $registro_senhas = DB::table('tbRegistroSenhas')->select('idRegistroSenha','strURL','strLogin',
                    'strSenha','observacao','admin','idTipoRegistro','idDominio')
                    ->where('idRegistroSenha', $dados['idRegistroSenha'])->first();
        //dd($registro_senhas);

        //$tipos_registros = DB::table('tbAuxTipoRegistro')->select('idTipoRegistro','nome')->where('ativo',1)->orderBy('idTipoRegistro', 'desc')->get();

        //dd($clientes_dominios);
        //$idDominio    =    isset($projetos->id_dominio)?$projetos->id_dominio:0;
        //$clientes_dominios = ClienteDominio::Where('id_cliente', '=', $id)->get();

        return response()->json($registro_senhas);
    }

    public function atualizarRegistroSenhaAprovacao(Request $request){

        // Verificando se o usuário tem permissão para efetuar essa ação
        //if( Gate::denies('editar_registro_senhas') ){
        //    Session::flash('flash_mensagem', ['msg'=>'Sem permissão para atualizar registro de senha !!', 'class'=>'']);
        //    return redirect()->back();
        //}
        // Fim

        $dados = $request->all();
        dd($dados);

        $registroSenha = DB::table('tbRegistroSenhas')->where('idRegistroSenha', '=', $dados['alt-idregistrosenha'])->update(
            array(

                'urlPendente' => $dados['url'],
                'loginPendente' => $dados['login'],
                'senhaPendente' => $dados['senha'],
                'pendente' => true,
                'updated_at' => date( 'Y-m-d H:i:s'),
                'idsolicitadopor' => auth()->user()->id
            )
        );
        //dd(auth()->user());
        $vEquipe = auth()->user()->setor;
        $solicitadoPor = auth()->user()->name . ' ' . auth()->user()->sobrenome;
        $emailResponsavel = DB::table('users')
                        ->join('role_user', 'users.id','role_user.user_id')
                        ->where("users.setor",$vEquipe)
                        ->where("role_user.role_id",2)
                        ->where("users.ativo",1)
                        ->select('users.email', 'users.name', 'users.sobrenome')
                        ->get();

        //$arrEmailResponsavel = $emailResponsavel->toArray();

        $dadosRegistroSenha = DB::table('tbRegistroSenhas')
        ->join('clientes', 'clientes.id','tbRegistroSenhas.idCliente')
        ->join('tbAuxTipoRegistro','tbAuxTipoRegistro.idTipoRegistro', 'tbRegistroSenhas.idTipoRegistro')
        ->leftJoin('tb_cliente_dominios','tb_cliente_dominios.id_dominio', 'tbRegistroSenhas.idDominio')
        ->where("tbRegistroSenhas.idRegistroSenha",$dados['alt-idregistrosenha'])
        ->select('tbRegistroSenhas.idRegistroSenha','tbRegistroSenhas.strURL',
                'tbRegistroSenhas.strLogin',
            'tbRegistroSenhas.strSenha','tbRegistroSenhas.observacao',
            'tbRegistroSenhas.admin','tbRegistroSenhas.idTipoRegistro','tbRegistroSenhas.idDominio',
            'clientes.nome_fantasia','clientes.id','clientes.nome','tbRegistroSenhas.idCliente',
            'tbAuxTipoRegistro.nome as nometipo','tb_cliente_dominios.dominio')
            ->get();

        //$dadosRegistroSenha = $dadosRegistroSenha->toArray();

        $data = array(
            'solicitadopor' => $solicitadoPor,
            'responsavel_nome' => $emailResponsavel[0]->name,
            'responsavel_sobrenome' => $emailResponsavel[0]->sobrenome,
            'cliente' => $dadosRegistroSenha[0]->nome_fantasia,
            'tipo' => $dadosRegistroSenha[0]->nometipo,
            'idcliente' => $dadosRegistroSenha[0]->idCliente,
            'idregistrosenha' => $dadosRegistroSenha[0]->idRegistroSenha
        );

        //dd($data);

        //dd($dadosRegistroSenha[0]->nome_fantasia);
        Mail::send('backend.emails.solitacaoalteracaosenha', ['arrDados' => $data], function ($m) use($emailResponsavel,$dadosRegistroSenha) {
            $m->from('intranet@logicadigital.info', 'LD Intranet');
            $m->to($emailResponsavel[0]->email, 'LD')->subject('[LD] Solicitação de Senha - ' . $dadosRegistroSenha[0]->nome_fantasia . ' - ' . $dadosRegistroSenha[0]->nometipo);
        });


        Session::flash('flash_mensagem', ['msg'=>'Solicitação enviada com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

        return $dados['alt-idregistrosenha'];

    }
}
