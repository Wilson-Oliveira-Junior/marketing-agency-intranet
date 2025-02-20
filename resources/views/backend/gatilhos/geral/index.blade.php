@extends('layouts.app-backend')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.6/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{asset('css/select2-bootstrap-5-theme.min.css')}}" />
    <style>
    .col-lg-4 .card:hover{
        box-shadow: 0px 7px 30px -5px rgba(0,0,0,0.75);
        transition: all .2s linear;
    }
    .col-lg-4 .list-group{
        float: left;
        display: inherit;
        width: 100%;
    }
    .card-body .list-group-item{
        float: left;
        width: 48%;
        margin-right: 2%;
        border: none;
        position: inherit;
    }
    .atendimento-em-dia{
            background-color: #1bce87;
            border-radius: 2px;
            color: #FFF;
            padding: 5px 10px;
            font-weight:bold;
            font-size: 10px;
        }
    .entrar-em-contato{
        background-color: #da4c2a;
        border-radius: 2px;
        color: #FFF;
        font-weight:bold;
        padding: 5px 10px;
        font-size: 10px;
    }

    .btn-play{
        background-color: #76c33b;
    }
    .btn-pause{
        background-color:#f79300;
    }

    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Listagem de Gatilhos
    </a>
@endsection

@section('content')
<div class="col">

    <div class="card shadow">

        <div class="card-header border-0">
            <h3 class="mb-0" style="float: left;width: 70%;">Gatilhos</h3>

            <!-- Busca Rápida
            <div class="form-group mb-0 busca-rapida">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                    </div>
                    <input id="txtBusca" class="form-control" name="busca-cliente" placeholder="Buscar Cliente..." type="text" style="color: #a2a2a2;">
                </div>
            </div>-->

        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Filtro</h3>
            </div>
            <form method="post" id="formFiltro" style="align-items: center;display: flex;flex-wrap: wrap;">
                @csrf
                <div class="row col-sm-12">


                    <div class="form-group col-sm-4">
                        <div class="form-group col-sm-12">
                            <label>Cliente</label>
                            <select name="idcliente" id="idcliente" class="form-control">
                                <option value="">Selecione</option>
                                @foreach ($projetosgatilhos as $projeto)
                                    <option value="{{ $projeto->id_projeto }}">{{ $projeto->projetos[0]->cliente->nome_fantasia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-sm-4">
                        <div class="form-group col-sm-12">
                            <label>Tipo de Projeto</label>
                            <select name="idtipoprojeto" id="idtipoprojeto" class="form-control">
                                <option value="">Selecione</option>
                                @foreach ($tipoprojetos as $tipoprojeto)
                                    <option value="{{ $tipoprojeto->id }}">{{ $tipoprojeto->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="form-group col-sm-12">
                            <label>Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="E" selected="selected">Em andamento</option>
                                <option value="F">Finalizados</option>
                                <option value="P">Pausados</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="form-group col-sm-12">
                            <label></label>
                            <div class="input-group input-group-alternative mb-3">
                                <input type="submit" class="btn btn-info" value="Filtrar">
                            </div>
                        </div>
                    </div>
                    <div class="row hidden" id="div-loader">
                        <div class="col-lg-12">
                            <img src="{{asset('img/loading.gif')}}" /> Carregando...
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="card shadow" id="listagem-gatilhos">

        </div>
    </div>
</div>
@include('backend.gatilhos.geral.mdl-comentario')
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
    $("select#idtipoprojeto").select2({
        theme: "bootstrap-5"
    });
    $("select#idcliente").select2({
        theme: "bootstrap-5"
    });
    $("select#status").select2({
        theme: "bootstrap-5"
    });
    $(document).on('select2:open', () => {
        document.querySelector('.select2-container--open .select2-search__field').focus();
    });
    $('#formFiltro').on('submit', function(event) {
            $('#div-loader').removeClass('hidden');
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('backend.gatilhos.geral.filtro') }}",
                data: new FormData(this),
                dataType:'HTML',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#div-loader').addClass('hidden');
                    $("#listagem-gatilhos").html(data);
                },
            });//ajax
        });//formsubmit

        $.ajax({
            type: 'POST',
            url: "{{ route('backend.gatilhos.geral.filtro') }}",
            data: new FormData(document.getElementById('formFiltro')),
            dataType:'HTML',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#div-loader').addClass('hidden');
                $("#listagem-gatilhos").html(data);
            },
        });//ajax

        $(document).on('click', '.btn-status', function(){
            id = $(this).data('id');
            status = $(this).data('status');
            msg = (status == 'E')?'Tem certeza que deseja pausar este projeto?':'Tem certeza que deseja voltar o projeto?';
            if(confirm(msg)){
                //TO DO: Ajax
                var fd = new FormData();
                fd.append('id_projeto', id);

                var url = "/backend/gatilhos/pausar-projeto";

                //TO DO: AJAX puxando a listagem das tarefas de priorizacao.
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: fd,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        //$('#div-loader').addClass('hidden');
                        //console.log(data);
                        if(status == 'E'){
                            $("#icon-"+id).removeClass('fa-pause');
                            $("#icon-"+id).addClass('fa-play');
                            $("#btnstatus-"+id).addClass('btn-play');
                            $("#btnstatus-"+id).removeClass('btn-pause');
                            $("#btnstatus-"+id).data('status', 'P');
                            msgnotificacao = 'Projeto pausado com sucesso.';
                        }else{
                            $("#icon-"+id).removeClass('fa-play');
                            $("#icon-"+id).addClass('fa-pause');
                            $("#btnstatus-"+id).addClass('btn-pause');
                            $("#btnstatus-"+id).removeClass('btn-play');
                            $("#btnstatus-"+id).data('status', 'E');
                            msgnotificacao = 'Projeto voltando para gatilhos com sucesso.';
                        }

                        toastr.success(msgnotificacao, 'Sucesso', {timeOut: 5000});
                    },
                });//ajax
            }

            return false;
        });

        $(document).on('click', '.btn-comentario', function(){

            id = $(this).data('id');
            url = "{{ route('backend.gatilhos.ultimo-comentario', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                data: {},
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#div-loader').addClass('hidden');

                    //console.log(data.mensagem.comentario);
                    $("#ultimoComentario").text(data.mensagem.comentario);
                },
            });//ajax
            $('#idprojeto').val(id);
            $('#mdlComentario').modal('show');

        });

        $('#formComentario').on('submit', function(event){
            $('#loader').show();
            event.preventDefault();
            vurl = "/backend/gatilhos/projeto/registrar-comentario";

            $.ajax({
                type: 'POST',
                url: vurl,
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    $('.errorObservacao').addClass('hidden');
                    $('#loader').hide();

                    toastr.success('Comentário adicionado no projeto com sucesso!', 'Sucesso', {timeOut: 5000});
                    $("#status-" + data.id_projeto).empty();
                    $("#status-" + data.id_projeto).append('<span class="atendimento-em-dia">ATENDIMENTO EM DIA</span>');
                    $("#formComentario")[0].reset();
                    $('#mdlComentario').modal('hide');
                },
                error: function (request, status, error) {

                    var data = $.parseJSON(request.responseText);

                    setTimeout(function () {
                        toastr.error('ERROS de Validação!', 'Alerta de Erro', {timeOut: 5000});
                    }, 500);
                    if (data.errors.comentario) {
                        $('.errorObservacao').removeClass('hidden');
                        $('.errorObservacao').text(data.errors.comentario);
                        $('#loader').hide();
                    }
                }
            });
        });
</script>
@endsection


