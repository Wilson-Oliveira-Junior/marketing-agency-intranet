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

    <!-- Favicon -->
    <link href="{{ asset('img/icone-logica-19x19.png') }}" rel="icon" type="image/png">

    <!-- Icons -->
    <link href="{{ asset('dashboard/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('dashboard/css/argon.css?v=1.0.0') }}" rel="stylesheet">

    <style>
      .navbar-horizontal .navbar-brand img {
        height: 70px;
      }
      @media (max-width: 768px) {

      }
    </style>
</head>

<body class="" style="background-color:#0a0a43;">
  <div class="main-content">

    @include('layouts.login.nav')

    @include('layouts.login.header')

    @yield('content')

  </div>


  @include('layouts.login.footer')

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>
