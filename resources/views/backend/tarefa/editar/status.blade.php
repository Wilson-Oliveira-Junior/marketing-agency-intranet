<div id="alterar_status" class="select2-container required-input" style="padding-left: 15px;">
                                            
    <!-- Campos para clicar -->
    <a href="javascript:void(0)" class="js-open-modal-status select2-choice select2-default" style="padding: 0px;width: auto;">
        
        <!-- Campo de texto -->
        <span class="select2-chosen" id="select2-chosen-status">
            @if($registro->nome_status == null)
                Sem Status
            @else
                {{ $registro->nome_status }}
            @endif
        </span>
        
        <!-- Ícone de editar -->
        <span class="select2-arrow" role="presentation">
            <i class="fas fa-angle-down"></i>
        </span>

    </a>

    <!-- Busca Status -->
    <div class="search-status" style="width: 30%;">
        <input id="txtBuscaStatus" type="text" class="form-control search-statu" placeholder="Digite para procurar" autofocus>
        <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
    </div>

    <!-- Conteudo que vai ser inserido pelo Jquery -->
    <ul id="status-conteudo-id" class="conteudo-status">
    </ul>

</div>