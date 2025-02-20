<table class="table align-items-center table-flush">

    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="contacts" style="width:80px;">Tipo</th>
            <th scope="col" class="sort" data-sort="contacts" style="width:80px;">URL</th>
            <th scope="col" class="sort" data-sort="contacts" style="width:80px;">Login</th>
            <th scope="col" class="sort" data-sort="contacts" style="width:80px;">Senha</th>
            <th scope="col" class="sort" data-sort="contacts" style="width:80px;">Dom&iacute;nio</th>
            <th scope="col" class="sort" data-sort="contacts" style="width:80px;">Observa&ccedil;&atilde;o</th>
        </tr>
    </thead>

    <tbody class="list">
        @foreach($registroDeSenha as $registro)
            @if($registro->admin)
                @if(Auth::user()->isAdmin())
                <tr @if(Auth::user()->isAdmin() && $registro->admin) class="borda" @endif>
                    <td>{{ $registro->tiporegistro->nome }}</td>
                    <td>
                        @if(isset($registro->strURL))
                            <a href="{{$registro->strURL}}" target="_blank">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                            </a>
                        @endif
                    </td>
                    <td class="budget">{{ $registro->strLogin }}</td>
                    <td>{{ $registro->strSenha }}</td>
                    @isset($registro->dominiocliente->dominio)
                        <td>{{ $registro->dominiocliente->dominio }}</td>
                    @else
                        <td></td>
                    @endisset

                    <td>
                        @if(isset($registro->observacao))
                            <div style="width: 300px;">
                                {{$registro->observacao}}
                            </div>
                        @endif
                    </td>
                </tr>
                @endif
            @else
                <tr @if(Auth::user()->isAdmin() && $registro->admin) class="borda" @endif>
                    <td>{{ $registro->tiporegistro->nome }}</td>
                    <td>
                        @if(isset($registro->strURL))
                            <a href="{{$registro->strURL}}" target="_blank">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                            </a>
                        @endif
                    </td>
                    <td class="budget">{{ $registro->strLogin }}</td>
                    <td>{{ $registro->strSenha }}</td>
                    @isset($registro->dominiocliente->dominio)
                        <td>{{ $registro->dominiocliente->dominio }}</td>
                    @else
                        <td></td>
                    @endisset

                    <td>
                        @if(isset($registro->observacao))
                            <div style="width: 300px;">
                                {{$registro->observacao}}
                            </div>
                        @endif
                    </td>
                </tr>
            @endif

        @endforeach

    </tbody>

</table>
