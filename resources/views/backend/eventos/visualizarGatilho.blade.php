@foreach($gatilhos as $registro)
    <i class="fas fa-chart-line icone-sino"></i>

    <div class="nome_cliente_evento">
        <h4>{{ $registro->nome_fantasia }}</h4>
    </div>

    <div class="form-group col-sm-12">
        <h6 class="i-h6">{{ $registro->nome_gatilho }}
    </div>

    <div class="form-group col-sm-6">
        <i class="ni ni-calendar-grid-58 icone-cliente-interno"></i>
        <span class="label-data"> Data Início</span>
        <input class="form-control input-data" name="data_incio" type="date" value="{{ date( 'Y-m-d' , strtotime($registro->data_incio)) }}">
    </div>

    <div class="form-group col-sm-6">
        <i class="ni ni-calendar-grid-58 icone-cliente-interno"></i>
        <span class="label-data"> Data Fim</span>
        <input class="form-control input-data" name="data_fim" type="date" value="{{ date( 'Y-m-d' , strtotime($registro->data_fim)) }}">
    </div>
@endforeach