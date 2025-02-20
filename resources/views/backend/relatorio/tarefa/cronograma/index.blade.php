@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="" style="font-size: 11px;margin-bottom: -5px !important;">
        Relat&oacute;rio
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Cronograma
    </a>
@endsection

@section('content')
<div class="col">
        <div class="card shadow">
            <div class="card-header border-0" style="display: flex;position: relative;">
                <h3 class="mb-0">Estatistica Cronograma {{$vSegunda}} - {{$vSexta}}</h3>

                <form action="#" method="POST" class="search-cliente navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex" style="position: absolute;right: 30px;margin-right: 0px !important;">
                    {{ csrf_field() }}
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                        </div>
                        <input id="txtBuscaFTP" class="form-control" name="busca-cliente" placeholder="Buscar Cliente..." type="text" style="color: #a2a2a2;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Setor</th>
                            <th scope="col">Qtde Associada</th>
                            <th scope="col">Qtde Finalizada</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="conteudo-ftp">
                        @foreach($arrCronogramas as $registro)
                            <tr class="bloco">
                                <td scope="row">{{ $registro->id_responsavel }}</td>
                                <td>{{ $registro->name }}</td>
                                <td>{{ $registro->nome }}</td>
                                <td>{{ $registro->qtdeAssociada }}</td>
                                <td>{{ $registro->qtdeFinalizada }}</td>
                                <td>
                                    <a href="{{ route('backend.relatorio.tarefa.cronogramagrafico',$registro->id_responsavel) }}" class="btn btn-info">Ver Gráfico Geral</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('script')


    <script>
        $("#txtBuscaFTP").keyup(function(){
            var texto = $(this).val();

            $(".conteudo-ftp .bloco").each(function(){
                if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                    $(this).fadeOut();
                }else {
                    $(this).fadeIn();
                }
            });
        });
    </script>
 @endsection
