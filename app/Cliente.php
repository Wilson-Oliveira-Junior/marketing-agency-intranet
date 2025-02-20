<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{

    use Notifiable;

    protected $table = "clientes";

    protected $fillable = ['nome'];

    public function clientes()
    {
        return $this->hasMany('App\ClienteDominio', 'id_cliente', 'id');
    }

	public function responsaveis(){
	        return $this->hasMany('App\ClienteResponsavel', 'idcliente', 'id')
	            ->join('users', 'users.id', 'clientes_responsaveis.idusuario')
	            ->join('setor_usuarios', 'setor_usuarios.id', 'clientes_responsaveis.idsetor')
	            ->select('users.name', 'setor_usuarios.nome', 'clientes_responsaveis.id as idcliente_responsavel',
	             'clientes_responsaveis.idcliente', 'clientes_responsaveis.idusuario',
                 'clientes_responsaveis.idsetor', 'users.image')
	             ->orderBy('clientes_responsaveis.id', 'DESC');
	    }

    public function projetos(){
        return $this->hasMany('App\Projeto', 'cliente_id', 'cliente_id')->where('status', 'Ativo');
    }

    public function contatos(){
        return $this->hasMany('App\ClienteContato', 'id_cliente', 'id');
    }

    public function dominios(){
        return $this->hasMany('App\ClienteDominio', 'id_cliente', 'id')->where('status', 'Ativo');
    }

    public function registroDeSenha(){
        return $this->hasMany('App\RegistroDeSenha', 'idCliente', 'id');
    }

    public function contaazul_vendas(){
        return $this->hasMany('App\ContaAzulVendas', 'idcliente', 'id')->where('idContaAzul', '!=', null)
            ->take(12)->orderBy('vencimento', 'DESC');
    }

    public function contaazul_ultimaemissao(){
        return $this->hasMany('App\ContaAzulVendas', 'idcliente', 'id')->where('idContaAzul', '!=', null)
            ->take(1)->orderBy('emissao', 'DESC');
    }

}
