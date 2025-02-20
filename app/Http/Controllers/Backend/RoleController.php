<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Permission;
use App\Role;
use App\User;
use App\Tarefa;
Use App\Cliente;

class RoleController extends Controller{

    public function index(){
        $roles = Role::all();

        // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

        return view('backend.tipo-usuario.index',compact('roles'));
    }

    public function adicionar(){
        $roles = Role::all();

        // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;


        return view('backend.tipo-usuario.adicionar', compact('roles'));
    }

    public function salvar(Request $request){
        $dados = $request->all();

        $roles = new Role();
        $roles->name            = $dados['name'];
        $roles->label           = $dados['label'];
        $roles->save();
        return redirect()->route('backend.tipo-usuario');
    }

    public function editar($id){
        $roles = Role::find($id);

        // ID Setor do usuário logado
            $usuario_id = auth()->user()->id;

        return view('backend.tipo-usuario.editar', compact('roles'));
    }

    public function atualizar(Request $request, $id){
        $roles  	       = Role::find($id);
        $dados             = $request->all();
        $roles->name       = $dados['name'];
        $roles->label      = $dados['label'];
        $roles->Update();
        return redirect()->route('backend.tipo-usuario');
    }

    public function deletar($id){
        $roles = Role::find($id);
        $roles->delete();
        return redirect()->route('backend.tipo-usuario');
    }

    public function permissao($id){

        // Recupera os roles
        $roles = Role::find($id);
        //dd($roles);

        // Recuperando as permissões
        $permissions = $roles->permissions()->get();
        //dd($permissions);

        //$all_permissions = Permission::all();
        $all_permissions = Permission::whereNotIn('id', function($query) use($id){
            $query->select('permission_id')
                ->from('permission_role')
                ->where('role_id', $id);
        })->get();
        //dd($all_permissions);

        return view('backend.tipo-usuario.permissao',compact('all_permissions', 'permissions' ,'roles'));
    }

    public function salvarPermissao(Request $request, $id){

        $dados  = $request->all();
        //dd($dados['permission_id']);

        DB::table('permission_role')
                ->insert([
                    'permission_id' => $dados['permission_id'],
                    'role_id'       => $id
                ]);

        return redirect()->route('backend.tipo-usuario.permissao', $id);
    }

    public function removerPermissao($id_role, $id_permission){

        //dd($id_permission);

        DB::table('permission_role')
                ->where('permission_id', '=', $id_permission)
                ->where('role_id', '=', $id_role)
                ->delete();

        return redirect()->route('backend.tipo-usuario.permissao', $id_role);
    }

}
