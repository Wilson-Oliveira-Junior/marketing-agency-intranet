@extends('layouts.app-backend')

@section('style')
    <style>
        .departamento-empresa{
            padding-left: 20px;
            list-style-type: circle;
            line-height: 30px;
        }
        .departamento-empresa a{
            transition: all .3s linear;
        }
        .departamento-empresa a:hover{
            padding-left: 10px;
        }
        .lista{
            float: left;
            width: 100%;
            margin-bottom: 20px;
        }
        .lista .imagem{
            width: 25%;
            float: left;
            height: 75px;
        }
        .lista .imagem img{
            width: 55px;
            height: 55px;
            border-radius: 300px;
        }
        .lista .conteudo{
            border: 1px dashed #c0b7f6;
            float: left;
            width: 75%;
            background-color: #fff;
            padding: 0px 10px;
            padding-top: 5px;
            margin-top: 15px;
            box-shadow: 10px 9px 20px -10px rgba(0,0,0,0.75);
            border-radius: 0px 10px 10px 10px;
        }
        .lista .conteudo h3{
            font-size: 14px;
            color: #7561e6;
            font-weight: bold;
        }
        .lista .conteudo h5{

        }

        .lista .conteudo-dtcomemorativa{
            border: 1px dashed #c0b7f6;
            float: left;
            width: 100%;
            background-color: #fff;
            padding: 0px 10px;
            padding-top: 5px;
            margin-top: 15px;
            box-shadow: 10px 9px 20px -10px rgba(0,0,0,0.75);
            border-radius: 0px 10px 10px 10px;
        }
        .lista .conteudo-dtcomemorativa h3{
            font-size: 14px;
            color: #7561e6;
            font-weight: bold;
        }

        .lista .conteudo-dtcomemorativa h5{
            font-weight: bold;
        }

        .sugestao{
            display: flex;
            align-items: center;
        }
        .sugestao textarea{
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            width: 90%;
            margin-right: 10px;
        }
        #sugestao .conteudo{
            background-color: #ffffff;
            padding: 15px;
            margin-top: 25px;
            border-radius: 0px 30px 30px 30px;
        }
        #sugestao p{
            font-size: 11px;
            text-align: justify;
            line-height: 16px;
            font-weight: 500;
        }
        #sugestao .card-body{
            background-color: #f7fafc;
            overflow: auto;
            height: 300px;
        }
        .title-sugestao{
            text-align: center !important;
            font-weight: bold !important;
            margin-top: 15px;
            margin-left: -20px;
            font-size: 14px !important;
        }
        .subtitle-sugestao{
            text-align: center !important;
            margin-left: -15px;
            margin-top: -10px;
        }
        .btndata{
            background-color: transparent;
            border: none;
            color: #16294e;
            font-size: 20px;
            cursor: pointer;
            width: 25px;
            padding: 0px;
        }
        #lista-datas {
            overflow: auto;
            height: 350px;
            background-color: #f7fafc;
        }

        .list-group-item{
            background-color: #f7fafc !important;
        }


      .adiamento-linha{
        /*position: absolute;
        right: 40px;*/
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
      .checklist-urgencia-1::before{color: red !important;}
      .checklist-urgencia-2::before{color: orange !important;}
      .checklist-urgencia-3::before{color: yellow !important;}
      .checklist-urgencia-4::before{color: green !important;}
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}">Dashboard</a>
@endsection

@section('content')
    <div class="col col-md-4">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0" style="width: 200px;float: left;">Wiki</h3>

                <button class="collapse-table-wiki">
                    <i class="ni ni-fat-add" style="float: left;margin-right: 5px;margin-top: 4px;color:#32315e"></i>
                </button>
            </div>

            <div class="card-body collapse-hidden-wiki" style="background-color: #f7fafc;">
                <p style="text-align: justify;font-weight: 500;font-size: 14px;">O wiki foi desenvolvido com o intuito de expor as etapas de desenvolvimento de cada
                área, padrões a serem seguidos em determinados prosseguimentos, etapas e treinamento para quem é novo no
                sistema, e também temos algumas dúvidas frequentes dos clientes ou da própria equipe.</p>

                <h3 style="font-size:15px">Wiki - Departamentos</h3>
                <ul class="departamento-empresa">
                    <li>
                        <a href="#" target="_blank">Atendimento</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">Comercial</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">Desenvolvimento</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">Criação</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">Marketing</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">RH</a>
                    </li>
                </ul>
            </div>

            <div class="card-footer py-4 collapse-hidden-wiki">
                <a href="#" class="btn btn-sm btn-primary" target="_blank">Acessar Wiki</a>
            </div>
        </div>


        <div class="card shadow" style="margin-top: 10px;">
            <div class="card-header border-0">
                <h3 class="mb-0">Ramais</h3>
            </div>

            <div class="card-body card-ramal" style="background-color: #f7fafc;">
                @foreach($ramais as $vramais)
                    <div class="ramal {{ $vramais->classes }}">
                        <h3 style="color: #666;">{{ $vramais->name }} {{ $vramais->sobrenome }} <br/><i class="fas fa-phone"></i> {{ $vramais->ramal }}</h3>
                    </div>
                @endforeach
                <!--<div class="ramal ramal-sala-reuniao">
                    <h3 style="color: #666;">Sala Reuni&atilde;o 1<br/><i class="fas fa-phone" style="background-color:gray;"></i> 7208</h3>
                </div>
                <div class="ramal ramal-sala-reuniao">
                    <h3 style="color: #666;">Sala Reuni&atilde;o 2<br/><i class="fas fa-phone" style="background-color:gray;"></i> 7211</h3>
                </div>-->
                <div class="legenda">
                    <div class="dev">
                        <hr />
                        <span>Desenvolvimento</span>
                    </div>

                    <div class="atendimento">
                        <hr />
                        <span>Atendimento</span>
                    </div>

                    <div class="comercial">
                        <hr />
                        <span>Comercial</span>
                    </div>

                    <div class="marketing">
                        <hr />
                        <span>Marketing</span>
                    </div>

                    <div class="adm">
                        <hr />
                        <span>Administrativo</span>
                    </div>

                    <div class="criacao">
                        <hr />
                        <span>Cria&ccedil;&atilde;o</span>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="col col-md-4">

        @include('backend.pautas.lista-pautas')

        <div id="sugestao" class="card shadow" style="margin-top: 10px;">
            <div class="card-header border-0">
                <h3 class="mb-0">Sugestões</h3>
            </div>

            <div class="card-body" style="background-color: #f7fafc;">
                @forelse($sugestoes as $registro)
                    <div class="lista">
                        <div class="imagem">
                            @if($registro->imagem_usuario == NULL)
                                <img src="{{ asset('img/user.png') }}" class="">
                            @else
                                <img src="{{ asset($registro->imagem_usuario) }}" class="">
                            @endif
                        </div>
                        <div class="conteudo">
                            <h3 style="color: #000;">{{ $registro->nome_usuario }}</h3>
                            <p>{{ $registro->descricao_sugestao }}</p>
                        </div>
                    </div>
                @empty
                    <div class="comentario-autor item-comentarios-zero" style="padding-top: 20%;">
                        <img class="image" src="{{ asset('img/nenhum-comentario.svg') }}">
                        <p class="title-sugestao">Nenhuma sugestão postada.</p>
                        <p class="subtitle-sugestao">Quem será o primeiro a postar? ;).</p>
                    </div>
                @endforelse
            </div>

            <div class="card-footer py-4">
                <form action="{{ route('backend.sugestao.salvar') }}" method="post" enctype="multipart/form-data" class="sugestao">
                    {{ csrf_field() }}

                    <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}">

                    <textarea class="sugestao" name="descricao"></textarea>

                    <button style="cursor: pointer;background: transparent;border: none;">
                        <i class="fas fa-paper-plane enviar"></i>
                    </button>

                </form>
            </div>

        </div>
    </div>

    <div class="col col-md-4">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0" style="width: 190px;float: left;">Aniversariante do Mês</h3>

                <button class="collapse-table-niver">
                    <i class="ni ni-fat-add" style="float: left;margin-right: 5px;margin-top: 4px;color:#32315e"></i>
                </button>
            </div>

            <div class="card-body collapse-hidden-niver" style="background-color: #f7fafc;">
                @if($qtd_aniversario == 0)
                    <h4>Nenhum Aniversariante esse Mês :(</h4>
                @else
                    @foreach($arrAniversario as $registro)
                        <div class="lista">
                            <div class="imagem">
                                <img src="{{ $registro->image ? config('app.url').'/'.ltrim($registro->image, '/') : asset('img/user.svg') }}" class="">
                            </div>
                            <div class="conteudo">
                                <h3>{{ $registro->name }} {{ $registro->sobrenome }}</h3>
                                <h5>{{ date( 'd/m/Y' , strtotime($registro->nascimento)) }}</h5>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

            <div class="card-footer py-4 collapse-hidden-niver">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdlAniversariantes">
                    Ver Completo
                </button>
                <!--<a href="" class="btn btn-sm btn-primary">Ver Completo</a>-->
            </div>

            <!-- Modal -->
            <div class="modal fade" id="mdlAniversariantes" tabindex="-1" role="dialog" aria-labelledby="mdlAniversariantesLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aniversariantes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($arrMeses as $niver)
                        <h3>{{$niver['mes_nome']}}</h3>
                        @if(! empty($niver['aniversariantes']))
                            @foreach($niver['aniversariantes'] as $pessoa)
                            <div class="lista">
                                <div class="imagem">
                                    @if($pessoa['img'])
                                        <img src="{{ $pessoa['img'] ? config('app.url').'/'.ltrim($pessoa['img'], '/') : asset('img/user.svg') }}" class="">
                                    @else
                                    <img src="{{ asset('img/user.png') }}" class="">
                                    @endif
                                </div>
                                <div class="conteudo">
                                    <h3>{{ $pessoa['nome'] }}</h3>
                                    <h5>{{ date( 'd/m/Y' , strtotime($pessoa['nascimento'])) }}</h5>
									@if(Auth::user()->isAdmin())
                                        @if($pessoa['id'] != 3 && $pessoa['id'] != 27 && $pessoa['id'] != 34)
                                            @php
                                                $dias = (int)date_diff(new \DateTime(), new \DateTime($pessoa['admitido']))->format("%d");
                                                $meses = (int)date_diff(new \DateTime(), new \DateTime($pessoa['admitido']))->format("%m");
                                                $anos = (int)date_diff(new \DateTime(), new \DateTime($pessoa['admitido']))->format("%Y");
                                                //echo $dias . '<br>';
                                                //echo $meses . '<br>';
                                                //echo $anos . '<br>';

                                                $texto = "Há ";
                                                if($anos > 0){
                                                    $texto = $texto . $anos .($anos == 1?' ano,':' anos,');
                                                }

                                                if($meses > 0){
                                                    $texto = $texto . ' ' . $meses . ($meses == 1?' mês,':' meses,');
                                                }

                                                if($dias > 0){
                                                    $texto = $texto . ' ' . $dias . ($dias == 1?' dia':' dias');
                                                }

                                            @endphp
                                            <p style="font-size: 11px;text-align: justify;line-height: 16px;font-weight: 500;">Admitido em: {{ date('d/m/Y', strtotime($pessoa['admitido']))}} ({{ $texto }})</p>
                                        @endif
									@endif
                                </div>
                            </div>
                            @endforeach
                        @else
                        <p>Sem aniversariante no mês</p>
                        @endif
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="card shadow mt-2">
            <div class="card-header border-0">
                <h3 class="mb-0" style="width: 75%;float: left;">Datas Comemorativas <span id="nomeMes">{{retornarNomeMes(date('m'))}}({{count($arrDtComemorativas)}})</span></h3>
                <button class="btndata" id="dtcomemorativa-anterior" data-mes="{{date('m')-1}}">
                    <i class="ni ni-bold-left" style="margin-right: 5px;margin-top: 4px;color:#32315e"></i>
                </button>
                <button class="btndata" id="dtcomemorativa-proximo" data-mes="{{date('m')+1}}">
                    <i class="ni ni-bold-right" style="margin-right: 5px;margin-top: 4px;color:#32315e"></i>
                </button>
                <button class="collapse-table-dtcomemorativa">
                    <i class="ni ni-fat-delete" style="float: left;margin-right: 5px;margin-top: 4px;color:#32315e"></i>
                </button>
            </div>
            <div id="loader" style="display:none !important">
                <img src="{{asset('img/load-oficial.gif')}}">
            </div>
            <div class="card-body collapse-hidden-dtcomemorativa" id="lista-datas" style="background-color: #f7fafc;">

                @if(count($arrDtComemorativas) == 0)
                    <h4>Nenhuma data comemorativa cadastrada este Mês</h4>
                @else
                    @foreach($arrDtComemorativas as $dtcomemorativa)
                        <div class="lista">
                            <div class="conteudo-dtcomemorativa">
                                <h3>{{ $dtcomemorativa->nome }}</h3>
                                <h5>{{ date( 'd/m' , strtotime($dtcomemorativa->data)) }}</h5>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>



    </div>
@endsection
@section('script')
<script>
    $('.btn-pauta').on('click', function(){

        id = $(this).data('id');
        $('#idpauta').val(id);
        $('#mdlObservacao').modal('show');

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
</script>

@endsection
