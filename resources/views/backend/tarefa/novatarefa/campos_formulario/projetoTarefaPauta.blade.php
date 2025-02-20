                    <!-- Conteúdo -->
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-3" style="padding: 0px;border: none;">

                            <div id="projetos_nova_pauta" class="select2-container required-input">
                                <!-- Campos para clicar -->
                                    <a href="javascript:void(0)" class="js-open-modal-projeto-pauta select2-choice select2-default">
                                        <span class="select2-chosen" id="select2-chosen-pauta">Em qual projeto?</span>
                                        <span class="select2-arrow" role="presentation">
                                            <i class="fas fa-angle-down"></i>
                                        </span>
                                    </a>

                                <!-- Busca dentro do Projetos -->
                                    <div class="search-projetos-pauta">
                                        <input id="txtBuscaProjetosPauta" type="text" class="form-control search-projeto-pauta" placeholder="Digite para procurar" autofocus>
                                        <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
                                    </div>

                                <!-- Conteudo -->
                                    <ul id="projetos-conteudo-id-pauta" class="conteudo-projetos-pauta">
                                    </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Fim Conteúdo -->
