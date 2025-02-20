<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FichaComercialContatos extends Model
{
    use Notifiable;

    protected $table = "tb_ficha_comercial_contatos";
    public $timestamps = false;
}
