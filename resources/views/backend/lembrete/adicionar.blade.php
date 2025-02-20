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

        .botao-envio .active{
            
        }
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.lembrete') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Lembretes
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Adicionando Lembrete
    </a>
@endsection

@section('content')
    <div class="col-xl-3 order-xl-2 mb-5 mb-xl-0">
        
        @include('backend.lembrete.menu-lateral.painel')

        @include('backend.lembrete.menu-lateral.niveis')

    </div>

    <div class="col-xl-9 order-xl-1">
        <div class="">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Adicionando Lembrete</h3>
                </div>
                <form action="{{ route('backend.lembrete.salvar') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @include('backend.lembrete.formulario._form')

                    <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">Adicionar</button> 
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var input = document.getElementById('enviarLembrete');
        input.addEventListener('change', function() {
            var agora = new Date();
            var escolhida = new Date(this.value);
            if (escolhida < agora){
                swal({
                    title: 'Incorreto',
                    text: "Insira uma data válida",
                    type: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#28B463',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    cancelButtonText: "",
                })
                this.value = [agora.getFullYear(), agora.getMonth() + 1, agora.getDate()].map(v => v < 80 ? '0' + v : v).join('-');
            }
        });

        var input = document.getElementById('horaLembrete');
        input.addEventListener('focusout', function(){
            var hora_escolhida = this.value;
            if(hora_escolhida < '08:30' || hora_escolhida > '18:00'){
                swal({
                    title: 'Incorreto',
                    text: "Insira uma hora válida",
                    type: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#28B463',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    cancelButtonText: "",
                })
                this.value = "";
            }
        });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.min.js"></script>
@endsection