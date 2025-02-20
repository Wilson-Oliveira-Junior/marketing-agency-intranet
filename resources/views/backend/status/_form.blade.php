<div class="row col-sm-12">
    <div class="form-group col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="nome" placeholder="Nome do Status" type="text" value="{{ isset($status->nome) ? $status->nome : '' }}" required>
        </div>
    </div>

    <div class="form-group col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="descricao" placeholder="Descrição" type="text" value="{{ isset($status->descricao) ? $status->descricao : '' }}" required>
        </div>
    </div>

    <div class="form-group col-sm-4" style="padding: 0px;padding-right: 20px;">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <select class="form-control" name="status">
                <option value="Ativo" {{ (isset($status->status) && $status->status == 'Ativo' ? 'selected' : '') }}>Ativo</option>
                <option value="Inativo" {{ (isset($status->status) && $status->status == 'Inativo' ? 'selected' : '') }}>Inativo</option>
            </select>
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