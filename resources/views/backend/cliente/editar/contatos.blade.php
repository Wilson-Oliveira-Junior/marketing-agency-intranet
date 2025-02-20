<div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome Contato</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Ramal</th>
                            <th scope="col">Celular</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes_contatos as $registro)
                        <tr>
                            <td scope="row">{{ $registro->id }}</td>
                            <td>{{ $registro->nome_contato }}</td>
                            <td>{{ $registro->telefone }}</td>
                            <td>{{ $registro->ramal }}</td>
                            <td>{{ $registro->celular }}</td>
                            <td>{{ $registro->email }}</td>
                            <td>{{ $registro->tipo_contato }}</td>
                            <td>
                                <a href="{{ route('backend.cliente.editarContato',[$clientes->id, $registro->id]) }}" class="btn btn-warning">Editar</a>
                                @can('deletar_cliente_contato')
                                    <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.cliente.deletarContato',[$clientes->id, $registro->id]) }}' : false)" class="btn btn-danger">Deletar</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
