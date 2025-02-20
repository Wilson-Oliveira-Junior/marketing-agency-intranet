<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TiposTarefa extends Model{

    use Notifiable;

    protected $table = "tb_tipostarefas";

    protected $fillable = ['nome', 'estimativa'];

}
