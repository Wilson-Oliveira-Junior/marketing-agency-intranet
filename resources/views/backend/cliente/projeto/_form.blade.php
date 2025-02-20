<div class="row col-sm-12">
    
    <!-- Listagem do tipo de Projeto -->
    @include('backend.projeto.formulario._form-tipo-projeto')

    <!-- Cliente -->
    <div class="form-group col-sm-6" style="display:none;">
        <label>Cliente do Projeto</label>
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="cliente_id" type="text" value="{{ $clientes->cliente_id }}" required>
        </div>
    </div>

    <!-- Domínio -->
    <div class="form-group col-sm-4">
        <label>Selecione o dominio</label>
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="ni ni-hat-3"></i>
                </span>
            </div>
            <select id="dominiosCliente" class="form-control" name="id_dominio">
                <option value="0"> --Selecione--</option>
                @foreach($clientedominios as $dominio)
                    <option value="{{$dominio->id_dominio}}" {{($dominio->id_dominio == $idDominio)?'selected=selected':''}}>{{$dominio->dominio}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Domínio -->
    <div class="form-group col-sm-4">
        <label>Selecione o prazo desse projeto*</label>
        @if($errors->has('tempo_projeto'))
            <span class="help-block"><strong>{{ $errors->first('tempo_projeto') }}</strong></span>
        @endif
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="ni ni-hat-3"></i>
                </span>
            </div>
            <select class="form-control" name="tempo_projeto">
                <option value="0">- Prazo -</option>
                @if(isset($projetos->prazo))
                    <option value="30" {{($projetos->prazo == 30)?'selected=selected':''}}>30 dias</option>
                    <option value="40" {{($projetos->prazo == 40)?'selected=selected':''}}>45 dias</option>
                    <option value="50" {{($projetos->prazo == 50)?'selected=selected':''}}>50 dias</option>
                    <option value="65" {{($projetos->prazo == 65)?'selected=selected':''}}>65 dias</option>
                @else
                    <option value="30" {{(old('tempo_projeto') == 30)?'selected=selected':''}}>30 dias</option>
                    <option value="40" {{(old('tempo_projeto') == 40)?'selected=selected':''}}>45 dias</option>
                    <option value="50" {{(old('tempo_projeto') == 50)?'selected=selected':''}}>50 dias</option>
                    <option value="65" {{(old('tempo_projeto') == 65)?'selected=selected':''}}>65 dias</option>
                @endif
            </select>
        </div>
    </div>

        <!-- Domínio -->
    <div class="form-group col-sm-4">
        <label>Selecione o prazo desse projeto</label>
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="ni ni-hat-3"></i>
                </span>
            </div>
            <input class="form-control" name="data-referencia" placeholder="" type="date" value="{{isset($projetos->data_referencia)?$projetos->data_referencia:old('data-referencia')}}">
        </div>
    </div>

    <!-- Status do Projeto -->
    <div class="form-group col-sm-8">
        <label>Status do Projeto</label>
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <select class="form-control" name="status">
                <option value="Ativo"   {{ (isset($avaliacoes->status) && $avaliacoes->status == 'Ativo' ? 'selected' : '') }}>Ativo</option>
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