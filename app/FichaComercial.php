<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FichaComercial extends Model
{
    use Notifiable;

    protected $table = "tb_ficha_comercial";
}
