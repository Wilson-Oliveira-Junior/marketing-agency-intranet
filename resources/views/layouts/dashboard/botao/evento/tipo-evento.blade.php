<!-- Modal -->
<div class="modal fade" id="adicionarEventoModal" tabindex="-1" role="dialog" aria-labelledby="adicionarEventoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div class="modal-content">
            <form id="enviar-evento" action="{{ route('backend.evento.salvar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header">
                    <h5 id="adicionarEventoModalLabel">
                        <i class="ni ni-calendar-grid-58 text-red"></i>
                        Adicionando Evento
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-bottom:0px;">
                    <div class="row">

                        <div class="form-group col-sm-4">
                            <label class="form-control-label d-block mb-3">Nome do Evento</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input id="nome-evento" class="form-control" name="nome" placeholder="Nome do Evento" type="text" value="{{ isset($eventos->nome) ? $eventos->nome : '' }}">
                            </div>
                        </div>

                        <div class="form-group col-sm-4">
                            <label class="form-control-label d-block mb-3">Data Início</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input id="data-inicio-evento" class="form-control" name="evento_data_inicio" placeholder="Descrição do Evento" type="date" value="{{ isset($eventos->evento_data_inicio) ? $eventos->evento_data_inicio : '' }}">
                            </div>
                        </div>

                        <div class="form-group col-sm-4">
                            <label class="form-control-label d-block mb-3">Data Fim</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="evento_data_fim" placeholder="Descrição do Evento" type="date" value="{{ isset($eventos->evento_data_fim) ? $eventos->evento_data_fim : '' }}">
                            </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="form-control-label d-block mb-3">Descrição do Evento</label>
                            <div class="input-group input-group-alternative mb-3">
                                <textarea class="form-control form-control-alternative edit-event--description textarea-autosize" name="descricao" placeholder="Descrição do Evento" style="min-height: 210px;">{{ isset($eventos->descricao) ? $eventos->descricao : '' }}</textarea>
                            </div>
                        </div>

                        @include('backend.eventos.adicionarColaborador')

                        <input name="id_usuario" placeholder="ID USUÁRIO" type="text" value="{{ Auth::user()->id }}" style="display:none;">
                        <input name="id_setor" placeholder="ID SETOR" type="text" value="{{ Auth::user()->setor}}" style="display:none;">
                        <input type="radio" name="event-tag" value="#5e72e4" autocomplete="off" checked="" style="display:none;">

                    </div>
                </div>

                <div class="modal-footer" style="margin-top: -35px;padding-top: 0px !important;display: flex !important;padding-bottom: 20px !important;padding-right: 20px !important;">
                    <button onclick="concluirEvento();" id="adicionar-evento-2" type="button" class="btn btn-primary">Adicionar Evento</button>
                    <img src="{{ asset('img/loading-gatilho.gif') }}" class="imagem-carregamento-evento" style="width: 100px;">
                </div>

                <ul class="progresso-nav" style="margin-left: 0%;">
                    <li><a href="#">.</a></li>
                    <li class="active"><a href="#">.</a></li>
                    <li><a href="#">.</a></li>
                </ul>

            </form>
        </div>
    </div>
</div>

<script>
    function concluirEvento(){
        if( ( $("#nome-evento").val().length <= 3 ) ){
            swal({
                title: 'Atenção',
                text: "Preencha o título do evento",
                type: 'info',
                showCancelButton: false,
                confirmButtonColor: '#28B463',
                confirmButtonText: 'Ok',
            })
        }else if( ( $("#data-inicio-evento").val().length <= 3 ) ){
            swal({
                title: 'Atenção',
                text: "Preencha a data de início do evento",
                type: 'info',
                showCancelButton: false,
                confirmButtonColor: '#28B463',
                confirmButtonText: 'Ok',
            })
        }else{
            $('#adicionar-evento-2').remove();
            $(".imagem-carregamento-evento").addClass("visible");
            $('#enviar-evento').submit();
        }
    }
</script>