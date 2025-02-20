<div class="tab-pane fade show" id="tabs-icons-text-90" role="tabpanel" aria-labelledby="tabs-icons-text-90-tab">
    <div class="form-group" style="margin-top: 10px;">
        <div class="input-group input-group-alternative mb-3" style="padding: 0px;border: none;box-shadow: none;">

            <div id="convidado_evento" class="select2-container required-input">

                <!-- Campos para clicar -->
                <a href="javascript:void(0)" class="js-open-modal-compartilhar-pauta select2-choice select2-default" style="padding: 10px 0px;">
                    <span class="select2-chosen" id="select2-chosen-10-pauta">Compartilhe a Pauta</span>
                    <span class="select2-arrow" role="presentation" style="padding-top: 0px;padding-left: 5px;">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>

                <!-- Busca dentro do Usuário-->
                <div class="search-compartilhar-pauta">
                    <input id="txtBuscaUsuarioCompartilhado" type="text" class="form-control" style="border: 1px dashed #5d6ee7" placeholder="Digite para procurar" autofocus>
                    <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
                </div>

                <!-- Conteudo -->
                <ul id="compartilhar-pauta-conteudo-id" class="conteudo-compartilhar-pauta">
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="compartilhar-pauta-mencionado">
</div>
