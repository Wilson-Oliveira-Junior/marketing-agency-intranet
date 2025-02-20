@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.sugestao') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Sugestão
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Editando Sugestão
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Adicionando Sugestão</h3>
            </div>
            <form action="{{ route('backend.sugestao.atualizar',$sugestoes->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" name="_method" value="put">

                @include('backend.sugestao._form')

                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">Adicionar</button> 
            </form>

        </div>
    </div>    
@endsection