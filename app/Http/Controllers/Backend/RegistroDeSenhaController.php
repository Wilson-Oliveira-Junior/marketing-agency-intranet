<?php

namespace App\Http\Controllers\Backend;

use App\Cliente;
use App\ClienteDominio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RegistroDeSenha;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegistroDeSenhaController extends Controller
{
    //
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
            $m->from(env('MAIL_FROM_ADDRESS','no-reply@example.com'), config('app.name', 'Intranet'));
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
                $m->from(env('MAIL_FROM_ADDRESS','no-reply@example.com'), config('app.name', 'Intranet'));
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

        $clientes = Cliente::where('clientes.status', 1)
                        ->orderBy('nome_fantasia')
                        ->get();


        return view('backend.cliente.registro-senha.listagem', compact('clientes'));
    }

    public function editarRegistroSenhaAprovacao(Request $request){

        $dados      = $request->all();
        //return 'oi';
        // Verificando se o usuário tem permissão para efetuar essa ação
        //if( Gate::denies('editar_registro_senhas') ){
        //    \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para atualizar registro de senha !!', 'class'=>'']);
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
        //    \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para atualizar registro de senha !!', 'class'=>'']);
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
            $m->from(env('MAIL_FROM_ADDRESS','no-reply@example.com'), config('app.name', 'Intranet'));
            $m->to($emailResponsavel[0]->email, 'LD')->subject('[LD] Solicitação de Senha - ' . $dadosRegistroSenha[0]->nome_fantasia . ' - ' . $dadosRegistroSenha[0]->nometipo);
        });


        Session::flash('flash_mensagem', ['msg'=>'Solicitação enviada com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

        return $dados['alt-idregistrosenha'];

    }

    public function listagemPorCliente($idcliente){
        $registroDeSenha = RegistroDeSenha::where('idCliente', $idcliente)->get();
        //dd($registroDeSenha);

        return view('backend.cliente.registro-senha.tabela-registro-senha', compact('registroDeSenha'));
    }
}
