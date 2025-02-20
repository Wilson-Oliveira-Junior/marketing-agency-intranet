<div id="alterar_aberta_projeto" class="select2-container required-input" style="padding-left: 15px;">
                                            
    <!-- Campos para clicar -->
    <a href="javascript:void(0)" class="js-open-modal-aberta-projeto select2-choice select2-default" style="padding: 0px;width: auto;">
        
        <!-- Campo de texto -->
        <span class="select2-chosen" id="select2-chosen-aberta-projeto">
            {{ $registro->nome_cliente }} > {{ $registro->tipo_projeto }}
        </span>
        
        <!-- Ícone de editar -->
        <span class="select2-arrow" role="presentation">
            <i class="fas fa-angle-down"></i>
        </span>

    </a>

    <!-- Busca aberta-projeto -->
    <div class="search-aberta-projeto" style="width: 30%;">
        <input id="txtBuscaAbertaProjeto" type="text" class="form-control search-statu" placeholder="Digite para procurar" autofocus>
        <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
    </div>

    <!-- Conteudo que vai ser inserido pelo Jquery -->
    <ul id="aberta-projeto-conteudo-id" class="conteudo-aberta-projeto">
    </ul>

</div>