@extends('layouts.app-backend')

@section('style')
    <link type="text/css" href="{{ asset('css/cronograma.css') }}" rel="stylesheet">
    <style>
        .exibicao{
            padding: 10px 20px !important;
        }
        .exibicao h3{
            width: 100%;
            font-size: 15px !important;
            text-align: left;
        }
        .exibicao i{
            float: left;
            margin-right: 5px;
            margin-top: 4px;
            color: #32315e;
            width: 25px;
        }
        .collapse-semana{
            background-color: transparent;
            border: none;
            color: #16294e;
            font-size: 20px;
            float: right;
            cursor: pointer;
            width: 100%;
            display: flex;
            padding: 0px;
        }
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cronograma') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Cronograma
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        {{ $usuario->name }} {{ $usuario->sobrenome }}
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">

            <!-- Header -->
            <div class="card-header bg-white border-0" style="padding: 0px;">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="exibicao">
                            <h3>{{ $usuario->name }} {{ $usuario->sobrenome }} - Cronograma</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div id="id_usuario" data-id="{{ $usuario->id }}"></div>

            @include('backend.cronograma.cronograma')

        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('js/cronograma.js') }}"></script>
    <script>
        $(document).on('click', '.collapse-semana', function(){

            cronogramaId = $(this).data('id');
            semana = $(this).data('semana');

            //console.log('ID', cronogramaId);
            //console.log('Semana', semana);
            //console.log('tem del', $(".ni-" + semana + "-" + cronogramaId).hasClass("ni-fat-delete"));
            //console.log('tem add', $(".ni-" + semana + "-" + cronogramaId).hasClass("ni-fat-add"));

            if( $(".ni-" + semana + "-" + cronogramaId).hasClass("ni-fat-add") ) {

                $(".ni-" + semana + "-" + cronogramaId).removeClass("ni-fat-add");
                $(".ni-" + semana + "-" + cronogramaId).addClass("ni-fat-delete");
                $(".semana-" + semana + "-" + cronogramaId).fadeIn();

            }else if( $(".ni-" + semana + "-" + cronogramaId).hasClass("ni-fat-delete") ) {

                $(".ni-" + semana + "-" + cronogramaId).addClass("ni-fat-add");
                $(".ni-" + semana + "-" + cronogramaId).removeClass("ni-fat-delete");
                $(".semana-" + semana + "-" + cronogramaId).fadeOut();
            }
        });
    </script>
@endsection
