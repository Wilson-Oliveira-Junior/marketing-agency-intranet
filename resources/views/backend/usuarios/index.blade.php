@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}">
        Usuários
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Usuários Cadastrados</h3>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Setor</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)		
                        <tr>
                            <td scope="row">{{ $usuario->id_usuario }}</td>
                            <td>
                                @if($usuario->imagem_usuario != null)
                                    <img width="40" class="rounded-circle" src="{{ asset($usuario->imagem_usuario) }}">
                                @else
                                    <img width="40" class="rounded-circle" src="{{ asset('img/user.png') }}"> 
                                @endif
                            </td>
                            <td>{{ $usuario->nome_usuario }}</td>
                            <td>{{ $usuario->email_usuario }}</td>
                            <td>{{ $usuario->nome_setor_usuario }}</td>
                            <td><span id="status{{$usuario->id_usuario}}" data-id="{{$usuario->id_usuario}}" style="cursor:pointer;" class="icon icon-shape @if ($usuario->status) bg-success @else bg-danger @endif text-white shadow pstatus"><i id="icon{{$usuario->id_usuario}}" class="fas @if ($usuario->status) fa-toggle-on @else fa-toggle-off @endif"></i></span></td>
                            <td>
                                <a href="{{ route('backend.usuario.editar',$usuario->id_usuario) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ route('backend.usuarios.papel',$usuario->id_usuario) }}" class="btn btn-info">Papel</a>
                                <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.usuario.deletar',$usuario->id_usuario) }}' : false)" class="btn btn-danger">Deletar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer py-4">
                
                <a href="{{ route('backend.usuario.adicionar') }}" class="btn btn-info" style="float: left;">Adicionar Novo</a>
                

                {!! $usuarios->links() !!}

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
                url: "{{ URL::route('backend.usuario.status') }}",
                data: {
                    'id': id
                },
                success: function(data) {
                    // empty
                    //
                    if(data.ativo){
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