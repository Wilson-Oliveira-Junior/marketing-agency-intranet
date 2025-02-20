<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Sugestao extends Model
{

    use Notifiable;

    protected $table = "tb_sugestoes";

    protected $fillable = ['descricao'];

    public function user(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
