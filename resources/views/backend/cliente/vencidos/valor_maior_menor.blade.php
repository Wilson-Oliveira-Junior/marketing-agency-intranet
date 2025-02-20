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
                <h3 class="mb-0" style="float:left;">Clientes com pagamento vencidos</h3>
                
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
                            <th scope="col">Nome <a href="#" class="ordernar"><i class="fas fa-sort-alpha-down"></i></a></th>
                            <th scope="col">
                                Valor 
                                <a href="{{ route('backend.cliente.vencidos.valor') }}" class="ordernar">
                                    <i class="fas fa-sort-amount-up"></i>
                                </a>
                            </th>
                            <th scope="col">Vencimento <a href="#" class="ordernar"><i class="fas fa-sort-amount-down"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $registro)
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>{{ $registro->nome }}</td>
                            <td>R$ {{ $registro->valor }}</td>
                            <td>{{ date( 'd/m/Y' , strtotime($registro->vencimento)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer py-4">
                
                <button class="btn btn-icon btn-3 btn-primary" type="button" style="border-color: #34a204;background-color: #34a204;" disabled>
                    <span class="btn-inner--icon"><i class="fas fa-sync-alt"></i></span>
                    <span class="btn-inner--text">Atualizar</span>
                </button>

                {!! $clientes->links() !!}
            </div>
        </div>
    </div>
@endsection