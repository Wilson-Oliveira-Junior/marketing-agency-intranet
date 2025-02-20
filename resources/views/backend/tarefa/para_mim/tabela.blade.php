<div class="card card-profile shadow" style="border: none;">
        
        <div class="card-header bg-white border-0" style="padding: 0px;">
            <div class="row align-items-center">
                <div class="col-12">
                
                    <ul class="nav-tarefa">
                        <li>
                            <a class="active" href="#">
                                Para Mim
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('backend.tarefa.criadas') }}">
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
                    <a href="#" class="active">
                        Abertas
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.tarefa.entregue') }}">
                        Entregues
                    </a>
                </li>
            </ul>

        </div>
		@if(! empty($arrStatus))
		<div class="tabs-filtro">
            <span>Filtro:</span>
            <ul>
                @foreach ($arrStatus as $status => $idstatus)
                    <li>
                        <a href="{{ route('backend.tarefa.filtro', $idstatus) }}" class="{{ $idstatus == $filtro ? 'active':'' }}">
                            {{$status}}
                        </a>
                    </li>
                @endforeach
                @if (!is_null($filtro))
                    <li>
                        <a href="{{ route('backend.tarefa') }}" class="limpar">
                            Limpar
                        </a>
                    </li>
                @endif
            </ul>

        </div>
		@endif

        <div class="table-responsive" style="padding: 0px 15px;">
            <?php $contador = 1; ?>
            @foreach($tarefas as $registro)
                @if($contador == 1)
                    <div class="linha-tarefa">
                        <div class="counts">
                            <div class="contador">
                                <?php echo $contador; ?>
                            </div>
                        </div>

                        <div class="acessorios">
                            <div class="linha-superior">
                                <a href="{{ route('backend.tarefa.editar',$registro->id_tarefa) }}" class="btn btn-tarefa">
                                    <div class="title-principal">
                                        {{ $registro->id_tarefa }}
                                        -
                                        {{ $registro->titulo }}
                                    </div>
                                </a>
                                <div class="title-segundario">
                                    {{ $registro->nome_cliente }} > {{ $registro->nome_tipo }}
                                </div>
                                <div class="botao-acoes">
                                    <a href="{{ route('backend.tarefa.concluir',$registro->id_tarefa) }}" class="btn entregar">Entregar</a>
                                    
                                    @if($registro->tempo_trabalhado == '00:00' || $registro->tempo_trabalhado == '00:00:00' )
                                        <button class="btn play play-comecar" disabled>
                                            Começar
                                        </button>
                                    @else
                                        <button class="btn play play-comecar-teste" disabled>
                                            <i class="ni ni-button-play"></i> 
                                            
                                            <!-- Formantando a hora, minutos e segundos da Tarefa -->
                                                <?php
                                                    $total = $registro->tempo_trabalhado;
                                                    $horas = floor($total / 3600);
                                                    $minutos = floor(($total - ($horas * 3600)) / 60);
                                                    $segundos = floor($total % 60);
                                                    echo $horas . ":" . $minutos . "<span class='segundos'>:" . $segundos . "</span>";
                                                ?>

                                        </button>
                                    @endif

                                </div>
                            </div>
                            <div class="etapa">
                                <span>Etapa</span>
                                <br/>
                                {{ $registro->nome_status }}
                            </div>
                            <div class="data-desejada">
                                <span>Data Desejada</span>
                                <br/>
                                @if($registro->data_desejada == null || $registro->data_desejada == '0000-00-00 00:00:00')

                                @else
                                    {{ date( 'd/m/Y' , strtotime($registro->data_desejada)) }}
                                @endif
                            </div>
                            <div class="esforco-estimado">
                                <span>Esforço estimado</span>
                                <br/>
                                {{ $registro->estimativa_tipo }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="linha-tarefa-bottom">
                        <div class="counts">
                            @if($registro->id_status_tarefa == 520118)
                                <div class="contador" style="background-color: #d6d6d6;border: 1px dashed #ff234d;padding-left: 7px !important;line-height: 22px;">
                                    <?php echo $contador; ?>
                                </div>
                            @else
                                <div class="contador" style="background-color: #d6d6d6;">
                                    <?php echo $contador; ?>
                                </div>
                            @endif
                        </div>

                        <div class="acessorios">
                            <div class="title-principal">
                                <a href="{{ route('backend.tarefa.editar',$registro->id_tarefa) }}" class="btn btn-tarefa" style="font-size: 15px;color: #545d7f;font-weight: bold;white-space: inherit;width: 95%;float: left;">
                                    {{ $registro->id_tarefa }}
                                    -
                                    {{ $registro->titulo }}
                                </a>
                            </div>
                            <div class="title-segundario">
                                {{ $registro->nome_cliente }} > {{ $registro->nome_tipo }}
                            </div>
                            <div class="etapa">
                                @if($registro->id_status_tarefa == 520118)
                                    <i class="fas fa-user-clock"></i>
                                    <span>Etapa</span>
                                    <br/>
                                    {{ $registro->nome_status }}
                                @elseif($registro->id_status_tarefa == 150040 || $registro->id_status_tarefa == 792967)
                                    <i class="ni ni-user-run"></i>
                                    <span>Etapa</span>
                                    <br/>
                                    {{ $registro->nome_status }}
                                @else
                                    <span>Etapa</span>
                                    <br/>
                                    {{ $registro->nome_status }}
                                @endif
                            </div>
                            <div class="data-desejada">
                                <span>Data Desejada</span>
                                <br/>
                                @if($registro->data_desejada == null || $registro->data_desejada == '0000-00-00 00:00:00')

                                @else
                                    {{ date( 'd/m/Y' , strtotime($registro->data_desejada)) }}
                                @endif
                            </div>
                            <div class="esforco-estimado">
                                <span>Esforço estimado</span>
                                <br/>
                                {{ $registro->estimativa_tipo }}
                            </div>
                            
                            <!--
                            <div class="botao-acoes">
                                <button class="btn play">
                                     Formantando a hora, minutos e segundos da Tarefa 
                                    <?php
                                        $total = $registro->tempo_trabalhado;
                                        $horas = floor($total / 3600);
                                        $minutos = floor(($total - ($horas * 3600)) / 60);
                                        $segundos = floor($total % 60);
                                        echo $horas . ":" . $minutos . "<span class='segundos' style='position: inherit;'>:" . $segundos . "</span>";
                                    ?>
                                </button>
                            </div>
                            -->

                        </div>
                    </div>
                @endif
                <?php $contador++; ?>
            @endforeach
       
        </div>
        
        <div class="card-footer py-4">
                
            {!! $tarefas->links() !!}

        </div>
    </div>