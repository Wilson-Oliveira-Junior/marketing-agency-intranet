<div class="input-group input-group-alternative mb-3" style="box-shadow: none;"> 
    <div id="usuario_evento" class="select2-container required-input">
                                                        
        <!-- Campos para clicar -->
        <a href="javascript:void(0)" class="js-open-modal-usuario_evento select2-choice select2-default" style="padding: 10px 0px;">
            <span class="select2-chosen" id="select2-chosen-171">Selecione o Usuário</span>
            <span class="select2-arrow" id="seta-usuario-retirar" role="presentation" style="padding-top: 0px;padding-left: 5px;">
                <i class="fas fa-angle-down"></i>
            </span>
        </a>

        <!-- Busca dentro do Usuário-->
        <div class="search-usuario_eventos">
            <input id="txtBuscaUsuarioEvento" type="text" class="form-control search-usuario_evento" placeholder="Digite para procurar" autofocus>
            <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
        </div>

        <!-- Conteudo -->
        <ul id="usuario_evento-conteudo-id" class="conteudo-usuario_evento">
        </ul>

    </div>
</div>