<div class="col-lg-12">
    <div class="card">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush" data-toggle="checklist" style="height: 500px;overflow: scroll;border: 2px solid #FFF;border-top: 0px;">
                @forelse($vPautas as $registro)

                    <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4" id="ckPauta-{{ $registro->id }}">
                        <div class="checklist-item checklist-item-info checklist-urgencia-{{ $registro->idUrgencia }}">

                            <div class="checklist-info checklist-info-{{ $registro->id }}">
                                <h4 class="checklist-title mb-0">{{$registro->projeto->cliente->nome_fantasia}} - {{$registro->projeto->projeto}} - {{ $registro->titulo }}</h4>
                                @isset($registro->data_desejada)
                                    <small>Data Desejada: <strong style="font-weight:bold;">{{ date( 'd/m/Y' , strtotime($registro->data_desejada)) }}</strong></small>
                                @endisset
                                @isset($registro->responsavel->name)
                                    @if($registro->responsavel->id != Auth::id())
                                        <small>Responsável: <strong>{{$registro->responsavel->name}} {{$registro->responsavel->sobrenome}}</strong></small>
                                    @endif
                                @endisset
                                @isset($registro->data_finalizado)
                                    <small>Finalizado em: <strong style="font-weight:bold;">{{ date( 'd/m/Y' , strtotime($registro->data_finalizado)) }}</strong></small>
                                @endisset
                            </div>
                            @if (!$registro->status)
                                <div class="adiamento-linha">
                                    <button type="button" class="btn-pauta" data-id="{{$registro->id}}">
                                    <i class="fa fa-comment"></i>
                                    </button>
                                </div>

                                <div>
                                    <div class="custom-control custom-control-{{ $registro->id }} custom-checkbox custom-checkbox-info">
                                        <input class="custom-control-input chk-pauta" data-id="{{$registro->id}}" id="chk-todo-task-{{ $registro->id }}" type="checkbox">
                                        <label class="custom-control-label" for="chk-todo-task-{{ $registro->id }}"></label>
                                    </div>
                                </div>
                            @else
                                @if($registro->comentario)
                                    <div class="adiamento-linha">
                                        <button type="button" class="btn-pauta-observacao" data-observacao="{{$registro->comentario}}">
                                        <i class="fa fa-comment"></i>
                                        </button>
                                    </div>
                                @endif
                            @endif


                            <img src="{{ asset('img/loading-gatilho.gif') }}" class="imagem-carregamento-{{ $registro->id }} invisible" style="width: 100px;position: absolute;">

                        </div>
                    </li>
                @empty
                <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                    Sem registros.
                </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
<div class="card-footer py-4">
    {!! $vPautas->links() !!}
</div>
<script>
    function fnFiltro(filtro){
        if(filtro == 'c'){
            $('.paramim').removeClass('active');
            $('.quecriei').addClass('active');
            $('.meusetor').removeClass('active');
            $('.todos').removeClass('active');
            $('.compartilhado').removeClass('active');
        }

        if(filtro == 'r'){
            $('.paramim').addClass('active');
            $('.quecriei').removeClass('active');
            $('.meusetor').removeClass('active');
            $('.todos').removeClass('active');
            $('.compartilhado').removeClass('active');
        }

        if(filtro == 's'){
            $('.paramim').removeClass('active');
            $('.quecriei').removeClass('active');
            $('.meusetor').addClass('active');
            $('.todos').removeClass('active');
            $('.compartilhado').removeClass('active');
        }

        if(filtro == 'co'){
            $('.paramim').removeClass('active');
            $('.quecriei').removeClass('active');
            $('.meusetor').removeClass('active');
            $('.todos').removeClass('active');
            $('.compartilhado').addClass('active');
        }

        if(filtro == 't'){
            $('.paramim').removeClass('active');
            $('.quecriei').removeClass('active');
            $('.meusetor').removeClass('active');
            $('.todos').addClass('active');
            $('.compartilhado').removeClass('active');

        }

        if(filtro == 'a'){
            $('.abertas').addClass('active');
            $('.finalizadas').removeClass('active');

        }

        if(filtro == 'f'){
            $('.finalizadas').addClass('active');
            $('.abertas').removeClass('active');
        }

        pramim = $('.paramim').hasClass('active');
        quecriei = $('.quecriei').hasClass('active');
        meusetor = $('.meusetor').hasClass('active');
        compartilhado = $('.compartilhado').hasClass('active');
        todos = $('.todos').hasClass('active');
        abertas = $('.abertas').hasClass('active');
        finalizadas = $('.finalizadas').hasClass('active');

        const formData = new FormData();
        formData.append('pramim', pramim);
        formData.append('quecriei', quecriei);
        formData.append('meusetor', meusetor);
        formData.append('compartilhado', compartilhado);
        formData.append('todos', todos);
        formData.append('abertas', abertas);
        formData.append('finalizadas', finalizadas);

        //console.log('Pra mim(I): ' + pramim);
        //console.log('Que Criei(I): ' + quecriei);
        //console.log('Abertas(I): ' + abertas);
        //console.log('Finalizadas(I): ' + finalizadas);

        $('#div-loader').removeClass('hidden');
        urlfiltro = "{{ route('backend.pauta.index') }}";
        //urlfiltro = urlfiltro.replace(':filtro', quecriei);
        //urlfiltro = urlfiltro.replace(':status', finalizadas);
        //urlfiltro = urlfiltro.replace(':filtrar', true);
        //console.log(urlfiltro);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            urlfiltro,
            data: formData,
            dataType:'HTML',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#lista-pautas").html(data);
                $("#div-loader").addClass("hidden");

            }
        });
    }

    $('.btn-pauta').on('click', function(){

        id = $(this).data('id');
        $('#idpauta').val(id);
        $('#mdlObservacao').modal('show');

    });
    $('.btn-pauta-observacao').click(function(){

        observacao = $(this).data('observacao');
        $('#consulta-observacao').val(observacao);
        $('#mdlConsultaObservacao').modal('show');

    });

    $('.chk-pauta').on('click', function(){
        id = $(this).data('id');

        url = "/backend/pauta/finalizar/:id";
        url = url.replace(':id', id);

        console.log(id);

        $.ajax({
            type: "GET",
            url: url,
            beforeSend: function () {
                // Colocando pra aparecer a imagem de carregamento
                $(".checklist-info-" + id).addClass("invisible");
                $(".custom-control-" + id).addClass("invisible");
                $(".imagem-carregamento-" + id).removeClass("invisible");
            },
            success: function(data){
                $(".imagem-carregamento-" + id).addClass("invisible");
                $(".checklist-info").removeClass("invisible");
                $(".custom-control-" + id).removeClass("invisible");
                $(".checklist-item-" + id).addClass("checklist-item-checked");
                toastr.success('Pauta finalizada com sucesso!', 'Sucesso', {timeOut: 5000});
                $("#ckPauta-" + id).fadeOut().remove();
            }
        });
    });

</script>
