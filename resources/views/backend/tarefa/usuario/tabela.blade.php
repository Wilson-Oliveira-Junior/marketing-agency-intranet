<div class="card card-profile shadow" style="border: none;">
        
        <div class="card-header bg-white border-0" style="padding: 0px;">
            <div class="row align-items-center">
                <div class="col-12">
                    
                    <div class="exibicao">
                        @if($usuario->image == NULL)
                            <img src="{{ asset('img/user.png') }}">
                        @else
                            <img src="http://intranet.logicadigital.com.br/{{ $usuario->image }}">
                        @endif
                        <h3>{{ $usuario->name }} {{ $usuario->sobrenome }}</h3>
                    </div>

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
                    <a href="{{ route('backend.usuario.tarefa.entregue', $usuario->id) }}">
                        Entregues
                    </a>
                </li>
            </ul>

            <a href="{{ route('backend.usuario.perfil', $usuario->id) }}" class="btn btn-info perfil">
                Perfil Completo
            </a>

            <a href="{{ route('backend.tarefa.backlog', Auth::user()->setor) }}" class="btn nova-tarefa">
                Voltar Backlog
            </a>

        </div>

        <div class="table-responsive" style="padding: 0px 15px;">
            <?php $contador = 1; ?>
            @foreach($tarefas as $registro)
                <div class="linha-tarefa-bottom" style="border-top: 1px solid #ccc;">
                    <div class="counts">
                        <div class="contador" style="background-color: #d6d6d6;">
                            <?php echo $contador; ?>
                        </div>                        
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
            <?php $contador++; ?>
            @endforeach
       
        </div>
        
        <div class="card-footer py-4">
                
            {!! $tarefas->links() !!}

        </div>
    </div>