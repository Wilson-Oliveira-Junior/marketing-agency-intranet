<div class="row col-sm-12">
    
    <!-- Listagem do tipo de Projeto -->
    @include('backend.projeto.formulario._form-tipo-projeto')

    <!-- Cliente -->
    <div class="form-group col-sm-4">
        <label>Cliente do Projeto</label>
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <select class="form-control" name="cliente_id">
                @foreach($clientes as $registro)
                    <option value="{{ $registro->cliente_id }}" {{ (isset($projetos->cliente_id) && $registro->cliente_id == $projetos->cliente_id ? 'selected' : '') }}>{{ $registro->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Status do Projeto -->
    <div class="form-group col-sm-4">
        <label>Status do Projeto</label>
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <select class="form-control" name="status">
                <option value="Ativo" {{ (isset($avaliacoes->status) && $avaliacoes->status == 'Ativo' ? 'selected' : '') }}>Ativo</option>
                <option value="Inativo" {{ (isset($avaliacoes->status) && $avaliacoes->status == 'Inativo' ? 'selected' : '') }}>Inativo</option>
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