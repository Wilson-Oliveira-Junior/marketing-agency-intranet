<div class="table-responsive">

        <table class="table align-items-center table-flush">

            <thead class="thead-light">
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Tipo de Projeto</th>
                    <th scope="col">Finalizados</th>
                    <th scope="col">Total</th>
                    <th scope="col">Processo</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            @foreach ($arrGatilhos as $projeto )
                        <tbody>
                            <tr>
                                <td id="status-{{ $projeto['id'] }}">
                                    @if(!$projeto['entraremcontato'])
                                        <span class="atendimento-em-dia">ATENDIMENTO EM DIA</span>
                                    @else
                                        <span class="entrar-em-contato">ENTRAR EM CONTATO</span>
                                    @endif
                                </td>
                                <td>
                                    @if(strlen($projeto['nome'])>=30)
                                        {{ ucwords(strtolower(mb_substr($projeto['nome'],0,30))) }}...
                                    @else
                                        {{ ucwords(strtolower($projeto['nome'])) }}
                                    @endif
                                </td>
                                <td>{{ $projeto['tipo_projeto'] }}</td>
                                <td>{{ $projeto['finalizados'] }}</td>
                                <td>{{ $projeto['gatilhos'] }}</td>
                                <td>
                                    <small>Processo está em: {{ number_format(($projeto['finalizados']/$projeto['gatilhos'])*100,2) }}%</small>
                                    <div class="progress progress-xs my-2">
                                        <div class="progress-bar bg-success" style="width: {{ ($projeto['finalizados']/$projeto['gatilhos'])*100 }}%;"></div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('backend.gatilhos.projeto', $projeto['id']) }}" class="btn" style="background-color:#00cdf1;color:#FFF;" title="Acompanhar Processo"><i class="fa fa-tasks" aria-hidden="true"></i></a>
                                    <button type="button" class="btn btn-comentario" data-id="{{ $projeto['id'] }}" style="color: #FFF;background: #5c6ce8;" title="Comentar">
                                        <i class="fa fa-comment"></i>
                                    </button>
                                    @if($projeto['status'] != 'F')
                                        <button type="button" id="btnstatus-{{$projeto['id']}}" class="btn btn-status {{($projeto['status'] == "P")?'btn-play':'btn-pause'}}" data-id="{{ $projeto['id'] }}" data-status="{{ $projeto['status'] }}" style="color: #FFF;" title="{{($projeto['status'] == "P")?'Continuar':'Pausar'}}">
                                            <i class="fa fa-{{($projeto['status'] == "P")?'play':'pause'}}" id="icon-{{$projeto['id']}}" aria-hidden="true"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
            @endforeach
        </table>
</div>
