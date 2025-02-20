<!-- Modal -->
<div class="modal fade" id="mdlDataComemorativa" tabindex="-1" role="dialog" aria-labelledby="mdlDataComemorativaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div id="loader" style="display:none !important">
            <img src="{{asset('img/load-oficial.gif')}}">
        </div>
        <div class="modal-content">
            <form id="formDataComemorativa" method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="mdlDataComemorativaLabel">Adicionar Data Comemorativa</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-bottom:0px;">
                    <div class="row">

                        <!-- Nome -->
                        <div class="form-group col-sm-6">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="nome" placeholder="Data Comemorativa" type="text">

                            </div>
                            <p class="errorNome text-center alert alert-danger hidden"></p>
                        </div>

                        <!-- Data de Nascimento -->
                        <div class="form-group col-sm-6">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control" placeholder="Data Comemorativa" name="data_comemorativa" type="date">

                            </div>
                            <p class="errorDtComemorativa text-center alert alert-danger hidden"></p>
                        </div>



                    </div>
                </div>

                <div class="modal-footer" style="padding-top: 0px !important;display: flex !important;padding-bottom: 20px !important;padding-right: 20px !important;">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $("#formDataComemorativa").on('submit', function(event){
        $('#loader').show();
        $('.errorNome').addClass('hidden');
        $('.errorDtComemorativa').addClass('hidden');

        event.preventDefault();

        console.log('ok');

        $.ajax({
            type: 'POST',
            url: "{{ route('backend.data-comemorativa.salvar') }}",
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                $('#loader').hide();
                toastr.success(data.nome + ' adicionado com sucesso!', 'Sucesso', {timeOut: 5000});


                //limpa o form
                //$('#mdlDataComemorativa').modal('hide');
                $("#formDataComemorativa")[0].reset();


            },
                error: function (request, status, error) {

                    var data = $.parseJSON(request.responseText);
                    $('#loader').hide();
                    setTimeout(function () {
                        toastr.error('ERROS de Validação!', 'Alerta de Erro', {timeOut: 5000});
                    }, 500);
                    if (data.errors.nome) {
                        $('.errorNome').removeClass('hidden');
                        $('.errorNome').text(data.errors.nome);
                    }
                    if (data.errors.data_comemorativa) {
                        $('.errorDtComemorativa').removeClass('hidden');
                        $('.errorDtComemorativa').text(data.errors.data_comemorativa);
                    }
                }
        });//ajax
    });
</script>
