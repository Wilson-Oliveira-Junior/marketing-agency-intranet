<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Notifications\ComentarioLembrete;
use App\Lembrete;
use App\Comentario_Lembrete;
use App\User;
use Auth;

class ComentarioController extends Controller{
    
    use Notifiable;

    public function comentario_adicionar(Request $request, $id){

        $dados = $request->all();
        $comentario = new Comentario_Lembrete();
        
        $comentario->id_user        = $dados['id_usuario_logado'];
        $comentario->id_lembrete    = $id;
        $comentario->comentario     = $dados['comentario'];

        /* Notificação Comentário */
            $id_postou = Lembrete::where('id', $id)->value('usuario_id');
            if($comentario->id_user == $id_postou){
                $postou_lembrete = Lembrete::where('id', $id)->value('postou_id');
                $email_usuario = User::where('id', $postou_lembrete)->value('email');                
                $comentario->email  = $email_usuario;
            }else{
                $comentario->email          = Lembrete::Where('id', $id)->value('email');
            }   
        /* Fim Notificação Comentário */

        $comentario->notify(new ComentarioLembrete());
        $comentario->save();

        return redirect()->route('backend.lembrete.editar',$id);
    }

    public function comentario_deletar($id){
        Comentario_Lembrete::find($id)->delete();
        return redirect()->route('backend.lembrete');
    }

}
