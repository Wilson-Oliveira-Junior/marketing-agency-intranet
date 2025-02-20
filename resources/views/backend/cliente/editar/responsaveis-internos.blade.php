<div class="table-responsive">
    <table class="table align-items-center" id="lista-responsavel-interno">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Responsabilidade</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes->responsaveis as $registro)
                <tr>
                    <td scope="row">{{ $registro->idcliente_responsavel }}</td>
                    <td>{{ $registro->name }}</td>
                    <td>{{ $registro->nome }}</td>
                    <td>
                        @can('apagar_cliente_responsavel')
                        <form id="frmApagarResponsavel{{$registro->idcliente_responsavel}}" method="POST" action="{{route('backend.clientes.responsavel.apagar', $registro->idcliente_responsavel)}}" onsubmit="return confirm('Tem certeza que deseja remover: {{addslashes($registro->name)}}?');">
                            @method('delete')
                            @csrf
                            <input type="hidden" name="idcliente" value="{{$registro->idcliente}}">
                            <button type="submit" class="btn btn-danger">Deletar</a>
                        </form>
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
