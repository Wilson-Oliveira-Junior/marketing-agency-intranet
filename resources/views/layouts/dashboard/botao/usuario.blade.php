<!-- Modal -->
<div class="modal fade" id="usuarioModal" tabindex="-1" role="dialog" aria-labelledby="usuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-floating" role="document">
        <div class="modal-content">
            <form action="{{ route('backend.usuario.salvar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header">
                    <h5 class="modal-title" id="usuarioModalLabel">Adicionar Usuário</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-bottom:0px;">
                    <div class="row">
                        
                        <!-- Nome -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="name" placeholder="Nome" type="text">
                            </div>
                        </div>
                        
                        <!-- Sobrenome -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="sobrenome" placeholder="Sobrenome" type="text">
                            </div>
                        </div>

                        <!-- E-mail -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" placeholder="E-mail">
                            </div>
                        </div>

                        <!-- Data de Nascimento -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control" placeholder="Nascimento" name="nascimento" type="date">
                            </div>
                        </div>

                        <!-- Celular -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                </div>
                                <input class="form-control" placeholder="Celular" name="celular" type="text">
                            </div>
                        </div>

                        <!-- Setor Usuário -->
                        <div class="form-group col-sm-4">
                            <div class="input-group input-group-alternative mb-3" style="min-height: 45px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-atom"></i></span>
                                </div>
                                <select name="setor" style="width: 80%;border: none;padding: 10px;color: #aeaeae;">
                                    @foreach($data['ldsetores'] as $setore)
                                        <option value="{{ $setore->id }}" {{ (isset($usuario->setor) && $usuario->setor == $setore->id ? 'selected' : '') }}>{{ $setore->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Imagem -->
                        <div class="form-group col-sm-6">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="btn">
                                    <input type="file" name="image" class="form-control-file">
                                </div>
                            </div>
                        </div>

                        <!-- Senha do Usuário -->
                        <div class="form-group col-sm-6">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Senha">
                            </div>
                        </div>

                        <div style="display:none;">

                            <input type="text" name="ramal" class="form-control" maxlength="6" placeholder="Ramal .Ex: 7212">

                            <input class="form-control" type="text" name="cep" id="campo_cep" placeholder="Digite o CEP">

                            <input class="form-control" type="text" name="endereco" id="campo_logradouro" placeholder="Endereço">

                            <input class="form-control" type="text" name="bairro" id="campo_bairro" placeholder="Bairro">

                            <input class="form-control" type="text" name="cidade" id="campo_cidade" placeholder="Cidade">

                            <input class="form-control" type="text" name="estado" id="campo_estado" placeholder="Estado">

                            <input class="form-control" name="facebook" placeholder="Link Facebook" type="text">

                            <input class="form-control" name="instagram" placeholder="Link Instagram" type="text">

                            <input class="form-control" name="linkedin" placeholder="Link Linkedin" type="text">
                            
                            <textarea rows="4" name="descricao" class="form-control form-control-alternative" placeholder="Escreva um pouco sobre você ..."></textarea>

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