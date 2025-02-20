@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Cronograma
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0" style="float:left;">Cronograma Usuários</h3>

            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Setor</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $registro)
                            <tr>
                                <td scope="row">{{ $registro->id_usuario }}</td>
                                <td>{{ $registro->nome_usuario }}</td>
                                <td>{{ $registro->email_usuario }}</td>
                                <td>{{ $registro->nome_setor_usuario }}</td>
                                <td>
                                    <a href="{{ route('backend.cronograma.usuario',$registro->id_usuario) }}" class="btn btn-warning {{ $registro->classes }}">Cronograma</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>

    </div>
@endsection
