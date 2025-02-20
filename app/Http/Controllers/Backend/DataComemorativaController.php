<?php

namespace App\Http\Controllers\Backend;

use App\DataComemorativa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataComemorativaFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class DataComemorativaController extends Controller
{
    //
    public function salvar(DataComemorativaFormRequest $request){

        if( Gate::denies('adicionar_data_comemorativa') ){
            Session::flash('flash_mensagem', ['msg'=>'Sem permissão para adicionar data comemorativa', 'class'=>'']);
            return redirect()->back();
        }

        $dados = $request->all();
        //dd($dados);
        $dtcomemorativa = new DataComemorativa();
        $dtcomemorativa->nome = $dados['nome'];
        $dtcomemorativa->data = $dados['data_comemorativa'];
        $dtcomemorativa->created_at = date('Y-m-d H:i:s');
        $dtcomemorativa->updated_at = date('Y-m-d H:i:s');
        $dtcomemorativa->save();

        return $dtcomemorativa;

    }

    public function fnRetornaDatasComemorativas(int $mes){

        $mes = ($mes > 12)?1:$mes;
        $mes = ($mes <= 0)?12:$mes;

        $arrDtComemorativas = DataComemorativa::whereMonth('data', $mes)
            ->where('status', 1)
            ->select(
                DB::raw('DATE_FORMAT(data,"%d/%m") as data')
                , 'nome')
            ->orderByRaw('DAY(data) ASC')
            ->get();

        //return response()->json($arrDtComemorativas);
        echo json_encode($arrDtComemorativas);
    }
}
