<!-- Segmento -->
<div class="form-group col-sm-4">
    <div class="form-group {{ $errors->has('id_segmento') ? 'has-error' : '' }} col-sm-12">
        <div class="input-group-alternative mb-3" style="padding: 0px;border: none;box-shadow: none;">  
            <div id="segmentos_atuais" class="select2-container required-input">
                                            
                <!-- Campos para clicar -->
                <a href="javascript:void(0)" class="js-open-modal-segmentos select2-choice select2-default" style="color: #525f7f;">
                    <span class="select2-chosen" id="select2-chosen-10">
                        Segmento da Empresa
                    </span>
                    <span class="select2-arrow" role="presentation">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>

                <!-- Busca dentro do Usuário-->
                <div class="search-segmentos">
                    <input id="txtBuscaSegmentos" type="text" class="form-control search-segmento" placeholder="Digite para procurar" autofocus>
                    <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
                </div>

                <!-- Conteudo -->
                <ul id="segmentos-conteudo-id" class="conteudo-segmentos">
                </ul>

                <div id="segmentos-campo-input">
                    <input id="valor_segmento_input" class="form-control valor_input" name="id_segmento" type="hidden" value="{{ isset($segmentoCliente->id) ? $segmentoCliente->id : '' }}">
					<input id="valor_segmento_input" class="form-control valor_input" name="nomeSegmento" type="text" value="{{ isset($segmentoCliente->nome) ? $segmentoCliente->nome : '' }}">
                </div>

            </div>
        </div>
    </div>
</div>