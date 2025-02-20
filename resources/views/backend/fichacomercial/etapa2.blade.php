<form method="POST" action="" name="formulario-passo-2" id="formulario-passo-2">

    @csrf

    <!-- Dados de Contato -->
    <div class="tab-pane" role="tabpanel" id="step2">

        <!-- Título do Cliente -->
        <h2 class="h2-titulo"><i class="ni ni-badge"></i> <span>Dados de</span> Contato</h2>

        <!-- Botão para passar -->
        <div id="passo-2" class="proximo-anterior">
            <a class="btn btn-anterior">
                <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
            </a>

            <a class="btn btn-proximo">
                <span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
            </a>
        </div>

        <!-- ID Ficha Comercial -->
        <input id="id-ficha-comercial-contato" name="id_ficha_comercial" type="text" value="" style="display:none;">

        <input id="id_numeros_contato" name="numeros_contato" type="text" value="1" style="display:none;">

        <!-- Dados do Formulário -->
        <div id="clonar-campos-contato">

            <div class="cloned-contato">

                <h3 class="h3-numero">_0</h3>

                <!-- Nome do Cliente -->
                <div class="form-group col-sm-4 form-ficha-comercial nome-cliente">
                    <h4 class="h4-fechamento">Nome do Cliente</h4>
                    <div class="input-group input-group-alternative mb-3">
                        <input id="nome-cliente" class="form-control" name="nome_cliente" placeholder="Nome" type="text"  maxlength="100" required>
                        <div class="icone-input-ficha-comercial">
                        </div>
                    </div>
                    <p class="error error_nome_cliente text-center alert alert-danger hidden"></p>
                </div>

                <!-- Cargo -->
                <div class="form-group col-sm-4 form-ficha-comercial cargo-cliente">
                    <h4 class="h4-fechamento">Cargo</h4>
                    <div class="input-group input-group-alternative mb-3">
                        <input id="cargo-cliente" class="form-control" name="cargo_cliente" placeholder="Cargo" type="text"  maxlength="100" required>
                        <div class="icone-input-ficha-comercial">
                        </div>
                    </div>
                    <p class="error error_cargo_cliente text-center alert alert-danger hidden"></p>
                </div>

                <!-- Responsavel do Projeto -->
                <div class="form-group col-sm-4 form-ficha-comercial responsavel-cliente">
                    <h4 class="h4-fechamento">Tipo de Contato</h4>
                    <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                        <select class="form-control" name="tipo_contato">
                            <option value="--">Tipo de Contato</option>
                            <option value="Responsável do Projeto">Responsável do Projeto</option>
                            <option value="Responsável Financeiro">Responsável Financeiro</option>
                            <option value="Responsável Projeto/Financeiro">Responsável Projeto/Financeiro</option>
                            <option value="Outro">Outro</option>
                        </select>
                        <div class="icone-input-ficha-comercial">
                        </div>
                    </div>
                    <p class="error error_tipo_contato text-center alert alert-danger hidden"></p>
                </div>

                <!-- Telefone -->
                <div class="form-group col-sm-4 form-ficha-comercial telefone-cliente">
                    <h4 class="h4-fechamento">Telefone</h4>
                    <div class="input-group input-group-alternative mb-3">
                        <input id="telefone" class="form-control" name="telefone_cliente" placeholder="Telefone Residencial" type="tel">
                        <div class="icone-input-ficha-comercial">
                        </div>
                    </div>
                </div>

                <!-- Celular -->
                <div class="form-group col-sm-4 form-ficha-comercial celular-cliente">
                    <h4 class="h4-fechamento">Celular</h4>
                    <div class="input-group input-group-alternative mb-3">
                        <input id="celular" class="form-control" name="celular" maxlength="15" placeholder="Celular" type="tel">
                        <div class="icone-input-ficha-comercial">
                        </div>
                    </div>
                    <p class="error error_celular text-center alert alert-danger hidden"></p>
                </div>

                <!-- E-mail -->
                <div class="form-group col-sm-4 form-ficha-comercial email-cliente">
                    <h4 class="h4-fechamento">E-mail</h4>
                    <div class="input-group input-group-alternative mb-3">
                        <input id="email" class="form-control" name="email" placeholder="E-mail" type="email" >
                        <div class="icone-input-ficha-comercial">
                        </div>
                    </div>
                    <p class="error error_email text-center alert alert-danger hidden"></p>
                </div>

                <!-- Data de Nascimento -->
                <div class="form-group col-sm-4 form-ficha-comercial data-nascimento">
                    <h4 class="h4-fechamento">Data de Nascimento</h4>
                    <div class="input-group input-group-alternative mb-3">
                        <input id="data-nascimento" class="form-control" name="nascimento" placeholder="Data de Nascimento" type="date" >
                        <div class="icone-input-ficha-comercial">
                        </div>
                    </div>
                </div>

                <!-- Perfil do Cliente -->
                <div class="form-group col-sm-12 form-ficha-comercial perfil-cliente" style="width:98% !important;">
                    <h4 class="h4-fechamento">Perfil do Cliente</h4>
                    <div class="input-group input-group-alternative mb-3">
                        <div class="custom-control custom-checkbox checkbox-ficha-comercial">
                            <input name="perfilcliente[]" class="custom-control-input" id="customCheck1" type="checkbox" value="Conhecimento Básico">
                            <label class="custom-control-label" for="customCheck1">Conhecimento Básico</label>
                        </div>

                        <div class="custom-control custom-checkbox checkbox-ficha-comercial">
                            <input name="perfilcliente[]" class="custom-control-input" id="customCheck2" type="checkbox" value="Conhecimento Intermediário">
                            <label class="custom-control-label" for="customCheck2">Conhecimento Intermediário</label>
                        </div>

                        <div class="custom-control custom-checkbox checkbox-ficha-comercial">
                            <input name="perfilcliente[]" class="custom-control-input" id="customCheck3" type="checkbox" value="Conhecimento Avançado">
                            <label class="custom-control-label" for="customCheck3">Conhecimento Avançado</label>
                        </div>

                        <div class="custom-control custom-checkbox checkbox-ficha-comercial">
                            <input name="perfilcliente[]" class="custom-control-input" id="customCheck4" type="checkbox" value="Exigente">
                            <label class="custom-control-label" for="customCheck4">Exigente</label>
                        </div>

                        <div class="custom-control custom-checkbox checkbox-ficha-comercial">
                            <input name="perfilcliente[]" class="custom-control-input" id="customCheck5" type="checkbox" value="Pró Ativo">
                            <label class="custom-control-label" for="customCheck5">Pró Ativo</label>
                        </div>

                        <div class="custom-control custom-checkbox checkbox-ficha-comercial">
                            <input name="perfilcliente[]" class="custom-control-input" id="customCheck6" type="checkbox" value="Indeciso / Confunso">
                            <label class="custom-control-label" for="customCheck6">Indeciso / Confunso</label>
                        </div>

                        <div class="custom-control custom-checkbox checkbox-ficha-comercial">
                            <input name="perfilcliente[]" class="custom-control-input" id="customCheck7" type="checkbox" value="Aberto a novas ideias">
                            <label class="custom-control-label" for="customCheck7">Aberto a novas ideias</label>
                        </div>
                    </div>
                    <p class="error error_perfilcliente text-center alert alert-danger hidden"></p>
                </div>

            </div>

        </div>

        <!-- Botão de Adicionar mais de um Contato -->
        <div id="adicionar-mais-contato" class="mais-contato">
            <a class="btn btn-add-mais">
                <span class="btn-inner--icon">
                    <i class="fas fa-plus my-float"></i>
                    Adicionar mais Contato
                </span>
            </a>
        </div>

        <!-- Botão Próximo Passo -->
        <button type="submit" class="btn btn-ficha-comercial-2">
            <span class="btn-inner--text">Próximo Passo</span>
            <span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
        </button>

    </div>

</form>
