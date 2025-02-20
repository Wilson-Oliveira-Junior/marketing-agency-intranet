<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;

class ControllerPerfil extends Controller
{
    public function index(){
        $id = Auth::user()->id;
        $usuario = DB::table('users')->where('id', $id )->get();

        $contagem_usuario = DB::table('users')->where('id', $id )->count();
        //dd($contagem_usuario);

        $area_atuacao = DB::table('users')
                            ->where('users.id', '=', $id)
                            ->leftJoin('setor_usuarios', 'users.setor', '=', 'setor_usuarios.id')
                            ->select('setor_usuarios.nome')
                        ->get();
        //dd($area_atuacao);

        $date = date( 'Y' , strtotime(Auth::user()->nascimento));
        $mes = date('Y');
        $ano_nascimento =  $mes - $date;       
        
        return view('backend.perfil.index',compact('usuario', 'contagem_usuario', 'ano_nascimento', 'area_atuacao'));
    }

    public function perfil($idusuario){
        $usuario = DB::table('users')->where('id', $idusuario )->get();

        $usuarios = User::find($idusuario);

        $contagem_usuario = DB::table('users')->where('id', $idusuario )->count();
        //dd($contagem_usuario);

        $area_atuacao = DB::table('users')
                            ->where('users.id', '=', $idusuario)
                            ->leftJoin('setor_usuarios', 'users.setor', '=', 'setor_usuarios.id')
                            ->select('setor_usuarios.nome')
                        ->get();
        //dd($area_atuacao);

        $date = date( 'Y' , strtotime(Auth::user()->nascimento));
        $mes = date('Y');
        $ano_nascimento =  $mes - $date;  
        
        //dd($usuarios);
        
        return view('backend.perfil.index',compact('usuarios', 'contagem_usuario', 'ano_nascimento', 'area_atuacao'));
    }
}
