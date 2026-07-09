<link type="text/css" href="{{ asset('css/menu-novo.css') }}" rel="stylesheet">
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-dark menu-oficial-mobile" id="sidenav-main" style="background:linear-gradient(87deg,#0a0a43 0,#825ee4 100%) !important;">
        <div id="fecha-menu-mobile">X</div>
        <div class="scroll-wrapper scrollbar-inner" style="position: relative;">
            <div class="scrollbar-inner scroll-content scroll-scrollx_visible scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 450px;">

            <div class="sidenav-header d-flex align-items-center" style="min-height: 40px;">

                <img src="{{ asset('img/logo.png') }}" class="navbar-brand-img" alt="Empresa">
                <img src="{{ asset('img/logo.png') }}" class="icone-empresa" alt="Empresa">

            </div>

            <div class="navbar-inner">
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    @include('layouts.dashboard.menu-lateral')
                </div>
            </div>
        </div>
    </nav>
