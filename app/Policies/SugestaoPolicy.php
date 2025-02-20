<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Sugestao;

class SugestaoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // Criando um metódo
    public function editarSugestao(User $user, Sugestao $sugestao){
        return $user->id == $sugestao->id_usuario;
    }

}
