<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ClienteDominio extends Model{

    protected $table = "tb_cliente_dominios";

    public function ClientesDominios(){
		
		  return $this->hasOne('App\ClienteFTPDominio', 'id_dominio', 'id_dominio');
	  }

    public function clientes()
    {
        return $this->hasOne('App\Cliente', 'id', 'id_cliente');
    }
}
