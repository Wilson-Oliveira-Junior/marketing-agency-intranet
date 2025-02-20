@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.setor') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Setores
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Adicionando Setor
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Adicionando Setor do Usuário</h3>
            </div>
            <form action="{{ route('backend.setor.atualizar',$setores->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" name="_method" value="put">

                @include('backend.setor._form')

                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">Atualizar</button> 
            </form>

        </div>
    </div> 
@endsection