@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Sugestao
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0" style="float:left;">Sugestao</h3>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Título</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sugestoes as $registro)

                                <tr>
                                    <td scope="row">{{ $registro->id }}</td>
                                    <td>{{ $registro->nome_usuario }}</td>
                                    <td>{{ $registro->titlo_sugestao }}</td>
                                    <td>
                                        @can('editar_sugestao', $registro)
                                            <a href="{{ route('backend.sugestao.editar',$registro->id) }}" class="btn btn-warning">Editar</a>
                                        @endcan
                                        <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.sugestao.deletar',$registro->id) }}' : false)" class="btn btn-danger">Deletar</a>
                                    </td>
                                </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer py-4">                
                <a href="{{ route('backend.sugestao.adicionar') }}" class="btn btn-info" style="float: left;">Adicionar Novo</a>
            </div>
        </div>
        {!! $sugestoes->links() !!}
    </div>
@endsection