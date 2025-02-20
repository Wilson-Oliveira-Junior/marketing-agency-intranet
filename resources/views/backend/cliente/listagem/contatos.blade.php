    <!-- Contatos -->
    <td>
        <div class="avatar-group" style="display:flex;">
            @foreach($cliente->contatos as $registro_contato)

                    @if($registro_contato->nome_contato != NULL)
                        <div class="divisao2">
                            <img width="40" class="rounded-circle" src="{{ asset('img/user.png') }}">
                            <h5>{{ $registro_contato->nome_contato }}</h5>
                    @endif

                    @if($registro_contato->telefone != NULL)
                        <h5>{{ $registro_contato->telefone }}</h5>
                    @endif

                    @if($registro_contato->ramal != NULL)
                        <h5>{{ $registro_contato->ramal }}</h5>
                    @endif

                    @if($registro_contato->celular != NULL)
                        <h5>{{ $registro_contato->celular }}</h5>
                    @endif

                    @if($registro_contato->email != NULL)
                        <h5>{{ $registro_contato->email }}</h5>
                    @endif

                    @if($registro_contato->tipo_contato != NULL)
                        <h5>{{ $registro_contato->tipo_contato }}</h5>
                        </div>
                    @endif
            @endforeach
        </div>
    </td>
