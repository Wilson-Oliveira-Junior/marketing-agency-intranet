<div class="card card-profile shadow" style="border: none;">
    <div class="table-responsive" style="padding: 0px 15px;">
        @if(Session::has('aviso_mensagem'))
            <div class="container-flash" style="display: flex;align-items: center;justify-content: center;">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: absolute;z-index: 10000;top: 0px;width: 55%;{{ Session::get('aviso_mensagem')['class'] }}">
                    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-inner--text"><strong>{{ Session::get('aviso_mensagem')['msg'] }}</strong></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        @endif
            @foreach($tarefas as $registro)

                <div id="id-usuario-real-time" style="display:none;">{{ Auth::user()->id }}</div>

                <!-- Modal Tarefa -->
                    <div class="modal fade modal-tarefa show" id="example{{ $registro->id_tarefa }}" tabindex="-1" role="dialog" aria-labelledby="example{{ $registro->id_tarefa }}Label" aria-hidden="true" style="display: block;background-color: #0000008a;overflow: scroll;">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1100px;">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <div class="header-superior">
                                        @if($registro->data_fim == NULL)

                                            @include('backend.tarefa.editar.acoes.titulotarefa')

                                        @else
                                            <h5 class="modal-title-sem-hover" id="exampleModalLabel">
                                                {{ $registro->titulo }}
                                            </h5>
                                        @endif

                                        <h5 class="modal-sub-title" id="exampleModalLabel">#{{ $registro->id_tarefa }} - Criado por: {{ $registro->nome_criador }} {{ $registro->sobrenome_criador }} em {{ date( 'd/m/Y H:i' , strtotime($registro->created_at)) }}</h5>

                                        @if(URL::previous() == URL::current())

	                                        <a href="{{ route('backend.tarefa') }}" class="close">
	                                            <span aria-hidden="true">&times;</span>
	                                        </a>
										@else
	                                        <a href="{{ URL::previous() }}" class="close">
	                                            <span aria-hidden="true">&times;</span>
	                                        </a>
										@endif
                                    </div>

                                    <div class="header-inferior">
                                        <div class="alocado">
                                            @include('backend.tarefa.editar.alocados')
                                        </div>
                                        <div class="acoes">
                                            @if($registro->data_fim == NULL)

                                                <a href="{{ route('backend.tarefa.concluir',$registro->id_tarefa) }}" class="btn entregar">Entregar</a>


                                                <div id="id-tarefa-real-time" style="display:none;">{{ $registro->id_tarefa }}</div>

                                                @if($registro->tempo_trabalhado == '00:00' || $registro->tempo_trabalhado == '00:00:00' || $registro->tempo_trabalhado == '0' )
                                                    <button class="btn play play-comecar" onclick="inicia();">Começar</button>

                                                    <div class="pause-div" style="float: right;margin-right: 1%;">
                                                        <button class="btn pause" onclick="para();">
                                                            <i class="ni ni-button-pause"></i>
                                                            <span id="counter">00:00:00</span>
                                                            <span id="counter-segundos" style="display: none !important;">0</span>
                                                        </button>

                                                        <button class="btn play play-comecar-teste" onclick="iniciarDnv();">
                                                            <?php
                                                                $total = $registro->tempo_trabalhado;
                                                                $horas = floor($total / 3600);
                                                                $minutos = floor(($total - ($horas * 3600)) / 60);
                                                                $segundos = floor($total % 60);
                                                                echo $horas . ":" . $minutos . "<span class='segundos'>:" . $segundos . "</span>";
                                                            ?>
                                                        </button>
                                                    </div>
                                                @else

                                                    <button class="btn play play-comecar-teste" onclick="iniciarDnv2();">
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

                                                    <button class="btn pause" onclick="paraDnv();">
                                                        <i class="ni ni-button-pause"></i>
                                                        <div id="id-tarefa-real-time" style="display:none;">{{ $registro->id_tarefa }}</div>
                                                        <div id="id-usuario-real-time" style="display:none;">{{ Auth::user()->id }}</div>
                                                        <span id="counter">00:00:00</span>
                                                    </button>

                                                    <span id="counter-segundos-denovo" style="display: none !important;">{{ $registro->tempo_trabalhado }}</span>
                                                @endif

                                            @else
                                                <a href="{{ route('backend.tarefa.reabrir',$registro->id_tarefa) }}" class="btn reabrir">Reabrir</a>
                                            @endif

                                        </div>
                                    </div>

                                </div>

                                <div class="modal-sub-header">
                                    <div class="caracteristicas-1">
                                        <ul>
                                            @if($registro->data_fim == NULL)

                                                @include('backend.tarefa.editar.acoes.aberta')

                                            @else

                                                @include('backend.tarefa.editar.acoes.fechada')

                                            @endif
                                        </ul>
                                    </div>

                                    <div class="caracteristicas-2">
                                        <ul>
                                            <li>
                                                Esforço total
                                                <span>{{ $registro->estimativa_tipo }}</span>
                                            </li>
                                            <li>
                                                Total Trabalhado
                                                <span>
                                                <?php
                                                    $total = $registro->tempo_trabalhado;
                                                    $horas = floor($total / 3600);
                                                    $minutos = floor(($total - ($horas * 3600)) / 60);
                                                    $segundos = floor($total % 60);
                                                    echo $horas . ":" . $minutos . "";
                                                ?>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="caracteristicas-3">
                                        <h5>Inicio</h5>
                                        <!--<h3>
                                            08 MAR
                                            <span>10:19</span>
                                        </h3>
                                        <p>
                                            Esta é a tarefa de maior prioridade. Deve ser iniciada assim que possível.
                                        </p>-->
                                    </div>
                                </div>

                                <div class="modal-body">

                                    @if($registro->data_fim == NULL)

                                        @include('backend.tarefa.editar.acoes.descricaotarefa')

                                    @else

                                        <h3>Descrição</h3>
                                        <div class="descricao">
                                            <p style="font-size: 14px;color: #444;font-weight: 400;">
                                            {!! $registro->descricao !!}
                                            </p>
                                        </div>

                                    @endif

                                </div>

                                <div class="modal-footer">

                                    <!-- Itens de Tarefa -->
                                    <div class="nav-wrapper">
                                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">

                                            <!-- Comentário -->
                                            <li class="nav-item">
                                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                                                    <i class="far fa-comments"></i>
                                                    Comentário ({{ $contador_comentarios }})
                                                </a>
                                            </li>

                                            <!-- Anexo -->
                                                <li class="nav-item">
                                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                                                        <i class="fas fa-paperclip"></i>
                                                        Anexo ({{ $contador_anexos }})
                                                    </a>
                                                </li>

                                            <!-- Seguidores -->
                                            <li class="nav-item">
                                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">
                                                    <i class="fas fa-users-cog"></i>
                                                    Seguidores ({{ $contador_seguidores }})
                                                </a>
                                            </li>

                                        </ul>
                                    </div>

                                    <!-- Conteúdo dos Itens -->
                                    <div class="card shadow comentario-interna-tarefa">
                                        <div class="card-body">
                                            <div class="tab-content" id="myTabContent">

                                                <!-- Adicionar Comentário -->
                                                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                                                    <form action="{{ route('backend.tarefa.comentario.adicionar',$registro->id_tarefa) }}" method="post" enctype="multipart/form-data" class="comentario-interna">
                                                        {{ csrf_field() }}

                                                        @include('backend.tarefa.editar.comentario')

                                                        <button style="cursor: pointer;background: transparent;border: none;" id="btnComentarioInterna">
                                                            <i class="fas fa-paper-plane enviar"></i>
                                                        </button>

                                                    </form>

                                                </div>

                                                <!-- Adicionar Anexo -->
                                                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                                    <form action="{{ route('backend.tarefa.anexo.adicionar',$registro->id_tarefa) }}" method="post" enctype="multipart/form-data" class="comentario-interna">
                                                        {{ csrf_field() }}

                                                        @include('backend.tarefa.editar.anexo')

                                                        <button style="cursor: pointer;background: transparent;border: none;">
                                                            <i class="fas fa-paper-plane enviar"></i>
                                                        </button>

                                                    </form>
                                                </div>

                                                <!-- Adicionar Seguidor -->
                                                <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">

                                                    <form action="{{ route('backend.tarefa.seguidor.adicionar',$registro->id_tarefa) }}" method="post" enctype="multipart/form-data" class="comentario-interna">
                                                        {{ csrf_field() }}

                                                        @include('backend.tarefa.editar.seguidor')

                                                        <button style="cursor: pointer;background: transparent;border: none;">
                                                            <i class="fas fa-paper-plane enviar"></i>
                                                        </button>

                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="conteudo-itens">

                                        @if($contador_comentarios == '0')
                                            <div class="comentario-autor item-comentarios-zero">
                                                <img class="image" src="{{ asset('img/nenhum-comentario.svg') }}">
                                                <p class="title">Essa tarefa ainda não possui comentários.</p>
                                                <p class="subtitle">Comentário de sistema não será postado.</p>
                                            </div>
                                        @else
                                            @foreach($comentarios as $comentario)
                                                @if($comentario->id_usuario_comentario == 0)

                                                    <div class="comentario-sistema">
                                                        <div class="comentario-cinza">
                                                            <div class="header">
                                                                <h3>Comentário da Intranet - {{ date( 'd/m/Y H:i' , strtotime($comentario->created_at)) }}</h3>
                                                            </div>
                                                            <div class="content">
                                                                {!! $comentario->comentario !!}
                                                            </div>
                                                        </div>
                                                    </div>

                                                @elseif($comentario->id_usuario_comentario == Auth::user()->id)

                                                    <div class="comentario-autor">
                                                        <div class="comentario-blue">
                                                            <div class="header">
                                                                <h2>{{ $comentario->name }} {{ $comentario->sobrenome }}</h2>
                                                                <h3>{{ date( 'd/m/Y H:i' , strtotime($comentario->created_at)) }}</h3>
                                                            </div>
                                                            <div class="content">
                                                                {!! $comentario->comentario !!}
                                                            </div>
															@php
                                                                $diff = strtotime(now()) - strtotime($comentario->created_at);
                                                                $dias = abs(round($diff / 86400));
                                                            @endphp
                                                            @if($dias <= 1)
                                                                <div class="d-flex justify-content-end">
                                                                    <form action="{{ route('backend.tarefa.comentario.apagar', [$registro->id_tarefa, $comentario->id_comentario]) }}" method="post" onsubmit="return confirm('Tem certeza que deseja apagar este comentário?');">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fa fa-trash" title="Apagar" alt="Apagar" aria-hidden="true"></i></button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                @else

                                                    <div class="comentario-autor" style="justify-content: flex-start;">
                                                        <div class="comentario-green">
                                                            <div class="header">
                                                                <h2>{{ $comentario->name }} {{ $comentario->sobrenome }}</h2>
                                                                <h3>{{ date( 'd/m/Y H:i' , strtotime($comentario->created_at)) }}</h3>
                                                            </div>
                                                            <div class="content">
                                                                {!! $comentario->comentario !!}</h3>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
                                            @endforeach
                                        @endif

                                        <ul class="anexo">
                                            @if($contador_anexos >1)
                                            <li>
                                                <a href="{{ route('backend.tarefa.anexo.all',$registro->id_tarefa) }}" style="background-color: #1c94ef;color: #fffcfc;">
                                                <i class="fas fa-file-archive"></i> Baixar Todos</a>
                                            </li>
                                            @endif
                                            @foreach($anexos as $anexo)
                                                <li>
                                                    <a href="/{{ $anexo->anexo }}" download>
                                                        <span class="tipo-arquivo">
                                                            {{ $anexo->tipo_arquivo }}
                                                        </span>
                                                        {{ $anexo->nome_arquivo }}
                                                    </a>
                                                    <h5>
                                                        Enviado por: {{ $anexo->name }} {{ $anexo->sobrenome }} {{ date( 'd/m/Y H:i' , strtotime($anexo->created_at)) }}
                                                    </h5>
                                                    @php
                                                        $diff = strtotime(now()) - strtotime($anexo->created_at);
                                                        $dias = abs(round($diff / 86400));
                                                    @endphp
                                                    @if($dias <= 10 && Auth::id() == $anexo->id_usuario_postou)
                                                        <form action="{{ route('backend.tarefa.anexo.apagar', [$registro->id_tarefa, $anexo->id_anexo]) }}" method="post" onsubmit="return confirm('Tem certeza que deseja apagar este anexo?');">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fa fa-trash" title="Apagar" alt="Apagar" aria-hidden="true"></i></button>
                                                        </form>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="seguidores">
                                            @foreach($seguidores as $seguidor)
                                                <div class="seguidores-info">
                                                    <img src="/{{ $seguidor->image }}">
                                                    <h3>{{ $seguidor->name }}</h3>
                                                    <a href="{{ route('backend.tarefa.seguidor.deletar',[$registro->id_tarefa,$seguidor->id_usuario_seguidor]) }}" class="remover-seguidor">X</a>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                <!-- Fim Modal Tarefa -->
            @endforeach
    </div>
</div>
