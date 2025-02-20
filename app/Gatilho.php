<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Gatilho extends Model{

    use Notifiable;

    protected $table = "tb_gatilhos";

    public function projetos(){
        return $this->hasMany('App\Projeto', 'id_tipo_projeto', 'id');
    }

    public function finalizado($idprojeto){
        return $this->where('id_tipo_projeto', $idprojeto)->where('status', 'Finalizado')->count();
    }

    public function gatilhoTemplate(){
        return $this->hasOne('App\GatilhoTemplate', 'id', 'id_gatilho_template');
    }

}
