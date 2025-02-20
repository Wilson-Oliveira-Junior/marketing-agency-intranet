@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.cliente') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Clientes
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Listagem de Clientes
    </a>
@endsection

@section('content')

    <div class="col">
        @can('adicionar_cliente')
	    <div class="row">
	        <div class="col-12"><a href="{{ route('backend.cliente.adicionar') }}" class="btn btn-info" style="margin:0 0 5px 13px;position:initial!important;">Adicionar Novo</a></div>
	    </div>
        @endcan
        <div class="card shadow">
            <div class="card-header border-0" style="display: flex;position: relative;">
                <h3 class="mb-0">Listagem de Clientes</h3>

                <form action="{{ route('backend.cliente.busca') }}" method="POST" class="search-cliente navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex" style="position: absolute;right: 30px;margin-right: 0px !important;">
                    {{ csrf_field() }}
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" name="busca-cliente" placeholder="Buscar Cliente..." type="text" style="color: #a2a2a2;">
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><i class="fas fa-donate"></i></th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Raz&atilde;o Social</th>
                            @if(Auth::id() == 3)
                            <th>Dt. Últ. Emissão</th>
                            @endif
                            <th scope="col">Status</th>
                            <th scope="col">P|D|C</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $registro)
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>@if($registro->status_financeiro == 0)
                                    <i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i>
                                @elseif($registro->status_financeiro == 1)
                                    <i class="fa fa-info-circle" style="color:yellow;" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-stop-circle" style="color:red;" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td>{{ isset($registro->nome_fantasia) ? mb_strimwidth($registro->nome_fantasia,0,40,'...') : $registro->nome  }}</td>
                            <td>{{ mb_strimwidth($registro->razao_social,0,40,'...') }}</td>
							<td>@if(Auth::id() == 3)
                                @if(count($registro->contaazul_ultimaemissao)>0)
                                <span>{{date('d/m/Y', strtotime($registro->contaazul_ultimaemissao[0]->emissao))}}</span>
                                @endif
                            @endif</td>
                            <td><span id="status{{$registro->id}}" data-id="{{$registro->id}}" style="cursor:pointer;" class="icon icon-shape @if ($registro->status) bg-success @else bg-danger @endif text-white shadow pstatus"><i id="icon{{$registro->id}}" class="fas @if ($registro->status) fa-toggle-on @else fa-toggle-off @endif"></i></span></td>
                            <td>{{$registro->num_projetos}}|{{$registro->num_dominios}}|{{$registro->num_contatos}}</td>
                            <td>
                                @can('editar_cliente')
                                    <a href="{{ route('backend.cliente.editar',$registro->id) }}" class="btn btn-warning">Editar</a>
                                @endcan

                                @can('deletar_cliente')
                                <a onclick="return confirm('Deletar esse registro?');" href="{{ route('backend.cliente.deletar',$registro->id) }}" class="btn btn-danger">Deletar</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer py-4">
                @can('adicionar_cliente')
                    <a href="{{ route('backend.cliente.adicionar') }}" class="btn btn-info" style="float: left;">Adicionar Novo</a>
                @endcan
                {!! $clientes->links() !!}
            </div>

        </div>

    </div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).on('click', '.pstatus', function() {
        id = $(this).data('id');

        $.ajax({
            type: 'GET',
            url: "{{ URL::route('backend.cliente.status') }}",
            data: {
                'id': id
            },
            success: function(data) {
                // empty
                //
                if(data.status){
                    $('#status' + id).removeClass('bg-danger');
                    $('#status' + id).addClass('bg-success');
                    $('#icon' + id).removeClass('fa-toggle-off');
                    $('#icon' + id).addClass('fa-toggle-on');
                }else{
                    $('#status' + id).removeClass('bg-success');
                    $('#status' + id).addClass('bg-danger');
                    $('#icon' + id).removeClass('fa-toggle-on');
                    $('#icon' + id).addClass('fa-toggle-off');

                }
                //alert(data.status);
            },
        });
    });
 </script>
@endsection


