<?php

namespace App\Http\Controllers\Backend;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContaAzulToken;
use App\ContaAzulVendas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Throwable;

class ContaAzulController extends Controller
{
    //
	public function fnAutorizarAplicacao(){
		$params = array(
			'client_id' => 'zWrNPNDXL8Zp7CVVIj56yV4NzqFrHb6n',
			'redirect_uri' => route('backend.contaazul.outh'),
			'scope' => 'sales',
			'state' => csrf_token(),
		);

		$provider = new \League\OAuth2\Client\Provider\GenericProvider([
		    'clientId'                => 'zWrNPNDXL8Zp7CVVIj56yV4NzqFrHb6n',    // The client ID assigned to you by the provider
		    'clientSecret'            => 'OKIUHADNVycXp8XMmwVfYECZrAMvcJfz',    // The client password assigned to you by the provider
		    'redirectUri'             => route('backend.contaazul.outh'),
		    'urlAuthorize'            => 'https://api.contaazul.com/auth/authorize',
		    'urlAccessToken'          => 'https://api.contaazul.com/oauth2/token',
		    'urlResourceOwnerDetails' => 'https://api.contaazul.com/v1/customers'
		]);

		// If we don't have an authorization code then get one
		if (!isset($_GET['code'])) {

		    // Fetch the authorization URL from the provider; this returns the
		    // urlAuthorize option and generates and applies any necessary parameters
		    // (e.g. state).
		    $authorizationUrl = $provider->getAuthorizationUrl();

		    // Get the state generated for you and store it to the session.
		    $_SESSION['oauth2state'] = $provider->getState();

		    // Redirect the user to the authorization URL.
		    header('Location: ' . $authorizationUrl);
		    exit;

		// Check given state against previously stored one to mitigate CSRF attack
		} elseif (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {

		    if (isset($_SESSION['oauth2state'])) {
		        unset($_SESSION['oauth2state']);
		    }

		    exit('Invalid state');

		} else {

		    try {

			        // Try to get an access token using the authorization code grant.
			        $accessToken = $provider->getAccessToken('authorization_code', [
			            'code' => $_GET['code']
			        ]);

			        // We have an access token, which we may use in authenticated
			        // requests against the service provider's API.
			        echo 'Access Token: ' . $accessToken->getToken() . "<br>";
			        echo 'Refresh Token: ' . $accessToken->getRefreshToken() . "<br>";
			        echo 'Expired in: ' . $accessToken->getExpires() . "<br>";
			        echo 'Already expired? ' . ($accessToken->hasExpired() ? 'expired' : 'not expired') . "<br>";

			        // Using the access token, we may look up details about the
			        // resource owner.
			        $resourceOwner = $provider->getResourceOwner($accessToken);

			        var_export($resourceOwner->toArray());

			        // The provider provides a way to get an authenticated API request for
			        // the service, using the access token; it returns an object conforming
			        // to Psr\Http\Message\RequestInterface.
			        $request = $provider->getAuthenticatedRequest(
			            'GET',
			            'https://service.example.com/resource',
			            $accessToken
			        );

			    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

			        // Failed to get the access token or user details.
			        exit($e->getMessage());

			    }
			}
	}

	public function outh(Request $request){
		$dados = $request->all();
		//dd($request->session());
		$provider = new \League\OAuth2\Client\Provider\GenericProvider([
		    'clientId'                => 'zWrNPNDXL8Zp7CVVIj56yV4NzqFrHb6n',    // The client ID assigned to you by the provider
		    'clientSecret'            => 'OKIUHADNVycXp8XMmwVfYECZrAMvcJfz',    // The client password assigned to you by the provider
		    'redirectUri'             => route('backend.contaazul.outh'),
		    'urlAuthorize'            => 'https://api.contaazul.com/auth/authorize',
		    'urlAccessToken'          => 'https://api.contaazul.com/oauth2/token',
		    'urlResourceOwnerDetails' => 'https://api.contaazul.com/v1/customers'
		]);

	    try {

	        // Try to get an access token using the authorization code grant.
	        $accessToken = $provider->getAccessToken('authorization_code', [
	            'code' => $dados['code']
	        ]);
            //dd($accessToken);

            $vExpirou = ($accessToken->hasExpired() ? 'expired' : 'not expired');

            $insToken = new ContaAzulToken();
            $insToken->access_token = $accessToken->getToken();
            $insToken->refresh_token = $accessToken->getRefreshToken();
            $insToken->expired_in = $accessToken->getExpires();
            $insToken->expirou = $vExpirou;
            $insToken->save();

	        // We have an access token, which we may use in authenticated
	        // requests against the service provider's API.
	        echo 'Access Token: ' . $accessToken->getToken() . "<br>";
	        echo 'Refresh Token: ' . $accessToken->getRefreshToken() . "<br>";
	        echo 'Expired in: ' . $accessToken->getExpires() . "<br>";
	        echo 'Already expired? ' . ($accessToken->hasExpired() ? 'expired' : 'not expired') . "<br>";

			if ($accessToken->hasExpired()) {
			    $newAccessToken = $provider->getAccessToken('refresh_token', [
			        'refresh_token' => $accessToken->getRefreshToken()
			    ]);

			    // Purge old access token and store new access token to your data store.
		        $resourceOwner = $provider->getResourceOwner($newAccessToken);

		        var_export($resourceOwner->toArray());

			}else{

		        // Using the access token, we may look up details about the
		        // resource owner.
		        $resourceOwner = $provider->getResourceOwner($accessToken);

		        var_export($resourceOwner->toArray());

		        // The provider provides a way to get an authenticated API request for
		        // the service, using the access token; it returns an object conforming
		        // to Psr\Http\Message\RequestInterface.
		        $request = $provider->getAuthenticatedRequest(
		            'GET',
		            'https://api.contaazul.com/v1/customers',
		            $accessToken
		        );
			}

	    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

	        // Failed to get the access token or user details.
	        exit($e->getMessage());

	    }


		//dd($dados);
	}

	public function clientes(){

		$provider = new \League\OAuth2\Client\Provider\GenericProvider([
		    'clientId'                => 'zWrNPNDXL8Zp7CVVIj56yV4NzqFrHb6n',    // The client ID assigned to you by the provider
		    'clientSecret'            => 'OKIUHADNVycXp8XMmwVfYECZrAMvcJfz',    // The client password assigned to you by the provider
		    'redirectUri'             => route('backend.contaazul.outh'),
		    'urlAuthorize'            => 'https://api.contaazul.com/auth/authorize',
		    'urlAccessToken'          => 'https://api.contaazul.com/oauth2/token',
		    'urlResourceOwnerDetails' => 'https://api.contaazul.com/v1/customers'
		]);

		$existeToken = ContaAzulToken::query()->take(1)->orderBy('id', 'DESC')->get();
        //dd($existeToken[0]->refresh_token);

        $newAccessToken = $provider->getAccessToken('refresh_token', [
			'refresh_token' => $existeToken[0]->refresh_token
		]);

        $uptToken = ContaAzulToken::find($existeToken[0]->id);
        $uptToken->access_token =  $newAccessToken->getToken();
        $uptToken->refresh_token =  $newAccessToken->getRefreshToken();
        $uptToken->expired_in = $newAccessToken->getExpires();
        $uptToken->save();



        //dd($newAccessToken);

        $clientes = Cliente::Where('CNPJ', '!=', null)->Where('idContaAzul', null)->get();
		//dd($clientes);
        foreach($clientes as $cliente){

            $documento = str_replace(" ", "", str_replace('/', '', str_replace('.','', str_replace('-', '',$cliente->CNPJ))));

            $request = $provider->getAuthenticatedRequest(
                'GET',
                'https://api.contaazul.com/v1/customers?search=' . $documento,
                $newAccessToken
            );

            $clienthttp = new \GuzzleHttp\Client();
            $customerResponse = $clienthttp->send($request);
            $customer = json_decode($customerResponse->getBody()->getContents());

            foreach($customer as $contaazul){
                //Atualiza
                $cliente->idContaAzul = $contaazul->id;
                $cliente->save();
            }

            //dd($customer[0]->id);

            //dd($cliente->nome_fantasia);
        }

        dd('ok');

        //$resourceOwner = $provider->getResourceOwner($newAccessToken);

        //$clientes = $resourceOwner->toArray();
        //dd($cliente);
        //sales
        //https://api.contaazul.com/v1/sales?emission_start=2021-12-01&emission_end=2022-02-28&status=COMMITTED&customer_id=c3640af3-38aa-4f08-8b9d-5c0f2c5bc9b7
	}

    public function vendas(){

		$provider = new \League\OAuth2\Client\Provider\GenericProvider([
		    'clientId'                => 'zWrNPNDXL8Zp7CVVIj56yV4NzqFrHb6n',    // The client ID assigned to you by the provider
		    'clientSecret'            => 'OKIUHADNVycXp8XMmwVfYECZrAMvcJfz',    // The client password assigned to you by the provider
		    'redirectUri'             => route('backend.contaazul.outh'),
		    'urlAuthorize'            => 'https://api.contaazul.com/auth/authorize',
		    'urlAccessToken'          => 'https://api.contaazul.com/oauth2/token',
		    'urlResourceOwnerDetails' => 'https://api.contaazul.com/v1/sales'
		]);

		$existeToken = ContaAzulToken::query()->take(1)->orderBy('id', 'DESC')->get();
        //dd($existeToken[0]->refresh_token);

        $newAccessToken = $provider->getAccessToken('refresh_token', [
			'refresh_token' => $existeToken[0]->refresh_token
		]);

        $uptToken = ContaAzulToken::find($existeToken[0]->id);
        $uptToken->access_token =  $newAccessToken->getToken();
        $uptToken->refresh_token =  $newAccessToken->getRefreshToken();
        $uptToken->expired_in = $newAccessToken->getExpires();
        $uptToken->save();

        $hoje = Carbon::today();
        $ultimosMeses = $hoje->subMonths(12)->toDateString();
        $vMes = date('m', strtotime($ultimosMeses));
        $vAno = date('Y', strtotime($ultimosMeses));
        $dtInicio = Carbon::create($vAno, $vMes, 1, 0, 0, 0, 'America/Sao_Paulo')->format('Y-m-d');
        //$dtFim = new Carbon('last day of last month');
        //$dtFim = $dtFim->toDateString();

		//dd($dtFim);
        $dtInicio = \Carbon\Carbon::now()->startOfMonth()->toDateString();
		//dd($dtInicio);
        $dtFim = \Carbon\Carbon::now()->endOfMonth()->toDateString();
		//dd($dtFim);
        //dd($newAccessToken);

        $clientes = Cliente::Where('idContaAzul', '!=', null)->get();

        foreach($clientes as $cliente){

            $idContaAzul = $cliente->idContaAzul;

            $request = $provider->getAuthenticatedRequest(
                'GET',
                'https://api.contaazul.com/v1/sales?emission_start='. $dtInicio .'&emission_end='. $dtFim .'&status=COMMITTED&customer_id=' . $idContaAzul,
                $newAccessToken
            );

            $arrStatus = [
                'ACQUITTED' => 0,
                'PENDING' => 1,
                'OVERDUE' => 2
            ];

            $clienthttp = new \GuzzleHttp\Client();
            $saleResponse = $clienthttp->send($request);
            $sale = json_decode($saleResponse->getBody()->getContents());
            //dd($sale);
            foreach($sale as $venda){
                //
				$idVenda = $venda->id;
                $numeroVenda = $venda->number;
                $emissao = date('Y-m-d', strtotime($venda->emission));
				$qtd = count($venda->payment->installments);
                foreach($venda->payment->installments as $parcela){
                    $valor = $parcela->value;
                    $status = $arrStatus[$parcela->status];
                    $numero_parcela = $parcela->number;
					$vencimento = date('Y-m-d', strtotime($parcela->due_date));
                }
				echo 'Cliente: ' . $cliente->nome_fantasia . '<br/>';
				echo 'ID Venda: ' . $idVenda . '<br/>';
                echo 'Customer ID: ' . $idContaAzul . '<br/>';
                echo 'Numero da Venda: ' . $numeroVenda . '<br/>';
				echo 'Qtd: ' . $qtd . '<br>';
                echo 'Emissao: ' . $emissao . '<br/>';
                echo 'Valor: ' . $valor . '<br/>';
                echo 'Status: ' . $status . '<br/>';
                echo 'Numero Parcela: ' . $numero_parcela . '<br/>';
				echo 'Vencimento: ' . $vencimento . '<br/><hr>';
                //exit;

                $insVenda = ContaAzulVendas::updateOrInsert(
                    ['idcliente'=> $cliente->id, 'idVenda' => $idVenda],
                    [
                        'idContaAzul' => $idContaAzul,
                        'numero_venda' => $numeroVenda,
                        'emissao' => $emissao,
                        'valor' => $valor,
                        'status' => $status,
                        'vencimento' => $vencimento,
                    ]
                    );
            }

            //dd($customer[0]->id);

            //dd($cliente->nome_fantasia);
        }

        dd('ok');
	}

    public function atualizaParcela(){

        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
		    'clientId'                => 'zWrNPNDXL8Zp7CVVIj56yV4NzqFrHb6n',    // The client ID assigned to you by the provider
		    'clientSecret'            => 'OKIUHADNVycXp8XMmwVfYECZrAMvcJfz',    // The client password assigned to you by the provider
		    'redirectUri'             => route('backend.contaazul.outh'),
		    'urlAuthorize'            => 'https://api.contaazul.com/auth/authorize',
		    'urlAccessToken'          => 'https://api.contaazul.com/oauth2/token',
		    'urlResourceOwnerDetails' => 'https://api.contaazul.com/v1/sales'
		]);

		$existeToken = ContaAzulToken::query()->take(1)->orderBy('id', 'DESC')->get();
        //dd($existeToken[0]->refresh_token);

        $newAccessToken = $provider->getAccessToken('refresh_token', [
			'refresh_token' => $existeToken[0]->refresh_token
		]);

        $uptToken = ContaAzulToken::find($existeToken[0]->id);
        $uptToken->access_token =  $newAccessToken->getToken();
        $uptToken->refresh_token =  $newAccessToken->getRefreshToken();
        $uptToken->expired_in = $newAccessToken->getExpires();
        $uptToken->save();

        $parcelas = ContaAzulVendas::where('status', '!=', 0)->where('status', '!=', 3)->get();

        //dd($parcelas);

        foreach($parcelas as $parcela){
            $request = $provider->getAuthenticatedRequest(
                'GET',
                'https://api.contaazul.com/v1/sales/'. $parcela->idVenda .'/installments/' . $parcela->numero_parcela,
                $newAccessToken
            );

            try{
                $parcelahttp = new \GuzzleHttp\Client();
                $parcelaResponse = $parcelahttp->send($request);

                if($parcelaResponse->getStatusCode() == 200){
                    $status_parcela = json_decode($parcelaResponse->getBody()->getContents());
                    //dd($status_parcela);
                    //dd($status_parcela->due_date);
                    $arrStatus = [
                        'ACQUITTED' => 0,
                        'PENDING' => 1,
                        'OVERDUE' => 2
                    ];

                    $status = $arrStatus[$status_parcela->status];

                    if($parcela->status != $status){
                        $parcela->status = $status;
                        $parcela->valor = $status_parcela->value;
                        $parcela->updated_at = date('Y-m-d H:i:s');
                        $parcela->vencimento = date('Y-m-d', strtotime($status_parcela->due_date));
                        $parcela->save();
                    }else{
                        $parcela->updated_at = date('Y-m-d H:i:s');
                        $parcela->vencimento = date('Y-m-d', strtotime($status_parcela->due_date));
                        $parcela->save();
                    }
                }else{
                    $parcela->status = 3;
                    $parcela->updated_at = date('Y-m-d H:i:s');
                    $parcela->save();
                }
            }catch(Throwable $e){
                //dd($e->getCode());

                if($e->getCode() == 404){
                    $parcela->status = 3;
                    $parcela->updated_at = date('Y-m-d H:i:s');
                    $parcela->save();
                }
                //exit($e->getMessage());

            }

        }
    }

    public function atualizaStatus(){

        //Atualizar status financeiro de todos os clientes para em dia e no final mudar de quem esta devendo.
        DB::table('clientes')
        ->update(['status_financeiro' => 0]);
		$dtOntem = Carbon::yesterday();

        $clientes = Cliente::from('clientes as c')->where('c.idContaAzul', '!=', null)
            ->join('tbContaAzulVendas as cv', 'cv.idcliente', 'c.id')
            ->where('c.status', 1)
            ->select('c.id', 'c.status', 'c.nome_fantasia')
            ->groupBy('c.id', 'c.status', 'c.nome_fantasia')->get();

        foreach($clientes as $cliente){
            $parcelas = ContaAzulVendas::where('idcliente', $cliente->id)
				->whereDate('vencimento', '<=', $dtOntem)
                    ->where('status', 1)->count();

            if($parcelas == 1){
                $status = 1;
                echo 'Cliente ATENCAO ' . $cliente->nome_fantasia . ' - ' . $parcelas . '<br>';
            }elseif($parcelas >= 2){
                $status = 2;
                echo 'Cliente DEVEDOR ' . $cliente->nome_fantasia . ' - ' . $parcelas . '<br>';
            }else{
                $status = 0;
                echo 'Cliente ' . $cliente->nome_fantasia . ' - ' . $parcelas . '<br>';
            }

            Cliente::where('id', $cliente->id)->update(['status_financeiro' => $status]);
        }
    }

    public function index(){
        $clientes = Cliente::where('clientes.status', '1')
            ->where('idContaAzul', '!=', null)
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

        return view('backend.cliente.conta-azul.index', compact('clientes'));
    }

    public function fnListaDevedores(){

        if( Gate::denies('listar_devedores_conta_azul') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para acessar a listagem de devedores', 'class'=>'']);
            return redirect()->route('backend.principal');
        }

        $dtOntem = Carbon::yesterday();
        $dtOntem = $dtOntem->toDateString();
        //dd($dtOntem);

        $devedores = ContaAzulVendas::where('status', 1)
            ->whereDate('vencimento', '<=' ,$dtOntem)
            ->orderBy('vencimento', 'DESC')
            ->get();
        //dd($devedores);
        return view('backend.cliente.conta-azul.devedores', compact('devedores'));
    }

    public function getPDF(){

        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
		    'clientId'                => 'zWrNPNDXL8Zp7CVVIj56yV4NzqFrHb6n',    // The client ID assigned to you by the provider
		    'clientSecret'            => 'OKIUHADNVycXp8XMmwVfYECZrAMvcJfz',    // The client password assigned to you by the provider
		    'redirectUri'             => route('backend.contaazul.outh'),
		    'urlAuthorize'            => 'https://api.contaazul.com/auth/authorize',
		    'urlAccessToken'          => 'https://api.contaazul.com/oauth2/token',
		    'urlResourceOwnerDetails' => 'https://api.contaazul.com/v1/sales'
		]);

		$existeToken = ContaAzulToken::query()->take(1)->orderBy('id', 'DESC')->get();
        //dd($existeToken[0]->refresh_token);

        $newAccessToken = $provider->getAccessToken('refresh_token', [
			'refresh_token' => $existeToken[0]->refresh_token
		]);

        $uptToken = ContaAzulToken::find($existeToken[0]->id);
        $uptToken->access_token =  $newAccessToken->getToken();
        $uptToken->refresh_token =  $newAccessToken->getRefreshToken();
        $uptToken->expired_in = $newAccessToken->getExpires();
        $uptToken->save();

        $vendas = ContaAzulVendas::where('idcliente', 136)
                ->where('id', 63)->get();

        foreach($vendas as $venda){
            $request = $provider->getAuthenticatedRequest(
                'GET',
                'https://api.contaazul.com/v1/sales/'. $venda->idVenda .'/pdf/',
                $newAccessToken
            );

            $clienthttp = new \GuzzleHttp\Client();
            $saleResponse = $clienthttp->send($request);

            //dd($sale);
            //return response()->file();
            return response($saleResponse->getBody()->getContents(), 200)
            ->header('Content-Type', 'application/pdf');
            //return response()->file($saleResponse->getBody()->getContents());
            //dd($arrDados);
            //dd($arrDados['content-disposition'][0]);

        }

    }
}
