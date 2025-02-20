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
        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        @media print
        {
            .no-print, .no-print *
            {
                display: none !important;
            }
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
                <h3 class="mb-0" style="float:left;">Devedores Asaas</h3>

                <form action="{{ route('backend.cliente.vencidos.busca') }}" method="POST" class="search-cliente navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex">
                    {{ csrf_field() }}
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" name="busca-cliente" placeholder="Buscar Cliente..." type="text" style="color: #a2a2a2;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome
                                @if( Route::getCurrentRoute()->getName() == 'backend.cliente.vencidos.nome_menor')
                                    <a href="{{ route('backend.cliente.vencidos.nome_maior') }}" class="ordernar">
                                        <i class="fas fa-sort-alpha-down"></i>
                                    </a>
                                @else
                                    <a href="{{ route('backend.cliente.vencidos.nome_menor') }}" class="ordernar">
                                        <i class="fas fa-sort-alpha-up"></i>
                                    </a>
                                @endif
                            </th>
                            <th scope="col">
                                Valor
                                @if( Route::getCurrentRoute()->getName() == 'backend.cliente.vencidos.valor_menor')
                                    <a href="{{ route('backend.cliente.vencidos.valor_maior') }}" class="ordernar">
                                        <i class="fas fa-sort-amount-down"></i>
                                    </a>
                                @else
                                    <a href="{{ route('backend.cliente.vencidos.valor_menor') }}" class="ordernar">
                                        <i class="fas fa-sort-amount-up"></i>
                                    </a>
                                @endif
                            </th>
                            <th scope="col">
                                Vencimento
                                @if( Route::getCurrentRoute()->getName() == 'backend.cliente.vencidos.data_maior')
                                    <a href="{{ route('backend.cliente.vencidos.data_maior') }}" class="ordernar">
                                        <i class="fas fa-sort-amount-down"></i>
                                    </a>
                                @else
                                    <a href="{{ route('backend.cliente.vencidos.data_menor') }}" class="ordernar">
                                        <i class="fas fa-sort-amount-up"></i>
                                    </a>
                                @endif
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $indexKey => $registro)
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>{{ $registro->nome }}</td>
                            <td>R$ {{ number_format($registro->valor, 2, ',', '') }}</td>
                            <td>{{ date( 'd/m/Y' , strtotime($registro->vencimento)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td><strong>R$ {{ number_format($clientes->sum('valor'), 2, ',', '')}}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="card-footer py-4">
                <!--<a href="{{ route('backend.cliente.vencidos.atualizar') }}" class="btn btn-icon btn-3 btn-primary" style="border-color: #34a204;background-color: #34a204;" disabled>-->

                <!--<a href="{{ route('backend.cliente.vencidos.atualizar') }}" class="btn btn-icon btn-3 btn-primary" style="border-color: #34a204;background-color: #34a204;" disabled>
                    <span class="btn-inner--icon"><i class="fas fa-sync-alt"></i></span>
                    <span class="btn-inner--text">Atualizar</span>--> </a><span>&Uacute;tima Atualiza&ccedil;&atilde;o: {{ date( 'd/m/Y H:i' , strtotime($clientes[0]->dt_atualizacao)) }} </span>

                <button class="btn btn-info print-window no-print" style="cursor:pointer;">Imprimir</button>

            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $('.print-window').click(function() {
    window.print();
    });
</script>
@endsection
