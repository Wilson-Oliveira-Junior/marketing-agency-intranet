@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Listagem de Gatilhos
    </a>
@endsection

@section('content')
    
    <div class="col-lg-12">
        <a href="{{ route('backend.gatilhos.adicionar') }}" class="btn btn-info" style="float: left;margin-bottom:20px;">Adicionar Novo</a>
    </div>

    @foreach($gatilhos as $registro)
        <div class="col-lg-4" style="margin-bottom:20px;">
            
            <div class="card">

                <div class="card-header">
                    <div class="row align-items-center">
                    
                        <div class="col-12">
                            <h5 class="h3 mb-0">
                                <span style="font-size:10px;">Projeto:</span> 
                                {{ $registro->nome_tipo_projeto }}
                            </h5>
                        </div>

                    </div>
                </div>

                <div class="card-body">

                    <ul class="list-group list-group-flush list my--3">
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <small>Quantidade de Gatilhos:</small>
                                    <h5 class="mb-0">{{ $registro->num_gatilhos }}</h5>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <small>Quantidade de Cliente :</small>
                                    <h5 class="mb-0">{{ $registro->num_cliente }}</h5>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <small>Quantidade de Equipe :</small>
                                    <h5 class="mb-0">{{ $registro->num_equipe }}</h5>
                                </div>
                            </div>
                        </li>

                    </ul>

                </div>

                <div class="card-footer">
                    <a href="{{ route('backend.gatilhos.template', $registro->id_tipo_projeto) }}" class="btn btn-sm btn-neutral" style="background-color: #5c6ce8;color: #FFF;padding: 7px 15px;border-color: #5c6ce8;">VER TODOS</a>
                </div>

            </div>

        </div>
    @endforeach

@endsection

@section('script')

@endsection

    
