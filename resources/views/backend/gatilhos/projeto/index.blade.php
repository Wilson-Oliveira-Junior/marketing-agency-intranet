@extends('layouts.app-backend')

@section('style')
    <link href="{{ asset('css/css-automizado.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tarefa.css') }}" rel="stylesheet">
	  <link href="{{ asset('chart/Chart.css') }}" rel="stylesheet">
	  <script src="{{ asset('chart/Chart.min.js') }}"></script>
    <script src="{{ asset('chart/utils.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <style>
      canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
		  }
      .botao-voltar{
        position: fixed;
        color: #FFF;
        background-color: #5c6ce8;
        padding-left: 30px !important;
        padding: 10px 13px;
        border-radius: 50px;
        text-align: center;
        font-size: 14px;
        font-weight: 900;
        z-index: 1000;
        letter-spacing: 0px;
        bottom: 70px;
      }
      .botao-voltar i{
        position: absolute;
        left: 10px;
        top: 14px;
      }
      .chartjs-render-monitor {
        animation: chartjs-render-animation 1ms;
      }
      .list-group-item{
        background-color: #ecf0f1 !important;
        border-bottom: 3px solid #FFF !important;
      }
      .botoom-footer .card{

      }
      .botoom-footer .card-body{
        height: 380px;
        min-height: 600px;
        overflow: auto;
      }
      .botoom-footer h5 i{
        background: linear-gradient(87deg,#f5365c 0,#f56036 100%)!important;
        color: #FFF;
        padding: 10px;
        border-radius: 20px 20px 3px 20px;
        margin-left: -5px;
        margin-right: 10px;
        margin-top: -10px;
      }
      .botoom-footer h6{
        font-weight: bold;
        font-size: 8px;
      }
      .botoom-footer h6 span{
        float: right;
      }
      .media-comment-text{
        border: 1px solid #5c6ce829;
        background-color: #FFF;
      }
      .media-comentario-sistema{
        position: relative;
        padding: 10px;
        border-radius: 5px;
        background-color: #FFF;
      }
      .div-contato{
        /*background: linear-gradient(87deg,#5c6ce8 0,#8158e7 100%)!important;*/
        float: left;
        /*box-shadow: 0px 3px 13px -1px rgb(236, 240, 241);*/
        width: 100%;
        background-color: #FFF;
        border: 1px solid #5c6ce82e;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
        overflow: auto;
      }
      .div-contato .my-4{
        padding: 0px !important;
        margin: 0px !important;
        padding-bottom: 5px !important;
      }
      .div-contato .my-4 span{
        font-size: 8px;
        font-weight: bold;
        color: #444;
        position: relative;
        padding-left: 20px;
      }
      .div-contato .my-4 span i{
        font-size: 10px;
        background-color: #6e5ceb;
        color: #FFF;
        padding: 3px;
        left: 0px;
        border-radius: 30px 30px 0px 30px;
        position: absolute;
      }
      .div-contato .my-4 .conteudo-texto{
        margin-top: -2px;
        color:#444;
        font-size: 15px;
      }
      .customizacao .card-body{
        background: linear-gradient(87deg,#f5365c 0,#f56036 100%)!important;
      }
      .adiamento-linha{
        position: absolute;
        right: 40px;
        color: #FFF;
        background: #5c6ce8;
        padding: 1px 6px;
        border-radius: 5px;
        font-size: 14px;
      }
      .adiamento-linha button{
        background: none;
        border: none;
        color: #FFF;
        padding: 0px;
      }
      .form-adiamento label, .form-adiamento span{
        color: #444;
        font-size: 12px;
      }
      .collapse-table-contato-cliente,
      .collapse-table-comentario-projeto,
      .collapse-table-adiamentos{
        background-color: transparent;
        border: none;
        color: #16294e;
        font-size: 20px;
        float: right;
        cursor: pointer;
        width: 25px;
        padding: 0px;
        position: absolute;
        right: 15px;
        top: 20px;
      }
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Gatilhos do Projeto
    </a>
@endsection

@section('content')

    <div class="col-lg-4">

        <!-- Gatilhos Feitos -->
          <div class="card bg-gradient-default" style="margin-bottom: 10px;">
            <div class="card-body">

              <div class="row">

                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                    Gatilhos Feitos
                  </h5>
                  <span class="h3 font-weight-bold mb-0 text-white">
                    {{ $numero_gatilho_entregue }}
                  </span>
                </div>

                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                    <i class="ni ni-active-40"></i>
                  </div>
                </div>

              </div>

              <p class="mt-3 mb-0 text-sm">
                <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> Dados do gatilho</span>
              </p>

            </div>
          </div>
        <!-- Fim Gatilhos -->

        <!-- Gatilhos Criados -->
          <div class="card bg-gradient-success" style="margin-bottom: 10px;">
            <div class="card-body">
              <div class="row">

                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                    Gatilhos Criados
                  </h5>
                  <span class="h3 font-weight-bold mb-0 text-white">
                    {{ $numero_gatilho_aberto }}
                  </span>
                </div>

                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                    <i class="ni ni-atom"></i>
                  </div>
                </div>

              </div>

              <p class="mt-3 mb-0 text-sm">
                <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> Dados do gatilho</span>
              </p>

            </div>

          </div>
        <!-- Fim Gatilhos -->

        <!-- Dias Passados / Total -->
          <div class="card bg-gradient-primary" style="margin-bottom: 10px;background: linear-gradient(87deg,#11cdef 0,#1171ef 100%)!important;border: none;">
            <div class="card-body">
              <div class="row">

                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                    Dias Passados / Total
                  </h5>
                  <span class="h3 font-weight-bold mb-0 text-white">
                    {{ $diasPassados }} / {{ $prazo }}
                  </span>
                </div>

                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                    <i class="ni ni-planet"></i>
                  </div>
                </div>

              </div>

              <p class="mt-3 mb-0 text-sm">
                <span class="text-white mr-2">
                  <i class="fa fa-arrow-up"></i> Dados do gatilho</span>
              </p>

            </div>

          </div>
        <!-- Fim Dias Passados / Total -->

        <!-- Criado em: -->
          <div class="card bg-gradient-danger" style="margin-bottom: 10px;">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                      Criado em:
                    </h5>
                    <span class="h3 font-weight-bold mb-0 text-white">
                      {{ date( 'd/m/Y' , strtotime($data_gatilho_criado)) }}
                    </span>
                  </div>

                  <div class="col-auto">
                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                      <i class="ni ni-spaceship"></i>
                    </div>
                  </div>

                </div>

                <p class="mt-3 mb-0 text-sm">
                  <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> Dados do gatilho</span>
                </p>

              </div>
          </div>
        <!-- Fim Criado em: -->

        <!-- Criado em: -->
        <div class="card bg-gradient-warning" style="margin-bottom: 10px;">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0 text-white">
                    Previsão de Finalizar:
                  </h5>
                  <span class="h3 font-weight-bold mb-0 text-white">
                    {{ date( 'd/m/Y' , strtotime($data_fim_projeto)) }}
                  </span>
                </div>

                <div class="col-auto">
                  <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                    <i class="ni ni-glasses-2"></i>
                  </div>
                </div>

              </div>

              <p class="mt-3 mb-0 text-sm">
                <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> Dados do gatilho</span>
              </p>

            </div>
        </div>
      <!-- Fim Criado em: -->

    </div>

    <div class="col-lg-8">
        <div class="card">

            <!-- Header dos Gatilhos -->
              <div class="card-header">
                  @foreach($projeto as $registro)
                      <h5 class="h3 mb-0">Gatilhos para o cliente "{{ $registro->nome_fantasia }} - {{ $registro->projeto }}"</h5>
                  @endforeach
              </div>
            <!-- Fim -->

            <div class="card-body p-0">

            <div id="usuario-sistema" style="display:none">{{ Auth::user()->id }}</div>

              <ul class="list-group list-group-flush" data-toggle="checklist" style="height: 660px;overflow: scroll;border: 2px solid #FFF;border-top: 0px;">
                @foreach($gatilhos as $registro)

                  @if($registro->status == 'Aberto')
                    <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                      <div class="checklist-item checklist-item-info checklist-item-{{ $registro->id }}">

                        <div class="checklist-info checklist-info-{{ $registro->id }}">
                          <h4 class="checklist-title mb-0">{{ $registro->gatilho }}</h4>
                          <small>Data Limite: <strong style="font-weight:bold;">{{ date( 'd/m/Y' , strtotime($registro->data_limite)) }}</strong> - @if($registro->bkp_data_origem) Antes era: {{ date('d/m/Y', strtotime($registro->bkp_data_origem)) }} @endif</small>

                        </div>

                        <div class="adiamento-linha">
                          <button type="button" data-toggle="modal" data-target="#modal-default{{ $registro->id }}">
                            <i class="fas fa-history"></i>
                          </button>
                        </div>

                        <div>
                          <div class="custom-control custom-control-{{ $registro->id }} custom-checkbox custom-checkbox-info">
                            <input class="custom-control-input" id="chk-todo-task-{{ $registro->id }}" type="checkbox">
                            <label class="custom-control-label" for="chk-todo-task-{{ $registro->id }}"></label>
                          </div>
                        </div>

                        <img src="{{ asset('img/loading-gatilho.gif') }}" class="imagem-carregamento-{{ $registro->id }} invisible" style="width: 100px;position: absolute;">

                      </div>
                    </li>

                    <!-- MODAL PARA ADIAMENTO -->
                      @include('backend.gatilhos.projeto.adiamento_form')
                    <!-- MODAL PARA ADIAMENTO -->
                  @else

                      <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                        <div class="checklist-item checklist-item checklist-item-{{ $registro->id }} checklist-item-checked">

                          <div class="checklist-info checklist-info-{{ $registro->id }}">
                            <h4 class="checklist-title mb-0">{{ $registro->gatilho }}</h4>
                            <small>Data Limite: <strong style="font-weight:bold;">{{ date( 'd/m/Y' , strtotime($registro->data_limite)) }}</strong></small>
                            <small class="data-conclusao">Data Conclusão: <strong style="font-weight:bold;">@if($registro->data_conclusao == null)  @else {{ date( 'd/m/Y' , strtotime($registro->data_conclusao)) }} @endif</strong></small>
                            <small class="quem-finalizou-conclusao">Quem Finalizou: <strong style="font-weight:bold;">{{ $registro->name }} {{ $registro->sobrenome }}</strong></small>
                          </div>

                          @can('abrir_gatilho')
                            <div>
                              <div class="custom-control custom-checkbox custom-checkbox-success">
                                <input class="custom-control-input" id="chk-todo-task-retirar-{{ $registro->id }}" type="checkbox" checked="">
                                <label class="custom-control-label" for="chk-todo-task-retirar-{{ $registro->id }}"></label>
                              </div>
                            </div>
                          @endcan
                        </div>
                      </li>

                  @endif
                @endforeach
              </ul>

            </div>

        </div>
    </div>

    <!-- Contato -->
    <div class="col-lg-4 botoom-footer">
      @include('backend.gatilhos.projeto.contato_cliente')
    </div>

    <!-- Adiantamento -->
    <div class="col-lg-3 botoom-footer">
      @include('backend.gatilhos.projeto.adiamentos')
    </div>

    <!-- Comentário -->
    <div class="col-lg-5 botoom-footer customizacao">
      @include('backend.gatilhos.projeto.comentarios')
    </div>

    <!-- Gráfico -->
    <div class="col-lg-12">
      @include('backend.gatilhos.projeto.grafico')
    </div>

    <!-- Botão Voltar -->
    <a href="{{ route('backend.gatilhos.tipoprojeto.aberto', $id_tipo_projeto->id) }}" class="botao-voltar">
      <i class="ni ni-bold-left"></i>
      VOLTAR
    </a>

@endsection

@section('script')

  @foreach($gatilhos as $registro)
    <script>
        $("#chk-todo-task-{{ $registro->id }}").click(function(){
          var id_usuario      = $('#usuario-sistema').text();
          $.ajax({
              type: "GET",
              url: '/backend/gatilhos/{{ $registro->id }}/statusFinalizado/usuario/' + id_usuario,
              beforeSend: function () {
                // Colocando pra aparecer a imagem de carregamento
                $(".checklist-info-{{ $registro->id }}").addClass("invisible");
                $(".custom-control-{{ $registro->id }}").addClass("invisible");
                $(".imagem-carregamento-{{ $registro->id }}").removeClass("invisible");
              },
              success: function(){
                $(".imagem-carregamento-{{ $registro->id }}").addClass("invisible");
                $(".checklist-info").removeClass("invisible");
                $(".custom-control-{{ $registro->id }}").removeClass("invisible");
                $(".checklist-item-{{ $registro->id }}").addClass("checklist-item-checked");
              }
          });
        });
    </script>

    <script>
      $("#chk-todo-task-retirar-{{ $registro->id }}").click(function(){
        var id_usuario      = $('#usuario-sistema').text();
        $.ajax({
          type: "GET",
          url: 'http://intranet.logicadigital.com.br/backend/gatilhos/{{ $registro->id }}/statusAberto/usuario/' + id_usuario,
          success: function(){
            $(".checklist-item-{{ $registro->id }}").removeClass("checklist-item-checked");
            $('.checklist-item-{{ $registro->id }} .data-conclusao').fadeOut();
            $('.checklist-item-{{ $registro->id }} .quem-finalizou-conclusao').fadeOut();
          }
        });
      });
    </script>
  @endforeach

@endsection
