@php
$i = 1;
$j = 1;
@endphp
@foreach ($cronograma['cronograma'] as $data => $tarefas)

@if(date('D', strtotime($data)) == 'Mon' || $data == '2023-05-02' || $data == '2023-11-21' || $data == '2023-12-01')

<div class="row align-items-center">
    <div class="col-12">
        <div class="exibicao">
            <button class="collapse-semana" data-id="{{ $cronograma['id'] }}" data-semana="{{ $j }}">
                <h3>Semana {{$j}}</h3>
                <i class="ni @if($tarefas['collapse'])ni-fat-delete @else ni-fat-add @endif ni-{{ $j }}-{{ $cronograma['id'] }}" style="float: left;margin-right: 5px;margin-top: 4px;color:#32315e"></i>
            </button>
        </div>
    </div>
</div>
@if($i != 1)
    <div class="cronograma @if($tarefas['collapse'])collapse-exibe @else collapse-oculta @endif semana-{{ $j }}-{{ $cronograma['id'] }}">
@endif
@endif

@if($i == 1)
<div class="cronograma @if($tarefas['collapse'])collapse-exibe @else collapse-oculta @endif semana-{{ $j }}-{{ $cronograma['id'] }}">
@endif
<div class="segunda">

    <div class="title fundo-{{ retornarDiaDaSemanaCompleto(date( 'N' , strtotime($data))) }}">
        <span class="dia">{{ retornarDiaDaSemana(date( 'N' , strtotime($data))) }}</span>
        <span class="data">
            {{ date( 'd/m' , strtotime($data)) }}
        </span>
    </div>

    <!-- Local onde adiciono o conteúdo -->
    <div id="conteudo-{{ retornarDiaDaSemanaCompleto(date( 'N' , strtotime($data))) }}-{{ $data }}-{{ $cronograma['id'] }}" class="box-tarefas">
        @foreach($tarefas['tarefas'] as $registro)
            <div class="info-tarefas tarefa-{{$registro->id_cronograma}}-{{$registro->id}}">

                @can('editar_cronograma')
                    <button data-id="{{$registro->id_cronograma}}" data-idtarefa="{{$registro->id}}" class="remover-tarefa">
                        <i class="ni ni-fat-remove"></i>
                    </button>
                @endcan

                <a href="{{ route('backend.tarefa.editar',$registro->id) }}">
                    <h3 style="font-size: 15px;">{{ $registro->titulo }}</h3>
                </a>

                <button data-id="{{$registro->id}}" class="finalizar-tarefa">
                    <i class="ni ni-check-bold {{ ($registro->status == 'Entregue')?'finalizado':'' }}"></i>
                </button>

                <div class="tipo{{date( 'N' , strtotime($data))}}">{{ $registro->id }} - Status: <span id="status-{{ $registro->id }}">{{ $registro->status }}</span></div>

            </div>
        @endforeach
        @foreach ($tarefas['pautas'] as $pauta)
            <div class="info-tarefas">
                <div class="urgencia{{ $pauta->idUrgencia}}">{{ $pauta->titulo }}</div>
            </div>

        @endforeach
    </div>

    @can('editar_cronograma')
        <a id="cronograma_{{ retornarDiaDaSemanaCompleto(date( 'N' , strtotime($data))) }}_{{ $data }}_{{ $cronograma['id'] }}" data-id="{{ $cronograma['id'] }}" class="adicionar-tarefa" href="javascript:void(0)">+</a>

        <div id="adicionar_tarefa_{{ retornarDiaDaSemanaCompleto(date( 'N' , strtotime($data))) }}-{{$data}}-{{ $cronograma['id'] }}" class="select212-container required-input cronograma-principal" style="left: -40px;">

            <!-- Busca Tarefa para Cronograma -->
            <div class="search-cronograma-tarefa-{{ retornarDiaDaSemanaCompleto(date( 'N' , strtotime($data))) }}-{{$data}}-{{ $cronograma['id'] }} busca-principal">
                <input id="txtBuscaCronograma_{{ retornarDiaDaSemanaCompleto(date( 'N' , strtotime($data))) }}_{{$data}}_{{ $cronograma['id'] }}" type="text" class="form-control search-cronograma-{{ retornarDiaDaSemanaCompleto(date( 'N' , strtotime($data))) }}-{{$data}}-{{ $cronograma['id'] }} encontrar-palavra" placeholder="Digite para procurar" autofocus>
                <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
            </div>

            <!-- Conteudo que vai ser inserido pelo Jquery -->
            <ul id="cronograma-tarefa-{{ retornarDiaDaSemanaCompleto(date( 'N' , strtotime($data))) }}-{{ $data }}-{{ $cronograma['id'] }}" class="conteudo-cronograma-{{ retornarDiaDaSemanaCompleto(date( 'N' , strtotime($data))) }}-{{$data}}-{{ $cronograma['id'] }} ul-cronograma-conteudo">
            </ul>

        </div>
    @endcan

</div>
    @if(date('D', strtotime($data)) == 'Fri' || $data == '2024-11-14' || $data == '2023-04-06' || $data == '2023-04-20' || $data == '2023-12-07')
    </div>
        @php
            $j++;
        @endphp
    @endif
@php
    $i++;
@endphp
@endforeach
</div>
