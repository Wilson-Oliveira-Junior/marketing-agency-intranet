@extends('layouts.app-backend')

@section('style')
    <style>
        #tipo-projeto-conteudo-id{
            float: none !important;
            position: absolute;
            z-index: 1000;
            margin-top: 24%;
            width: 400px;
            list-style: none;
            display: none;
            padding-left: 0px;
            background-color: #FFF;
            margin-bottom: 0px !important;
            overflow-x: hidden;
            overflow-y: auto;
            max-height: 165px;
            border: 1px solid #ccc;
        }
        .valor_input{
            margin-top: 7px !important;
            box-shadow: 0 4px 6px rgba(50,50,93,.11),0 1px 3px rgba(0,0,0,.08)!important;
            border: 1px solid #fff !important;
        }
        #tipo-projeto-conteudo-id li{
            width: 100%;
            border-bottom: 1px solid #000;
            cursor: pointer;
            color: #737373;
            padding: 10px;
            float: left;
            margin: 0px;
            line-height: 10px;
            padding-left: 20px;
            transition: all .3s linear;
        }
        #tipo-projeto-conteudo-id li:hover{
            background-color: #5e6de7;
            color: #FFF;
        }
        #tipo-projeto-conteudo-id li .nome{
            float: left;
            width: 70%;
        }
        .visible {
            display: block !important;
        }
        #tipo-projeto-conteudo-id li .estimativa{
            width: 25%;
            float: right;
            text-align: right;
            font-size: 11px;
            padding-top: 5px;
            color: #b3b3b3;
        }
        .imagem-carregamento{
            display:none;
            width: 100%;
        }
        .search-tipo-projetos{
            display:none;
            position: absolute;
            width: 100%;
            margin-top: 0px;
            background-color: #eaeaea;
            padding: 10px 16px;
            z-index: 10000;
            border: 1px solid #CCC;
        }
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cliente') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Clientes
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Editando Projeto
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Editando Projeto " - {{ $clientes->nome }} - "</h3>
            </div>
            <form action="{{ route('backend.cliente.atualizarProjeto', [$clientes->id, $projetos->id]) }}" method="post" enctype="multipart/form-data" style="align-items: center;display: flex;flex-wrap: wrap;">
                {{ csrf_field() }}

                <input type="hidden" name="_method" value="put">

                @include('backend.cliente.projeto._form')

                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;height: 40px;">Atualizar</button> 
            </form>
        </div>
    </div>    
@endsection