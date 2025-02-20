@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#" style="font-size: 11px;margin-bottom: -5px !important;">
        Relat&oacute;rio
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Listagem de Documentos
    </a>
@endsection

@section('content')
<div class="col">
        <div class="card shadow">
            <div class="card-header border-0" style="display: flex;position: relative;">
                <h3 class="mb-0">Listagem de Documentos da &Aacute;rea de: {{$vSetor}}</h3>

                <form action="#" method="POST" class="search-cliente navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex" style="position: absolute;right: 30px;margin-right: 0px !important;">
                    {{ csrf_field() }}
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                        </div>
                        <input id="txtBuscaDocumento" class="form-control" name="busca-cliente" placeholder="Buscar Documento..." type="text" style="color: #a2a2a2;">
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
                            <th scope="col">Descri&ccedil;&atilde;o</th>
                            <th scope="col">Visualizar?</th>
                        </tr>
                    </thead>
                    <tbody class="conteudo-ftp">
                        @foreach($arrDocumentos as $registro)				
                            <tr class="bloco">
                                <td scope="row">{{ $registro->idDocumento }}</td>
                                <td>{{ $registro->NomeDocumento }}</td>
                                <td>{{mb_strimwidth($registro->Descricao,0,60,'...')}}</td>
                                <td><a href='{{ asset($registro->Arquivo) }}' alt="Abrir PDF" text="Abrir PDF" target="_blank"><img src="{{ asset('img/icone-pdf.png') }}" /></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div> 
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.btn');
    </script>

    <script>
        $("#txtBuscaDocumento").keyup(function(){
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