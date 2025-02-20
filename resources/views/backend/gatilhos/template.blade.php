@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.gatilhos') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Listagem de Gatilhos
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Listagem de Gatilhos Projetos
    </a>
@endsection

@section('content')
    <div class="col">

        <div class="card shadow">
            
            <div class="card-header border-0" style="display: flex;position: relative;">
                <h3 class="mb-0">Listagem de Gatilhos Projetos</h3> 
            </div>

            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gatilho</th>
                            <th scope="col">Projeto</th>
                            <th scope="col">Tipo Gatilho</th>

                            <th scope="col">Padrão</th>
                            <th scope="col">50 Dias</th>
                            <th scope="col">40 Dias</th>
                            <th scope="col">30 Dias</th>

                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gatilhos as $registro)				
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>{{ $registro->gatilho }}</td>
                            <td>{{ $registro->nome_tipo_projeto }}</td>
                            <td>{{ $registro->tipo_gatilho }}</td>

                            <!-- Dias Passados do Projeto -->
                            <td>{{ $registro->dias_limite_padrao }}</td>
                            <td>{{ $registro->dias_limite_50 }}</td>
                            <td>{{ $registro->dias_limite_40 }}</td>
                            <td>{{ $registro->dias_limite_30 }}</td>

                            <td>
                                @can('editar_gatilhos')
                                    <a href="{{ route('backend.gatilhos.editar',$registro->id) }}" class="btn btn-warning">Editar</a>
                                @endcan

                                @can('deletar_gatilhos')
                                    <a onclick="return confirm('Deletar esse registro?');" href="{{ route('backend.gatilhos.deletar',$registro->id) }}" class="btn btn-danger">Deletar</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer py-4">
                {!! $gatilhos->links() !!}
            </div>

        </div>
        
    </div>  

@endsection

@section('script')

@endsection

    
