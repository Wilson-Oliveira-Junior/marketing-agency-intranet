@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Listagem de Grupos Gatilhos
    </a>
@endsection

@section('content')
    <div class="col">

        <div class="card shadow">
            
            <div class="card-header border-0" style="display: flex;position: relative;">
                <h3 class="mb-0">Listagem de Grupos Gatilhos</h3> 

                <a href="{{ route('backend.gatilhos.grupo.adicionar') }}" class="btn btn-info" style="margin:-5px 0 -10px 20px;position:initial!important;">
                    Adicionar Novo
                </a>

                <form action="#" method="POST" class="search-cliente navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex" style="position: absolute;right: 30px;margin-right: 0px !important;">
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
                            <th scope="col">#</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gatilhos_grupos as $registro)				
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>{{ $registro->descricao }}</td>
                            <td>
                                @can('editar_gatilhos_grupo')
                                    <a href="{{ route('backend.gatilhos.grupo.editar',$registro->id) }}" class="btn btn-warning">Editar</a>
                                @endcan

                                @can('deletar_gatilhos_grupo')
                                    <a onclick="return confirm('Deletar esse registro?');" href="{{ route('backend.gatilhos.grupo.deletar',$registro->id) }}" class="btn btn-danger">Deletar</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer py-4">
            <a href="{{ route('backend.gatilhos.grupo.adicionar') }}" class="btn btn-info" style="float: left;">Adicionar Novo</a>                
                {!! $gatilhos_grupos->links() !!}
            </div>

        </div>
        
    </div>    
    
@endsection

@section('script')

@endsection

    
