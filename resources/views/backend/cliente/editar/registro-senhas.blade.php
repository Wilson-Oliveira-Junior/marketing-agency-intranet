<div class="table-responsive">
    <table class="table align-items-center">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo Registro</th>
                <th scope="col">Dom&iacute;nio</th>
                <th scope="col">URL</th>
                <th scope="col">Login</th>
                <th scope="col">Senha</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros_senhas as $registro)				
                <tr @if($registro->admin) class="borda" @endif>
                    <td scope="row">{{ $registro->idRegistroSenha }}</td>
                    <td>{{ $registro->nome }}</td>
                    <td>{{ $registro->dominio }}</td>
                    <td>{{ $registro->strURL }}</td>
                    <td>{{ $registro->strLogin }}</td>
                    <td>{{ $registro->strSenha }}</td>
                    <td>
                        <a href="{{ route('backend.cliente.editarRegistroSenha',[$clientes->id, $registro->idRegistroSenha]) }}" class="btn btn-warning">Editar</a>
                        @can('deletar_registro_senhas')
                            <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.cliente.deletarRegistroSenha',[$clientes->id, $registro->idRegistroSenha]) }}' : false)" class="btn btn-danger">Deletar</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('script')
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.btn');
    </script>
 @endsection