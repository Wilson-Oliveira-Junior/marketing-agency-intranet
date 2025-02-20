@extends('layouts.app-backend')

@section('style')
    <link href="{{ asset('css/fichacomercial.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>
        .focused .input-group {
            box-shadow: none !important;
        }
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Ficha Comercial
    </a>
@endsection

@section('content')
    <div class="wizard">

        <div class="wizard-inner">

            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="active icone-passo-1">
                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                        <span class="round-tab">1</span>
                    </a>
                </li>

                <li role="presentation" class="disabled icone-passo-2">
                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                        <span class="round-tab">2</span>
                    </a>
                </li>

                <li role="presentation" class="disabled icone-passo-3">
                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                        <span class="round-tab">3</span>
                    </a>
                </li>

                <li role="presentation" class="disabled">
                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                        <span class="round-tab"><i class="ni ni-check-bold"></i></span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            @include('backend.fichacomercial.etapa1')
            @include('backend.fichacomercial.etapa2')
            @include('backend.fichacomercial.etapa3')
            @include('backend.fichacomercial.concluido')
        </form>

    </div>
@endsection

@section('script')
    <script src="{{ asset('js/mascara.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/validar_cpf_cnpj/valida_cpf_cnpj.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/fichacomercial.js') }}"></script>
    <script src="{{ asset('js/select2.full.min.js') }} "></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        })
        $("#telefone").mask("(99) 9999-9999");
        $("#celular").mask("(99) 99999-9999");
    </script>
@endsection
