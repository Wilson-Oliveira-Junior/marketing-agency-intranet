                            <!-- Setor -->
                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                <div class="form-group" style="margin-top: 20px;">
                                    <div class="input-group input-group-alternative mb-3" style="padding: 0px;border: none;">
                                        
                                        <div id="setores_nova_tarefa" class="select2-container required-input">
                                            <!-- Campos para clicar -->
                                            <a href="javascript:void(0)" class="js-open-modal-setores select2-choice select2-default">
                                                <span class="select2-chosen" id="select2-chosen-768">Qual equipe trabalhará na tarefa?</span>
                                                <span class="select2-arrow" role="presentation">
                                                    <i class="fas fa-angle-down"></i>
                                                </span>
                                            </a>

                                            <!-- Busca dentro do Usuário-->
                                            <div class="search-setores">
                                                <input id="txtBuscaSetor" type="text" class="form-control search-setor" placeholder="Digite para procurar" autofocus>
                                                <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
                                            </div>

                                            <!-- Conteudo -->
                                            <ul id="setores-conteudo-id" class="conteudo-setores" style="margin-top: 25%;">
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>