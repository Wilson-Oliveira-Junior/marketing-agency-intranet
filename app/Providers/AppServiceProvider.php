<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        View::composer('*', function($view)
        {
            if (Auth::check()){
                $data = array(
                    'quadro1'               => ldDashboardQuadro1(Auth::id()),
                    'quadro2'               => ldDashboardQuadro2(Auth::id()),
                    'quadro3'               => ldDashboardQuadro3(),
                    'quadro4'               => ldDashboardQuadro4(),
                    'ldsetores'             => LDSetores(),
                    'ldsegmentos'           => LDSegmentos(),
                    'notificacaoEvento'     => notificationsEvento(Auth::id()),
                    'notificacaoTarefa'     => notificationsTarefa(Auth::id()),
                    'notificationsSoma'     => notificationsSoma(Auth::id()),
                    'notificacaoErros'     => notificationsErros(Auth::id())
                );
                View::share('data', $data);
            }

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
