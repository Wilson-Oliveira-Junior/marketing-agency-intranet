<table class="table align-items-center table-sm">
    <thead class="thead-light">
        <tr>
            <!--<th scope="col">#</th>-->
            <th scope="col">Tarefa</th>
            <th scope="col" title="Gravidade">G</th>
            <th scope="col" title="Urgência">U</th>
            <th scope="col" title="Tendência">T</th>
            <th scope="col" title="Pontuação">P</th>
            <th scope="col">Data Tarefa</th>
            <th scope="col">Data Desejada</th>
            <th scope="col">Status</th>
            <th scope="col">Responsável</th>
        </tr>
    </thead>
    <tbody>
        @foreach($arrTarefas as $key => $tarefa)
        <tr id="linha-{{ $tarefa->id }}">
            <!--<td scope="row">{{ $tarefa->id }}</td>-->
            <td>
                <a href="{{ route('backend.tarefa.editar', $tarefa->id) }}" target="_blank" class="text-muted">
                @if(strlen($tarefa->titulo)>=40)
                    {{ $key+1 }} - {{ mb_substr($tarefa->titulo,0,40) }}...
                @else
                    {{ $key+1 }} - {{ $tarefa->titulo }}
                @endif
                </a>
            </td>
            <td>
                <select id="gravidade-{{ $tarefa->id }}" name="gravidade" class="form-select gut">
                    @for ($i=0;$i<=5;$i++)
                        <option value="{{ $i }}" @if($tarefa->gravidade == $i) selected="selected" @endif>{{ $i }}</option>
                    @endfor
                </select>
            </td>
            <td>
                <select id="urgencia-{{ $tarefa->id }}" name="urgencia" class="form-select gut">
                    @for ($i=0;$i<=5;$i++)
                        <option value="{{ $i }}" @if($tarefa->urgencia == $i) selected="selected" @endif>{{ $i }}</option>
                    @endfor
                </select>
            </td>
            <td>
                <select id="tendencia-{{ $tarefa->id }}" name="tendencia" class="form-select gut">
                    @for ($i=0;$i<=5;$i++)
                        <option value="{{ $i }}" @if($tarefa->tendencia == $i) selected="selected" @endif>{{ $i }}</option>
                    @endfor
                </select>
            </td>
            <td id="pontuacao-{{ $tarefa->id }}">{{ $tarefa->tarefa_ordem }}</td>
            <td>{{ date("d/m/Y", strtotime($tarefa->created_at)) }}</td>
            <td><input type="date" name="datadesejada" id="datadesejada-{{ $tarefa->id }}" class="datadesejada" value="@if(strtotime($tarefa->data_desejada)){{ date("Y-m-d", strtotime($tarefa->data_desejada)) }}@endif"> <i class="fas fa-sync ml-1" style="cursor:pointer;"></i>
            </td>
            <td>{{ $tarefa->statusTarefa->nome }}</td>
            <td>
                @if(!is_null($tarefa->id_responsavel))
                    {{ $tarefa->responsavel->name }}
                @else
                    Backlog
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
