@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Projetos
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0" style="float:left;">Projetos</h3>
                
                <form action="{{ route('backend.projeto.busca') }}" method="POST" class="search-cliente navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex">
                    {{ csrf_field() }}
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" name="busca-projeto" placeholder="Buscar Projeto..." type="text" style="color: #a2a2a2;">
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Projeto</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projetos as $registro)				
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>{{ $registro->projeto }}</td>
                            <td>{{ $registro->nome_cliente }}</td>
                            <td>{{ $registro->status }}</td>
                            <td>
                                <a href="{{ route('backend.projeto.editar',$registro->id) }}" class="btn btn-warning">Editar</a>
                                <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.projeto.deletar',$registro->id) }}' : false)" class="btn btn-danger">Deletar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer py-4">                
                <a href="{{ route('backend.projeto.adicionar') }}" class="btn btn-info" style="float: left;">Adicionar Novo</a>
            </div>
        </div>
        {!! $projetos->links() !!}
    </div>
@endsection