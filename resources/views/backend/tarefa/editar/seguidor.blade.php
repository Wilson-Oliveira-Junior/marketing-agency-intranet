<i class="fas fa-user-plus" style="color: #1f99c1;"></i>

<div class="tab-pane fade show" id="tabs-icons-text-90" role="tabpanel" aria-labelledby="tabs-icons-text-90-tab" style="width: 75%;border: 1px dashed #ccc;padding: 0px;border-radius: 10px;">             
    <div class="form-group" style="margin-top: 0px;margin-bottom: 0px;">
        <div class="input-group input-group-alternative mb-3" style="padding: 0px;border: none;margin-bottom: 0px !important;"> 

            <div id="seguidores_tarefa" class="select2-container required-input">
                                                        
                <!-- Campos para clicar -->
                <a href="javascript:void(0)" class="js-open-modal-seguidores-interna select2-choice select2-default" style="padding: 10px 0px;">
                    <span class="select2-chosen" id="select2-chosen-10">Selecione o Seguidor</span>
                    <span class="select2-arrow" role="presentation" style="padding-top: 0px;padding-left: 20px;">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>

                <!-- Busca dentro do Usuário-->
                <div class="search-seguidores-interna">
                    <input id="txtBuscaSeguidoresInterna" type="text" class="form-control search-seguidor-interna" placeholder="Digite para procurar" autofocus>
                    <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
                </div>

                <!-- Conteudo -->
                <ul id="seguidores-tarefa-id" class="conteudo-seguidores-interna" style="padding-left: 0px;">
                </ul>

            </div>

        </div>
    </div>
</div>

<div style="display:none">
    <input type="text" name="criado_por" value="{{ Auth::user()->id }}">
</div>