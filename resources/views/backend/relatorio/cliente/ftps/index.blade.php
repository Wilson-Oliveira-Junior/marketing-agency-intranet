@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.relatorio.cliente.ftps') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Relat&oacute;rio
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Listagem de FTPs
    </a>
@endsection

@section('content')
<div class="col">
        <div class="card shadow">
            <div class="card-header border-0" style="display: flex;position: relative;">
                <h3 class="mb-0">Listagem de FTPs</h3>

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
                            <th scope="col">Cliente</th>
                            <th scope="col">Domínio</th>
                            <th scope="col">&Eacute; Principal?</th>
                            <th scope="col">Tipo Hospedagem</th>

                        </tr>
                    </thead>
                    <tbody class="conteudo-ftp">
                        @foreach($arrFTPs as $registro)				
                            <tr class="bloco">
                                <td scope="row">
                                    
                                @if(!empty($registro->ClientesDominios))
                                    <button class="btn" data-clipboard-text="Servidor: {{ $registro->ClientesDominios->servidor }} ; Usuário: {{ $registro->ClientesDominios->usuario }} ; Senha: {{ $registro->ClientesDominios->senha }}; Protocolo: {{ $registro->ClientesDominios->protocolo }}" style="margin-right: 4px;padding: 0px;margin: 0px;background-color: #d52d28;">
                                        <img src="{{ asset('img/icone-filezilla-vermelho.png') }}" style="height: 40px;">
                                    </button>
                                @else
                                    <button class="btn" data-clipboard-text="Sem dados." style="margin-right: 4px;padding: 0px;margin: 0px;background-color: #000;">
                                        <img src="{{ asset('img/icone-filezilla-preto-copia.png') }}" style="height: 40px;">
                                    </button>
                                @endif                                    
                                </td>
                                <td>{{ isset($registro->clientes->nome_fantasia) ? mb_strimwidth($registro->clientes->nome_fantasia,0,35,'...') : $registro->clientes->nome  }}</td>
                                <td>{{ $registro->dominio }}</td>
                                <td>{{ $registro->dominio_principal }}</td>
                                <td>{{ $registro->tipo_hospedagem }}</td>
                                
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