<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroDeSenha extends Model
{
    //
    protected $table = "tbRegistroSenhas";

    public function tiporegistro(){
        return $this->hasOne('App\TipoRegistroSenha', 'idTipoRegistro', 'idTipoRegistro');
    }

    public function dominiocliente(){
        return $this->hasOne('App\ClienteDominio', 'id_dominio', 'idDominio');
    }
}
