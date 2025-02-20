
@extends('layouts.app-backend')
@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
				<h3 class="mb-0">Atualizando Cliente</h3>
				<form action="{{ route('backend.importarClientesAsaas') }}" method="POST" class="search-cliente navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex" style="position: absolute;right: 30px;margin-right: 0px !important;">
                    {{ csrf_field() }}
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" name="busca-cliente-asaass" placeholder="Buscar Cliente..." type="text" style="color: #a2a2a2;">
                        </div>
                    </div>
                </form>
			</div>
			<div class="table-responsive">
            <form action="{{ route('backend.importarClientesAsaas.salvarClienteAsaas') }}" method="post"  style="align-items: center;display: flex;flex-wrap: wrap;">
                {{ csrf_field() }}

                
					@foreach($resultado as $registro)
					<div class="row">
						<div class="col-12 col-md-8">{{ $registro->name }}
							<div class="form-group">
								<input class="form-control" name="cliente[]" type="text" value="{{ $registro->id }}" readonly="readonly">
							</div>
						</div>
						<div class="col-6 col-md-4">
							Cliente
							<div class="form-group">
								<select name="cliente_id[]">
									<option value="0" selected="selected">Sem Cliente</option>
									@foreach($clientes as $cliente)
									<option value="{{ $cliente->id}}">{{ $cliente->nome }} - {{ $cliente->idCustomerAsaas }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>	
					@endforeach
				</div>

                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;    height: 40px;">Atualizar</button> 
            </form>
		</div>
        </div>
    </div>    
@endsection