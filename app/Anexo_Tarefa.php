<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Anexo_Tarefa extends Model{

    use Notifiable;

    protected $table = 'tb_anexos_tarefas';

    protected $fillable = [
        'id_usuario_postou', 'id_tarefa', 'anexo',
    ];

}
