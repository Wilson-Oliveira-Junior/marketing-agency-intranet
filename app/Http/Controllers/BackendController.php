<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\User;
use App\Lembrete;
use App\Tarefa;
use App\Sugestao;
use App\DataComemorativa;
use App\ToDoList;
use Illuminate\Support\Facades\Auth;


class BackendController extends Controller{

    public function index(){

        $arrAniversario = User::whereMonth('nascimento', '=', date('m'))
                        ->where('ativo', '=', 1)
                        ->select('users.id',
                            'users.name',
                            'users.sobrenome',
                            'users.nascimento',
                            'users.image')
                        ->orderByRaw('DAY(users.nascimento) ASC')
                        ->get();
        //dd($arrAniversario);

		$arrDtComemorativas = DataComemorativa::whereMonth('data', date('m'))
            ->where('status', 1)
            ->select('data', 'nome')
            ->orderByRaw('DAY(data) ASC')
            ->get();

        $qtd_aniversario = count($arrAniversario);
        //dd($qtd_aniversario);

        //Listagem de todos os aniversariantes por mes.
        for($i=1;$i<=12;$i++){
            $arrNiver = User::whereMonth('nascimento', '=', $i)
                        ->where('ativo', '=', 1)
                        ->select('users.id',
                            'users.name',
                            'users.sobrenome',
                            'users.nascimento',
                            'users.image', 'users.created_at', 'users.id')
                        ->orderByRaw('DAY(users.nascimento) ASC')
                        ->get();
            foreach($arrNiver as $key => $regniver){
                $arrAniversariante[$key] = [
                    'nascimento' => $regniver->nascimento,
                    'nome' => $regniver->name . ' ' . $regniver->sobrenome,
                    'img' => $regniver->image,
					'admitido' => $regniver->created_at,
                    'id' => $regniver->id
                ];

            }
            $arrMeses[] = [
                'mes' => $i,
                'mes_nome' => retornarNomeMes($i),
                'aniversariantes'=> isset($arrAniversariante)?$arrAniversariante:''
            ];
            unset($arrAniversariante);
        }
        //dd($arrMeses);


        $ramais = User::whereNotNull('ramal')->where('users.ativo', 1)
        ->select(
            'users.id as idusuario',
            'users.name',
            'users.sobrenome',
            'users.ramal',
            DB::raw('(CASE
            WHEN users.setor = "1" THEN "ramal-dev"
            WHEN users.setor = "2" THEN "ramal-atendimento"
            WHEN users.setor = "3" THEN "ramal-criacao"
            WHEN users.setor = "4" THEN "ramal-comercial"
            WHEN users.setor = "5" THEN "ramal-marketing"
            WHEN users.setor = "7" THEN "ramal-adm"
            ELSE ""
            END) AS classes')
        )->orderBy('users.setor', 'ASC')->orderBy('users.ramal', 'ASC')->get();
        //dd($ramais);

        $sugestoes = DB::table('tb_sugestoes')
            ->leftJoin('users', 'tb_sugestoes.id_usuario', '=', 'users.id')
            ->select(
                'users.id           as id_usuario',
                'users.image        as imagem_usuario',
                'users.name         as nome_usuario',
                'tb_sugestoes.id    as id_sugestao',
                'tb_sugestoes.id_usuario',
                'tb_sugestoes.descricao as descricao_sugestao'
            )
            ->orderBy('tb_sugestoes.id', 'DESC')
        ->get();

        $date = date_create(date('Y-m-d'));
        date_add($date, date_interval_create_from_date_string('5 days'));
        $dataPauta = date_format($date, 'Y-m-d');

        $vPautas = ToDoList::from('tbToDoList as td')
                ->leftJoin('tbToDoList_Compartilhados as tdc', 'tdc.id_todolist', 'td.id')
                ->where('td.excluido', 0)
                ->where('td.status', 0)
                ->where(function($q){
                    $q->where('td.idresponsavel', Auth::id())
                        ->orWhere('tdc.id_usuario', Auth::id());
                })
                ->where('td.data_desejada', '<=', $dataPauta)
                ->select('td.id', 'td.idUrgencia', 'td.titulo', 'td.status', 'td.idprojeto', 'td.idcriadopor',
                        'td.idresponsavel', 'td.data_desejada')
                ->orderBy('td.idUrgencia')->orderBy('td.created_at')
                ->groupBy('td.id', 'td.idUrgencia', 'td.titulo', 'td.status', 'td.idprojeto', 'td.idcriadopor',
                'td.idresponsavel', 'td.data_desejada', 'td.created_at')
                ->get();

        return view('backend.principal.index', compact('sugestoes','arrAniversario','qtd_aniversario','ramais', 'arrMeses', 'arrDtComemorativas', 'vPautas'));
    }

    public function importarClientesAsaas(Request $request){

        $clientes = DB::table('clientes')
                    ->Where('clientes.CNPJ', '!=' , null)
                    ->Where('clientes.idCustomerAsaas', null)
                    ->orderBy('clientes.nome_fantasia','ASC')
                    ->select(
                        'clientes.id',
                        'clientes.nome_fantasia',
                        'clientes.nome',
                        'clientes.status_financeiro',
                        'clientes.CNPJ'
                    )->get();
        //dd($clientes);

        $apikey = 'bdc8085c1ef24587525a014056cc7c7d0bde593adfa637523ca9b8e565068d50';

        /* Cabelhaço das autenticação */
        $headers = array(
            "access_token: " . $apikey,
            "Content-type: application/json",
            "Connection: close",
        );

        /* Browser para acesso (User Agent) */
        $userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
        $i = 0;
        foreach ($clientes as $registro){
            $urlLogin = 'https://www.asaas.com/api/v3/customers?cpfCnpj=' . str_replace('-','',str_replace('/','',str_replace('.','',$registro->CNPJ)));
            //dd($urlLogin);
            /* Executando a autentição */
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $urlLogin );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_ENCODING, '' );
            curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 0 );
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
            curl_setopt( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
            $data = curl_exec($ch);
            //dd($data);
            if(!curl_errno($ch)){
                $resultado = json_decode($data, true);
                $resultado = json_decode(json_encode($resultado['data']), FALSE);


                if (!empty($resultado)){
                    foreach($resultado as $cliente):
                        if($cliente->id <> ''){
                            print 'Atualiza o cliente ' . $registro->nome_fantasia .' CNPJ: ' . str_replace('-','',str_replace('/','',str_replace('.','',$registro->CNPJ))) . ' com o id: ' . $cliente->id . '<br/>';
                            //$atucliente  	= Cliente::find($registro->id);
                            //$atucliente->idCustomerAsaas = $cliente->id;
                            //$atucliente->Update();
                            //exit;
                            $i++;
                        }

                    endforeach;
                }
            }



        }
        print 'Total: ' . $i;
        exit;
        /*$dados = $request->all();

        $busca = isset($dados['busca-cliente-asaass'])?$dados['busca-cliente-asaass']:'';
		//dd($busca);
		$clientes = Cliente::all();

        /* Montando a autenticação do Sistema
        //$urlLogin = 'https://www.asaas.com/api/v3/customers?limit=50&offset=100';
        if($busca != ''){
            $urlLogin = 'https://www.asaas.com/api/v3/customers?name=' . $busca;
        }else{
            $urlLogin = 'https://www.asaas.com/api/v3/customers?limit=50&offset=100';
        }

        $apikey = '4abe1dff999766a7bc35b4c1fe7c3a3d274121793a05a66d8cc77faf8bdfca7a';


        /* Cabelhaço das autenticação
            $headers = array(
                "access_token: " . $apikey,
                "Content-type: application/json",
                "Connection: close",
            );

        /* Browser para acesso (User Agent)
            $userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';

        /* Executando a autentição
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $urlLogin );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $data = curl_exec($ch);

        if(!curl_errno($ch)){
            $resultado = json_decode($data, true);
			$resultado = json_decode(json_encode($resultado['data']), FALSE);



            //dd($resultado);

            //foreach($resultado['data'] as $registro):
                /*$urlCEP = 'https://viacep.com.br/ws/'.$registro['postalCode'].'/json/';
                $regiao = @file_get_contents($urlCEP);
                $regiao = @json_decode($regiao);

                //print_r($regiao);
                //exit;
                //$cliente = isset($registro['company'])?$registro['company']:$registro['name'];
                //print 'Nome da Empresa: ' . $cliente . '<br/>';
                //print 'ID: ' . $registro['id'] . '<br/>';
                //print 'Cidade: ' . @$regiao->localidade . '<br/>';
                //print '<hr>';
                //exit;
            //endforeach;
        }
        return view('backend.principal.asaas', compact('resultado','clientes'));*/

    }

	public function salvarClienteAsaas(Request $request){
		$dados = $request->all();

		$data = array_merge(['customer' => $dados['cliente']], ['cliente_id' => $dados['cliente_id']]);
		//$data = json_decode(json_encode($data), FALSE);
		//dd($data);
        foreach(array_combine($data['customer'],$data['cliente_id']) as $customer => $cliente):
            if($cliente != 0){
                print $customer . ' - ' . $cliente . '<br>';

                //Iniciando a atualizacao
                $clientes  	= Cliente::find($cliente);

                /* Montando a autenticação do Sistema */
                $urlLogin = 'https://www.asaas.com/api/v3/customers/' . $customer;
                //dd($urlLogin);
                $apikey = '4abe1dff999766a7bc35b4c1fe7c3a3d274121793a05a66d8cc77faf8bdfca7a';


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
                    $resultado = json_decode(json_encode($resultado), FALSE);
                    //dd($resultado);
                    $vNomeFantasia = $resultado->name;
                    $vRazaoSocial = $resultado->company;
                    $vCNPJCPF = $resultado->cpfCnpj;

                    $vEndereco = $resultado->address;
                    $vBairro = $resultado->province;
                    $vEstado = $resultado->state;
                    $vNumero = $resultado->addressNumber;

                    $urlCEP = 'https://viacep.com.br/ws/'.$resultado->postalCode.'/json/';
                    $regiao = @file_get_contents($urlCEP);
                    $regiao = @json_decode($regiao);
                    $vCidade = @$regiao->localidade;
                    $vCEP = @$regiao->cep;
                    //dd($regiao);

                    /*print 'Nome Fantasia: ' . $vNomeFantasia . '<br/>';
                    print 'Razao Social: ' . $vRazaoSocial . '<br/>';
                    print 'CPF/CNPJ: ' . $vCNPJCPF . '<br/>';
                    print 'CEP: ' . $vCEP . '<br/>';
                    print 'Endereco: ' . $vEndereco . '<br/>';
                    print 'Bairro: ' . $vBairro . '<br/>';
                    print 'Estado: ' . $vEstado . '<br/>';
                    print 'Numero: ' . $vNumero . '<br/>';
                    print 'Cidade: ' . $vCidade . '<br/>';*/

                    $clientes->razao_social             = $vRazaoSocial;
                    $clientes->nome_fantasia            = $vNomeFantasia;
                    $clientes->CNPJ                     = $vCNPJCPF;

                    // Endereço
                    $clientes->cep                      = $vCEP;
                    $clientes->endereco                 = $vEndereco;
                    $clientes->bairro                   = $vBairro;
                    $clientes->cidade                   = $vCidade;
                    $clientes->estado                   = $vEstado;
                    $clientes->numero                   = $vNumero;
                    //exit;

                    //foreach($resultado['data'] as $registro):
                        /*$urlCEP = 'https://viacep.com.br/ws/'.$registro['postalCode'].'/json/';
                        $regiao = @file_get_contents($urlCEP);
                        $regiao = @json_decode($regiao);

                        //print_r($regiao);
                        //exit;*/
                        //$cliente = isset($registro['company'])?$registro['company']:$registro['name'];
                        //print 'Nome da Empresa: ' . $cliente . '<br/>';
                        //print 'ID: ' . $registro['id'] . '<br/>';
                        //print 'Cidade: ' . @$regiao->localidade . '<br/>';
                        //print '<hr>';
                        //exit;
                    //endforeach;
                }
                //update

                $clientes->idCustomerAsaas  = $customer;
                $clientes->Update();



            }
		endforeach;
	}

}
