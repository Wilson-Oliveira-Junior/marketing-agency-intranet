<div class="modal fade modal-nova-tarefa" id="novapauta" tabindex="-1" role="dialog" aria-labelledby="novapautaLabel" aria-hidden="true" style="top:10px;">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 800px;">
        <div id="loader" style="display:none !important">
            <img src="{{asset('img/load-oficial.gif')}}">
        </div>
        <div class="modal-content">

            <!-- Topo -->
            <div class="top-nova-tarefa">
                <h4>Nova Pauta</h4>

                <button type="button close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="adicionarpauta" action="#" method="post" onsubmit="return concluirpauta(this, event);">
                @csrf

                <div class="formulario">

                    <!-- Título da Tarefa -->
                    <div class="titulo">
                        <h5>Título</h5>
                        <input type="text" id="titulopauta" class="form-control required-input user-error" name="titulo" value="" placeholder="Título da pauta">
                        <span>*</span>
                    </div>

                    <!-- Alocados na Tarefa -->
                    <div class="alocados">
                        <h5>Quem</h5>

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
                                    <!--<li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                                            <i class="fas fa-users"></i>
                                        </a>
                                    </li>-->

                                </ul>
                            </div>

                            <!-- Exibindo o Conteúdo -->
                            <div class="tab-content" id="myTabContent">

                                @include('backend.tarefa.novatarefa.campos_formulario.usuarioPauta')

                            </div>

                        </div>

                    </div>

                    <!-- Projeto da Tarefa (Usando a mesma class)-->
                    <div class="tipo">
                        <h5>Projeto</h5>

                            @include('backend.tarefa.novatarefa.campos_formulario.projetoTarefaPauta')

                        <span>*</span>
                    </div>

                    <div class="tipo">
                        <h5>Urgência</h5>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <input type="radio" name="urgencia" id="urgencia1" class="urgencia-pauta" value="1">
                                    <label for="urgencia1">Tem que ser feito imediatamente!</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="radio" name="urgencia" id="urgencia2" class="urgencia-pauta" value="2">
                                    <label for="urgencia2">Tem que ser feito no mesmo dia!</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="radio" name="urgencia" id="urgencia3" class="urgencia-pauta" value="3">
                                    <label for="urgencia3">Tem que ser feito até a data estipulada</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="radio" name="urgencia" id="urgencia4" class="urgencia-pauta" value="4">
                                    <label for="urgencia4">Encaixar no cronograma</label>
                                </div>
                            </div>




                            <!--<select name="urgencia" id="urgencia">
                                <option value="1">Tem que ser feito imediatamente!</option>
                                <option value="2">Tem que ser feito no mesmo dia!</option>
                                <option value="3">Tem que ser feito até a data estimulada</option>
                                <option value="4">Encaixar no cronograma</option>
                            </select>-->
                        </div>

                        <span>*</span>
                    </div>

                    <div id="compartilharPauta" class="select2-container required-input">

                        <!-- Campos para clicar -->
                        <a href="javascript:void(0)" class="js-open-modal-usuario-evento select2-choice select2-default" style="border: none;padding: 0px;width: auto;">
                            <span class="select2-chosen" id="select2-chosen-usuario-evento">
                                <i class="ni ni-single-02"></i>
                                Compartilhar Pauta
                            </span>
                        </a>

                        <div class="evento-seguidor js-open-modal-principal-compartilhar-pauta">

                            <button id="fechar-compartilhar-pauta" type="button" class="close close-data">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <h2>Compartilhar Pauta</h2>

                            @include('layouts.dashboard.botao.abas.usuarios')

                            <div class="arrow arrow-down-border"></div>
                            <div class="arrow arrow-down"></div>

                        </div>

                    </div>

                    <div class="titulo hidden" id="dtDesejadaPauta">
                        <h5>Data Desejada</h5>
                        <input type="date" class="form-control user-success" name="datadesejada-tarefa" id="datadesejada-tarefa" data-ui="date-addon">
                    </div>


                    <!-- Ações da Tarefa -->
                    <div class="acoes">
                        <button class="btn adicionar" type="submit">Adicionar</button>
                    </div>


                    <!-- Concluir Lembrete -->
                    <script>
                        $(".urgencia-pauta").click(function(){
                            valor = $(this).val();

                            if(valor == 3 || valor == 4){
                                $('#dtDesejadaPauta').removeClass('hidden');
                            }else{
                                $('#dtDesejadaPauta').addClass('hidden');
                            }
                        });
                        function concluirpauta(form,event){

                            //console.log($("input[name=urgencia]:checked").val());
                            //console.log($("#datadesejada-tarefa").val());
                            if( ( $("#titulopauta").val().length <= 3) ){
                                swal({
                                    title: 'Atenção',
                                    text: "Preencha o título da pauta",
                                    type: 'info',
                                    showCancelButton: false,
                                    confirmButtonColor: '#28B463',
                                    confirmButtonText: 'Ok',
                                });
                                return false;
                            }
                            else if( ( $("#idusuariounicopauta").length <= 0) ){
                                    swal({
                                        title: 'Atenção',
                                        text: "Selecione usuário",
                                        type: 'info',
                                        showCancelButton: false,
                                        confirmButtonColor: '#28B463',
                                        confirmButtonText: 'Ok',
                                    });
                                    return false;

                            }
                            else if( ( $("#idprojetounicopauta").length <= 0) ) {
                                swal({
                                    title: 'Atenção',
                                    text: "Selecione o Projeto",
                                    type: 'info',
                                    showCancelButton: false,
                                    confirmButtonColor: '#28B463',
                                    confirmButtonText: 'Ok',
                                });
                                return false;
                            }
                            else if( (! $("input[name=urgencia]:checked").val()) ){
                                    swal({
                                        title: 'Atenção',
                                        text: "Selecione a urgência",
                                        type: 'info',
                                        showCancelButton: false,
                                        confirmButtonColor: '#28B463',
                                        confirmButtonText: 'Ok',
                                    });
                                    return false;
                            }
                            else if( ( $("input[name=urgencia]:checked").val() >=3 && $("#datadesejada-tarefa").val() =="") ){

                                swal({
                                    title: 'Atenção',
                                    text: "Adicione a data desejada.",
                                    type: 'info',
                                    showCancelButton: false,
                                    confirmButtonColor: '#28B463',
                                    confirmButtonText: 'Ok',
                                });
                                return false;

                            }
                            else{
                                $('.acoes .adicionar').hide();
                                $('#loader').show();
                                //$('#adicionarpauta').submit();
                                event.preventDefault();

                                var myForm = document.getElementById('adicionarpauta');

                                //console.log(idselecionado);
                                $.ajax({
                                    type: 'POST',
                                    url: "/backend/pauta/salvar",
                                    data: new FormData(myForm),
                                    dataType:'HTML',
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(data) {

                                        toastr.success('Pauta adicionada com sucesso!', 'Sucesso', {timeOut: 5000});
                                        $("#adicionarpauta")[0].reset();
                                        $('.acoes .adicionar').show();
                                        $("#compartilhar-pauta-mencionado").empty();
                                        $("body").find(".js-open-modal-principal-compartilhar-pauta").removeClass("visible");
                                        $('#loader').hide();
                                        if ($("#lista-pautas").length){
                                            //console.log('sim');
                                            filtro = $(".filtro").data('filtro');
                                            fnFiltro(filtro);
                                        }
                                    },
                                    error: function (request, status, error) {
                                        //console.log('Falha');
                                        var data = $.parseJSON(request.responseText);

                                        setTimeout(function () {
                                            toastr.error('ERROS de Validação!', 'Alerta de Erro', {timeOut: 5000});
                                        }, 500);

                                    }
                                });//ajax

                            }
                        }
                    </script>

                </div>
            </form>

        </div>
    </div>
</div>
