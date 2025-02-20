<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model{
    
    use Notifiable;

    protected $table = "tbTarefas";
	
	public function responsavel(){
		return $this->belongsTo('App\User', 'id_responsavel', 'id');
	}

    public function statusTarefa(){
        return $this->belongsTo('App\Status', 'id_status', 'id');
    }

}