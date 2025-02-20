@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Tipos de Projetos
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Tipos de Projetos Cadastrados</h3>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipos_projetos as $registro)				
                        <tr>
                            <!-- ID Do Tipo de Projeto -->
                            <td scope="row">
                                {{ $registro->id }}
                            </td>

                            <!-- Nome do Tipo de Projeto -->
                            <td>
                                {{ $registro->nome }}
                            </td>

                            <!-- Descrição do Tipo de Projeto -->
                            <td>
                                {{ $registro->descricao }}
                            </td>

                            <!-- Status do Tipo de Projeto -->
                            <td>
                                {{ $registro->status }}
                            </td>

                            <!-- Ações do Tipo de Projeto -->
                            <td>
                                <!-- Botão de Editar de Tipo de Projeto -->
                                <a href="{{ route('backend.tipo-projeto.editar',$registro->id) }}" class="btn btn-warning">
                                    Editar
                                </a>

                                <!-- Botão de Deletar o Tipo de Projeto -->
                                <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.tipo-projeto.deletar',$registro->id) }}' : false)" class="btn btn-danger">
                                    Deletar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer py-4">                
                <a href="{{ route('backend.tipo-projeto.adicionar') }}" class="btn btn-info" style="float: left;">Adicionar Novo</a>
                {!! $tipos_projetos->links() !!}
            </div>
        </div>
    </div>
@endsection