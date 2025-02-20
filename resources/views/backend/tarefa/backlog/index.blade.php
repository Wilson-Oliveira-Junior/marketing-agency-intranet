@extends('layouts.app-backend')

@section('style')
    <link href="{{ asset('css/tarefa.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tarefa_nova.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.6/dist/css/bootstrap-select.min.css">
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Backlog
    </a>
@endsection

@section('content')
    <div class="col-xl-12 order-xl-1">
        @include('backend.tarefa.backlog.abertas')
    </div>
@endsection

@section('script')

@endsection