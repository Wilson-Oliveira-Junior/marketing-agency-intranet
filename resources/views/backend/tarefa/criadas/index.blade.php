@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Tarefas que eu Criei
    </a>
@endsection

@section('content')
    <div class="col-xl-12 order-xl-1">
        @include('backend.tarefa.criadas.abertas')
    </div>
@endsection

@section('script')

@endsection