<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\GatilhoCron::class,
		Commands\RelatorioCronogramaCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // daily
        //$schedule->command('gatilho:cron')->daily();
		//$schedule->command('gatilho:cron')->weekdays()->dailyAt('07:55');
        $schedule->call('App\Http\Controllers\Backend\GatilhosController@atualizaStatusGatilhos')->weekdays()->dailyAt('06:55');
        $schedule->call('App\Http\Controllers\Backend\GatilhosController@dispararEmailGatilhos')->weekdays()->dailyAt('07:55');
		$schedule->command('relatoriocronograma:cron')->weekdays()->dailyAt('20:00');

		//$schedule->command('relatoriocronograma:cron')->weekdays()->everyMinute();
        $schedule->call('App\Http\Controllers\Backend\GatilhosController@relatorioGatilhos')->weeklyOn(1, '08:30');
		$schedule->call('App\Http\Controllers\Backend\GatilhosController@relatorioGatilhos')->weeklyOn(3, '08:30');
		$schedule->call('App\Http\Controllers\Backend\GatilhosController@relatorioGatilhos')->weeklyOn(5, '08:30');

        $schedule->call('App\Http\Controllers\Backend\GatilhosController@relatorioGatilhosPausados')->monthlyOn(1, '08:40');

        $schedule->call('App\Http\Controllers\Backend\ToDoListController@fnPautasCron')->weekdays()->dailyAt('08:40');
        $schedule->call('App\Http\Controllers\Backend\ContaAzulController@vendas')->weekdays()->dailyAt('17:00');
        $schedule->call('App\Http\Controllers\Backend\ContaAzulController@clientes')->weekdays()->monthly();
        $schedule->call('App\Http\Controllers\Backend\ContaAzulController@atualizaParcela')->weekdays()->dailyAt('07:10');
        $schedule->call('App\Http\Controllers\Backend\ContaAzulController@atualizaParcela')->weekdays()->dailyAt('10:00');
        $schedule->call('App\Http\Controllers\Backend\ContaAzulController@atualizaParcela')->weekdays()->dailyAt('13:00');
		$schedule->call('App\Http\Controllers\Backend\ContaAzulController@atualizaParcela')->weekdays()->dailyAt('17:00');
		$schedule->call('App\Http\Controllers\Backend\ContaAzulController@atualizaStatus')->weekdays()->dailyAt('06:50');
        $schedule->call('App\Http\Controllers\Backend\ClienteController@atualizar_vencidos')->weekdays()->dailyAt('07:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
