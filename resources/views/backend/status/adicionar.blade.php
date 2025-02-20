@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.status') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Status
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Adicionando Status
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Adicionando Status</h3>
            </div>
            <form action="{{ route('backend.status.salvar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('backend.status._form')
                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">Adicionar</button> 
            </form>
        </div>
    </div>
@endsection