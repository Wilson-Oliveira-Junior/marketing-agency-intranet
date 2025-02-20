    <div id="adicionarColaborador" class="select2-container required-input">
                                                
        <!-- Campos para clicar -->
        <a href="javascript:void(0)" class="js-open-modal-usuario-evento select2-choice select2-default" style="border: none;padding: 0px;width: auto;">
            <span class="select2-chosen" id="select2-chosen-usuario-evento">
                <i class="ni ni-single-02"></i>
                Compartilhar Evento
            </span>
        </a>

        <div class="evento-seguidor js-open-modal-principal-convidado">
                                    
            <button id="fechar-convidado" type="button" class="close close-data">
                <span aria-hidden="true">&times;</span>
            </button>
                                    
            <h2>Compartilhar Evento</h2>
                    
            @include('backend.eventos.abas.seguidor')
                                    
            <div class="arrow arrow-down-border"></div>
            <div class="arrow arrow-down"></div>
                                    
        </div>
    
    </div>