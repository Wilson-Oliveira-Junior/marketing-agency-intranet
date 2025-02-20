<!-- Modal -->
<div class="modal fade" id="eventoModal" tabindex="-1" role="dialog" aria-labelledby="eventoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div class="modal-content">
            <form action="{{ route('backend.evento.salvar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header">
                    <h5 id="eventoModalLabel"><i class="ni ni-calendar-grid-58 text-red"></i> Adicionando Evento</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-bottom:0px;">
                    <div class="row">

                        <div class="form-group col-sm-6">
                            <label class="form-control-label d-block mb-3">Nome do Evento</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="nome" placeholder="Nome do Evento" type="text" value="{{ isset($eventos->nome) ? $eventos->nome : '' }}">
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-control-label d-block mb-3">Data Início</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="evento_data_inicio" placeholder="Descrição do Evento" type="date" value="{{ isset($eventos->evento_data_inicio) ? $eventos->evento_data_inicio : '' }}">
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-control-label d-block mb-3">Data Fim</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="evento_data_fim" placeholder="Descrição do Evento" type="date" value="{{ isset($eventos->evento_data_fim) ? $eventos->evento_data_fim : '' }}">
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-control-label d-block mb-3">Etiqueta de Cor</label>
                            <div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                                <label class="btn bg-info active">
                                    <input type="radio" name="event-tag" value="#11cdef" autocomplete="off" checked="">
                                </label>
                                <label class="btn bg-warning">
                                    <input type="radio" name="event-tag" value="#fb6340" autocomplete="off">
                                </label>
                                <label class="btn bg-danger">
                                    <input type="radio" name="event-tag" value="#f5365c" autocomplete="off"
                                ></label>
                                <label class="btn bg-success">
                                    <input type="radio" name="event-tag" value="#2dce89" autocomplete="off">
                                </label>
                                <label class="btn bg-default">
                                    <input type="radio" name="event-tag" value="#172b4d" autocomplete="off">
                                </label>
                                <label class="btn bg-primary">
                                    <input type="radio" name="event-tag" value="#5e72e4" autocomplete="off">
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="form-control-label d-block mb-3">Descrição do Evento</label>
                            <div class="input-group input-group-alternative mb-3">
                                <textarea class="form-control form-control-alternative edit-event--description textarea-autosize" name="descricao" placeholder="Descrição do Evento">{{ isset($eventos->descricao) ? $eventos->descricao : '' }}</textarea>
                            </div>
                        </div>

                        @include('backend.eventos.adicionarColaborador')

                        <input class="form-control" name="id_usuario" placeholder="ID USUÁRIO" type="text" value="{{ Auth::user()->id }}" style="display:none;">
                        <input class="form-control" name="id_setor" placeholder="ID SETOR" type="text" value="{{ Auth::user()->setor}}" style="display:none;">
                        
                    </div>
                </div>

                <div class="modal-footer" style="margin-top: -35px;padding-top: 0px !important;display: flex !important;padding-bottom: 20px !important;padding-right: 20px !important;">
                    <button type="submit" class="btn btn-primary">Adicionar Evento</button>
                </div>

            </form>
        </div>
    </div>
</div>