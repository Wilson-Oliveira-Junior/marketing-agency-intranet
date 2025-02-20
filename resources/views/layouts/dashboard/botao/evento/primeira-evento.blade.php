<!-- Modal -->
<div class="modal fade" id="eventoModalPrimeiro" tabindex="-1" role="dialog" aria-labelledby="eventoModalPrimeiroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 id="eventoModalPrimeiroLabel">
                        <i class="ni ni-calendar-grid-58 text-red"></i> 
                        Selecione o Tipo de Evento
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-bottom:0px;">
                    <div class="row">

                        <!-- Selecionando o tipo de evento para ir para a próxima etapa -->
                        <div class="form-group col-sm-12" style="padding: 0px 25%;">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <select id="tipo-evento" class="form-control">
                                    <option value="-">- Selecione o Tipo de Evento -</option>
                                    <option value="1">Evento</option>
                                    @can('editar_cronograma')
                                        <option value="2">Tarefa</option>
                                    @endcan
                                    <!--
                                        <option value="3">Gatilho</option>
                                        <option value="4">To do List</option>
                                        <option value="5">Lembretes</option>
                                    -->
                                </select>
                            </div>
                        </div>

                        <ul class="progresso-nav">
                            <li class="active"><a href="#">.</a></li>
                            <li><a href="#">.</a></li>
                            <li><a href="#">.</a></li>
                        </ul>

                    </div>
                </div>
                
        </div>
    </div>
</div>