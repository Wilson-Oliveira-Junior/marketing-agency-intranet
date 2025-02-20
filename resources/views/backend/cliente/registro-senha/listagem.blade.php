@extends('layouts.app-backend')

@section('style')
    <style>
        /* Modal Registro de Senha */
            .modal-registro-senha{
                max-width: 70% !important;
            }

            /* Título do Modal */
            .titulo-formulario{
                font-size: 20px !important;
                color: #FFF !important;
                font-weight: 900;
                text-transform: capitalize;
                background-color: #4e5bc3 !important;
                border-bottom: 1px solid #4e5bc3;
            }
            .titulo-formulario i{
                background-color: #FFF;
                color: #4d57c6;
                padding: 6px;
                font-size: 15px;
                margin-right: 5px;
                border-radius: 50%;
                margin-left: 5px;
            }
        /* Modal Registro de Senha */

        .avatar-group .avatar+.avatar {
            margin-left: -5px !important;
        }
        .media-body{
            font-size: 15px;
            letter-spacing: -1px;
            font-weight: bold;
        }
        .media-body span{
            font-size: 9px;
            margin-left: 5px;
            letter-spacing: 0px;
            font-weight: 100;
        }
        .busca-rapida{
            float: left;
            width: 30%;
            margin-top: -5px;
            margin-bottom: -20px;
            border: 1px solid #eaeaea;
            border-radius: 5px;
        }
        .busca-rapida .input-group{
            height: 40px;
            padding-top: 0px;
        }
        .busca-rapida input{
            padding-top: 0px;
            color: #a2a2a2;
            height: 40px;
            padding-bottom: 0px;
        }
        .divisao2{
            margin-right: 15px;
            position: relative;
            padding-left: 50px;
        }
        .divisao2 img{
            position: absolute;
            left: 0px;
        }
        .bloco th{

        }
        .bloco td{

        }
        .detalhamento-tabela{

        }
        .detalhamento-tabela .title-td{
            padding: 0px !important;
            background-color: #f8f9fe;
            position: relative;
        }
        .detalhamento-tabela thead{
            border-bottom: 1px dashed #999;
        }
        .fechar-botao{
            background-color: #fe2828;
            border: 1px solid #fe2828 !important;
            color: #FFF;
            padding: 15px 8px !important;
            padding-top: 10px !important;
            font-size: 25px !important;
            border-radius: 50px !important;
            line-height: 0px !important;
            font-weight: 100 !important;
            position: absolute !important;
            margin-left: 20px;
            height: 0px;
            top: 10px;
        }
        .btn-detalhes{
            background-color: #00cdf5;
            border: 2px solid #00cdf3 !important;
            color: #ffffff;
            border-radius: 30px !important;
            width: 34px;
            font-size: 25px !important;
            height: 35px;
            line-height: 23px !important;
            padding-left: 3px !important;
        }
        .loading {display:none;}
        .loading img{
            margin-top: -24px;
        }

    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cliente') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Listagem de Cliente
    </a>
@endsection

@section('content')
    <div class="col">

        <div class="card shadow">

            <div class="card-header border-0">
                <h3 class="mb-0" style="float: left;width: 70%;">Registros de Senha</h3>

                <!-- Busca Rápida -->
                <div class="form-group mb-0 busca-rapida">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                        </div>
                        <input id="txtBusca" class="form-control" name="busca-cliente" placeholder="Buscar Cliente..." type="text" style="color: #a2a2a2;">
                    </div>
                </div>

            </div>

            <div class="table-responsive">
                <table class="table align-items-center table-flush">

                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="contacts" style="width:50px;">Ação</th>
                            <th scope="col" class="sort" data-sort="name">Nome do Cliente (domínio)</th>
                            <th scope="col" class="sort" data-sort="name">Visualizar mais Detalhes</th>
                        </tr>
                    </thead>

                    <tbody class="list">

                        @foreach($clientes as $cliente)
                            @if($cliente->registroDeSenha->count() > 0)
                                <tr class="bloco">
                                    <!-- Editar -->
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                @can('editar_cliente')
                                                    <a class="dropdown-item" href="{{ route('backend.cliente.editar',$cliente->id) }}">
                                                        Editar
                                                    </a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Cliente -->
                                    <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                {{ $cliente->nome_fantasia }} <span>({{ $cliente->nome }})</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Botão Ver mais Detalhes -->
                                    <td>
                                        <button class="btn btn-sm btn-detalhes botao-ver-detalhes" id="botao{{ $cliente->id }}" data-id="{{$cliente->id}}"><i class="ni ni-fat-add"></i></button>
                                    </td>

                                </tr>

                                <tr class="detalhamento-tabela detalhamento-tabela-botao{{ $cliente->id }}">

                                    <td class="title-td"></td>

                                    <td class="title-td">
                                        <div class="table-responsive" id="conteudo-{{$cliente->id}}">

                                        </div>
                                    </td>

                                    <td class="title-td"></td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            $("#txtBusca").keyup(function(){
                var texto = $(this).val();
                $(".bloco").each(function(){
                    var resultado = $(this).text().toUpperCase().indexOf(' '+texto.toUpperCase());
                    if(resultado < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">

            $(".detalhamento-tabela*").hide();

            $(".btn-solicita-alteracao").click(function(){
                $id = $(this).attr('data-id');
                //alert($id);

                var $dados = {
                    idRegistroSenha   : $id,
                    _token      : '{{ csrf_token() }}'
                }

                $.post("{{ route('backend.cliente.editarRegistroSenhaAprovacao') }}", $dados, function($retorna){
                    //alert($retorna.strLogin);
                    $('#modal-form-'+ $id + ' input#alt-login').val($retorna.strLogin);
                    $('#modal-form-'+ $id + ' input#alt-senha').val($retorna.strSenha);
                    $('#modal-form-'+ $id + ' input#alt-url').val($retorna.strURL);
                    $('#modal-form-'+ $id + ' input#alt-idregistrosenha').val($retorna.idRegistroSenha);
                    //$("#visualizarEventoModal").modal("show");
                    //$("#visualizarDetalhesEvento").html(retorna);
                });

            }

            );

            $(document).on('click', '.botao-ver-detalhes', function(){
                $id = $(this).attr('id');
                idcliente = $(this).data('id');
                console.log(idcliente);

                if( $("#" + $id + " i").hasClass("ni-fat-add") ) {

                    $("#" + $id + " i").removeClass("ni-fat-add");
                    $("#" + $id + " i").addClass("ni-fat-delete");

                    //TO DO: Ajax pra puxar os registros de senha.
                    var url = "/backend/clientes/registro-senha/listagem-por-cliente/:idcliente";
                    url = url.replace(':idcliente', idcliente);

                    $.ajax({
                        type: 'GET',
                        url: url,
                        dataType:'HTML',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {

                            $("#conteudo-" +idcliente).html(data);
                            $(".detalhamento-tabela-" +$id).fadeIn();
                        },
                    });//ajax


                }else if( $("#" + $id + " i").hasClass("ni-fat-delete") ) {
                    $("#" + $id + " i").addClass("ni-fat-add");
                    $("#" + $id + " i").removeClass("ni-fat-delete");
                    $(".detalhamento-tabela-" +$id).fadeOut();

                }

            });

            $(".fechar-botao").click(function(){
                $id = $(this).attr('id');
                $botaonome = $id.replace('fechar','');
                //alert($botaonome);
                $("#" + $botaonome + " i").addClass("ni-fat-add");
                $("#" + $botaonome + " i").removeClass("ni-fat-delete");
                $(".detalhamento-tabela-" +$botaonome).fadeOut();

            });

            $('.btn-solicita-aprovacao').click(function(){
                $id = $(this).attr('data-id');
                $(".msg-loading-" + $id).removeClass("loading");

                $( "#formEditarAprovacao" + $id ).submit(function(event) {


                    event.preventDefault();

                    $.ajax({
                    type: 'POST',
                    url: '/backend/clientes/registro-senha/atualizar-solicitacao/',
                    data: new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {

                        if ((data.errors)) {
                            alert('Falha');
                        }else{
                            $(".msg-loading-" + data).addClass("loading");
                            $("#modal-form-" + data).modal("hide");
                            $("#solicitacao-senha-" +data).show();
                        }
                    }
                });
                });

            });

        </script>


@endsection
