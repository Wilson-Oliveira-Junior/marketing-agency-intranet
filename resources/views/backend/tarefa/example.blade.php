            <table class="table align-items-center table-flush">
                <tbody>
                    @foreach($tarefas as $registro)
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