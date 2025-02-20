<!-- Modal -->
<div class="modal fade" id="adicionarEventoTarefaModal" tabindex="-1" role="dialog" aria-labelledby="adicionarEventoTarefaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div class="modal-content">
            <form action="{{ route('backend.evento.salvarTarefa') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header">
                    <h5 id="adicionarEventoTarefaModalLabel">
                        <i class="ni ni-calendar-grid-58 text-red"></i> 
                        Adicionando evento - Tarefa -
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-bottom:0px;">
                    <div class="row">

                        <div class="form-group col-sm-6 usuario-evento-tarefa-2">
                            <label class="form-control-label d-block mb-3">
                                <i class="far fa-user text-info"></i>
                                Selecione o Usuário
                            </label>
                            @include('layouts.dashboard.botao.evento.adicionarUsuario')
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-control-label d-block mb-3">
                                <i class="ni ni-active-40"></i>
                                Selecione a Tarefa
                            </label>
                            @include('layouts.dashboard.botao.evento.adicionarTarefa')
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-control-label d-block mb-3">Data Início</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="tarefa_evento_data_inicio" placeholder="Data de Início" type="date" value="">
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-control-label d-block mb-3">Data Fim</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="tarefa_evento_data_fim" placeholder="Data Final" type="date" value="">
                            </div>
                        </div>

                        <!-- CAMPOS DISPLAY NONE -->
                        <div class="campos-inativos" style="display:none;">
                            <input name="event-tag" type="text" value="#2dce89" style="display:none;">
                            <input id="id_setor_usuario_interno" type="text" value="{{ Auth::user()->setor }}" style="display:none;">
                        </div>    
                        <!-- CAMPOS DISPLAY NONE -->

                    </div>
                </div>

                <div class="modal-footer" style="display: flex !important;padding-right: 20px !important;">
                    <button type="submit" class="btn btn-primary" style="margin-bottom: 30px;">Adicionar Evento</button>
                </div>

            </form>
        </div>
    </div>
</div>