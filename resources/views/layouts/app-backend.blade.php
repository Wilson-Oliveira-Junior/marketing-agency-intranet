<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lógica Digital - Intranet</title>

    <!-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="https://kit.fontawesome.com/98affa4f14.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/icone-logica-19x19.png') }}" rel="icon" type="image/png">

    <!-- Icons -->
    <link href="{{ asset('dashboard/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    @yield('style')

    <link href="{{ asset('css/tarefa.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tarefa_nova.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.6/dist/css/bootstrap-select.min.css">
    <!-- Include stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <!--<script src="https://cdn.tiny.cloud/1/v2yekotwhmraymhy9vhq7qdnivn2s48q3gdwrtifj8q6ekp4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
    <script>
        /*tinymce.init({
            selector: '#mytextarea',
            branding: false,
            width: '100%',
            language: 'pt_BR',
            menubar: false
        });

        tinymce.init({
            selector: '#mytextareatarefa',
            branding: false,
            width: '100%',
            language: 'pt_BR',
            menubar: false
        });

        tinymce.init({
            selector: '#mytextareacomentario',
            branding: false,
            width: '100%',
            language: 'pt_BR',
            menubar: false
        });*/
    </script>

    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('dashboard/css/argon.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('dashboard/css/argon.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/botao-floating.css') }}" rel="stylesheet">

    <!-- CSS MOBILE -->
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}" media="screen and (max-width: 768px)">

    <!-- CSS MOBILE -->
    <link rel="stylesheet" href="{{ asset('css/mobile-oficial.css') }}" media="screen and (max-width: 768px)">

    <style>
        #editor{height:300px;}
        .ql-editor{width:100%;}
        #sidenav-main{
            position: absolute;
            top: 0;
            left: 0;
            bottom: auto;
            padding-top: 25px;
            min-height: 100%;
            width: 250px;
            z-index: 810;
            -webkit-transition: -webkit-transform .3s ease-in-out,width .3s ease-in-out;
            -moz-transition: -moz-transform .3s ease-in-out,width .3s ease-in-out;
            -o-transition: -o-transform .3s ease-in-out,width .3s ease-in-out;
            transition: transform .3s ease-in-out,width .3s ease-in-out;
        }
        .card-ramal{
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: wrap;
            flex: none;
        }
        .ramal{
            flex-basis: 150px;
            margin-bottom: 1em;
        }
        .ramal i{
            color: #FFF;
            font-size: 11px;
            border-radius: 15px;
            padding: 6px;
        }

        .ramal-marketing i{
            background: #f83159;
        }
        .ramal-atendimento i{
            background: #ffd700;
        }
        .ramal-comercial i{
            background: #00cdf1;
        }
        .ramal-criacao i{
            background:pink;
        }
        .ramal-adm i{
            background: #5e6de7;
        }
        .ramal-dev i{
            background: #20ce88;
        }

        #collapse-wiki{
            padding: 0px;
            position: absolute;
            right: 25px;
            top: 22px;
        }

        .collapse-table-wiki, .collapse-table-niver, .collapse-table-dtcomemorativa, .collapse-table-pautas{
            background-color: transparent;
            border: none;
            color: #16294e;
            font-size: 20px;
            float: right;
            cursor: pointer;
            width: 25px;
            padding: 0px;
        }

        .botao-dev, .botao-dev:hover{
            background-color: #00ce86;
            border-color: #00ce86;
            color: #FFF;
        }
        .botao-atendimento, .botao-atendimento:hover{
            background-color: #ffd700;
            border-color: #ffd700;
            color: #FFF;
        }
        .botao-comercial, .botao-comercial:hover{
            background-color: #00cdf1;
            border-color: #00cdf1;
            color: #FFF;
        }
        .botao-marketing, .botao-marketing:hover{
            background-color: #f83159;
            border-color: #f83159;
            color: #FFF;
        }
        .botao-adm, .botao-adm:hover{
            background-color: #5c69eb;
            border-color: #5c69eb;
            color: #FFF;
        }

        .perfil{
            margin-top: -10px;
            font-size: 15px !important;
            color: #FFF !important;
            margin-left: 65px;
            float: left;
        }

        .setor-backlog{
            float: left;
            width: 100%;
            padding: 10px 20px;
            margin-bottom: 10px;
            background-color: #eaeaea;
        }

        .legenda{
            flex-wrap: wrap;
            display: flex;
        }

        .dev, .marketing, .comercial, .atendimento, .adm, .criacao{
            display: flex;
            align-items: center;
            margin-right: 15px;
            margin-top: 30px;
        }
        .dev hr{
            height: 15px;
            width: 15px;
            background-color: #00ce86;
            border-color: #00ce86;
            color: #00ce86;
            margin-right: 5px !important;
            margin: 0px;
        }
        .marketing hr{
            height: 15px;
            width: 15px;
            background-color: #f83159;
            border-color: #f83159;
            color: #f83159;
            margin-right: 5px !important;
            margin: 0px;
        }
        .comercial hr{
            height: 15px;
            width: 15px;
            background-color: #00cdf1;
            border-color: #00cdf1;
            color: #00cdf1;
            margin-right: 5px !important;
            margin: 0px;
        }
        .atendimento hr{
            height: 15px;
            width: 15px;
            background-color: #ffd700;
            border-color: #ffd700;
            color: #ffd700;
            margin-right: 5px !important;
            margin: 0px;
        }
        .adm hr{
            height: 15px;
            width: 15px;
            background-color: #5c69eb;
            border-color: #5c69eb;
            color: #5c69eb;
            margin-right: 5px !important;
            margin: 0px;
        }
        .criacao hr{
            height: 15px;
            width: 15px;
            background-color: pink;
            border-color: pink;
            color: pink;
            margin-right: 5px !important;
            margin: 0px;
        }

        .header-nova-tarefa-botao{
            background-color: #28d384;
            color: #FFF;
            padding: 11px 22px;
            border: 1px solid #11d482;
            font-size: 15px;
            border-radius: 5px;
            margin-right: 0px !important;
            font-weight: 600;
            text-transform: uppercase;
        }
        .header-nova-tarefa-botao:hover{
            color:#FFF !important;
        }
        .navbar-vertical.navbar-expand-md .navbar-nav .nav-link{
            font-weight: 600;
        }
        .titulo-formulario{
            padding-left: 23px !important;
            font-size: 13px;
            color: #828282;
            width:100%;
            background-color: #f3f3f3;
            padding: 10px;
            margin-bottom: 25px;
        }
        .pagination{
            float: right;
        }
        .search-cliente{
            width: 33%;
            float: right;
            margin-top: -15px;
            margin-bottom: -10px;
            margin-right: -15px !important;
        }
        .search-cliente ::-webkit-input-placeholder {
            color: #a2a2a2 !important;
        }
        .search-cliente ..navbar-search-dark .input-group {
            border-color: rgba(226, 226, 226, 0.6);
        }
        .add-lembrete{
            background-color: #fff;
            padding: 15px;
            float: right;
            font-size: 13px;
            color: #815ee4;
            text-transform: uppercase;
            transition: all .3s linear;
            border: 2px solid #FFF;
            font-weight: bold;
            margin-left: 25px;
            border-radius: 5px;
        }
        .add-lembrete:hover{
            background-color: #815ee4;
            color: #FFF;
        }

        .linha-lembrete:hover{
            box-shadow: -1px 2px 20px -5px rgba(0,0,0,0.75);
        }
        .btn-file{
            border: 1px solid #CCC;
            padding: 0px 10px;
            height: 45px;
            background-color: #d52d28;
        }
        .btn-file img{
            width: 40px;
            height: 40px;
        }
        .btn-null{
            border: 1px solid #CCC;
            padding: 0px 10px;
            height: 45px;
            background-color: #000;
        }
        .btn-null img{
            width: 40px;
            height: 40px;
        }
        @media (max-width: 768px) {
            #sidenav-main{
                position: inherit;
                width:100%;
            }
        }
    </style>
</head>

<body>
    @if(Session::has('flash_concluir'))
        <div class="concluir-tareda">
            <div class="teste">
            <p>
                    <span style="color:#e83126">P</span>
                    <span style="color:#3e6bb2">A</span>
                    <span style="color:#ffdc0e">R</span>
                    <span style="color:#a5d0e1">A</span>
                    <span style="color:#ed7406">B</span>
                    <span style="color:#3f6bae">É</span>
                    <span style="color:#e6322c">N</span>
                    <span style="color:#fedf00">S</span>
                </p>
            </div>
        </div>
    @endif

    @if(Session::has('flash_mensagem'))
        <div class="container-flash" style="display: flex;align-items: center;justify-content: center;">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: absolute;z-index: 1000;top: 0px;width: 55%;{{ Session::get('flash_mensagem')['class'] }}">
                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-inner--text"><strong>{{ Session::get('flash_mensagem')['msg'] }}</strong></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif

    @include('layouts.dashboard.nav-mobile')

    <div class="main-content">

        @include('layouts.dashboard.nav')

        @include('layouts.dashboard.header')

        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                @yield('content')
            </div>

            @include('layouts.dashboard.footer')
        </div>

    </div>

    <!-- Core -->
    <script src="{{ asset('dashboard/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Argon JS -->
    <script src="{{ asset('dashboard/assets/js/argon.min.js') }}"></script>

    <a href="#" class="float" id="menu-share">
		<i class="fas fa-plus my-float"></i>
	</a>

	<ul class="button-floating">
		@can('adicionar_data_comemorativa')
	        <li>
				<a href="#" style="background: linear-gradient(87deg,#f5365c 0,#f56036 100%) !important;" data-toggle="modal" data-target="#mdlDataComemorativa">
					<i class="ni ni-calendar-grid-58 my-float-interno"></i>
	                <span style="width:182px!important;">Data Comemorativa</span>
				</a>
			</li>
        @endcan
        <li>
			<a href="#" style="background-color: #805ee3;" data-toggle="modal" data-target="#novapauta">
				<i class="ni ni-building my-float-interno"></i>
                <span>Pauta</span>
			</a>
		</li>
		@can('adicionar_usuario')
            <li>
                <a href="#" style="background-color: #f5365c;" data-toggle="modal" data-target="#usuarioModal">
                    <i class="ni ni-single-02 my-float-interno"></i>
                    <span>Usuário</span>
                </a>
            </li>
        @endcan
        @can('adicionar_cliente')
            <li>
                <a href="#" style="background-color: #fd6237;" data-toggle="modal" data-target="#clienteModal">
                    <i class="ni ni-spaceship my-float-interno"></i>
                    <span>Clientes</span>
                </a>
            </li>
        @endcan
		<li>
			<a href="#" style="background-color: #28d384;" data-toggle="modal" data-target="#novatarefa">
				<i class="ni ni-active-40 my-float-interno"></i>
                <span>Tarefas</span>
			</a>
		</li>
	</ul>
	@can('adicionar_data_comemorativa')
        @include('layouts.dashboard.botao.data_comemorativa')
    @endcan
    <div class="tabs-sub">
		@include('layouts.dashboard.botao.pauta')
    </div>
    @can('adicionar_usuario')
        @include('layouts.dashboard.botao.usuario')
    @endcan

    @can('adicionar_cliente')
        @include('layouts.dashboard.botao.cliente')
    @endcan

    <div class="tabs-sub">
        @include('layouts.dashboard.botao.tarefa')
    </div>

    @include('layouts.dashboard.botao.evento.primeira-evento')
    @include('layouts.dashboard.botao.evento.tipo-evento')
    @include('layouts.dashboard.botao.evento.tipo-tarefa')

    @include('layouts.dashboard.mobile.menu')

    @include('backend.tarefa.conteudo.script')
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    @yield('script')

    <script>
        const toolbarOptions = [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline'],// toggled buttons
            ['link', 'image'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
            [{ 'align': [] }],
            ['clean']// remove formatting button
        ];

        const quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Escreva a descrição da tarefa...',
        theme: 'snow'
        });

        $("#editor").on('click', quill.focus());

        const quillComentario = new Quill('#editorComentario', {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Escreva o comentário da tarefa...',
        theme: 'snow'
        });

        $("#editorComentario").on('click', quill.focus());

        setTimeout(function(){
            $(".concluir-tareda").slideUp();
        }, 2000);
    </script>
</body>

</html>
