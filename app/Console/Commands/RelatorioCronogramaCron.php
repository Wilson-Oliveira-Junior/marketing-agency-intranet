<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RelatorioCronogramaCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'relatoriocronograma:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
        $tmpCronograma = DB::unprepared(
            DB::raw("
                CREATE TEMPORARY TABLE tmpCronogramas 
                                AS (
                                    SELECT t.id_responsavel, tc.id_tarefa,count(distinct 1) as qtdeAssociada, COUNT(DISTINCT CASE 
                            WHEN t.status = 'Finalizado' THEN 1 END) AS qtdeFinalizada
                            FROM tb_cronogramas AS tc
                            INNER JOIN tbTarefas AS t ON tc.id_tarefa = t.id
                            GROUP BY t.id_responsavel, tc.id_tarefa);")
                );

        //dd($tmpCronograma);

        $arrCronogramas = DB::table('tmpCronogramas')
                    ->join('users', 'tmpCronogramas.id_responsavel', 'users.id')
                    ->join('setor_usuarios', 'users.setor', 'setor_usuarios.id')
                    ->select(
                        'tmpCronogramas.id_responsavel',
                        DB::raw('SUM(tmpCronogramas.qtdeAssociada) as qtdeAssociada'),
                        \DB::raw('SUM(tmpCronogramas.qtdeFinalizada) AS qtdeFinalizada'),
                        'users.name',
                        'setor_usuarios.nome'
                    )->groupBy('tmpCronogramas.id_responsavel','users.name','setor_usuarios.nome')
                    ->orderBy('setor_usuarios.nome','ASC')
                    ->orderBy('users.name','ASC')
                    ->get();
        
        //dd($arrCronogramas);   
        // Configurando a Segunda-Feira
        $hoje = (new Carbon())->format('Y-m-d');        
        $proxima_segunda = (new Carbon('last monday', 'America/Sao_Paulo'))->addWeek(1)->format('Y-m-d');

        if($proxima_segunda == $hoje){
            $segunda = $proxima_segunda;
            $vSegunda = (new Carbon('last monday', 'America/Sao_Paulo'))->addWeek(1)->format('d/m/Y');
            $vSexta = (new Carbon('last monday', 'America/Sao_Paulo'))->addWeek(1)->addDay(4)->format('d/m/Y');
        }else{
            $segunda = (new Carbon('last monday', 'America/Sao_Paulo'));
            $vSegunda = (new Carbon('last monday', 'America/Sao_Paulo'))->format('d/m/Y');
            $vSexta = (new Carbon('last monday', 'America/Sao_Paulo'))->addDay(4)->format('d/m/Y');
        }

        foreach($arrCronogramas as $dado):
            $registroExiste = DB::table('tb_relatorio_cronogramas')
                                ->select('idRelatorioCronograma')
                                ->where('dtSemana', '=', $segunda)
                                ->where('id_responsavel', '=', $dado->id_responsavel)
                                ->count();
            //dd($registroExiste);
            if($registroExiste == 0){
                //insere

                DB::table('tb_relatorio_cronogramas')->insert(
                    ['id_responsavel' => $dado->id_responsavel,
                     'qtdeAssociada' => $dado->qtdeAssociada,
                     'qtdeFinalizada' => $dado->qtdeFinalizada,
                     'dtSemana' => $segunda]);

            }else{
                //atualiza
                DB::table('tb_relatorio_cronogramas')
                    ->where('dtSemana', '=', $segunda)
                    ->where('id_responsavel', '=', $dado->id_responsavel)
                    ->update(['qtdeAssociada' => $dado->qtdeAssociada,
                                'qtdeFinalizada' => $dado->qtdeFinalizada,
                                'dtAtualizada' => (new Carbon())->format('Y-m-d H:i:s')]);
            }                    
        endforeach;
    }
}
