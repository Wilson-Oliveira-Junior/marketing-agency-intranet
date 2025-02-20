<div class="card card-profile shadow" style="border: none;">
        
        <div class="card-header bg-white border-0" style="padding: 0px;">
            <div class="row align-items-center">
                <div class="col-12">
                
                    <ul class="nav-tarefa">
                        <li>
                            <a href="{{ route('backend.tarefa') }}">
                                Para Mim
                            </a>
                        </li>
                        <li>
                            <a class="active" href="#">
                                Que criei
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('backend.tarefa.seguindo') }}">
                                Que eu sigo
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('backend.tarefa.backlog', Auth::user()->setor) }}">
                                Backlog
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="tabs-sub">
            <ul>
                <li>
                    <a href="{{ route('backend.tarefa.criadas') }}">
                        Abertas
                    </a>
                </li>
                <li>
                    <a href="#" class="active">
                        Entregues
                    </a>
                </li>
            </ul>

        </div>

        <div class="table-responsive" style="padding: 0px 15px;">
            <?php $contador = 1; ?>
            @foreach($tarefas as $registro)
                <div class="linha-tarefa-bottom" style="border-top: 1px solid #CCC;margin-top: 10px;">
                    <div class="acessorios" style="width: 100%;padding: 15px;">
                        <div class="title-principal">
                            <a href="{{ route('backend.tarefa.editar',$registro->id_tarefa) }}" class="btn btn-tarefa" style="font-size: 15px;color: #545d7f;font-weight: bold;">
                                {{ $registro->id_tarefa }}
                                -
                                {{ $registro->titulo }}
                            </a>
                        </div>
                
                        <div class="title-segundario">
                            {{ $registro->nome_cliente }} > {{ $registro->nome_tipo }}
                        </div>
                            
                        <div class="data-desejada">
                            <span>Data Desejada</span>
                            <br/>
                            @if($registro->data_desejada == null || $registro->data_desejada == '0000-00-00 00:00:00')

                            @else
                                {{ date( 'd/m/Y' , strtotime($registro->data_desejada)) }}
                            @endif
                        </div>

                        <div class="data-desejada">
                            <span>Data de Entrega</span>
                            <br/>
                            @if($registro->dataentregue == null)

                            @else
                                {{ date( 'd/m/Y' , strtotime($registro->dataentregue)) }}
                            @endif
                        </div>
                            
                        <div class="esforco-estimado" style="width:15%;">
                                <span>Esforço Total</span>
                                <br/>
                                <?php
                                    $total = $registro->totaltrabalhado;
                                    $horas = floor($total / 3600);
                                    $minutos = floor(($total - ($horas * 3600)) / 60);
                                    $segundos = floor($total % 60);
                                    echo $horas . ":" . $minutos . "";
                                ?>
                        </div>
                    
                        <div class="botao-acoes">
                            <a href="{{ route('backend.tarefa.reabrir',$registro->id_tarefa) }}" class="btn reabrir">
                                Reabrir
                            </a>
                        </div>
                
                        </div>
                    </div>
                <?php $contador++; ?>
            @endforeach
       
        </div>
        
        <div class="card-footer py-4">
                
            {!! $tarefas->links() !!}

        </div>
    </div>