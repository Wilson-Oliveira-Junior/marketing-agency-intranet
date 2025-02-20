@extends('layouts.app-backend')

@section('style')
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>

    <style>
        #mceu_11{
            width: 93% !important;
            border: 0px !important;
        }
        #mceu_13-body, #mceu_28, #mceu_27, .mce-notification-inner, .mce-close, #mceu_31{
            display: none !important;
        }
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
        .caixa-comentario{
            width: 100%;
            margin-bottom: 30px;
        }
        .caixa-comentario .complemento{
            background-color: #dcf8c6;
            color: #444;
            padding: 20px;
            border-radius: 0px 15px 15px 15px;
            margin-top: 15px;
            min-height: 125px;
            float: left;
            padding-top: 15px;
            width: 85%;
            margin-left: 10px;
            padding-bottom: 0px !important;
        }
        .caixa-comentario .complemento .texto{
            min-height: 60px;
        }
        .caixa-comentario .complemento .detalhes p{
            font-size: 11px;
            font-weight:bold;
        }
        .caixa-comentario .foto{
            width: 35px;
            float: left;
            margin-left: 25px;
        }
        .caixa-comentario .foto img{
            width: 40px;
            border-radius: 200px;
            height: 40px;
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
        Editando o Lembretes
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
                    <h3 class="mb-0" style="float:left">Editar Lembrete</h3>
					
					@if($lembretes->concluido == 'N')
						<button id="btn" onclick="concluir{{ $lembretes->id }}();" class="btn bg-success margin" style="margin: 0px;color:#FFF;float:left;margin-left: 25%;margin-top: -10px;">Concluir</button>
					@else
						<button id="btn" onclick="reabrir{{ $lembretes->id }}();" class="btn bg-orange margin" style="margin: 0px;color:#FFF;float:left;margin-left: 25%;margin-top: -10px;">Reabrir</button>
					@endif  
				
					@foreach($responsavel as $registro)
                        <h3 style="text-align:right;">
                            <span style="font-weight: 400;font-size: 15px;margin-right: 5px;">Criado por:</span> 
                            {{ $registro->name }}
                        </h3>
                    @endforeach
                </div>                      
             				
                <form action="{{ route('backend.lembrete.atualizar',$lembretes->id) }}" method="post" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}

                    @include('backend.lembrete.formulario.form_editar')

                    <!--<button class="btn btn-info" style="margin: 17px;margin-top: -10px;">
                        Atualizar
                    </button>-->
                </form>

            </div>
        </div>

        <div class="card shadow" style="margin-top: 30px;">
            <div class="card-header border-0">
                <h3 class="mb-0">Adicione um Comentário</h3>
            </div>
            <form action="{{ route('backend.lembrete.comentario.adicionar',$lembretes->id) }}" method="post" enctype="multipart/form-data">
                    
                {{ csrf_field() }}

                @include('backend.lembrete.formulario.comentario_form')

                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">
                    <i class="fas fa-paper-plane" style="margin-left: -3px;"></i>
                </button> 
            </form>
        </div>
        

        <div class="card show" style="margin-top:30px;">
            <div class="card-header border-0">
                <h3 class="mb-0"> Comentários</h3>
            </div>

            @foreach($comentarios as $registro)
                @if($registro->id_user == Auth::user()->id)
                    <div class="caixa-comentario">
                        <div class="foto">
                            <img src="http://intranet.logicadigital.com.br/{{ $registro->image }}">
                        </div>

                        <div class="complemento">
                            
                            <div class="icone" style="float: right;">
                                <a href="{{ route('backend.lembrete.comentario.deletar', $registro->id) }}">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>

                            <div class="texto">     
                                <p>{!! $registro->comentario !!}</p>
                            </div>

                            <div class="detalhes">
                                <p>{{ $registro->name }} - {{ date( 'd/m/Y' , strtotime($registro->created_at))}}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="caixa-comentario">
                        <div class="foto" style="float: right;margin-left: 0px;margin-right: 25px;">
                            <img src="http://intranet.logicadigital.com.br/{{ $registro->image }}">
                        </div>

                        <div class="complemento" style="float: right;margin-right: 10px;background-color: #e1efee;border-radius: 15px 0px 15px 15px;">
                        
                            <div class="texto">     
                                <p>{!! $registro->comentario !!}</p>
                            </div>

                            <div class="detalhes">
                                <p>{{ $registro->name }} - {{ date( 'd/m/Y' , strtotime($registro->created_at))}}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('script')
							<!-- Concluir Lembrete -->
                        <script>
                            function concluir{{ $lembretes->id }}(){
                                swal({
                                    title: 'Concluir',
                                    text: "Tem certeza que deseja concluir?",
                                    type: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#28B463',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ok',
                                    cancelButtonText: "Cancelar",
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.replace("{{ route('backend.lembrete.concluir',$lembretes->id) }}");												  		
                                    }
                                })
                            }
                        </script>

                        <!-- Reabrir Lembrete -->
                        <script>
                            function reabrir{{ $lembretes->id }}(){
                                swal({
                                    title: 'Reabrir',
                                    text: "Tem certeza que deseja reabrir?",
                                    type: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#28B463',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ok',
                                    cancelButtonText: "Cancelar",
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.replace("{{ route('backend.lembrete.reabrir',$lembretes->id) }}");												  		
                                    }
                                })
                            }
                        </script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.min.js"></script>
@endsection