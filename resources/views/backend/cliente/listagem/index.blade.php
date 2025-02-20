@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cliente') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Listagem de Cliente
    </a>
@endsection

@section('style')
    <style>
        /*.avatar{
            font-size: 10px !important;
            width: 35px !important;
            height: 35px !important;
            background-color: #5e6fe5 !important;
        }*/
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
    </style>
@endsection

@section('content')
    <div class="col">

        <div class="card shadow">

            <div class="card-header border-0">
                <h3 class="mb-0" style="float: left;width: 70%;">Listagem de Cliente</h3>

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
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-spaceship text-orange"></i></span>
                                    </div>
                                    <input class="form-control" name="nome_cliente" type="text" value="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-sm-4">
                            <div class="form-group col-sm-12">
                                <label>Tipo de Projeto</label>
                                <div class="input-group input-group-alternative mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-palette text-yellow"></i></span>
                                    </div>
                                    <select name="idtipoprojeto" id="idtipoprojeto" class="form-control">
                                        <option value="">Selecione</option>
                                        @foreach ($tipoprojetos as $tipoprojeto)
                                            <option value="{{$tipoprojeto->id}}">{{$tipoprojeto->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-3">
                            <div class="form-group col-sm-12">
                                <label>Contato</label>
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-bell-55 text-blue"></i></span>
                                    </div>
                                    <input class="form-control" name="nome_contato" type="text" value="">
                                </div>
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
<div class="row">
    <div class="col">
        <div class="card shadow" id="listagem-clientes">
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
                                    <button class="btn btn-sm btn-detalhes botao-ver-detalhes" id="botao{{ $cliente->id }}"><i class="ni ni-fat-add"></i></button>
                                </td>

                            </tr>

                            <tr class="detalhamento-tabela detalhamento-tabela-botao{{ $cliente->id }}">

                                <td class="title-td">
                                    <button class="btn fechar-botao" id="fecharbotao{{ $cliente->id }}">
                                        -
                                    </button>
                                </td>

                                <td class="title-td">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" class="sort" data-sort="contacts" style="width:80px;">Financeiro</th>
                                                    <th scope="col" class="sort" data-sort="name">Contatos</th>
                                                    <th scope="col" class="sort" data-sort="name">Serviços</th>
                                                    <th scope="col" class="sort" data-sort="name">Domínio</th>
                                                </tr>
                                            </thead>

                                            <tbody class="list">

                                                <tr>

                                                    <!-- Financeiro -->
                                                    @if($cliente->status_financeiro > 0)
                                                        <td class="budget">
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-warning"></i>
                                                                <span class="status">Pendente</span>
                                                            </span>
                                                        </td>
                                                    @else
                                                        <td class="budget">
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i>
                                                                <span class="status">Em Dia</span>
                                                            </span>
                                                        </td>
                                                    @endif

                                                    @include('backend.cliente.listagem.contatos')

                                                    @include('backend.cliente.listagem.projetos')

                                                    <!-- Domínios -->
                                                    <td>
                                                        <div class="avatar-group">
                                                            @foreach($cliente->dominios as $registro_dominio)
                                                                <a href="#" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $registro_dominio->dominio }}">
                                                                    <img alt="{{ $registro_dominio->dominio }}" src="{{ asset('img/icones-clientes/icone-dominio.png') }}">
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                </td>

                                <td class="title-td"></td>
                            </tr>
                            @include('backend.cliente.listagem.responsaveis')
                            @if (Auth::id() == 3)
                                @include('backend.cliente.conta-azul.parcelas')
                            @endif
                        @endforeach

                    </tbody>

                </table>
            </div>
            <div class="card-footer py-4">
                {!! $clientes->links() !!}
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript">


        //$(".detalhamento-tabela{{ $cliente->id }}").hide();
        $(".detalhamento-tabela*").hide();

        $(".botao-ver-detalhes").click(function(){
            $id = $(this).attr('id');

            if( $("#" + $id + " i").hasClass("ni-fat-add") ) {

                $("#" + $id + " i").removeClass("ni-fat-add");
                $("#" + $id + " i").addClass("ni-fat-delete");
                $(".detalhamento-tabela-" +$id).fadeIn();

            }else if( $("#" + $id + " i").hasClass("ni-fat-delete") ) {
                $("#" + $id + " i").addClass("ni-fat-add");
                $("#" + $id + " i").removeClass("ni-fat-delete");
                $(".detalhamento-tabela-" +$id).fadeOut();

            }else{

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

        $('#formFiltro').on('submit', function(event) {
            $('#div-loader').removeClass('hidden');
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('backend.cliente.listagem.filtro') }}",
                data: new FormData(this),
                dataType:'HTML',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#div-loader').addClass('hidden');
                    $("#listagem-clientes").html(data);
                },
            });//ajax
        });//formsubmit

    </script>


@endsection
