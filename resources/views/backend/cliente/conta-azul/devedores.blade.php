@extends('layouts.app-backend')

@section('style')
    <style>
        .ordernar{
            float: right;
            font-size: 15px;
            color: #5e72e4;
            margin-bottom: -10px;
            margin-top: -5px;
        }
    </style>
    <link href="{{asset('css/print.css')}}" rel="stylesheet" media="print" type="text/css">
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Clientes
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0" style="float:left;">Devedores Conta Azul</h3>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data de Emissão</th>
                            <th scope="col">Data de Vencimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($devedores as $key => $registro)
                            <tr>
                                <td scope="row">{{ $key+1 }}</td>
                                <td>{{ $registro->cliente->nome_fantasia }}</td>
                                <td>R$ {{ $registro->valor }}</td>
                                <td>{{ date( 'd/m/Y' , strtotime($registro->emissao)) }}</td>
                                <td>{{ date( 'd/m/Y' , strtotime($registro->vencimento)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td><strong>R$ {{$devedores->sum('valor')}}</strong></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="card-footer py-4">

            </div>
        </div>
    </div>
@endsection
