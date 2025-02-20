<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model{

    use Notifiable;

    protected $table = "tb_eventos";
    
}
