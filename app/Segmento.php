<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Segmento extends Model{

    use Notifiable;

    protected $table = "tb_segmentos";

}
