@foreach($usuarios as $usuario)
    @if($usuario->setor == '2')
        <style>
            .collapse-cronograma-{{ $usuario->id }}{
                background-color: transparent;
                border: none;
                color: #16294e;
                font-size: 20px;
                float: right;
                cursor: pointer;
                width: 100%;
                display: flex;
                padding: 0px;
            }
            .collapse-cronograma-{{ $usuario->id }} i{
                float: left;
                margin-right: 5px;
                margin-top: 4px;
                color: #32315e;
            }
        </style>

        <div class="card-header bg-white border-0" style="padding: 0px;">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="exibicao">
                        <button class="collapse-cronograma-{{ $usuario->id }} monta-cronograma" data-id={{ $usuario->id }}>

                            <h3>

                                @if($usuario->classes == 'cro-desenvolvimento')
                                    <i class="fas fa-laptop-code" style="color: #00ce86;margin-right: 5px;"></i>
                                @elseif($usuario->classes == 'cro-atendimento')
                                    <i class="fas fa-mail-bulk" style="color: #ffd700;margin-right: 5px;"></i>
                                @elseif($usuario->classes == 'cro-criacao')
                                    <i class="fas fa-laptop" style="color: #fb6340;margin-right: 5px;"></i>
                                @elseif($usuario->classes == 'cro-comercial')
                                    <i class="far fa-sticky-note" style="color: #00cdf1;margin-right: 5px;"></i>
                                @elseif($usuario->classes == 'cro-marketing')
                                    <i class="far fa-lightbulb" style="color: #f83159;margin-right: 5px;"></i>
                                @else
                                    <i class="fas fa-ticket-alt" style="color: #5c69eb;margin-right: 5px;"></i>
                                @endif

                                {{ $usuario->name }} {{ $usuario->sobrenome }}

                            </h3>

                            <i class="ni ni-fat-add" style="float: left;margin-right: 5px;margin-top: 4px;color:#32315e"></i>

                        </button>
                    </div>
                </div>
            </div>
        </div>

                        <div class="collapse-cronograma{{ $usuario->id }}">


                        </div>

                        <script src="{{ asset('dashboard/jquery/dist/jquery.min.js') }}"></script>
                        <script>
                            $(".collapse-cronograma{{ $usuario->id }}").fadeOut();

                            $(".collapse-cronograma-{{ $usuario->id }}").click(function(){

                                if( $(".collapse-cronograma-{{ $usuario->id }} i").hasClass("ni-fat-add") ) {

                                    $(".collapse-cronograma-{{ $usuario->id }} i").removeClass("ni-fat-add");
                                    $(".collapse-cronograma-{{ $usuario->id }} i").addClass("ni-fat-delete");
                                    $(".collapse-cronograma{{ $usuario->id }}").fadeIn();

                                }else if( $(".collapse-cronograma-{{ $usuario->id }} i").hasClass("ni-fat-delete") ) {

                                    $(".collapse-cronograma-{{ $usuario->id }} i").addClass("ni-fat-add");
                                    $(".collapse-cronograma-{{ $usuario->id }} i").removeClass("ni-fat-delete");
                                    $(".collapse-cronograma{{ $usuario->id }}").fadeOut();

                                }else{

                                }

                            });
                        </script>
    @endif
@endforeach
