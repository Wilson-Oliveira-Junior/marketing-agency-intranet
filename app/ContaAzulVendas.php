<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContaAzulVendas extends Model
{
    protected $table = "tbContaAzulVendas";

    public function cliente(){
        return $this->hasOne('App\Cliente', 'id', 'idcliente');
    }
}
