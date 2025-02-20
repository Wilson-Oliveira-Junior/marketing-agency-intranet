@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cliente') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Clientes
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cliente.editar', $clientes->id) }}" style="font-size: 11px;margin-bottom: -5px !important;">
        {{ $clientes->nome_fantasia }}
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Editando Domínio
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Editando Domínio " - {{ $clientes->nome }} - "</h3>
            </div>
            <form action="{{ route('backend.cliente.atualizarDominio', [$clientes->id, $clientes_dominios->id_dominio]) }}" method="post" enctype="multipart/form-data" style="align-items: center;display: flex;flex-wrap: wrap;">
                {{ csrf_field() }}

                <input type="hidden" name="_method" value="put">

                @include('backend.cliente.dominio._form')

                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;height: 40px;">Atualizar</button> 
            </form>
        </div>
    </div>    
@endsection

@section('script')
    <script src="{{ asset('js/mascara.js') }}" type="text/javascript"></script>
    <script>
        // Mascara no campo de CNPJ
        $(document).ready(function(){	
            $("#telefone").mask("(99) 9999-9999");
            $("#celular").mask("(99) 9.9999-9999");
        });
    </script>
@endsection