@extends('layouts.app-backend')

@section('style')
    <link href="{{ asset('css/tarefa.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tarefa_nova.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.6/dist/css/bootstrap-select.min.css">

@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Tarefas
    </a>
@endsection

@section('content')
    <div class="col-xl-12 order-xl-1">
        @include('backend.tarefa.editar.tabela')
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', "#btnComentarioInterna", function(){
            comentario = $( "#editorComentario .ql-editor" ).html();
            $("#mytextareacomentariointerna").text(comentario);
        });
        document.onkeydown = function(evt) {
            evt = evt || window.event;
            var isEscape = false;
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc");
            } else {
                isEscape = (evt.keyCode === 27);
            }
            if (isEscape) {
                var r = confirm("Deseja sair?");
                if(r==true){
                    urlAnterior = "{{ URL::previous() }}";
                    urlAtual = "{{ URL::current() }}";

                    if(urlAnterior == urlAtual){
                        window.location.href = "http://intranet.logicadigital.com.br/backend/tarefas";
                    }else{
                        window.location.href = "{{ URL::previous() }}";
                    }
                }
            }
        };
    </script>
@endsection
