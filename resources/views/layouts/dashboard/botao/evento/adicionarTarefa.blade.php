<div class="input-group input-group-alternative mb-3" style="box-shadow: none;"> 
    <div id="tarefa_evento" class="select2-container required-input">
                                                        
        <!-- Campos para clicar -->
        <a href="javascript:void(0)" class="js-open-modal-tarefa_evento select2-choice select2-default" style="padding: 10px 0px;">
            <span class="select2-chosen" id="select2-chosen-169">Selecione a Tarefa</span>
            <span class="select2-arrow" id="seta-tarefa" role="presentation" style="padding-top: 0px;padding-left: 5px;">
                <i class="fas fa-angle-down"></i>
            </span>
        </a>

        <!-- Busca dentro do Usuário-->
        <div class="search-tarefa_tarefas">
            <input id="txtBuscaTarefaEvento" type="text" class="form-control search-tarefa_tarefa" placeholder="Digite para procurar" autofocus>
            <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
        </div>

        <!-- Conteudo -->
        <ul id="tarefa_evento-conteudo-id" class="conteudo-tarefa_evento">
        </ul>

    </div>
</div>