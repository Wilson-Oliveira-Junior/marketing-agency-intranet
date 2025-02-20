<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TipoProjeto extends Model{

    use Notifiable;

    protected $table = "tb_tipo_projetos";

    public function projetos(){
        return $this->hasMany('App\Projeto', 'id_tipo_projeto', 'id');
    }

}
