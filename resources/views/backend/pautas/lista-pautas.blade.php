<div class="card">
    <div class="card-header border-0">
        <h3 class="mb-0" style="width: 75%;float: left;">Minhas Pautas ({{ $vPautas->count() }})</span></h3>

        <button class="collapse-table-pautas">
            <i class="ni ni-fat-delete" style="float: left;margin-right: 5px;margin-top: 4px;color:#32315e"></i>
        </button>
    </div>
    <div class="card-body p-0 collapse-hidden-pautas">
        <ul class="list-group list-group-flush" data-toggle="checklist" style="height: 300px;overflow: scroll;border: 2px solid #FFF;border-top: 0px;">
            @forelse($vPautas as $registro)

                <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4" id="ckPauta-{{ $registro->id }}">
                    <div class="checklist-item checklist-item-info checklist-urgencia-{{ $registro->idUrgencia }}">

                        <div class="checklist-info checklist-info-{{ $registro->id }}">
                            <h4 class="checklist-title mb-0">{{$registro->projeto->cliente->nome_fantasia}} - {{$registro->projeto->projeto}} - {{ $registro->titulo }}</h4>
                            @isset($registro->data_desejada)
                                <small>Data Desejada: <strong style="font-weight:bold;">{{ date( 'd/m/Y' , strtotime($registro->data_desejada)) }}</strong></small>
                                <i class="fas fa-circle btn-tooltip checklist-urgencia-{{ $registro->idUrgencia }}" data-toggle="tooltip" data-placement="top" title="@if ($registro->idUrgencia == 1)
                                    Tem que ser feito imediatamente!
                                    @elseif ($registro->idUrgencia ==2)
                                    Tem que ser feito no mesmo dia!
                                    @elseif ($registro->idUrgencia ==3)
                                    Tem que ser feito até a data estipulada
                                    @else
                                    Encaixar no cronograma
                                @endif" data-container="body" data-animation="true"></i>
                            @endisset

                            <div class="d-flex justify-content-end">

                                <div class="adiamento-linha mr-2">
                                    <button type="button" class="btn-pauta" data-id="{{$registro->id}}">
                                        <i class="fa fa-comment"></i>
                                    </button>
                                </div>
                                <div class="adiamento-linha">
                                    <button type="button" class="chk-pauta" id="chk-todo-task-{{ $registro->id }}" data-id="{{$registro->id}}">
                                        <i class="fa fa-check"></i>
                                        </button>
                                </div>



                            </div>

                        </div>





                        <img src="{{ asset('img/loading-gatilho.gif') }}" class="imagem-carregamento-{{ $registro->id }} invisible" style="width: 100px;position: absolute;">

                    </div>

                </li>
            @empty
            <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                Sem registros.
            </li>
            @endforelse
        </ul>
    </div>
</div>
@include('backend.pautas.mdl-observacao')
