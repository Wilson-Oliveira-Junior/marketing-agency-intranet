<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class GatilhoTemplate extends Model{

    use Notifiable;

    protected $table = "tb_gatilhos_templates";

    public function gatilhoGrupo(){
        return $this->belongsTo('App\GatilhoGrupo', 'id_grupo_gatilho', 'id');
    }

}
