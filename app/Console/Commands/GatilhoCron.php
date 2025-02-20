<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Notifications\Gatilho\GatilhoFeitoMail;
use App\Notifications\Gatilho\GatilhoEquipeAlertaMail;
use Illuminate\Notifications\Notifiable;
use App\Gatilho;

class GatilhoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gatilho:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rotina para mandar email com os gatilhos pendentes ou que passaram da data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Pegando a data de hoje
        $hoje = Carbon::today();
        $dtCompare = $hoje->addDays(3)->format('Y-m-d');
        $hojeFormatado = Carbon::today()->format('Y-m-d');

        $gatilho = Gatilho::where('tb_gatilhos.status', '=', 'Aberto')->where(DB::raw("DATE_FORMAT( `tb_gatilhos`.`data_limite` , '%Y-%m-%d' )"), '<=', $dtCompare)
                    // Trazendo a informação do Gatilho Template
                    ->join('tb_gatilhos_templates', 'tb_gatilhos.id_gatilho_template',          '=', 'tb_gatilhos_templates.id')
                    
                    // Trazendo a informação do E-mail que vai ser enviado
                    ->join('tb_gatilhos_grupos',    'tb_gatilhos_templates.id_grupo_gatilho',   '=', 'tb_gatilhos_grupos.id')
                    
                    // Trazendo as informações do Projeto
                    ->join('tb_projetos',           'tb_gatilhos.id_tipo_projeto',              '=', 'tb_projetos.id')

                    // Trazendo informções do Cliente
                    ->join('clientes', 'tb_projetos.cliente_id', '=', 'clientes.cliente_id')
                    
                    ->select(
                        // Gatilhos Principal
                        'tb_gatilhos.id as id_gatilo',
                        'tb_gatilhos.data_conclusao',
                        'tb_gatilhos.data_limite',

                        // Gatilhos Templates
                        'tb_gatilhos_templates.gatilho',

                        // Informação do Projeto
                        'tb_projetos.id as id_projeto',
                        'tb_projetos.projeto',

                        // Informação do Cliente
                        'clientes.id as id_cliente',
                        'clientes.nome_fantasia',

                        // E-mail que vão receber a noticição
                        'tb_gatilhos_grupos.email',
                        'tb_gatilhos_grupos.email_adicionais',
                        \DB::raw('(CASE 
                            WHEN DATE_FORMAT(tb_gatilhos.data_limite,"%Y-%m-%d") <= "' . $hojeFormatado . '" THEN "atraso" 
                            WHEN DATE_FORMAT(tb_gatilhos.data_limite,"%Y-%m-%d") > "' . $hojeFormatado . '" THEN "aviso" 
                            ELSE ""
                            END) AS Alerta')
                    )
                    ->get();
            //dd($gatilho);
                
                //$notificacao->notify(new GatilhoFeitoMail());
                Notification::send($gatilho, new GatilhoEquipeAlertaMail());
                $this->info('Gatilho:Cron Comando Rodado com sucesso!');
            //dd($gatilho);

    }
}
