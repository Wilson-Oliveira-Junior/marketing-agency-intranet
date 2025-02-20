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
            <select id="transferircliente" class="form-control" name="cliente_id">
                @foreach($clientes as $registro)
                    <option id="{{ $registro->id }}" value="{{ $registro->cliente_id }}" class="option-dominio" {{ (isset($projetos->cliente_id) && $registro->cliente_id == $projetos->cliente_id ? 'selected' : '') }}>{{ $registro->nome }}</option>
                @endforeach
            </select>
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
            </select>
        </div>
    </div>

    <!-- Status do Projeto -->
    <div class="form-group col-sm-6">
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

    <div id="adicionarDoCliente" class="form-group col-sm-6">
        <label>Gostaria de Adicionar um Domínio?</label>
        <div class="input-group input-group-alternative mb-3" style="box-shadow: none !important;">
            <a href="#" class="btn btn-info" style="background-color: #fd6237;border-color: #ff612c;" data-toggle="modal" data-target="#dominioModel">    
                <span>Adicionar Domínio</span>
            </a>
        </div>
    </div>

</div>

<!-- Script Aparte -->
@section('style')
    <link type="text/css" href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script>
        var url = "http://intranet.logicadigital.com.br/backend/clientes/"+ {{ $idCliente }} +"/dominios/";
        $("#dominiosCliente").find(".dominioos").remove();
        var j = 0;
        $.ajax({
            type: "GET",
            url: url,
            contentType: "application/json; charset=utf-8",
            cache: false,
            success: function (retorno) {
                var tipos = $.parseJSON(retorno);
                $.each(tipos, function(i, dominio_cliente) {
                    // Formatando o conteúdo
                    if(dominio_cliente.id_dominio == {{ $idDominio }}){
                        $selected = "selected='selected'";
                    }else{
                        $selected = "";
                    }
                    
                    var item = '<option id="' + dominio_cliente.id_cliente + '" class="dominioos" ' + $selected + ' value="' + dominio_cliente.id_dominio + '">' + dominio_cliente.dominio + '</div></option>';
                    $("#dominiosCliente").append(item);
                    j++;
                });
            }
        });
    </script>


    <script src="{{ asset('js/select2.full.min.js') }} "></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        })
    </script>
@endsection