@if(count($cliente->responsaveis)>0)
<tr class="detalhamento-tabela detalhamento-tabela-botao{{ $cliente->id }}">
    <td class="title-td">

    </td>

    <td class="title-td">
        <div class="table-responsive">
            <table class="table align-items-center table-flush">

                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="contacts" style="width:80px;" colspan="4">Responsáveis</th>
                    </tr>
                </thead>

                <tbody class="list">

                    <tr>

                        <td>
                            <div class="avatar-group">
                                @forelse($cliente->responsaveis as $responsavel)
                                    <a href="#" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $responsavel->name }} - {{ $responsavel->nome }}">
                                        <img alt="{{ $responsavel->name }}" src="{{ asset($responsavel->image) }}" width="64px" height="64px">
                                    </a>
                                @empty
                                    <p>Nenhum responsável atribuído.</p>
                                @endforelse
                            </div>
                        </td>


                    </tr>

                </tbody>

            </table>
        </div>
    </td>

    <td class="title-td"></td>
</tr>
@endif
