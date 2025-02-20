@extends('layouts.app-backend')

@section('style')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        .collapse-table-detalhes, .collapse-table-contato{
            background-color: transparent;
            border: none;
            color: #16294e;
            font-size: 20px;
            float: right;
            cursor: pointer;
            width: 25px;
            padding: 0px;
        }
        .nav-pills .nav-link{
            background-color: #5e6ee6 !important;
            color: #FFF !important;
            border: 1px solid #5e6ee6;
            border-radius: 0px !important;
            box-shadow: none !important;
        }
        .nav-item .active{
            background-color: #ffffff !important;
            color: #5e6ee6 !important;
            box-shadow: inset -1px -1px 10px -4px rgba(0,0,0,0.75) !important;
        }
        .titulo-formulario {
            border: 0px dashed #5d6ae8;
        }
        #segmentos-conteudo-id{
            float: none !important;
            position: absolute;
            z-index: 1000;
            margin-top: 24%;
            width: 400px;
            list-style: none;
            display: none;
            padding-left: 0px;
            background-color: #FFF;
            margin-bottom: 0px !important;
            overflow-x: hidden;
            overflow-y: auto;
            max-height: 165px;
            border: 1px solid #ccc;
        }
        .valor_input{
            border: 1px solid #CCCC !important;
            margin-top: 7px !important;
        }
        #segmentos-conteudo-id li{
            width: 100%;
            border-bottom: 1px solid #000;
            cursor: pointer;
            color: #737373;
            padding: 10px;
            float: left;
            margin: 0px;
            line-height: 10px;
            padding-left: 20px;
            transition: all .3s linear;
        }
        #segmentos-conteudo-id li:hover{
            background-color: #5e6de7;
            color: #FFF;
        }
        #segmentos-conteudo-id li .nome{
            float: left;
            width: 70%;
        }
        .visible {
            display: block !important;
        }
        #segmentos-conteudo-id li .estimativa{
            width: 25%;
            float: right;
            text-align: right;
            font-size: 11px;
            padding-top: 5px;
            color: #b3b3b3;
        }
        .imagem-carregamento{
            display:none;
            width: 100%;
        }
        .search-segmentos{
            display:none;
            position: absolute;
            width: 100%;
            margin-top: 0px;
            background-color: #eaeaea;
            padding: 10px 16px;
            z-index: 10000;
            border: 1px solid #CCC;
        }
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cliente') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Clientes
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Editando Cliente
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Visualizando Informações do {{ isset($clientes->nome_fantasia)?$clientes->razao_social:$clientes->nome }}</h3>
                @can('adicionar_dominio_cliente')
                <a href="{{ route('backend.cliente.adicionarDominio', $clientes->id) }}" class="btn btn-info" style="margin-top: 15px;">Adicionar Domínio</a>
                @endcan
                @can('adicionar_contato_cliente')
                <a href="{{ route('backend.cliente.adicionarContato', $clientes->id) }}" class="btn btn-info" style="margin-top: 15px;">Adicionar Contato</a>
                @endcan
                @can('adicionar_projetos')
                <a href="{{ route('backend.cliente.adicionarProjeto', $clientes->id) }}" class="btn btn-info" style="margin-top: 15px;">Adicionar Projeto</a>
                @endcan

                @can('adicionar_registro_senhas')
                    <a href="{{ route('backend.cliente.adicionarRegistroSenha', $clientes->id) }}" class="btn btn-info" style="margin-top: 15px;">Adicionar Registro de Senha</a>
                @endcan

				@can('adicionar_cliente_responsavel')
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#mdlResponsaveisInternos" style="margin-top: 15px;">Adicionar Responsável</a>
                @endcan

                @can('deletar_cliente')
                <a onclick="return confirm('Deletar esse registro?');" href="{{ route('backend.cliente.deletar',$clientes->id) }}" class="btn btn-danger" style="margin-top: 15px;">Apagar Cliente</a>
                @endcan
            </div>

            <div class="nav-wrapper" style="background-color: #5d6ce8;padding: 0px;">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item" style="padding-right: 0px;">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                            <i class="ni ni-cloud-upload-96 mr-2"></i>
                            Informações
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                            <i class="ni ni-bell-55 mr-2"></i>
                            Contatos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">
                            <i class="fa fa-link mr-2"></i>
                            Domínios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">
                            <i class="ni ni-planet mr-2"></i>
                            Projetos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false">
                            <i class="ni ni-key-25 mr-2"></i>
                            Registro de Senhas
                        </a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-6-tab" data-toggle="tab" href="#tabs-icons-text-6" role="tab" aria-controls="tabs-icons-text-6" aria-selected="false">
                            <i class="ni ni-single-02 mr-2"></i>
                            Responsáveis Internos
                        </a>
                    </li>
					@can('listar_historico_financeiro')
						@if(count($clientes->contaazul_vendas)>0)
							<li class="nav-item">
		                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-7-tab" data-toggle="tab" href="#tabs-icons-text-7" role="tab" aria-controls="tabs-icons-text-7" aria-selected="false">
		                            <i class="ni ni-money-coins mr-2"></i>
		                            Histórico Financeiro
		                        </a>
		                    </li>
						@endif
					@endcan

                </ul>
            </div>

            <div class="card shadow">
                <div class="card-body" style="padding: 0px;">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            @include('backend.cliente.editar.formulario')
                        </div>

                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            @include('backend.cliente.editar.contatos')
                        </div>

                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            @include('backend.cliente.editar.dominios')
                        </div>

                        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                            @include('backend.cliente.editar.projetos')
                        </div>

                        <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                            @include('backend.cliente.editar.registro-senhas')
                        </div>

						<div class="tab-pane fade" id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
                            @include('backend.cliente.editar.responsaveis-internos')
                        </div>
						@can('listar_historico_financeiro')
							@if(count($clientes->contaazul_vendas)>0)
								<div class="tab-pane fade" id="tabs-icons-text-7" role="tabpanel" aria-labelledby="tabs-icons-text-7-tab">
		                            @include('backend.cliente.editar.historico-financeiro')
		                        </div>
							@endif
						@endcan
                    </div>
                </div>
            </div>

        </div>
    </div>
	@include('backend.cliente.mdl-responsaveis-internos')
@endsection

@section('script')
    <!-- Funções para validação de CPF e CNPJ -->
    <script src="{{ asset('js/validar_cpf_cnpj/valida_cpf_cnpj.js') }}"></script>

    <!-- Pressionando teclas -->
    <script src="{{ asset('js/validar_cpf_cnpj/exemplo_2.js') }}"></script>

    <script src="{{ asset('js/mascara.js') }}" type="text/javascript"></script>
    <script>
        // Mascara no campo de CNPJ
        $(document).ready(function(){
            //$("#cnpj").mask("99.999.999/9999-99");
            $("#cep").mask("99999-999");
        });
    </script>

    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#campo_logradouro").val("");
                $("#campo_bairro").val("");
                $("#campo_cidade").val("");
                $("#campo_estado").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#campo_logradouro").val("...");
                        $("#campo_bairro").val("...");
                        $("#campo_cidade").val("...");
                        $("#campo_estado").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#campo_logradouro").val(dados.logradouro);
                                $("#campo_bairro").val(dados.bairro);
                                $("#campo_cidade").val(dados.localidade);
                                $("#campo_estado").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>
@endsection
