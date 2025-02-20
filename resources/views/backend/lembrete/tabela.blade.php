<div class="card card-profile shadow">
        
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-12">
                    <h3 class="mb-0">Lembretes</h3>

                    <form action="{{ route('backend.lembrete.busca') }}" method="POST" class="search-cliente navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex" style="margin-right: 10% !important;margin-top: -40px;">
                        {{ csrf_field() }}
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                            </div>
                            <input class="form-control" name="busca-lembrete" placeholder="Buscar Lembrete..." type="text" style="color: #a2a2a2;">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Título</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Data</th>
                        <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lembretes as $registro)
                    <tr class="linha-lembrete">
                        <td>
                            @if($registro->concluido == 'N')
                                <button id="btn" onclick="concluir{{ $registro->id }}();" class="btn bg-success margin" style="margin: 0px;color:#FFF">Concluir</button>
                            @else
                                <button id="btn" onclick="reabrir{{ $registro->id }}();" class="btn bg-orange margin" style="margin: 0px;color:#FFF">Reabrir</button>
                            @endif
                        </td>
                        <td>
                            {{ $registro->titulo }}
                        </td>
                        <td>
                            {{ $registro->nome_cliente }}
                        </td>
                        <td>
                            {{ date( 'd/m/Y' , strtotime($registro->data))}}
                        </td>                        
                        <td>
                            <a href="{{ route('backend.lembrete.editar',$registro->id) }}">
                                <i class="fas fa-edit"></i>
		                    </a>
                        </td>
                    </tr>
                    
                        <!-- Concluir Lembrete -->
                        <script>
                            function concluir{{ $registro->id }}(){
                                swal({
                                    title: 'Concluir',
                                    text: "Tem certeza que deseja concluir?",
                                    type: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#28B463',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ok',
                                    cancelButtonText: "Cancelar",
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.replace("{{ route('backend.lembrete.concluir',$registro->id) }}");												  		
                                    }
                                })
                            }
                        </script>

                        <!-- Reabrir Lembrete -->
                        <script>
                            function reabrir{{ $registro->id }}(){
                                swal({
                                    title: 'Reabrir',
                                    text: "Tem certeza que deseja reabrir?",
                                    type: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#28B463',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ok',
                                    cancelButtonText: "Cancelar",
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.replace("{{ route('backend.lembrete.reabrir',$registro->id) }}");												  		
                                    }
                                })
                            }
                        </script>
                    @endforeach
                </tbody>
            </table>         
        </div>
        
        <div class="card-footer py-4">
                
            {!! $lembretes->links() !!}

        </div>
    </div>