<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lógica Digital - Intranet</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://sistema.contatto.com.br:18030/css/backend/dist/css/AdminLTE.min.css">

    <!-- Favicon -->
    <link href="{{ asset('img/icone-logica.png') }}" rel="icon" type="image/png">

    <!-- Icons -->
    <link href="{{ asset('dashboard/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('dashboard/css/argon.css?v=1.0.0') }}" rel="stylesheet">

    <style>
        .navbar-vertical.navbar-expand-md .navbar-nav .nav-link{
            font-weight: 600;
        }
        .titulo-formulario{
            padding-left: 23px !important;
            font-size: 13px;
            color: #828282;
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
    </style>
</head>

<body>
  
    @include('layouts.dashboard.nav-mobile')

    <div class="main-content">
    
        @include('layouts.dashboard.nav')

        @include('layouts.dashboard.header-perfil')

        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                @include('backend.perfil.esquerda')
                @include('backend.perfil.direita')
            </div>
        
            @include('layouts.dashboard.footer')

        </div>
    </div>


    <!--<script src="{{ asset('dashboard/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  
    <script src="{{ asset('dashboard/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/chart.js/dist/Chart.extension.js') }}"></script>

    <script src="{{ asset('dashboard/js/argon.js') }}"></script>-->

    @yield('script')
</body>

</html>