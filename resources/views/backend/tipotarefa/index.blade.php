@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Tipo de Tarefa
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0" style="float:left;">Tipo de Tarefa</h3>

                <form action="{{ route('backend.tipotarefa.busca') }}" method="POST" class="search-cliente navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex">
                    {{ csrf_field() }}
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" name="busca-tipotarefa" placeholder="Buscar Tipo de Tarefa..." type="text" style="color: #a2a2a2;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Estimativa</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipostarefas as $registro)
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>{{ $registro->nome }}</td>
                            <td>{{ $registro->estimativa }}</td>
                            <td><span id="status{{$registro->id}}" data-id="{{$registro->id}}" style="cursor:pointer;" class="icon icon-shape @if ($registro->status) bg-success @else bg-danger @endif text-white shadow pstatus"><i id="icon{{$registro->id}}" class="fas @if ($registro->status) fa-toggle-on @else fa-toggle-off @endif"></i></span></td>
                            <td>
                                @can('editar_tipo_tarefa')
                                    <a href="{{ route('backend.tipotarefa.editar',$registro->id) }}" class="btn btn-warning">Editar</a>
                                @endcan
                                @can('deletar_tipo_tarefa')
                                    <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.tipotarefa.deletar',$registro->id) }}' : false)" class="btn btn-danger">Deletar</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @can('adicionar_tipo_tarefa')
            <div class="card-footer py-4">
                <a href="{{ route('backend.tipotarefa.adicionar') }}" class="btn btn-info" style="float: left;">Adicionar Novo</a>
            </div>
            @endcan
        </div>
        {!! $tipostarefas->links() !!}
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).on('click', '.pstatus', function() {
            id = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: "{{ URL::route('backend.tipotarefa.status') }}",
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
