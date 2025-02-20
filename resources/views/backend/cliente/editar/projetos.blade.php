<div class="table-responsive">
    <table class="table align-items-center">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Status</th>
                <th scope="col">Dom&iacute;io</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes_projetos as $registro)
                <tr>
                    <td scope="row">{{ $registro->id }}</td>
                    <td>{{ $registro->projeto }}</td>
                    <td>{{ $registro->status }}</td>
                    <td>{{ $registro->dominio }}</td>
                    <td>
                        @can('editar_projeto')
                        <a href="{{ route('backend.cliente.editarProjeto',[$clientes->id, $registro->id]) }}" class="btn btn-warning">Editar</a>
                        @endcan
                        @can('deletar_projeto')
                            <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.cliente.deletarProjeto',[$clientes->id, $registro->id]) }}' : false)" class="btn btn-danger">Deletar</a>
                        @endcan
                        <!--<a href="{{ route('backend.cliente.transferir',[$clientes->id, $registro->id]) }}" class="btn" style="background-color:#00cdf1;color:#FFF;">Transferir</a>-->
                        <a href="{{ route('backend.gatilhos.projeto', $registro->id) }}" class="btn" style="background-color:#00cdf1;color:#FFF;">Gatilhos</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
