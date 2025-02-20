@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.tipotarefa') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Tipo de Tarefa
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Adicionando Tipo de Tarefa
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Adicionando Tipo de Tarefa</h3>
            </div>
            <form action="{{ route('backend.tipotarefa.salvar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('backend.tipotarefa._form')
                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">Adicionar</button> 
            </form>
        </div>
    </div>
@endsection