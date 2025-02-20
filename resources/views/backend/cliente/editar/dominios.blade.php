<div class="table-responsive">
    <table class="table align-items-center">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Domínio</th>
                <th scope="col">Hospedagem</th>
                <th scope="col">Domínio Principal</th>
                <th scope="col">Status</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes_dominios as $registro)
                <tr>
                    <td scope="row">{{ $registro->id_dominio }}</td>
                    <td>{{ $registro->dominio }}</td>
                    <td>{{ $registro->tipo_hospedagem }}</td>
                    <td>{{ $registro->dominio_principal }}</td>
                    <td>{{ $registro->status }}</td>
                    <td>
                        @can('editar_dominio_cliente')
                        <a href="{{ route('backend.cliente.editarDominio',[$clientes->id, $registro->id_dominio]) }}" class="btn btn-warning">Editar</a>
                        @endcan
                        @can('deletar_dominio')
                            <a href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('backend.cliente.deletarDominio',[$clientes->id, $registro->id_dominio]) }}' : false)" class="btn btn-danger">Deletar</a>
                        @endcan

                        @if(!empty($registro->ClientesDominios))
                            <button class="btn" data-clipboard-text="Servidor: {{ $registro->ClientesDominios->servidor }} ; Usuário: {{ $registro->ClientesDominios->usuario }} ; Senha: {{ $registro->ClientesDominios->senha }}; Protocolo: {{ $registro->ClientesDominios->protocolo }}" style="margin-right: 4px;padding: 0px;margin: 0px;background-color: #d52d28;">
                                <img src="{{ asset('img/icone-filezilla-vermelho.png') }}" style="height: 40px;">
                            </button>
                        @else
                            <button class="btn" data-clipboard-text="Sem dados." style="margin-right: 4px;padding: 0px;margin: 0px;background-color: #000;">
                                <img src="{{ asset('img/icone-filezilla-preto-copia.png') }}" style="height: 40px;">
                            </button>
                        @endif

                        @can('adicionar_ftp')
                            @if(!empty($registro->ClientesDominios))
                                <a href="{{ route('backend.cliente.dominio.ftp.editar',[$registro->id_cliente,$registro->id_dominio]) }}" class="btn btn-danger" style="background-color: #00d57f;border-color: #00d57f;">Atualizar FTP</a>
                            @else
                                <a href="{{ route('backend.cliente.dominio.ftp.adicionar',[$registro->id_cliente,$registro->id_dominio]) }}" class="btn btn-danger" style="background-color: #000;border-color: #000;">Adicionar FTP</a>
                            @endif
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
