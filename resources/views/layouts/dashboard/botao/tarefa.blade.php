<div class="modal fade modal-nova-tarefa" id="novatarefa" tabindex="-1" role="dialog" aria-labelledby="novatarefaLabel" aria-hidden="true" style="top:10px;">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 800px;">
        <div id="loader" style="display:none !important">
            <img src="http://intranet.logicadigital.com.br/img/load-oficial.gif">
        </div>
        <div class="modal-content">

            <!-- Topo -->
            <div class="top-nova-tarefa">
                <h4>Criar nova Tarefa</h4>

                <button type="button close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="adicionartarefa" action="{{ route('backend.tarefa.salvar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="formulario">

                    <!-- Título da Tarefa -->
                    <div class="titulo">
                        <h5>Título da tarefa</h5>
                        <input type="text" id="titulonovatarefa" class="form-control required-input user-error" name="titulo" value="" placeholder="Título da tarefa">
                        <span>*</span>
                    </div>

                    <!-- Alocados na Tarefa -->
                    <div class="alocados">
                        <h5>Alocados</h5>

                        <div class="alocados-sub">

                            <!-- Ícones -->
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                    <!-- Usuário -->
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                                            <i class="fas fa-user"></i>
                                        </a>
                                    </li>

                                    <!-- Setores -->
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                                            <i class="fas fa-users"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <!-- Exibindo o Conteúdo -->
                            <div class="tab-content" id="myTabContent">

                                @include('backend.tarefa.novatarefa.campos_formulario.usuarioTarefa')

                                @include('backend.tarefa.novatarefa.campos_formulario.setorTarefa')

                            </div>

                        </div>

                    </div>

                    <!-- Tipos da Tarefa -->
                    <div class="tipo">
                        <h5>Tipo</h5>

                            @include('backend.tarefa.novatarefa.campos_formulario.tiposTarefa')

                        <span>*</span>
                    </div>

                    <!-- Projeto da Tarefa (Usando a mesma class)-->
                    <div class="tipo">
                        <h5>Projeto</h5>

                            @include('backend.tarefa.novatarefa.campos_formulario.projetoTarefa')

                        <span>*</span>
                    </div>

                    <!-- Descrição da Tarefa -->
                    <div class="descricao">
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3" id="editor">
                            </div>
                        </div>
                    </div>
                    <textarea name="descricao" id="mytextareatarefa" class="validate form-control d-none" rows="5" placeholder="Adicone um Comentário..."></textarea>

                    <!-- Ações da Tarefa -->
                    <div class="acoes">
                        <!-- Itens a parte da tarefa -->
                        <ul>
                            <li>
                                <button type="button" class="btn btn-default" id="id-anexo-conteudo">
                                    <i class="fas fa-paperclip"></i>
                                </button>

                                <div class="anexo-conteudo">

                                    <button type="button" class="close close-anexo">
                                        <span aria-hidden="true">&times;</span>
                                    </button>


                                    <input multiple="multiple" type="file" name="anexos[]" class="form-control-file">
                                    <input name="id_usuario_postou" value="{{ Auth::user()->id }}" style="display:none">

                                    <div class="arrow arrow-down-border"></div>
                                    <div class="arrow arrow-down"></div>

                                </div>
                            </li>

                            <li>
                                <button type="button" class="btn btn-default" name="anexo-tarefa" id="id-data-conteudo">
                                    <i class="fas fa-calendar-check"></i>
                                </button>

                                <div class="data-conteudo">

                                    <button type="button" class="close close-data">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <h2>Data Desejada</h2>
                                    <input type="date" class="form-control user-success" name="datadesejada-tarefa" data-ui="date-addon">
                                    <div class="arrow arrow-down-border"></div>
                                    <div class="arrow arrow-down"></div>

                                </div>
                            </li>

                            <li>
                                <button type="button" class="btn btn-default" name="seguidor-tarefa" id="id-seguidor">
                                    <i class="fas fa-users-cog"></i>
                                </button>

                                <div class="seguidor-conteudo">

                                    <button type="button" class="close close-data">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <h2>Adicionar Seguidor</h2>

                                    @include('backend.tarefa.novatarefa.campos_formulario.seguidorTarefa')

                                    <div class="arrow arrow-down-border"></div>
                                    <div class="arrow arrow-down"></div>

                                </div>
                            </li>

                        </ul>

                        <button onclick="concluir();" class="btn adicionar" type="button">Adicionar</button>
                    </div>

                    <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                    <!-- Concluir Lembrete -->
                    <script>
                        function concluir(){
                            comentario = $( "#editor .ql-editor" ).html();
                            $("#mytextareatarefa").text(comentario);
                            if( ( $("#titulonovatarefa").val().length <= 3) ){
                                swal({
                                    title: 'Atenção',
                                    text: "Preencha o título da tarefa",
                                    type: 'info',
                                    showCancelButton: false,
                                    confirmButtonColor: '#28B463',
                                    confirmButtonText: 'Ok',
                                })
                            }
                            else if( ( $("#idusuariounico").length <= 0) ){
                                if( ( $("#idsetorunico").length <= 0) ){
                                    swal({
                                        title: 'Atenção',
                                        text: "Selecione usuário ou setor",
                                        type: 'info',
                                        showCancelButton: false,
                                        confirmButtonColor: '#28B463',
                                        confirmButtonText: 'Ok',
                                    })
                                }else{
                                    if( ( $("#idtipounico").length <= 0) ) {
                                        swal({
                                            title: 'Atenção',
                                            text: "Selecione o Tipo de Alteração",
                                            type: 'info',
                                            showCancelButton: false,
                                            confirmButtonColor: '#28B463',
                                            confirmButtonText: 'Ok',
                                        })
                                    }
                                    else if( ( $("#idprojetounico").length <= 0) ) {
                                        swal({
                                            title: 'Atenção',
                                            text: "Selecione o Projeto",
                                            type: 'info',
                                            showCancelButton: false,
                                            confirmButtonColor: '#28B463',
                                            confirmButtonText: 'Ok',
                                        })
                                    }
                                    else{
                                        $('.acoes .adicionar').remove();
                                        $('#loader').show();
                                        $('#adicionartarefa').submit();
                                    }
                                }
                            }
                            else if( ( $("#idtipounico").length <= 0) ) {
                                swal({
                                    title: 'Atenção',
                                    text: "Selecione o Tipo de Alteração",
                                    type: 'info',
                                    showCancelButton: false,
                                    confirmButtonColor: '#28B463',
                                    confirmButtonText: 'Ok',
                                })
                            }
                            else if( ( $("#idprojetounico").length <= 0) ) {
                                swal({
                                    title: 'Atenção',
                                    text: "Selecione o Projeto",
                                    type: 'info',
                                    showCancelButton: false,
                                    confirmButtonColor: '#28B463',
                                    confirmButtonText: 'Ok',
                                })
                            }
                            else{
                                $('.acoes .adicionar').remove();
                                $('#loader').show();
                                $('#adicionartarefa').submit();
                            }
                        }
                    </script>

                </div>
            </form>

        </div>
    </div>
</div>
