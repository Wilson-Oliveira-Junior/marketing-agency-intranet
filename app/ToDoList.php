<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    //
    protected $table = "tbToDoList";

    public function criadopor(){
        return $this->belongsTo('App\User', 'idcriadopor', 'id');
    }

    public function responsavel(){
        return $this->hasOne('App\User', 'id', 'idresponsavel');
    }

    public function projeto(){
        return $this->belongsTo('App\Projeto', 'idprojeto', 'id');
    }
}
