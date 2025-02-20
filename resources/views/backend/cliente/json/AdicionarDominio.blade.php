<!-- Modal -->
<div class="modal fade" id="dominioModel" tabindex="-1" role="dialog" aria-labelledby="dominioModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="dominioModelLabel">Adicionando Domínio</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('backend.cliente.transferir.dominio.salvarDominio', [$cliente->id, $projeto->id]) }}" method="post" enctype="multipart/form-data" style="align-items: center;display: flex;flex-wrap: wrap;">
                    
                {{ csrf_field() }}
                <div class="row">
                    <!-- Nome do Domínio -->
                    <div class="form-group col-sm-4">
                        <div class="form-group col-sm-12">
                            <label>Dominio do Site *</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="dominio" type="text" value="" required>
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de Hospedagem -->
                    <div class="form-group col-sm-4">
                        <div class="form-group col-sm-12">
                            <label>Tipo de Hospedagem</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <select class="form-control" name="tipo_hospedagem">
                                    <option value="">--</option>
                                    <option value="Redirecionamento">Redirecionamento</option>
                                    <option value="Hospedagem Interna">Hospedagem Interna</option>
                                    <option value="Hospedagem Externa">Hospedagem Externa</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Dominio Principal -->
                    <div class="form-group col-sm-4">
                        <div class="form-group col-sm-12">
                            <label>Dominio Principal</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <select class="form-control" name="dominio_principal">
                                    <option value="">--</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- SSL -->
                    <div class="form-group col-sm-4">
                        <div class="form-group col-sm-12">
                            <label>SSL</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <select class="form-control" name="ssl">
                                    <option value="">--</option>
                                    <option value="1">Sim</option>
                                    <option value="0">N&atilde;o</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <!-- CDN -->
                    <div class="form-group col-sm-4">
                        <div class="form-group col-sm-12">
                            <label>CDN</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <select class="form-control" name="cdn">
                                    <option value="1" selected="selected">--</option>
                                    <option value="1">Sim</option>
                                    <option value="0">N&atilde;o</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <!-- Status do Dominio -->
                    <div class="form-group col-sm-4">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} col-sm-12">
                            <label>Status</label>
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <select class="form-control" name="status">
                                    <option value="Ativo">--</option>
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                            </select>
                            </div>
                        </div>
                    </div>

                    <!-- Cliente Selecionado no select -->
                    <input class="form-control" name="pcliente_selecionado" id="pcliente_selecionado" type="hidden" value="" >
                    
                    
                    <div class="form-group col-sm-4">
                        <button class="btn btn-info" style="margin: 17px;margin-top: -10px;height: 40px;">Adicionar</button> 
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>