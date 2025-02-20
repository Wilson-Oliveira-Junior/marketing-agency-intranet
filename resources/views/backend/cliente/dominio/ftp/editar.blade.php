@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cliente.dominio.ftp.editar', [$id, $id_dominio]) }}" style="font-size: 11px;margin-bottom: -5px !important;">
        FTP
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Atualizar FTP
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Atualizando FTP: {{$nomeDominio}}</h3>
            </div>
            @if(Session::has('flash_message'))
                <div class="mensagem {{ Session::get('flash_message')['class'] }}" style="margin-top: 20px;font-weight: bold;" >
                    {{ Session::get('flash_message')['msg'] }}
                </div>
			@endif
            <form action="{{ route('backend.cliente.dominio.ftp.atualizar',[$id,$id_dominio]) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('backend.cliente.dominio.ftp._form')

                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">Atualizar</button> 
            </form>

        </div>
    </div>    
@endsection