<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class EventoTarefa extends Model{

    use Notifiable;

    protected $table = "tb_tarefa_eventos";
    
}