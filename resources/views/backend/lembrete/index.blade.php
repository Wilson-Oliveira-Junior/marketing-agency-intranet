@extends('layouts.app-backend')

@section('style')
    <style>
        .painel-lembrete{
            padding-left: 0px;
            padding-right: 0px;
            padding-top: 5px;
        }
        .painel-lembrete li{
            
        }
        .painel-lembrete li a{
            text-transform: capitalize;
            background-color: #f5365c;
            border: 2px dashed #f5365c;
            transition: all .3s linear;
            color: #FFF;
            padding-left: 25px !important;
            padding: 10px;
            margin-bottom: -6px;
        }
        .painel-lembrete li a:hover{
            background-color: #fbfbfb;
            color: #f5365c;
        }
        .painel-lembrete li a:hover i{
            color: #f5365c !important;
        }
        .painel-lembrete li a i{
            margin-right: 10px;
            color: #FFF !important;
        }

        .painel-lembrete .two{
            background-color: #11cdef;
            border-color: #11cdef;
        }
        .painel-lembrete .two:hover{
            color: #11cdef;
        }
        .painel-lembrete .two:hover i{
            color: #11cdef !important;
        }

        .painel-lembrete .three{
            background-color: #ffd600;
            border-color: #ffd600 !important;
        }
        .painel-lembrete .three:hover{
            color: #ffd600;
        }
        .painel-lembrete .three:hover i{
            color: #ffd600 !important;            
        }

        .painel-lembrete .four{
            background-color: #fb6340;
            border-color: #fb6340;
        }
        .painel-lembrete .four:hover{
            color: #fb6340;
        }
        .painel-lembrete .four:hover i{
            color: #fb6340 !important;      
        }

        .painel-lembrete .five{
            background-color: #2dce89;
            border-color: #2dce89;
        }
        .painel-lembrete .five:hover{
            color: #2dce89;
        }
        .painel-lembrete .five:hover i{
            color: #2dce89 !important;  
        }

        .painel-lembrete .six{
            background-color:#172b4d;
            border-color: #172b4d;
        }
        .painel-lembrete .six:hover{
            color: #172b4d;
        }
        .painel-lembrete .six:hover i{
            color: #172b4d !important;  
        }

        .painel-lembrete .seven{
            background-color: #7e30d8;
            border-color: #7e30d8;
        }
        .painel-lembrete .seven:hover{
            color: #7e30d8;
        }
        .painel-lembrete .seven:hover i{
            color: #7e30d8 !important;  
        }

        .painel-lembrete .eight{
            background-color: #3dff53;
            border-color: #3dff53;
        }
        .painel-lembrete .eight:hover{
            color: #3dff53;
        }
        .painel-lembrete .eight:hover i{
            color: #3dff53 !important;  
        }
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Lembretes
    </a>
@endsection

@section('content')
    <div class="col-xl-3 order-xl-2 mb-5 mb-xl-0">
        
        @include('backend.lembrete.menu-lateral.painel')

        @include('backend.lembrete.menu-lateral.niveis')

    </div>

    <div class="col-xl-9 order-xl-1">
        @include('backend.lembrete.tabela')
    </div>
@endsection

@section('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.min.js"></script>
@endsection