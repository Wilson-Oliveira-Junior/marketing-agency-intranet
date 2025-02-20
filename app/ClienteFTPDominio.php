<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteFTPDominio extends Model
{
    //
    protected $table = "tb_cliente_dominios_ftp";
    protected $primaryKey = 'id_dominio';
    protected $fillable = ['id_dominio','servidor','protocolo','usuario','senha','observacao'];

    public function ClientesDominios(){
		
        return $this->belongsTo('App\ClienteFTPDominio', 'id_dominio', 'id_dominio');
    }
}
