<div class="card">
        
    <div class="card-header">
        <h5 class="h3 mb-0">
            <i class="fas fa-address-book" style="background: linear-gradient(87deg,#5b66ec 0,#8052eb 100%)!important;"></i>
            Contato do Cliente ({{ $numeros_cliente }})
        </h5>
        <button class="collapse-table-contato-cliente">
            <i class="ni ni-fat-add"></i> 
        </button>
    </div>

    <div class="card-body p-0 collapse-hidden-contato-cliente" style="padding: 10px !important;background: linear-gradient(87deg,#5f5cef 0,#8052eb 100%)!important;">

        @foreach($dados_cliente as $registro)
            <div class="div-contato">
                
                <!-- Nome -->
                <div class="my-4">
                    <span>
                        <i class="ni ni-circle-08"></i>
                        Nome
                    </span>
                    
                    <div class="conteudo-texto">
                        {{ $registro->nome_contato }}
                    </div>
                </div>

                <!-- E-mail -->
                @if($registro->email == NULL)
                @else
                    <div class="my-4">
                        <span>
                        <i class="ni ni-email-83"></i> 
                        E-mail
                        </span>

                        <div class="conteudo-texto">
                        {{ $registro->email }}
                        </div>
                    </div>
                @endif

                <!-- Telefone -->
                @if($registro->telefone == NULL)
                @else
                    <div class="my-4">
                        <span>
                        <i class="ni ni-mobile-button"></i>
                        Telefone
                        </span>

                        <div class="conteudo-texto">
                        {{ $registro->telefone }}
                        </div>
                    </div>
                @endif

                <!-- Ramal -->
                @if($registro->ramal == NULL)
                @else
                    <div class="my-4">
                        <span>
                        <i class="ni ni-mobile-button"></i>
                        Ramal
                        </span>

                        <div class="conteudo-texto">
                        {{ $registro->ramal }}
                        </div>
                    </div>
                @endif

                <!-- Celular -->
                @if($registro->celular == NULL)           
                @else
                    <div class="my-4">
                        <span>
                        <i class="ni ni-mobile-button"></i>
                        Celular
                        </span>

                        <div class="conteudo-texto">
                        {{ $registro->celular }}
                        </div>
                    </div>
                @endif

                <!-- Tipo de Contato-->
                @if($registro->tipo_contato == NULL) 
                @else
                    <div class="my-4">
                        <span>
                        <i class="ni ni-badge"></i>
                        Tipo Contato
                        </span>

                        <div class="conteudo-texto">
                        {{ $registro->tipo_contato }}
                        </div>
                    </div>
                @endif

            </div>
        @endforeach

    </div>

</div>