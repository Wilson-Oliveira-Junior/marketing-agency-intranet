@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Setores
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Setores Cadastrados</h3>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Descricão</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($setores as $registro)				
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>{{ $registro->nome }}</td>
                            <td>{{ $registro->email }}</td>
                            <td>{{ $registro->descricao }}</td>
                            <td>
                                <a href="{{ route('backend.setor.editar',$registro->id) }}" class="btn btn-warning">Editar</a>
                                <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.setor.deletar',$registro->id) }}' : false)" class="btn btn-danger">Deletar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer py-4">                
                <a href="{{ route('backend.setor.adicionar') }}" class="btn btn-info" style="float: left;">Adicionar Novo</a>
            </div>
        </div>
    </div>
@endsection