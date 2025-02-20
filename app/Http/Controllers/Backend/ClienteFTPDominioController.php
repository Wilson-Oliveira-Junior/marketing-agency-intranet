<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Notifications\NovaTarefaMail;
use App\Notifications\EntregueTarefaMail;
use Gate;
use App\Cliente;
use App\User;
use App\ClienteDominio;
use App\ClienteFTPDominio;
use Validator;

class ClienteFTPDominioController extends Controller
{
    //
    public function adicionarFTP($id,$id_dominio){

        if( Gate::denies('adicionar_ftp') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar clientes !!', 'class'=>'']);
            return redirect()->back();
        }   

        //dd($id);
        $nomeDominio = ClienteDominio::where('id_dominio','=',$id_dominio)->value('dominio');
        
        return view('backend.cliente.dominio.ftp.adicionar', compact('id_dominio','nomeDominio','id'));
    }

    public function editarFTP($id,$id_dominio){

        if( Gate::denies('adicionar_ftp') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar clientes !!', 'class'=>'']);
            return redirect()->back();
        }
        
        //dd($id_dominio);
        $nomeDominio = ClienteDominio::where('id_dominio','=',$id_dominio)->value('dominio');

        $vFTP = ClienteFTPDominio::where('id_dominio', '=', $id_dominio)->first();

        return view('backend.cliente.dominio.ftp.editar', compact('vFTP','nomeDominio','id','id_dominio'));
    }

    public function salvarFTP(Request $request,$id){
        $dados = $request->all();

        $messages = [
            'servidor.required'    => 'O campo SERVIDOR precisa ser preenchido.'
		];
		
		$validator = Validator::make($dados, [
		            'servidor' => 'required'
		        ],$messages);

		if ($validator->fails()) {
			return redirect()->route('backend.cliente.dominio.ftp.adicionar',$dados['id_dominio'])
						->withErrors($validator)
						->withInput();
		}
        //dd($dados);

        $sqlInsert = ClienteFTPDominio::create([
            'id_dominio' => $dados['id_dominio'],
            'servidor' => $dados['servidor'],
            'protocolo' => $dados['protocolo'],
            'usuario' => $dados['usuario'],
            'senha' => $dados['senha'], 'observacao' => $dados['observacao']
        ]);
        
        //var_dump($postViews);
        if($sqlInsert){
            DB::commit();
            \Session::flash('flash_mensagem', ['msg'=>'FTP do cliente salvo com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);
        }else{
            \Session::flash('flash_mensagem', ['msg'=>'Tivemos problemas ao inserir. Procure o administrador do sistema.', 'class'=>'background-color: #11d482;border-color: #11d482;']);
            DB::rollBack();
        }

        return redirect()->route('backend.cliente.editar', $id);
    }

    public function atualizarFTP(Request $request, $id,$id_dominio){

        //$clientes  	= SetorUsuario::find($id);
        $dados      = $request->all();
        //dd($dados);

        $dominioFTP             = ClienteFTPDominio::find($id_dominio);
        //dd($dominioFTP);
        $dominioFTP->servidor           = $dados['servidor'];
        $dominioFTP->protocolo          = $dados['protocolo'];
        $dominioFTP->usuario            = $dados['usuario'];
        $dominioFTP->senha              = $dados['senha'];
        $dominioFTP->observacao         = $dados['observacao'];
        $dominioFTP->Update();
        
        \Session::flash('flash_mensagem', ['msg'=>'FTP do cliente atualizado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);
        
        return redirect()->route('backend.cliente.editar', $id);
    }
}
