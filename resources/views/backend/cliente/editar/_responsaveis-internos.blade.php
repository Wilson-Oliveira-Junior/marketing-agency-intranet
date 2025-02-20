<tr>
    <td scope="row">{{ $registro['idcliente_responsavel'] }}</td>
    <td>{{ $registro['name'] }}</td>
    <td>{{ $registro['nome'] }}</td>
    <td>
        @can('apagar_cliente_responsavel')
        <form id="frmApagarResponsavel{{$registro['idcliente_responsavel']}}" method="POST" action="{{route('backend.clientes.responsavel.apagar', $registro['idcliente_responsavel'])}}" onsubmit="return confirm('Tem certeza que deseja remover: {{addslashes($registro['name'])}}?');">
            @method('delete')
            @csrf
            <input type="hidden" name="idcliente" value="{{$registro['idcliente']}}">
            <button type="submit" class="btn btn-danger">Deletar</a>
        </form>
        @endcan
    </td>
</tr>
