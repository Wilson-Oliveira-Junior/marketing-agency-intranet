<?php

namespace App\Providers;

use App\Events\ConcluirTarefa;
use App\Events\FinalizaPauta;
use App\Events\NovaPauta;
use App\Events\NovaTarefa;
use App\Events\NovoAnexo;
use App\Events\Seguidor;
use App\Events\NovoComentarioTarefa;
use App\Events\NovoUsuario;
use App\Listeners\EnviaEmailConcluirTarefa;
use App\Listeners\EnviaEmailFinalizaPauta;
use App\Listeners\EnviaEmailNovoAnexo;
use App\Listeners\EnviaEmailSeguidor;
use App\Listeners\EnviarEmailNovaTarefa;
use App\Listeners\EnviaEmailPauta;
use App\Listeners\EnviaEmailNovoComentarioTarefa;
use App\Listeners\EnviaEmailNovoUsuario;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NovaTarefa::class => [
            EnviarEmailNovaTarefa::class,
        ],
        Seguidor::class => [
            EnviaEmailSeguidor::class,
        ],
        NovoAnexo::class => [
            EnviaEmailNovoAnexo::class,
        ],
		NovaPauta::class => [
		    EnviaEmailPauta::class,
		],
		FinalizaPauta::class => [
		    EnviaEmailFinalizaPauta::class,
		],
        NovoComentarioTarefa::class => [
            EnviaEmailNovoComentarioTarefa::class,
        ],
        NovoUsuario::class => [
            EnviaEmailNovoUsuario::class,
        ],
        ConcluirTarefa::class => [
            EnviaEmailConcluirTarefa::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
