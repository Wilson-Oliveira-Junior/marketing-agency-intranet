<div class="card card-profile shadow" style="border: none;">

    <div class="card-header bg-white border-0" style="padding: 0px;">
        <div class="row align-items-center">
            <div class="col-12">

                <ul class="nav-tarefa">
                    <li>
                        <a class="active filtro paramim" data-filtro="r" tabindex="1" style="cursor: pointer;">
                            Para Mim
                        </a>
                    </li>
                    <li>
                        <a data-filtro="c" class="filtro quecriei" tabindex="2" style="cursor: pointer;">
                            Que criei
                        </a>
                    </li>

                    <li>
                        <a data-filtro="s" class="filtro meusetor" tabindex="3" style="cursor: pointer;">
                            {{$setor->nome}}
                        </a>
                    </li>
                    <li>
                        <a data-filtro="co" class="filtro compartilhado" tabindex="4" style="cursor: pointer;">
                            Compartilhado comigo
                        </a>
                    </li>
                    @if(Auth::id() == 3)
                    <li>
                        <a data-filtro="t" class="filtro todos" tabindex="4" style="cursor: pointer;">
                            Todos
                        </a>
                    </li>
                    @endif
                </ul>

            </div>
        </div>
    </div>

    <div class="tabs-sub">
        <ul>
            <li>
                <a data-filtro="a" class="active filtro abertas" tabindex="5" style="cursor: pointer;">
                    Abertas
                </a>
            </li>
            <li>
                <a data-filtro="f" class="filtro finalizadas" tabindex="6" style="cursor: pointer;">
                    Finalizadas
                </a>
            </li>
            <li class="hidden" id="div-loader">
                <img src="{{asset('img/loading.gif')}}" width="24px" /> Carregando...
            </li>
        </ul>

    </div>


    <div class="table-responsive" style="padding: 0px 15px;" id="lista-pautas">
        @include('backend.pautas.pautas')

    </div>


    @include('backend.pautas.mdl-observacao')
    @include('backend.pautas.mdl-consulta-observacao')
</div>
