<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Lembrete extends Model
{
    use Notifiable;
    
    protected $table = "lembretes";

    public function SetorUsuario(){
    	return $this->belongsTo('App\SetorUsuario','setor_id');
    }

    public function Usuario(){
    	return $this->belongsTo('App\User','usuario_id');
    }

    public function Cliente(){
    	return $this->belongsTo('App\Cliente','cliente_id');
    }
}
