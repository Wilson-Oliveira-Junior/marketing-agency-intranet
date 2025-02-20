@foreach($evento as $registro)
    
    <div class="col-sm-9">
        
        <i class="ni ni-calendar-grid-58 icone-interno-calendario"></i> 

        <div class="form-group col-sm-12">
            <input class="form-control titulo-interno-calendario" name="nome" placeholder="Nome do Evento" type="text" value="{{ isset($registro->nome_evento) ? $registro->nome_evento : '' }}">
        </div>

        <div class="form-group col-sm-12">
            <textarea class="form-control form-control-alternative edit-event--description textarea-autosize" name="descricao" placeholder="Descrição do Evento" style="min-height: 190px;">{{ isset($registro->descricao_evento) ? $registro->descricao_evento : '' }}</textarea>
        </div>

        <input class="form-control" name="id_evento_oficial" placeholder="ID EVENTO OFICIAL" type="text" value="{{ $registro->id_evento }}" style="display:none;">
    
        @if(Auth::user()->id == $registro->id_usuario)
            <div class="modal-footer" style="padding-top: 0px !important;display: flex !important;padding-bottom: 20px !important;padding-right: 20px !important;float: left;margin-left: 20px;">
                <button type="submit" class="btn btn-primary">Atualizar Evento</button>
            </div>
        @endif

    </div>

    <div class="col-sm-3" style="margin-top: -50px;">

        <div class="criado_por_evento">
            <span>Criado por:</span> 
            <img src="http://intranet.logicadigital.com.br/{{ $registro->image }}">
            {{ $registro->nome_usuario }} {{ $registro->sobrenome_usuario }}
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <i class="ni ni-calendar-grid-58 icone-data-interno"></i>
            <span class="label-data"> Data Início</span>
            <input class="form-control input-data" name="evento_data_inicio" type="date" value="{{ isset($registro->evento_data_inicio) ? $registro->evento_data_inicio : '' }}">
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <i class="ni ni-calendar-grid-58 icone-data-interno"></i>
            <span class="label-data"> Data Fim</span>
            <input class="form-control input-data" name="evento_data_fim" type="date" value="{{ isset($registro->evento_data_fim) ? $registro->evento_data_fim : '' }}">
        </div>

        <div class="seguidores-evento">
            <h2>Compartilhado com:</h2>
            @foreach($seguidores as $seguidor)
                <div class="seguidores-info-evento">
                    <img src="http://intranet.logicadigital.com.br/{{ $seguidor->image }}">
                    <h3>{{ $seguidor->name }} {{ $seguidor->sobrenome }}</h3>
                    <a href="#" class="remover-seguidor">X</a>
                </div>
            @endforeach
        </div>

    </div>
@endforeach