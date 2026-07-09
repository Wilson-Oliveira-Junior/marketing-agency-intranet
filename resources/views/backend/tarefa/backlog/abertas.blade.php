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
                            <a href="{{ route('backend.tarefa.seguindo') }}">
                                Que eu sigo
                            </a>
                        </li>
                        <li>
                            <a href="#" class="active">
                                Backlog
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="tabs-sub">
            <ul class="setores-ul-backlog" style="width: 33%;">
                <li>
                    <!-- Setor -->
                    <div id="setores-backlog" class="select2-container required-input">
                        <!-- Campos para clicar -->
                        <a href="javascript:void(0)" class="js-open-modal-setores-backlog select2-choice select2-default">
                            <span class="select2-chosen" id="select2-chosen-backlog">Qual equipe deseja ver o backlog?</span>
                            <span class="select2-arrow" role="presentation">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>

                        <!-- Busca dentro do Usuário-->
                        <div class="search-setores-backlog invisible" style="margin-top: 1%;width: 45%;">
                            <input id="txtBuscaSetorBacklog" type="text" class="form-control search-setor-backlog" placeholder="Digite para procurar" autofocus>
                            <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento-backlog">
                        </div>

                        <!-- Conteudo -->
                        <ul id="setores-conteudo-id-backlog" class="conteudo-setores-backlog" style="margin-top: 8%;">
                        </ul>
                    </div>
                </li>
            </ul>

            <div class="nome-setor-clicado" style="float: left;font-size: 17px;">
                Você está visualizando a área de: <strong>{{ $setores[0]->nome }}</strong>
            </div>

            <div class="setor-backlog" style="color: #ff612c;font-weight: bold;border: 1px dashed;background-color: #f9f9f9;">
                <i class="ni ni-box-2" style="float: left;margin-right: 5px;margin-top: 4px;"></i>
                Backlog

                <button class="collapse-table-setores">
                    <i class="ni ni-fat-add" style="float: left;margin-right: 5px;margin-top: 4px;color:#ff612c"></i>
                </button>

            </div>

        </div>

        <div class="table-responsive listar-tarefas-backlog" style="padding: 0px 15px;">
            @forelse($tarefas as $registro)
                <div class="linha-tarefa-bottom" style="border-top: 1px solid #CCC;margin-top: 10px;">

                    <div class="acessorios" style="width: 100%;padding: 15px;">
                        <div class="title-principal">

                            <a href="{{ route('backend.tarefa.editar',$registro->id_tarefas) }}" class="btn btn-tarefa" style="white-space: inherit;width: 95%;float: left;color:#545d7f;font-weight:bold;">
                                {{ $registro->id_tarefas }}
                                    -
                                {{ $registro->titulo }}
                            </a>

                        </div>

                        <div class="title-segundario">
                            {{ $registro->nome_cliente }}
                                >
                            {{ $registro->nome_tipo }}
                        </div>

                        <div class="etapa">
                            <span>Data Criada</span>
                            <br/>
                            {{ date( 'd/m/Y' , strtotime($registro->datacriada)) }}
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
                           <span>Status</span>
                           <br/>
                           {{ $registro->nome_status }}
                       </div>



                        <!--
                            @if($registro->id_responsavel == Auth::user()->id)
                                <div class="botao-acoes">
                                    <button class="btn play">
                                        <i class="ni ni-button-play"></i>
                                    </button>
                                </div>
                            @else
                                <div class="botao-acoes">
                                    <button class="btn play" disabled>
                                        <i class="ni ni-button-play"></i>
                                    </button>
                                </div>
                            @endif
                        -->
                    </div>
                </div>
            @empty
                <div class="tarefas-404">
                    <div class="texto">
                        <h2>Oops !</h2>
                        <p>Parece que não tem nenhuma tarefa no backlog.</p>
                        <p>Volte para suas tarefas.</p>
                        <a href="{{ route('backend.tarefa') }}">Clique Aqui</a>
                    </div>

                    <div class="imagem">
                        <img src="{{ asset('img/homer.png') }}" style="width: 250px;">
                    </div>
                </div>
            @endforelse
        </div>

        <div class="setor-backlog" style="color: #00cdf1;font-weight: bold;border: 1px dashed;background-color: #f9f9f9;">
            <i class="ni ni-user-run" style="float: left;margin-right: 5px;margin-top: 4px;font-weight: bold;"></i>
            Equipe

            <button class="collapse-table">
                <i class="ni ni-fat-add" style="float: left;margin-right: 5px;margin-top: 4px;color:#00cdf1"></i>
            </button>

        </div>

        <div class="table-responsive collapse-hidden" style="padding: 0px 15px;">
            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="background-color: #fff;">#</th>
                        <th scope="col" style="background-color: #fff;">Imagem</th>
                        <th scope="col" style="background-color: #fff;">Nome</th>
                        <th scope="col" style="background-color: #fff;">E-mail</th>
                        <th scope="col" style="background-color: #fff;">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td scope="row">{{ $usuario->id }}</td>

                            <td>
                                @if($usuario->image != null)
                                    <img width="40" class="rounded-circle" src="{{ asset($usuario->image) }}">
                                @else
                                    <img width="40" class="rounded-circle" src="{{ asset('img/user.png') }}">
                                @endif
                            </td>

                            <td>{{ $usuario->name }} {{ $usuario->sobrenome }}</td>
                            <td>{{ $usuario->email }}</td>

                            <td>
                                <a href="{{ route('backend.cronograma.usuario',$usuario->id) }}" class="btn btn-cronograma">Cronograma</a>
                                <a href="{{ route('backend.usuario.tarefa',$usuario->id) }}" class="btn btn-ver-tarefas">Ver Tarefas</a>
                            </td>
                        </tr>
                    @empty
                        <h1>NADA</h1>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
