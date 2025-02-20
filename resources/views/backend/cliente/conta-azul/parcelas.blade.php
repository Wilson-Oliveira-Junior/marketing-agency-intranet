@if(count($cliente->contaazul_vendas)>0)
<tr class="detalhamento-tabela detalhamento-tabela-botao{{ $cliente->id }}">
    <td class="title-td">

    </td>

    <td class="title-td">
        <div class="table-responsive">
            <table class="table align-items-center table-flush">

                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="contacts" style="width:80px;" colspan="4">Parcelas</th>
                    </tr>
                </thead>

                <tbody class="list">
                    @forelse($cliente->contaazul_vendas as $vendas)
                    <tr>

                        <td>
                            Valor: {{$vendas->valor}} - Emissão: {{date('d/m/Y', strtotime($vendas->emissao))}} - Vencimento: {{date('d/m/Y', strtotime($vendas->vencimento))}} - Status:
                            @if($vendas->status == 0)
                                Pago
                            @elseif ($vendas->status ==1)
                                Pendente
                            @else
                                Devedor
                            @endif
                        </td>


                    </tr>
                    @empty
                        <tr>
                            <td>Nenhuma parcela</td>
                    @endforelse

                </tbody>

            </table>
        </div>
    </td>

    <td class="title-td"></td>
</tr>
@endif
