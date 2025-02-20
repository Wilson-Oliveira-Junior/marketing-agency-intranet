@extends('layouts.app-backend')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>
        label{
            color: #0064ae;
            font-weight: 400;
        }
        .select2-container--default{
            margin-top: 0px;
        }
        .select2-selection--single{
            padding: 5px !important;
            box-shadow: none !important;
            color: #aeaeae;
            border-radius: 6px !important;
            border: none !important;
            height: 35px !important;
            transition: box-shadow .15s ease;
            box-shadow: 0 3px 2px rgba(50,50,93,.15), 0 20px 0 rgba(0,0,0,.02);
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            color: #989898 !important;
        }
        .col .input-group{
            padding: 5px !important;
            color: #aeaeae;
            font-weight: 400;
            border-radius: 6px !important;
            border: none !important;
            height: 50px !important;
            transition: box-shadow .15s ease;
            box-shadow: 0 3px 2px rgba(50,50,93,.15), 0 20px 0 rgba(0,0,0,.02);    
        }
        .col .input-group input{
            border: none;
            padding: 0px;   
        }
        .col .input-group-addon{
            border:none;
        }


        #dominioModelLabel{
            text-align: center;
            font-size: 21px;
            color: #444;
            margin-right: auto;
            display: block;
            width: 100%;
            margin-left: 40px;
        }
        #dominioModel .col-sm-4{

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
        Transferindo Cliente
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">

            <div class="card-header border-0">
                <h3 class="mb-0">Transferindo Projeto <strong>{{ $projeto->projeto}}</strong> do Cliente: {{ isset($cliente->nome_fantasia)?$cliente->nome_fantasia:$cliente->nome }}</h3>
            </div>

            <form action="{{ route('backend.cliente.salvar.transferir', [$cliente->id, $projeto->id]) }}" method="post" style="align-items: center;display: flex;flex-wrap: wrap;">
                {{ csrf_field() }}

                <!-- Cliente -->
                <div class="form-group col-sm-4">
                    <label>Selecione o novo cliente</label>
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                        </div>
                        <select id="transferircliente" class="form-control" name="cliente_id">
                            @foreach($todas_clientes as $registro)
                                <option id="{{ $registro->id }}" class="option-dominio" value="{{ $registro->cliente_id }}" {{ (isset($projetos->cliente_id) && $registro->cliente_id == $projetos->cliente_id ? 'selected' : '') }}>{{ $registro->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Domínio -->
                <div class="form-group col-sm-4">
                    <label>Selecione o dominio</label>
                    <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="ni ni-hat-3"></i>
                            </span>
                        </div>
                        <select id="dominiosCliente" class="form-control" name="dominio">
                            <option value="">--Selecione--</option>
                        </select>
                    </div>
                </div>

                <div id="adicionarDoCliente" class="form-group col-sm-4">
                    <label>Gostaria de Adicionar um Domínio?</label>
                    <div class="input-group input-group-alternative mb-3" style="box-shadow: none !important;">
                        <a href="#" class="btn btn-info" style="background-color: #fd6237;border-color: #ff612c;" data-toggle="modal" data-target="#dominioModel">    
                            <span>Adicionar Domínio</span>
                        </a>
                        
                    </div>
                </div>

                <div class="form-group col-sm-6" style="padding-left: 0px;">
                    <button class="btn btn-info" style="margin: 17px;margin-top: -10px;    height: 40px;">Transferir</button> 
                </div>  

            </form>
            @include('backend.cliente.json.AdicionarDominio')
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/select2.full.min.js') }} "></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        })
    </script>    
@endsection