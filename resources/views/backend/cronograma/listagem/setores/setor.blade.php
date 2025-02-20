@foreach($arrCronogramaEquipe as $key => $cronograma)
        <style>
            .collapse-cronograma-{{ $cronograma['id'] }}{
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
            .collapse-cronograma-{{ $cronograma['id'] }} i{
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
                        <button class="collapse-cronograma-{{ $cronograma['id'] }} monta-cronograma" data-id={{ $cronograma['id'] }}>

                            <h3>

                                @if($idsetor == '1')
                                    <i class="fas fa-laptop-code" style="color: #00ce86;margin-right: 5px;"></i>
                                @elseif($idsetor == '2')
                                    <i class="fas fa-mail-bulk" style="color: #ffd700;margin-right: 5px;"></i>
                                @elseif($idsetor == '3')
                                    <i class="fas fa-laptop" style="color: #fb6340;margin-right: 5px;"></i>
                                @elseif($idsetor == '4')
                                    <i class="far fa-sticky-note" style="color: #00cdf1;margin-right: 5px;"></i>
                                @elseif($idsetor == '5')
                                    <i class="far fa-lightbulb" style="color: #f83159;margin-right: 5px;"></i>
                                @else
                                    <i class="fas fa-ticket-alt" style="color: #5c69eb;margin-right: 5px;"></i>
                                @endif

                                {{ $cronograma['nome'] }}

                            </h3>

                            <i class="ni ni-fat-add" style="float: left;margin-right: 5px;margin-top: 4px;color:#32315e"></i>

                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="collapse-cronograma{{ $cronograma['id'] }}">
            @include('backend.cronograma.cronograma-equipe')

        </div>

        <script>
            $(".collapse-cronograma{{ $cronograma['id'] }}").fadeOut();

            $(".collapse-cronograma-{{ $cronograma['id'] }}").click(function(){

                if( $(".collapse-cronograma-{{ $cronograma['id'] }} i").hasClass("ni-fat-add") ) {

                    $(".collapse-cronograma-{{ $cronograma['id'] }} i").removeClass("ni-fat-add");
                    $(".collapse-cronograma-{{ $cronograma['id'] }} i").addClass("ni-fat-delete");
                    $(".collapse-cronograma{{ $cronograma['id'] }}").fadeIn();

                }else if( $(".collapse-cronograma-{{ $cronograma['id'] }} i").hasClass("ni-fat-delete") ) {

                    $(".collapse-cronograma-{{ $cronograma['id'] }} i").addClass("ni-fat-add");
                    $(".collapse-cronograma-{{ $cronograma['id'] }} i").removeClass("ni-fat-delete");
                    $(".collapse-cronograma{{ $cronograma['id'] }}").fadeOut();

                }
            });
        </script>
@endforeach
<script src="{{ asset('js/cronograma.js') }}"></script>
