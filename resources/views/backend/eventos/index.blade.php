@extends('layouts.app-backend')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/calendario.css') }}" />
    <style>
        /* Eventos de Hoje */
            .timeline {
                position: relative;
                height: 250px;
                overflow: auto;
                margin-top: 5%;
            }
            .timeline-one-side:before {
                left: 1rem;
            }
            .timeline:before {
                left: 50%;
                margin-left: -2px;
            }
            .timeline:before {
                position: absolute;
                top: 15%;
                left: 1rem;
                height: 65%;
                content: '';
                border-right: 2px dashed #e9ecef;
            }
            .timeline-block {
                position: relative;
                margin: 2em 0;
            }
            .timeline-step {
                font-size: 1rem;
                font-weight: 600;
                position: absolute;
                z-index: 1;
                left: 16px;
                display: inline-flex;
                width: 33px;
                height: 33px;
                transform: translateX(-50%);
                text-align: center;
                border-radius: 50%;
                align-items: center;
                justify-content: center;
            }
            .timeline-content {
                position: relative;
                top: -15px;
                margin-left: 50px;
                padding-top: .5rem;
            }
            .timeline-block:after {
                display: table;
                clear: both;
                content: '';
            }
            .justify-content-between {
                justify-content: space-between!important;
            }
            .d-flex {
                display: flex!important;
            }
        /* Eventos de Hoje */
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Eventos
    </a>
@endsection

@section('content')

    <div class="col-9">
        <div class="card shadow" style="box-shadow: none !important;border: none;">
            <div class="col-12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <div class="card col-3">
        @include('backend.eventos.abas.exibicao')
    </div>

    @include('backend.eventos.modal-interna')

@endsection

@section('script')
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,listWeek'
                },
                defaultView         : 'month',
                // Habilitando o final de semana
                weekends            : true,
                // Função para habilitar o editar
                editable            : true,
                // Ignorar a zona que está executando
                ignoreTimezone      : false,
                // Delimitando quantidade de exibição
                eventLimit          : true,
                // Tradução dos itens
                allDayText          : 'Dia Todo', 
                eventLimitText      : "Mais",
                monthNames          : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort     : ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                dayNames            : ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
                dayNamesShort       : ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                buttonText: {
                    today:    'Hoje',
                    month:    'Mês',
                    week:     'Semana',
                    day:      'Dia',
                    list:     'Semana'
                },               
                eventClick          : function(calEvent) {
                    
                    var id_evento = calEvent.id;
                    var class_evento = calEvent.borderColor;
                    //alert(class_evento);

                    // Verificando se a variavel é vazia
                    if(id_evento !== ''){
                        // Configurando pra abrir evento ou gatilho
                        if(class_evento == '#5e72e4'){
                            var dados = {
                                id_evento   : id_evento,
                                _token      : '{{ csrf_token() }}'
                            }
                            $.post("{{ route('backend.evento.visualizar') }}", dados, function(retorna){
                                $("#visualizarEventoModal").modal("show");
                                $("#visualizarDetalhesEvento").html(retorna);
                            });
                        }else{

                            // GATILHOS
                            var dados = {
                                id_evento   : id_evento,
                                _token      : '{{ csrf_token() }}'
                            }
                            $.post("{{ route('backend.evento.visualizarGatilho') }}", dados, function(retorna){
                                $("#visualizarEventoModal").modal("show");
                                $("#visualizarDetalhesEvento").html(retorna);
                            });

                        }
                    }
                },
                events : [
                    @foreach($eventos as $registro)
                        {
                            id              : '{{ $registro->id }}',
                            className       : '@if($registro->descricao == NULL) class-evento @else class-evento icone-descricao @endif',
                            backgroundColor : '{{ $registro->tag }}',
                            borderColor     : '{{ $registro->tag }}',
                            title           : '{{ $registro->nome }}',
                            start           : '{{ $registro->evento_data_inicio }}',
                            end             : '{{ $registro->evento_data_fim }}'
                        },
                    @endforeach
                    @foreach($eventos_convidados as $registro)
                        {
                            id              : '{{ $registro->id }}',
                            className       : '@if($registro->descricao == NULL) class-evento icone-convidado @else class-evento icone-descricao icone-convidado @endif',
                            backgroundColor : '#FFF',
                            textColor       : '{{ $registro->tag }} !important',
                            borderColor     : '{{ $registro->tag }}',
                            title           : '{{ $registro->nome }}',
                            start           : '{{ $registro->evento_data_inicio }}',
                            end             : '{{ $registro->evento_data_fim }}'
                        },
                    @endforeach
                    @foreach($tarefas_eventos as $registro)
                        {
                            id              : '{{ $registro->id_tarefa }}',
                            className       : 'class-tarefa',
                            backgroundColor : '{{ $registro->tag }}',
                            borderColor     : '{{ $registro->tag }}',
                            title           : '{{ $registro->titulo }}',
                            start           : '{{ $registro->tarefa_evento_data_inicio }}',
                            end             : '{{ $registro->tarefa_evento_data_fim }}',
                            url             : '{{ route("backend.tarefa.editar", $registro->id_tarefa) }}'
                        },
                    @endforeach
                    @foreach($gatilhos as $registro)
                        {
                            id              : '{{ $registro->id }}',
                            className       : 'class-gatilho',
                            backgroundColor : '#fc8135',
                            borderColor     : '#fc8135',
                            title           : '{{ $registro->nome_fantasia }}',
                            start           : '{{ date( "Y-m-d" , strtotime($registro->data_incio)) }}',
                            end             : '{{ date( "Y-m-d" , strtotime($registro->data_fim)) }}',
                        },
                    @endforeach
					@foreach($arrDtComemorativas as $registro)
                        {
                            id              : '{{ $registro->id }}',
                            className       : 'class-gatilho',
                            backgroundColor : '#f5365c',
                            borderColor     : '#f5365c',
                            title           : '{{ $registro->nome }}',
                            start           : '{{ date( "Y-m-d" , strtotime($registro->data)) }}',
                            end             : '{{ date( "Y-m-d" , strtotime($registro->data)) }}',
                        },
                    @endforeach
                ]
            })
        });
    </script>

    <!-- Adicionando Classe Conforme Condicões -->
    <script>
        $(document).ready(function() {
            // Adicionando a classe de descrição
            $(".icone-descricao .fc-title").append("<i class='fas fa-align-right' style='float: right;margin-top: 2px;'></i>");
            
            // Adicionando a classe de convidado
            $(".icone-convidado .fc-title").append("<i class='fas fa-at' style='margin-right: 15px;float: right;margin-top: 2px;'></i>");
        });

        $("#aba-evento span").click(function(){
                
            if ( $("#aba-evento").hasClass( "mostrar" ) ) {
                $("#aba-evento").removeClass("mostrar");
                $(".class-evento").removeClass("invisible");
                
            }else{
                $("#aba-evento").addClass("mostrar");
                $(".class-evento").addClass("invisible");
            }
    
        });

        $("#aba-tarefa span").click(function(){
                
            if ( $("#aba-tarefa").hasClass( "mostrar" ) ) {
                $("#aba-tarefa").removeClass("mostrar");
                $(".class-tarefa").removeClass("invisible");
                
            }else{
                $("#aba-tarefa").addClass("mostrar");
                $(".class-tarefa").addClass("invisible");
            }
    
        });

        $("#aba-gatilho span").click(function(){
                
            if ( $("#aba-gatilho").hasClass( "mostrar" ) ) {
                $("#aba-gatilho").removeClass("mostrar");
                $(".class-gatilho").removeClass("invisible");
                    
            }else{
                $("#aba-gatilho").addClass("mostrar");
                $(".class-gatilho").addClass("invisible");
            }
        
        });

    </script>
@endsection