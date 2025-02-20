<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ComentarioProjeto extends Model{

    use Notifiable;

    protected $table = "tb_comentario_projeto";

    protected $fillable = ['comentario', 'created_at', 'updated_at', 'tipo', 'id_usuario', 'id'];

}
