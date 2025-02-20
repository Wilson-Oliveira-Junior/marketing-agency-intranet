<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class GatilhoProjeto extends Model
{
    protected $table = "tb_gatilhos_projetos";

    public function gatilhos(){
        return $this->hasMany('App\Gatilho', 'id_tipo_projeto', 'id_projeto');
    }

    public function comentario_projeto(){
        $comentario = $this->hasOne('App\ComentarioProjeto', 'id_projeto', 'id_projeto')->take(1)->orderBy('id', 'desc')->first();
        //dd($comentario->created_at);
        if(isset($comentario)){
            $date1 = new DateTime(date('Y-m-d', strtotime($comentario->created_at)));
            $date2 = new DateTime(date('Y-m-d'));
            $interval = $date1->diff($date2);
            //dd($interval->days);
            if($interval->days > 7){
                return true;
            }
            return false;

        }
        return true;
    }

    public function ultimo_comentario_projeto(){
        $comentario = $this->hasOne('App\ComentarioProjeto', 'id_projeto', 'id_projeto')->take(1)->orderBy('id', 'desc')->first();
        //dd($comentario->created_at);
        if(isset($comentario)){
            return $comentario->comentario;

        }
        return '';
    }

    public function ultimo_contato_projeto(){
        $comentario = $this->hasOne('App\ComentarioProjeto', 'id_projeto', 'id_projeto')->take(1)->orderBy('id', 'desc')->first();
        //dd($comentario->created_at);
        if(isset($comentario)){
            return $comentario->created_at;

        }
        return '';
    }

    public function projetos(){
        return $this->hasMany('App\Projeto', 'id', 'id_projeto');
    }

}
