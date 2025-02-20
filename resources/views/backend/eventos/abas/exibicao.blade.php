    <a href="#" style="background-color: #28d384;" data-toggle="modal" data-target="#eventoModalPrimeiro" class="a-butao">
        Adicionar Novo
    </a>

    <h2 style="float:left">Exibição</h2>

    <ul class="navegacao">

        <!-- Eventos -->
        <li>
            <i class="ni ni-bold-right" style="color:#5e72e4"></i>
            Eventos
            <label id="aba-evento" class="custom-toggle custom-toggle-evento">
                <input type="checkbox" checked="">
                <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
            </label>
        </li>

        <!-- Tarefas -->
        <li>
            <i class="ni ni-bold-right" style="color: #28d384 !important;"></i>
            Tarefas
            <label id="aba-tarefa" class="custom-toggle custom-toggle-tarefa">
                <input type="checkbox" checked="">
                <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
            </label>
        </li>
        
        <!-- Gatilhos -->
        <li>
            <i class="ni ni-bold-right" style="color: #fc8135;"></i>
            Gatilhos
            <label id="aba-gatilho" class="custom-toggle custom-toggle-gatilho">
                <input type="checkbox" checked="">
                <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
            </label>
        </li>
        
        <!-- 
        <li>
            <i class="ni ni-bold-right" style="color:#f5365c"></i>
            To do List
            <label class="custom-toggle custom-toggle-to-do-list">
                <input type="checkbox" checked="">
                <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
            </label>
        </li>
        To do List -->

        <!-- 
        <li>
            <i class="ni ni-bold-right" style="color:#00cdf1;"></i>
            Lembrete
            <label class="custom-toggle custom-toggle-lembrete">
                <input type="checkbox" checked="">
                <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
            </label>
        </li>
        Lembrete -->
        
    </ul>

    <h2 style="float:left;margin-bottom: -10px;">Eventos do Dia</h2>

    <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
        @forelse($evento_hoje as $registro)
            <div class="timeline-block">
                <span class="timeline-step badge-success">
                    <i class="ni ni-bell-55"></i>
                </span>

                <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                        <div>
                            <span class="text-muted text-sm font-weight-bold">Eventos</span>
                        </div>
                        <div class="text-right">
                            <small class="text-muted">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $hoje_formatado }}
                            </small>
                        </div>
                    </div>

                    <h6 class="text-sm mt-1 mb-0">{{ $registro->nome }}</h6>
                </div>
            </div>
        @empty
        
        @endforelse

        @forelse($evento_seguidor as $registro)
            <div class="timeline-block">
                <span class="timeline-step badge-success">
                    <i class="ni ni-bell-55"></i>
                </span>

                <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                        <div>
                            <span class="text-muted text-sm font-weight-bold">Eventos</span>
                        </div>
                        <div class="text-right">
                            <small class="text-muted">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $hoje_formatado }}
                            </small>
                        </div>
                    </div>

                    <h6 class="text-sm mt-1 mb-0">{{ $registro->nome }}</h6>
                </div>
            </div>
        @empty

        @endforelse

    </div>
    