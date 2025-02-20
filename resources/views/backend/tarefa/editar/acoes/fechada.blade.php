<li style="display:flex;">
    <span>Status:</span>
    @if($registro->nome_status == null)
        Sem Status
    @else
        {{ $registro->nome_status }}
    @endif
</li>
<li>
    <span>Tipo:</span>
    @if($registro->nome_tipo == null)
        Sem Tipo
    @else
        {{ $registro->nome_tipo }}
    @endif
</li>
<li>
    <span>Projeto:</span>
    {{ $registro->nome_cliente }} > {{ $registro->tipo_projeto }}
</li>
<li>
    <span>Tags:</span>
    Nenhuma
</li>