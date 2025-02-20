<!-- Tipo -->
<div class="form-group col-sm-4">
    <div class="form-group {{ $errors->has('id_tipo_projeto') ? 'has-error' : '' }} col-sm-12">
        <div class="input-group-alternative mb-3" style="padding: 0px;border: none;box-shadow: none;">  
            <div id="tipo-projetos" class="select2-container required-input">
                                            
                <!-- Campos para clicar -->
                <a href="javascript:void(0)" class="js-open-modal-tipo-projetos select2-choice select2-default" style="color: #525f7f;">
                    <span class="select2-chosen" id="select2-chosen-10">
                        Selecione o Tipo de Projeto*
                    </span>
                    <span class="select2-arrow" role="presentation">
                        <i class="fas fa-angle-down"></i>
                    </span>
                    @if($errors->has('id_tipo_projeto'))
                        <span class="help-block"><strong>{{ $errors->first('id_tipo_projeto') }}</strong></span>
                    @endif
                </a>

                <!-- Busca dentro do Usuário-->
                <div class="search-tipo-projetos">
                    <input id="txtBuscaTipoProjeto" type="text" class="form-control search-tipo-projeto" placeholder="Digite para procurar" autofocus>
                    <img src="{{ asset('img/gif-carregamento.gif') }}" class="imagem-carregamento">
                </div>

                <!-- Conteudo -->
                <ul id="tipo-projeto-conteudo-id" class="conteudo-tipo-projeto">
                </ul>

                <div id="tipo-projeto-campo-input">
                    <input id="valor_tipo_projeto_input" class="form-control valor_input valor_input-456" name="id_tipo_projeto" type="hidden" value="{{ isset($projetos->id_tipo_projeto) ? $projetos->id_tipo_projeto : old('id_tipo_projeto') }}">
                    <input id="valor_tipo_projeto_nome_input" class="form-control valor_input valor_input-12" name="id_tipo_projeto_nome" type="text" value="{{ isset($projetos->projeto) ? $projetos->projeto : old('id_tipo_projeto_nome') }}" readonly="readonly">
                </div>

            </div>
        </div>
    </div>
</div>