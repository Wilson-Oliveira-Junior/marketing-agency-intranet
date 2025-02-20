<li class="nav-item dropdown">
    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="ni ni-bell-55"></i>
        <div class="contagem-notificacao">{{ $data['notificationsSoma'] }}</div>
    </a>
              
    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                
        <div class="px-3 py-3">
            <h6 class="text-sm text-muted m-0">
                Você tem
                <strong class="text-primary">
                    {{ $data['notificationsSoma'] }}
                </strong> 
                @if($data['notificationsSoma'] > 1)
                notificações.
                @else
                notifica&ccedil;&atilde;o
                @endif
            </h6>
        </div>

        <div class="list-group list-group-flush" style="height: 270px;overflow: auto;">
        
            @foreach($data['notificacaoEvento'] as $registro)
                <a href="{{ route('backend.evento') }}" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                <i class="ni ni-calendar-grid-58"></i>
                            </span>
                        </div>
                        <div class="col ml--2">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                
                                <div>
                                    <h4 class="mb-0 text-sm">
                                        Evento
                                    </h4>
                                </div>

                                <div class="text-right text-muted">
                                    <small>
                                        @if($registro->diferenca > 1)
                                            {{ $registro->diferenca }} horas atras
                                        @else
                                            {{ $registro->diferenca }} hora atras
                                        @endif
                                    </small>
                                </div>
                            </div>

                            <p class="text-sm mb-0">
                                {{ $registro->nome }}
                            </p>

                        </div>
                    </div>
                </a>
            @endforeach

            @foreach($data['notificacaoTarefa'] as $registro)
                <a href="{{ route('backend.tarefa.editar',$registro->id) }}" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                <i class="ni ni-active-40"></i>
                            </span>
                        </div>
                        <div class="col ml--2">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                
                                <div>
                                    <h4 class="mb-0 text-sm">
                                        Tarefa
                                    </h4>
                                </div>

                                <div class="text-right text-muted">
                                    <small>
                                        @if($registro->diferenca > 1)
                                            {{ $registro->diferenca }} horas atras
                                        @else
                                            {{ $registro->diferenca }} hora atras
                                        @endif
                                    </small>
                                </div>
                            </div>

                            <p class="text-sm mb-0">
                                {{ $registro->titulo }}
                            </p>

                        </div>
                    </div>
                </a>
            @endforeach
            @if (isset($data['notificacaoErros']))
                @foreach($data['notificacaoErros'] as $registro)
                    <a href="{{ route('backend.evento') }}" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                    <i class="ni ni-support-16"></i>
                                </span>
                            </div>
                            <div class="col ml--2">
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    
                                    <div>
                                        <h4 class="mb-0 text-sm">
                                            Erro
                                        </h4>
                                    </div>

                                    <div class="text-right text-muted">
                                        <small>
                                        @if($registro->diferenca > 1)
                                        {{ $registro->diferenca }} horas atras
                                        @else
                                        {{ $registro->diferenca }} hora atras
                                        @endif
                                        </small>
                                    </div>
                                </div>

                                <p class="text-sm mb-0">
                                    {{ $registro->controller_metodo }} - {{ $registro->mensagem }}
                                </p>

                            </div>
                        </div>
                    </a>
                @endforeach
            @endif

            
        </div>
    </div>
</li>