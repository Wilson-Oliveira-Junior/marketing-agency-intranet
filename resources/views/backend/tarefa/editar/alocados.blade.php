@if($registro->data_fim == NULL)
    <div id="alterar_tarefa_usuario" class="select2-container required-input" style="padding-left: 15px;width: 45%;">
                                                
        <!-- Campos para clicar -->
        <a href="javascript:void(0)" class="js-open-modal-tarefa_usuario select2-choice select2-default" style="padding: 0px;width: auto;">
            
            <!-- Campo de texto -->
            <span class="select2-chosen" id="select2-chosen-tarefa_usuario" style="float: left;padding-left: 0px;margin-left: -10px;">
                @if($registro->imagem_responsavel == NULL)
                    <img src="{{ asset('img/user.png') }}">
                @else
                    <img src="http://intranet.logicadigital.com.br/{{ $registro->imagem_responsavel }}">
                @endif
                <h3 id="id-nome-h3" style="width: 50%;">{{ $registro->nome_responsavel }}</h3>
                <h5 id="id-nome-h5">{{ $registro->nome_setor }}</h5>
            </span>

            <!-- Ícone de editar -->
            <span class="select2-arrow" role="presentation">
                <i class="fas fa-angle-down"></i>
            </span>

        </a>

        <!-- Busca tarefa_usuario -->
        <div class="search-tarefa_usuario" style="width: 30%;">
            <input id="txtBuscatarefa_usuario" type="text" class="form-control search-user" placeholder="Digite para procurar" autofocus>
            <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
        </div>

        <!-- Conteudo que vai ser inserido pelo Jquery -->
        <ul id="tarefa_usuario-conteudo-id" class="conteudo-tarefa_usuario">
        </ul>

    </div>
@else
    <div id="alterar_tarefa_usuario" class="select2-container required-input" style="padding-left: 15px;width: 45%;">                           
        <span class="select2-chosen" id="select2-chosen-tarefa_usuario" style="float: left;padding-left: 0px;margin-left: -10px;">
            @if($registro->imagem_responsavel == NULL)
                <img src="{{ asset('img/user.png') }}">
            @else
                <img src="http://intranet.logicadigital.com.br/{{ $registro->imagem_responsavel }}">
            @endif
            <h3 id="id-nome-h3" style="width: 50%;">{{ $registro->nome_responsavel }}</h3>
            <h5 id="id-nome-h5">{{ $registro->nome_setor }}</h5>
        </span>
    </div>
@endif