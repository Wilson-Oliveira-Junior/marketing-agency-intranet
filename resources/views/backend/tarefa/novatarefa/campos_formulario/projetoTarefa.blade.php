                    <!-- Conteúdo -->
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-3" style="padding: 0px;border: none;">
                            
                            <div id="projetos_nova_tarefa" class="select2-container required-input">
                                <!-- Campos para clicar -->
                                    <a href="javascript:void(0)" class="js-open-modal-projeto select2-choice select2-default">
                                        <span class="select2-chosen" id="select2-chosen-6">Em qual projeto?</span>
                                        <span class="select2-arrow" role="presentation">
                                            <i class="fas fa-angle-down"></i>
                                        </span>
                                    </a>

                                <!-- Busca dentro do Projetos -->
                                    <div class="search-projetos">
                                        <input id="txtBuscaProjetos" type="text" class="form-control search-projeto" placeholder="Digite para procurar" autofocus>
                                        <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
                                    </div>

                                <!-- Conteudo -->
                                    <ul id="projetos-conteudo-id" class="conteudo-projetos">
                                    </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Fim Conteúdo -->