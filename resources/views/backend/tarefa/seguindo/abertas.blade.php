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
                            <a href="{{ route('backend.tarefa.criadas') }}">
                                Que criei
                            </a>
                        </li>
                        <li>
                            <a href="#" class="active">
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
                    <a href="{{ route('backend.tarefa.seguindo.entregue') }}">
                        Entregues
                    </a>
                </li>
            </ul>

        </div>

            <?php $contador = 1; ?>
            @if($tarefas_contagens == 0)
                <div class="tarefas-404">
                    <div class="texto">
                        <h2>Oops !</h2>
                        <p>Parece que não tem nenhuma tarefa aqui para mostrar.</p>
                        <p>Volte para suas tarefas.</p>
                        <a href="{{ route('backend.tarefa') }}">Clique Aqui</a>
                    </div>
                    <div class="imagem">
                        <img src="http://intranet.logicadigital.com.br/img/homer.png" style="width: 250px;">
                    </div>
                </div>
            @else
                <div class="table-responsive" style="padding: 0px 15px;">
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
                                        <a href="{{ route('backend.tarefa.editar',$registro->id_tarefas) }}" class="btn btn-tarefa">
                                            <div class="title-principal">
                                                {{ $registro->id_tarefas }}
                                                -
                                                {{ $registro->titulo }}
                                            </div>
                                        </a>
                                        <div class="title-segundario">
                                            {{ $registro->nome_cliente }} > {{ $registro->nome_tipo }}
                                        </div>
                                        <div class="botao-acoes">
                                            @if($registro->id_responsavel == Auth::user()->id)
                                                <a href="{{ route('backend.tarefa.concluir',$registro->id_tarefas) }}" class="btn entregar">Entregar</a>
                                                <button class="btn play">Começar</button>
                                            @else
                                                <button class="btn entregar" disabled>Entregar</button>
                                                <button class="btn play" disabled>Começar</button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="etapa">
                                        <span>Etapa</span>
                                        <br/>
                                        Sem etapa
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
                                    <div class="contador" style="background-color: #d6d6d6;">
                                        <?php echo $contador; ?>
                                    </div>
                                </div>

                                <div class="acessorios">
                                    <div class="title-principal">
                                        <a href="{{ route('backend.tarefa.editar',$registro->id_tarefas) }}" class="btn btn-tarefa" style="font-size: 15px;color: #545d7f;font-weight: bold;">
                                            {{ $registro->id_tarefas }}
                                            -
                                            {{ $registro->titulo }}
                                        </a>
                                    </div>
                                    <div class="title-segundario">
                                        {{ $registro->nome_cliente }} > {{ $registro->nome_tipo }}
                                    </div>
                                    <div class="etapa">
                                        <span>Etapa</span>
                                        <br/>
                                        Sem etapa
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
                        @endif
                        <?php $contador++; ?>
                    @endforeach
                </div>

                <div class="card-footer py-4">
                
                    {!! $tarefas->links() !!}
    
                </div>
            @endif
    </div>