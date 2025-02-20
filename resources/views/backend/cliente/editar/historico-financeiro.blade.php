<div class="table-responsive">
    <table class="table align-items-center" id="lista-responsavel-interno">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Número da Venda</th>
                <th scope="col">Valor</th>
                <th scope="col">Data de Emissão</th>
				<th scope="col">Data de Vencimento</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes->contaazul_vendas as $key => $parcela)
                <tr>
                    <td scope="row">{{ $key+1 }}</td>
                    <td>{{ $parcela->numero_venda }}</td>
                    <td>{{ $parcela->valor }}</td>
                    <td>{{ date('d/m/Y', strtotime($parcela->emissao)) }}</td>
					<td>{{ date('d/m/Y', strtotime($parcela->vencimento)) }}</td>
                    <td>
                        @if($parcela->status == 0)
                            Pago
                        @elseif ($parcela->status ==1)
                            Pendente
                        @elseif ($parcela->status == 2)
                            Devedor
                        @else
                            Excluída
                        @endif
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
