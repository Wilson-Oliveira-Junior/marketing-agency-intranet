@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.usuario') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Usuário
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Papel Usuário
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Papel do " - {{ $users->name }} - "</h3>
            </div>
            <form action="{{ route('backend.usuarios.papel.salvar',$users->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="row col-sm-12">
                    <div class="form-group col-sm-12">
                        <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                            </div>
                            <select name="role_id" style="width: 95%;border: none;padding: 10px;color: #aeaeae;">
                                @foreach($all_roles as $registro)
                                    <option value="{{ $registro->id }}">{{ $registro->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">Adicionar</button> 

            </form>

                    

            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Label</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $registro)				
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>{{ $registro->name }}</td>
                            <td>{{ $registro->label }}</td>
                            <td>
                                <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.usuarios.papel.remover',[ $users->id, $registro->id ] ) }}' : false)" class="btn btn-danger">Deletar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection