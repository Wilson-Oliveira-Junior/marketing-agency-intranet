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
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
            color: #5d6ee7 !important;
            background-color: #ffffff !important;
            border-radius: 10px 0px 0px 0px !important;
        }
        .nav-pills .nav-link {
            color: #fefefe !important;
            background-color: transparent !important;
            border-radius: 10px 0px 0px 0px !important;
            box-shadow: none !important;
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
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cronograma') }}">
        Cronograma
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow" style="border: 0;background: transparent;">

            <div class="nav-wrapper" style="background-color: transparent;padding: 0px;margin-bottom: 0px;">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">

                    <li class="nav-item" style="padding-right: 0px;">
                        <a class="nav-link mb-sm-3 mb-md-0 active cronograma-setor" id="tabs-icons-text-1-tab" data-id="2" data-toggle="tab" href="#atendimento" role="tab" aria-controls="#atendimento" aria-selected="true">
                            <i class="fas fa-mail-bulk mr-2"></i>
                            Atendimento
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 cronograma-setor" id="tabs-icons-text-2-tab" data-id="3" data-toggle="tab" href="#criacao" role="tab" aria-controls="criacao" aria-selected="false">
                            <i class="fas fa-laptop mr-2"></i>
                            Criação
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 cronograma-setor" id="tabs-icons-text-2-tab" data-id="1" data-toggle="tab" href="#desenvolvimento" role="tab" aria-controls="desenvolvimento" aria-selected="false">
                            <i class="fas fa-laptop-code mr-2"></i>
                            Desenvolvimento
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 cronograma-setor" id="tabs-icons-text-2-tab" data-id="5" data-toggle="tab" href="#marketing" role="tab" aria-controls="marketing" aria-selected="false">
                            <i class="far fa-lightbulb mr-2"></i>
                            Marketing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 cronograma-setor" id="tabs-icons-text-2-tab" data-id="4" data-toggle="tab" href="#comercial" role="tab" aria-controls="comercial" aria-selected="false">
                            <i class="far fa-sticky-note mr-2"></i>
                            Comercial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 cronograma-setor" id="tabs-icons-text-2-tab" data-id="7" data-toggle="tab" href="#administrativo" role="tab" aria-controls="administrativo" aria-selected="false">
                            <i class="fas fa-ticket-alt mr-2"></i>
                            Administrativo
                        </a>
                    </li>

                </ul>
            </div>

            <div class="card shadow">
                <div class="card-body" style="padding: 0px;">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="atendimento" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                        </div>

                        <div class="tab-pane fade" id="criacao" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">

                        </div>

                        <div class="tab-pane fade" id="desenvolvimento" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">

                        </div>

                        <div class="tab-pane fade" id="marketing" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">

                        </div>

                        <div class="tab-pane fade" id="comercial" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">

                        </div>

                        <div class="tab-pane fade" id="administrativo" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
    <script>
        idsetor = 2;
        nomesetor = 'atendimento';
        jQuery.ajax({
                type: "GET",
                url: "/backend/usuario/" + idsetor + "/montacronograma",
                processData: false,
                contentType: false,
                cache: false,
                success: function(dados){
                    $("#desenvolvimento").empty();
                    $("#atendimento").empty();
                    $("#criacao").empty();
                    $("#comercial").empty();
                    $("#marketing").empty();
                    $("#administrativo").empty();
                    $("#" + nomesetor).html(dados);
                }
            });
        $(".cronograma-setor").on('click', function(){
            var idsetor = $(this).attr("data-id");
            var nomesetor = '';
            if(idsetor == 1){
                nomesetor = 'desenvolvimento';
            }else if(idsetor == 2){
                nomesetor = 'atendimento';
            }else if(idsetor == 3){
                nomesetor = 'criacao';
            }else if(idsetor == 4){
                nomesetor = 'comercial';
            }else if(idsetor == 5){
                nomesetor = 'marketing';
            }else if(idsetor == 7){
                nomesetor = 'administrativo';
            }

            jQuery.ajax({
                type: "GET",
                url: "/backend/usuario/" + idsetor + "/montacronograma",
                processData: false,
                contentType: false,
                cache: false,
                success: function(dados){
                    $("#desenvolvimento").empty();
                    $("#atendimento").empty();
                    $("#criacao").empty();
                    $("#comercial").empty();
                    $("#marketing").empty();
                    $("#administrativo").empty();
                    $("#" + nomesetor).html(dados);
                }
            });
        });

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
