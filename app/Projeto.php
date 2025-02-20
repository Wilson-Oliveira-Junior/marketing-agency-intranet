<?php

namespace App;

use DateTime;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model{

    protected $table = "tb_projetos";

    protected $fillable = ['projeto', 'cliente_id', 'status'];

    public function cliente(){
        return $this->hasOne('App\Cliente', 'cliente_id', 'cliente_id');
    }

    public function gatilhos(){
        return $this->hasMany('App\Gatilho', 'id_tipo_projeto', 'id');
    }

    public function comentario_projeto(){
        $comentario = $this->hasOne('App\ComentarioProjeto', 'id_projeto', 'id')->take(1)->orderBy('id', 'desc')->first();
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

    public function tipo_projeto(){
        return $this->hasOne('App\TipoProjeto', 'id', 'id_tipo_projeto');

    }

}
