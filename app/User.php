<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permission;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'image', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*************************
        Carregando os tipos de usuários do sistema (Papeis)
        Exemplo:   
            - Administrador
            - Líder 
            - Colaborador
    **************************/
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /*************************
        Carregando as informações das permissões
        Exemplo:   
            - listar_sugestao
            - editar_sugestao 
            - deletar_sugestao
    **************************/
    public function hasPermission(Permission $permission){
        return $this->hasAnyRole($permission->roles);
    }

    /*************************
        Verificar se as funções de permissão tem no usuário
        Exemplo:   
            - Julio -> Líder -> listar_sugestao (True)
            - Julio -> Líder -> delatar_sugestao (False)
    **************************/
    public function hasAnyRole($roles){
        
        if( is_array($roles) || is_object($roles) ){
            return !! $roles->intersect($this->roles)->count();
        }

        // Retorna se a função é verdadeira ou falsa (True or False)
        return $this->roles->contains('name', $roles);
    }
	
	public function isAdmin() {
	        return $this->roles()->where('name', 'Administrador')->exists();
	}

}
