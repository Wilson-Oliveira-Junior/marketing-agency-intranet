<div id="alterar_tarefa_tipos" class="select2-container required-input" style="padding-left: 15px;">
                                            
    <!-- Campos para clicar -->
    <a href="javascript:void(0)" class="js-open-modal-tarefa_tipos select2-choice select2-default" style="padding: 0px;width: auto;">
        
        <!-- Campo de texto -->
        <span class="select2-chosen" id="select2-chosen-tarefa_tipos" style="float: left;padding-left: 0px;margin-left: -10px;">
            @if($registro->nome_tipo == null)
                Sem Tipo
            @else
                {{ $registro->nome_tipo }}
            @endif
        </span>

        <!-- Ícone de editar -->
        <span class="select2-arrow" role="presentation">
            <i class="fas fa-angle-down"></i>
        </span>

    </a>

    <!-- Busca tarefa_tipos -->
    <div class="search-tarefa_tipos" style="width: 30%;">
        <input id="txtBuscatarefa_tipos" type="text" class="form-control search-tarefa-tipos" placeholder="Digite para procurar" autofocus>
        <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
    </div>

    <!-- Conteudo que vai ser inserido pelo Jquery -->
    <ul id="tarefa_tipos-conteudo-id" class="conteudo-tarefa_tipos">
    </ul>

</div>