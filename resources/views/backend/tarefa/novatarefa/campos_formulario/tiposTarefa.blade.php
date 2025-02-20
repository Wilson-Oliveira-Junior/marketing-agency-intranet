    <!-- Conteúdo -->
        <div class="form-group">
            <div class="input-group input-group-alternative mb-3" style="padding: 0px;border: none;">
                <div id="tipos_nova_tarefa" class="select2-container required-input">
                                    
                    <!-- Campos para clicar -->
                        <a href="javascript:void(0)" class="js-open-modal-tipo select2-choice select2-default">
                            <span class="select2-chosen" id="select2-chosen-5">O que essa pessoa irá fazer?</span>
                                <span class="select2-arrow" role="presentation">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>

                    <!-- Busca dentro do Tipo-->
                        <div class="search-tipos">
                            <input id="txtBusca" type="text" class="form-control search-tipo" placeholder="Digite para procurar" autofocus>
                            <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
                        </div>

                    <!-- Conteudo -->
                        <ul id="tipo-conteudo-id" class="conteudo-tipo">
                        </ul>
        
                </div>
            </div>
        </div>
    <!-- Fim Conteúdo -->