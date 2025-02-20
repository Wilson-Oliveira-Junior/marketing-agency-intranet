 <!-- Core -->
 <script src="{{ asset('dashboard/jquery/dist/jquery.min.js') }}"></script>
 <script src="{{ asset('dashboard/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

 <!-- Argon JS -->
 <script src="{{ asset('dashboard/assets/js/argon.min.js') }}"></script>
<div class="table-responsive">
    <table class="table align-items-center table-flush">

        <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="contacts" style="width:50px;">Ação</th>
                <th scope="col" class="sort" data-sort="name">Nome do Cliente (domínio)</th>
                <th scope="col" class="sort" data-sort="name">Visualizar mais Detalhes</th>
            </tr>
        </thead>

        <tbody class="list">
            @forelse($clientes as $cliente)

                <tr class="bloco">

                    <!-- Editar -->
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                @can('editar_cliente')
                                    <a class="dropdown-item" href="{{ route('backend.cliente.editar',$cliente->id) }}">
                                        Editar
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </td>

                    <!-- Cliente -->
                    <td scope="row">
                        <div class="media align-items-center">
                            <div class="media-body">
                                {{ $cliente->nome_fantasia }} <span>({{ $cliente->nome }})</span>
                            </div>
                        </div>
                    </td>

                    <!-- Botão Ver mais Detalhes -->
                    <td>
                        <button class="btn btn-sm btn-detalhes botao-ver-detalhes" id="botao{{ $cliente->id }}"><i class="ni ni-fat-add"></i></button>
                    </td>

                </tr>

                <tr class="detalhamento-tabela detalhamento-tabela-botao{{ $cliente->id }}">

                    <td class="title-td">
                        <button class="btn fechar-botao" id="fecharbotao{{ $cliente->id }}">
                            -
                        </button>
                    </td>

                    <td class="title-td">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">

                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="contacts" style="width:80px;">Financeiro</th>
                                        <th scope="col" class="sort" data-sort="name">Contatos</th>
                                        <th scope="col" class="sort" data-sort="name">Serviços</th>
                                        <th scope="col" class="sort" data-sort="name">Domínio</th>
                                    </tr>
                                </thead>

                                <tbody class="list">

                                    <tr>

                                        <!-- Financeiro -->
                                        @if($cliente->status_financeiro > 0)
                                            <td class="budget">
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-warning"></i>
                                                    <span class="status">Pendente</span>
                                                </span>
                                            </td>
                                        @else
                                            <td class="budget">
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-success"></i>
                                                    <span class="status">Em Dia</span>
                                                </span>
                                            </td>
                                        @endif

                                        @include('backend.cliente.listagem.contatos')

                                        @include('backend.cliente.listagem.projetos')

                                        <!-- Domínios -->
                                        <td>
                                            <div class="avatar-group">
                                                @foreach($cliente->dominios as $registro_dominio)
                                                    <a href="#" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $registro_dominio->dominio }}">
                                                        <img alt="{{ $registro_dominio->dominio }}" src="{{ asset('img/icones-clientes/icone-dominio.png') }}">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </td>

                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </td>

                    <td class="title-td"></td>
                </tr>
                @include('backend.cliente.listagem.responsaveis')
                @if (Auth::id() == 3)
                    @include('backend.cliente.conta-azul.parcelas')
                @endif
            @empty
                <tr>
                    <td colspan="3">Nenhum registro encontrado</td>
                </tr>
            @endforelse

        </tbody>

    </table>
</div>
<script type="text/javascript">

    $(".detalhamento-tabela*").hide();

    $(".botao-ver-detalhes").click(function(){
        $id = $(this).attr('id');

        if( $("#" + $id + " i").hasClass("ni-fat-add") ) {

            $("#" + $id + " i").removeClass("ni-fat-add");
            $("#" + $id + " i").addClass("ni-fat-delete");
            $(".detalhamento-tabela-" +$id).fadeIn();

        }else if( $("#" + $id + " i").hasClass("ni-fat-delete") ) {
            $("#" + $id + " i").addClass("ni-fat-add");
            $("#" + $id + " i").removeClass("ni-fat-delete");
            $(".detalhamento-tabela-" +$id).fadeOut();

        }else{

        }

    });

    $(".fechar-botao").click(function(){
        $id = $(this).attr('id');
        $botaonome = $id.replace('fechar','');
        //alert($botaonome);
        $("#" + $botaonome + " i").addClass("ni-fat-add");
        $("#" + $botaonome + " i").removeClass("ni-fat-delete");
        $(".detalhamento-tabela-" +$botaonome).fadeOut();

    });

</script>
