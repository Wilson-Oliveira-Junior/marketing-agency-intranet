<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class SeguidorTarefa extends Model{

    use Notifiable;

    protected $table = "tb_seguidores_tarefas";

    protected $fillable = ['id_usuario_postou', 'id_usuario_seguidor', 'id_tarefa'];

    public $timestamps = false;

}
