<div class="row col-sm-12">
    <div class="form-group col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="nome" placeholder="Nome do Tipo de Tarefa" type="text" value="{{ isset($tipostarefas->nome) ? $tipostarefas->nome : '' }}" required>
        </div>
    </div>

    <div class="form-group col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="estimativa" type="time" value="{{ isset($tipostarefas->estimativa) ? $tipostarefas->estimativa : '' }}" required>
        </div>
    </div>

</div>

<!-- Script Aparte -->
@section('style')
    <link type="text/css" href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('js/select2.full.min.js') }} "></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        })
    </script>
@endsection