<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Sugestao;
use App\User;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Sugestao' => 'App\Policies\SugestaoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*
            Trazendo as permissões do usuários logado
            Exemplo:
                'listar_sugestao'   => Administrador
                                    => Lider
                                    => Colaborador
                                    
                'editar_sugestao'   => Administrador
                                    => Lider
                                    
                'deletar_sugestao'  => Administrador
        */
        $permissions = Permission::with('roles')->get();

        foreach( $permissions as $permission ){
            Gate::define($permission->name, function(User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
        //dd($permission);
    }
}
