<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use App\Notifications\NewUser;
use App\Notifications\UsuarioCriado;
use Illuminate\Support\Facades\DB;
use Gate;
use Auth;
use App\User;
use App\TiposUsuario;
use App\Lembrete;
use App\Tarefa;
use App\Cliente;
use App\Events\NovoUsuario;
use App\Role;
use App\SetorUsuario;

class UsuarioController extends Controller{

    use Notifiable;

    public function login(Request $request){
    	$dados = $request->all();

    	if(Auth::attempt(['email'=>$dados['email'],'senha'=>$dados['senha'], 'ativo' => 1])){
    		\Session::flah('mensagem', ['msg'=>'Login Realizado com sucesso', 'class'=>'green white-text']);
    		return redirect()->route('backend.principal');
    	}
        \Session::flah('mensagem', ['msg'=>'Erro!! Confira seus dados', 'class'=>'red white-text']);

    	return redirect()->route('backend');
    }

    public function sair(){
        Auth::logout();
        return redirect()->route('backend.principal');
    }

    public function index(){

        $usuarios = User::LeftJoin('setor_usuarios', 'users.setor', '=', 'setor_usuarios.id')
            ->select(
                'users.id as id_usuario',
                'users.name as nome_usuario',
                'users.image as imagem_usuario',
                'users.email as email_usuario',
                'users.ativo as status',
                'setor_usuarios.nome as nome_setor_usuario'
            )
            ->orderBy('users.id')
            ->paginate(15);
        //dd($usuarios);

        if( Gate::denies('listar_usuario') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listar os usuários', 'class'=>'']);
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

        return view('backend.usuarios.index',compact('usuarios', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function adicionar(){

        if( Gate::denies('adicionar_usuario') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar usuário', 'class'=>'']);
            return redirect()->back();
        }

        $usuario = User::all();
        $setores = SetorUsuario::all();
        //$usuario = Cliente::all();

        // ID Setor do usuário logado
        $usuario_id = auth()->user()->id;

        return view('backend.usuarios.adicionar', compact('setores','usuario'));
    }

    public function salvar(Request $request){
        $dados = $request->all();
        $usuario = new User();

        if( Gate::denies('adicionar_usuario') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar usuário', 'class'=>'']);
            return redirect()->back();
        }

        // Informações de Usuário
            $usuario->name          = $dados['name'];
            $usuario->sobrenome     = $dados['sobrenome'];
            $usuario->email         = $dados['email'];
            $usuario->setor         = $dados['setor'];
            $usuario->nascimento    = $dados['nascimento'];
            $usuario->celular       = $dados['celular'];
            $usuario->password      = bcrypt($dados['password']);
            $usuario->ramal       = $dados['ramal'];

        // Informações de Endereço
            $usuario->cep           = $dados['cep'];
            $usuario->endereco      = $dados['endereco'];
            $usuario->bairro        = $dados['bairro'];
            $usuario->cidade        = $dados['cidade'];
            $usuario->estado        = $dados['estado'];

        // Redes Sociais
            $usuario->facebook      = $dados['facebook'];
            $usuario->instagram     = $dados['instagram'];
            $usuario->linkedin      = $dados['linkedin'];

        // Descrição
            $usuario->descricao     = $dados['descricao'];

        //Imagem
            $file = $request->file('image');
            if($file){
                $rand = rand(11111,99999);
                $diretorio = "img/usuario/".str_slug($dados['name'],'_')."/";
                $ext = $file->guessClientExtension();
                $nomeArquivo = "_img_".$rand.".".$ext;
                $file->move($diretorio,$nomeArquivo);
                $usuario->image = $diretorio.''.$nomeArquivo;
            }

        // Apelido
        $usuario->apelido     = $dados['apelido'];

        //Sexo
        $usuario->sexo     = $dados['sexo'];

        //Usuario da rede
        $usuario->user_rede     = $dados['user_rede'];

        $usuario->save();

        $evento = new NovoUsuario($usuario);
        event($evento);
        return redirect()->route('backend.usuario');
    }

    public function editar($id){

        //$this->authorize('update', User::class);

        $usuario = User::find($id);

        // ID Setor do usuário logado
        $usuario_id = auth()->user()->id;

        $setores = SetorUsuario::all();

        /* Graças */
            $lembretes_entregue     = self::LembreteEntregue();
            $quantidade_clientes    = self::QuantidadeClientes();
            $quantidade_usuarios    = self::QuantidadeUsuarios();
            $quantidade_lembrete    = self::QuantidadeLembrete();
        /* Fim das Graças*/

        return view('backend.usuarios.editar',compact('setores', 'usuario', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
    }

    public function atualizar(Request $request, $id){

        $usuario = User::find($id);
        $dados = $request->all();

        // Informações de Usuário
            $usuario->name          = $dados['name'];
            $usuario->sobrenome     = $dados['sobrenome'];
            $usuario->email         = $dados['email'];
            $usuario->setor         = $dados['setor'];
            $usuario->nascimento    = $dados['nascimento'];
            $usuario->celular       = $dados['celular'];
            $usuario->ramal       = $dados['ramal'];

            if(isset($dados['password']) && strlen($dados['password']) > 5){
                $usuario->password = bcrypt($dados['password']);
            }else{
                unset($dados['password']);
            }

        // Informações de Endereço
            $usuario->cep           = $dados['cep'];
            $usuario->endereco      = $dados['endereco'];
            $usuario->bairro        = $dados['bairro'];
            $usuario->cidade        = $dados['cidade'];
            $usuario->estado        = $dados['estado'];

        // Redes Sociais
            $usuario->facebook      = $dados['facebook'];
            $usuario->instagram     = $dados['instagram'];
            $usuario->linkedin      = $dados['linkedin'];

        // Descrição
            $usuario->descricao     = $dados['descricao'];

        //Imagem
            $file = $request->file('image');
            if($file){
                $rand = rand(11111,99999);
                $diretorio = "img/usuario/".str_slug($dados['name'],'_')."/";
                $ext = $file->guessClientExtension();
                $nomeArquivo = "_img_".$rand.".".$ext;
                $file->move($diretorio,$nomeArquivo);
                $usuario->image = $diretorio.''.$nomeArquivo;
            }
        // Apelido
        $usuario->apelido     = $dados['apelido'];

        //Sexo
        $usuario->sexo     = $dados['sexo'];

        //Usuario da rede
        $usuario->user_rede     = $dados['user_rede'];

        $usuario->Update();
        return redirect()->route('backend.usuario');
    }

    public function deletar($id){

        if( Gate::denies('deletar_usuario') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para deletar usuários', 'class'=>'']);
            return redirect()->back();
        }

        User::find($id)->delete();
        return redirect()->route('backend.usuario');
    }

    /* Permissões (Atribuindo ao Usuário) */
        public function papel($id){

            // Recupera os roles
            $users = User::find($id);
            //dd($users);

            // Recuperando as permissões
            $roles = $users->roles()->get();
            //dd($roles);

            $all_roles = Role::all();
            //dd($all_roles);

            if( Gate::denies('adicionar_papel_usuario') ){
                \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para atribuir papel', 'class'=>'']);
                return redirect()->back();
            }

            /* Graças */
                $lembretes_entregue     = self::LembreteEntregue();
                $quantidade_clientes    = self::QuantidadeClientes();
                $quantidade_usuarios    = self::QuantidadeUsuarios();
                $quantidade_lembrete    = self::QuantidadeLembrete();
            /* Fim das Graças*/

            return view('backend.usuarios.papel',compact('users', 'roles' ,'all_roles', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));
        }

        public function salvarPapel(Request $request, $id){

            $dados  = $request->all();
            //dd($dados['role_id']);

            DB::table('role_user')
                    ->insert([
                        'role_id'   => $dados['role_id'],
                        'user_id'   => $id
                    ]);

            return redirect()->route('backend.usuarios.papel', $id);
        }

        public function removerPapel($id_usuario, $id_role){

            //dd($id_role);

            DB::table('role_user')
                    ->where('role_id', '=', $id_role)
                    ->where('user_id', '=', $id_usuario)
                    ->delete();

            return redirect()->route('backend.usuarios.papel', $id_usuario);
        }
    /* Fim Permissões */

    public function criptSenha(){

        $usuarios = User::all();

        foreach($usuarios as $registro){
            $senha = "123mudar";
            $registro->password      = bcrypt($senha);
            $registro->save();
        }


    }

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

    public function mudarStatus(){

        $id = Input::get('id');

        if( Gate::denies('mudar_status_usuario') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para mudar o status do usuário', 'class'=>'']);
            return redirect()->back();
        }

        $usuario = User::findOrFail($id);
        $usuario->ativo = !$usuario->ativo;
        $usuario->save();

        return response()->json($usuario);
    }

    public function testando(){

        $usuarios = User::LeftJoin('setor_usuarios', 'users.setor', '=', 'setor_usuarios.id')
            ->select(
                'users.id as id_usuario',
                'users.name as nome_usuario',
                'users.image as imagem_usuario',
                'users.email as email_usuario',
                'users.ativo as status',
                'setor_usuarios.nome as nome_setor_usuario'
            )
            ->orderBy('users.id')
            ->paginate(15);
        //dd($usuarios);

        if( Gate::denies('listar_usuario') ){
            \Session::flash('flash_mensagem', ['msg'=>'Sem permissão para listar os usuários', 'class'=>'']);
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

        return view('backend.usuarios.testando',compact('usuarios', 'lembretes_entregue', 'quantidade_clientes', 'quantidade_usuarios', 'quantidade_lembrete'));

    }
}
