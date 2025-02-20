@extends('layouts.app-backend')

@section('style')
<link href="{{ asset('css/css-automizado.css') }}" rel="stylesheet">
<style>
    .list-group-item{
        background-color: #ecf0f1 !important;
        border-bottom: 3px solid #FFF !important;
      }


      .adiamento-linha{
        position: absolute;
        right: 40px;
        color: #FFF;
        background: #5c6ce8;
        padding: 1px 6px;
        border-radius: 5px;
        font-size: 14px;
      }
      .adiamento-linha button{
        background: none;
        border: none;
        color: #FFF;
        padding: 0px;
      }
      .checklist-urgencia-1::before{background-color: orange !important;}
      .checklist-urgencia-2::before{background-color: red !important;}
      .checklist-urgencia-3::before{background-color: yellow !important;}
      .checklist-urgencia-4::before{background-color: green !important;}

</style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Pautas
    </a>
@endsection

@section('content')
    <div class="col-xl-12 order-xl-1">
        @include('backend.pautas.tabela')
    </div>

@endsection

@section('script')
<script>
    function fnFiltro(filtro){
        console.log(filtro);
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
    $('.filtro').click(function(){

        filtro = $(this).data('filtro');
        //console.log('Index' + filtro);

        $('#lista-pautas').empty();

        fnFiltro(filtro);

    });
    $('.btn-pauta').click(function(){

        id = $(this).data('id');
        $('#idpauta').val(id);
        $('#mdlObservacao').modal('show');

    });

    $('.btn-pauta-observacao').click(function(){

        observacao = $(this).data('observacao');
        $('#consulta-observacao').val(observacao);
        $('#mdlConsultaObservacao').modal('show');

    });

    $('#formObservacao').on('submit', function(event){
        $('#loader').show();
        event.preventDefault();
        vurl = "/backend/pautas/registrar-observacao";

        $.ajax({
            type: 'POST',
            url: vurl,
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                $('.errorObservacao').addClass('hidden');
                $('#loader').hide();
                toastr.success('Pauta finalizada com sucesso!', 'Sucesso', {timeOut: 5000});
                if(data.incluir_historico){
                    toastr.success('Comentário adicionado no projeto com sucesso!', 'Sucesso', {timeOut: 5000});
                }
                $("#ckPauta-" + data.id).fadeOut().remove();
                $('#mdlObservacao').modal('hide');
                $("#formObservacao")[0].reset();
            },
            error: function (request, status, error) {

                var data = $.parseJSON(request.responseText);

                setTimeout(function () {
                    toastr.error('ERROS de Validação!', 'Alerta de Erro', {timeOut: 5000});
                }, 500);
                if (data.errors.observacao) {
                    $('.errorObservacao').removeClass('hidden');
                    $('.errorObservacao').text(data.errors.observacao);
                    $('#loader').hide();
                }
            }
        });
    });

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        //console.log(page);
        filtro = $('.filtro.active').data('filtro');
        //console.log(filtro);

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
            $('.compartilhado').addClass('active');
            $('.todos').removeClass('active');
        }

        if(filtro == 't'){
            $('.paramim').removeClass('active');
            $('.quecriei').removeClass('active');
            $('.meusetor').removeClass('active');
            $('.compartilhado').removeClass('active');
            $('.todos').addClass('active');

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
        formData.append('page', page);

        //console.log('Pra mim(I): ' + pramim);
        //console.log('Que Criei(I): ' + quecriei);
        //console.log('Abertas(I): ' + abertas);
        //console.log('Finalizadas(I): ' + finalizadas);

        $('#div-loader').removeClass('hidden');
        urlfiltro = "/backend/pautas?page=" + page;
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

    });
</script>
@endsection
