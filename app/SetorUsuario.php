<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SetorUsuario extends Model{

    use Notifiable;

    protected $table = "setor_usuarios";

    protected $fillable = ['nome','email','descricao'];

}
