<?php

namespace App\Http\Controllers\Backend;

use App\ClienteResponsavel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ClienteResponsavelController extends Controller
{
    protected $rules = [
            'responsavel_interno' => 'not_in:--'
        ];
    protected $messages = [
            'responsavel_interno.not_in' => 'O campo RESPONSÁVEL é obrigatório. Preencha corretamente.'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dados = $request->all();

        $validator = Validator::make($dados, $this->rules, $this->messages);

        if ($validator->fails()) {
            //return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            return response()->json([
                'success' => 'false',
                'errors'  => $validator->getMessageBag()->toArray(),
            ], 400);
        }

        //Recupera o setor
        $idsetor = User::Where('id', $dados['responsavel_interno'])->value('setor');

        $responsavel = new ClienteResponsavel();
        $responsavel->idcliente = $dados['idcliente'];
        $responsavel->idusuario = $dados['responsavel_interno'];
        $responsavel->idsetor = $idsetor;
        $responsavel->save();
        $id = $responsavel->id;

        $registro = ClienteResponsavel::Where('clientes_responsaveis.id', $id)->join('users', 'users.id', 'clientes_responsaveis.idusuario')
            ->join('setor_usuarios', 'setor_usuarios.id', 'clientes_responsaveis.idsetor')
            ->select('clientes_responsaveis.id as idcliente_responsavel', 'users.name', 'setor_usuarios.nome', 'clientes_responsaveis.idcliente', 'clientes_responsaveis.idusuario')
            ->first();

        \Session::flash('flash_mensagem', ['msg'=>'Responsável do cliente salvo com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);

        return view('backend.cliente.editar._responsaveis-internos', compact('registro'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClienteResponsavel  $clienteResponsavel
     * @return \Illuminate\Http\Response
     */
    public function show(ClienteResponsavel $clienteResponsavel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClienteResponsavel  $clienteResponsavel
     * @return \Illuminate\Http\Response
     */
    public function edit(ClienteResponsavel $clienteResponsavel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClienteResponsavel  $clienteResponsavel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteResponsavel $clienteResponsavel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClienteResponsavel  $clienteResponsavel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
    {
        if( Gate::denies('apagar_cliente_responsavel') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para editar clientes !!', 'class'=>'']);
            return redirect()->back();
        }

        $dados = $request->all();

        //dd($id);
        $cliente_responsavel = ClienteResponsavel::find($id)->delete($id);

        \Session::flash('flash_mensagem', ['msg'=>'Responsável deletado com sucesso.', 'class'=>'background-color: #11d482;border-color: #11d482;']);
        return redirect()->route('backend.cliente.editar', $dados['idcliente']);
    }
}
