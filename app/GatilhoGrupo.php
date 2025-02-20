<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class GatilhoGrupo extends Model{

    use Notifiable;

    protected $table = "tb_gatilhos_grupos";

}
