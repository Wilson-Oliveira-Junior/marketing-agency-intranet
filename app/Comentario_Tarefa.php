<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Comentario_Tarefa extends Model{

    use Notifiable;

    protected $table = "tb_comentarios_tarefas";

}