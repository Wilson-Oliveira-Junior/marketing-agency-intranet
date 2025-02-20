@extends('layouts.app-backend')

@section('style')
    <style>
        .form-group{
            float:left;
        }
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.permissao') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Listagem de Gatilhos
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Editando Gatilho
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0" style="float:left;width:85%">Editando Gatilho</h3>

                <a href="{{ route('backend.gatilhos') }}" class="btn btn-info" style="float: left;margin-top: -10px;">
                    VOLTAR
                </a>
            </div>
            <form action="{{ route('backend.gatilhos.atualizar',$gatilhos->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" name="_method" value="put">

                @include('backend.gatilhos._form')

                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">Atualizar</button>
            </form>

        </div>
    </div> 
@endsection