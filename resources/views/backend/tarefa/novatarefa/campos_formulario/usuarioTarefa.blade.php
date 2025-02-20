                            <!-- Usuário -->
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">             
                                <div class="form-group" style="margin-top: 20px;">
                                    <div class="input-group input-group-alternative mb-3" style="padding: 0px;border: none;">  
                                        <div id="usuarios_nova_tarefa" class="select2-container required-input">
                                            
                                            <!-- Campos para clicar -->
                                            <a href="javascript:void(0)" class="js-open-modal-usuarios select2-choice select2-default">
                                                <span class="select2-chosen" id="select2-chosen-10">Quem trabalhará na tarefa?</span>
                                                <span class="select2-arrow" role="presentation">
                                                    <i class="fas fa-angle-down"></i>
                                                </span>
                                            </a>

                                            <!-- Busca dentro do Usuário-->
                                            <div class="search-usuarios">
                                                <input id="txtBuscaUsuario" type="text" class="form-control search-usuario" placeholder="Digite para procurar" autofocus>
                                                <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
                                            </div>

                                            <!-- Conteudo -->
                                            <ul id="usuarios-conteudo-id" class="conteudo-usuarios">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>