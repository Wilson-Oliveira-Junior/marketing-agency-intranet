<div class="card">
        
    <div class="card-header">
        <h5 class="h3 mb-0">
            <i class="fas fa-history" style="background: linear-gradient(87deg,#1bce8a 0,#1bcecb 100%)!important;"></i>
            Adiamentos ({{ $numero_adiamentos }})
        </h5>
        <button class="collapse-table-adiamentos">
            <i class="ni ni-fat-add"></i> 
        </button>
    </div>

    <div class="card-body p-0 collapse-hidden-adiamentos" style="padding: 10px !important;background: linear-gradient(87deg,#1bce8a 0,#1bcecb 100%)!important;">
        <div class="list-group list-group-flush">
            @foreach($adiamentos as $registro)
                <div class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4" style="margin-bottom: 10px;background-color: #FFF !important;border-radius: 0px 20px 20px 20px;padding: 10px 15px !important;">
                    <div class="d-flex w-100 justify-content-between">
                        <div>
                            <div class="d-flex w-100 align-items-center" style="display: block !important;">
                                <img src="http://intranet.logicadigital.com.br/{{ $registro->image }}" alt="Image placeholder" class="avatar avatar-xs mr-2" style="width:30px;height:30px;float: left;">
                                <h5 class="mb-1" style="width: 70%;float: left;">{{ $registro->name }} {{ $registro->sobrenome }}</h5>
                                <small style="float: left;width: 70%;font-size: 9px;font-weight: 400;color: #444;margin-top: -5px;">Postado em: {{ date( 'd/m/Y' , strtotime($registro->postado_em)) }}</small>
                            </div>
                        </div>
                    </div>
                    <h4 style="margin-top: 5px !important;" class="mt-3 mb-1">{{ $registro->nome_gatilho }}</h4>
                    <p style="font-size: 11px;text-align: justify;font-weight: 400;margin-bottom: -9px;">{{ $registro->motivo }}</p>
                    <p style="font-weight: bold;font-size: 10px;margin-top: 15px;margin-bottom: -5px;">Adiado para: {{ date( 'd/m/Y' , strtotime($registro->data_adiamento)) }}</p>
                </div>
            @endforeach
        </div>
    </div>
        
</div>