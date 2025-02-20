<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Comentario_Lembrete extends Model{

    use Notifiable;

    protected $table = "comentario_lembrete";

}