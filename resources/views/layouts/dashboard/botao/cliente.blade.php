<!-- Modal -->
<div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div class="modal-content">
            <form action="{{ route('backend.cliente.salvar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header">
                    <h5 class="modal-title" id="clienteModalLabel">Adicionando Cliente</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-bottom:0px;">
                    <div class="row">

                        <!-- Domínio -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="nome" type="text" placeholder="Dominio *">
                            </div>
                        </div>

                        <!-- Razão Social -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="razao_social" type="text" placeholder="Razão Social *">
                            </div>
                        </div>

                        <!-- Nome Fantasia -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="nome_fantasia" type="text" placeholder="Nome Fantasia">
                            </div>
                        </div>

                        <!-- CNPJ -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control cpf_cnpj" name="CNPJ" type="text" id="cnpj" placeholder="CPF/CNPJ">
                            </div>
                        </div>

                        <!-- Inscrição Estadual -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="inscricao_estadual" type="text" placeholder="Inscrição Estadual">
                            </div>
                        </div>

                        <!-- Segmento Cliente -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3" style="min-height: 45px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-atom"></i></span>
                                </div>
                                <select name="id_segmento" style="width: 80%;border: none;padding: 10px;color: #aeaeae;">
                                    @foreach($data['ldsegmentos'] as $setore)
                                        <option value="{{ $setore->id }}">{{ $setore->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Melhor dia para Boleto -->
                        <div class="form-group col-sm-6">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <select class="form-control" name="dia_boleto">
                                    <option value="null">- Melhor dia para Boleto -</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                        </div>
        
                        <!-- Perfil do Cliente -->
                        <div class="form-group col-sm-6">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <select class="form-control" name="perfil_cliente">
                                    <option value="null">- Perfil do Cliente -</option>
                                    <option value="Conhecimento básico">Conhecimento básico</option>
                                    <option value="Conhecimento intermediário">Conhecimento intermediário</option>
                                    <option value="Conhecimento Avançado">Conhecimento Avançado</option>
                                    <option value="Aberto a novas ideias">Aberto a novas ideias</option>
                                    <option value="Exigente">Exigente</option>
                                    <option value="Pró ativo">Pró ativo</option>
                                    <option value="Indeciso / Confuso">Indeciso / Confuso</option>
                                </select>
                            </div>
                        </div>

                        <div style="display:none;">
                            
                            <input class="form-control" type="text" name="cep" id="cep" placeholder="Digite o CEP">
           
                            <input class="form-control" type="text" name="endereco" id="campo_logradouro" placeholder="Endereço">
            
                            <input class="form-control" type="text" name="bairro" id="campo_bairro" placeholder="Bairro">
                        
                            <input class="form-control" type="text" name="cidade" id="campo_cidade" placeholder="Cidade">
                        
                            <input class="form-control" type="text" name="estado" id="campo_estado" placeholder="Estado">

                            <input class="form-control" type="text" name="numero" placeholder="numero">

                            <input class="form-control" type="text" name="complemento" placeholder="complemento">

                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="padding-top: 0px !important;display: flex !important;padding-bottom: 20px !important;padding-right: 20px !important;">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>

            </form>
        </div>
    </div>
</div>