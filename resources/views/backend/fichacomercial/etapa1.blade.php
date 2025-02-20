<form method="POST" action="" id="formulario-passo-1">

    @csrf

    <!-- Dados da Empresa -->
    <div class="tab-pane active" role="tabpanel" id="step1">

        <!-- Título do Cliente -->
        <h2 class="h2-titulo"><i class="fas fa-child"></i> <span>Dados da</span> Empresa</h2>

        <!-- Próximo e Volta
        <div id="passo-1" class="proximo-anterior">
            <a class="btn btn-anterior" style="background-color: #c2c6ff;cursor: inherit;color:#FFF;">
                <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
            </a>

            <a class="btn btn-proximo">
                <span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
            </a>
        </div>-->

        <!-- CNPJ/CPF -->
        <div class="form-group col-sm-4 form-ficha-comercial cnpj_cpf">
            <h4 class="h4-fechamento">CNPJ/CPF <span>Somente Números</span></h4>
            <div class="input-group input-group-alternative mb-3">
                <input class="form-control" name="cnpj_cpf" id="cnpj_cpf" placeholder="CNPJ/CPF" type="text" maxlength="14" required>
                <div class="icone-input-ficha-comercial">
                    <i class="ni ni-fat-remove"></i>
                </div>
            </div>
            <p class="error error_cnpj_cpf text-center alert alert-danger hidden"></p>
        </div>

        <!-- Razão Social -->
        <div class="form-group col-sm-4 form-ficha-comercial razao-social">
            <h4 class="h4-fechamento">Razão Social</h4>
            <div class="input-group input-group-alternative mb-3">
                <input id="razao-social" class="form-control" name="razao_social" placeholder="Razão Social" type="text"  maxlength="100" required>
                <div class="icone-input-ficha-comercial">
                    <i class="ni ni-fat-remove"></i>
                </div>
            </div>
            <p class="error error_razao_social text-center alert alert-danger hidden"></p>
        </div>

        <!-- Nome Fantasia -->
        <div class="form-group col-sm-4 form-ficha-comercial nome-fantasia">
            <h4 class="h4-fechamento">Nome Fantasia</h4>
            <div class="input-group input-group-alternative mb-3">
                <input id="nome-fantasia" class="form-control" name="nome_fantasia" placeholder="Nome Fantasia" type="text" maxlength="100" required>
                <div class="icone-input-ficha-comercial">
                    <i class="ni ni-fat-remove"></i>
                </div>
            </div>
            <p class="error error_nome_fantasia text-center alert alert-danger hidden"></p>
        </div>

        <!-- Segmento da Empresa -->
        <div class="form-group col-sm-4 form-ficha-comercial segmento-empresa">
            <h4 class="h4-fechamento">Segmento da Empresa</h4>
            <div class="input-group input-group-alternative mb-3" style="box-shadow: none !important;">
                <select id="segmento-empresa" class="form-control select-ficha select2" name="segmento_empresa">
                    <option value="0">Segmento da Empresa</option>
                    @foreach($segmentos as $registro)
                        <option value="{{ $registro->id }}">{{ $registro->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>



        <!-- Inscrição Estadual -->
        <div class="form-group col-sm-4 form-ficha-comercial inscricao_estadual">
            <h4 class="h4-fechamento">Inscrição Estadual</h4>
            <div class="input-group input-group-alternative mb-3">
                <input id="inscricao_estadual" class="form-control" name="inscricao_estadual" placeholder="Inscrição Estadual" type="text">
                <div class="icone-input-ficha-comercial">
                    <i class="ni ni-fat-remove"></i>
                </div>
            </div>
        </div>

        <!-- Endereço -->

            <!-- CEP -->
            <div class="form-group col-sm-4 form-ficha-comercial cep">
                <h4 class="h4-fechamento">CEP</h4>
                <div class="input-group input-group-alternative mb-3">
                    <input id="cep" class="form-control" type="text" name="cep" id="cep" maxlength="9" placeholder="Digite o CEP" required>
                    <div class="icone-input-ficha-comercial">
                        <i class="ni ni-fat-remove"></i>
                    </div>
                </div>
                <p class="error error_cep text-center alert alert-danger hidden"></p>
            </div>

            <!-- Endereço -->
            <div class="form-group col-sm-4 form-ficha-comercial cep">
                <h4 class="h4-fechamento">Endereço <span>Automático</span></h4>
                <div class="input-group input-group-alternative mb-3">
                    <input class="form-control" type="text" name="endereco" maxlength="164" id="campo_logradouro" placeholder="Endereço" required>
                    <div class="icone-input-ficha-comercial">
                        <i class="ni ni-fat-remove"></i>
                    </div>
                </div>
                <p class="error error_endereco text-center alert alert-danger hidden"></p>
            </div>

            <!-- Bairro -->
            <div class="form-group col-sm-4 form-ficha-comercial cep">
                <h4 class="h4-fechamento">Bairro <span>Automático</span></h4>
                <div class="input-group input-group-alternative mb-3">
                    <input class="form-control" type="text" name="bairro" id="campo_bairro" maxlength="64" placeholder="Bairro" required>
                    <div class="icone-input-ficha-comercial">
                        <i class="ni ni-fat-remove"></i>
                    </div>
                </div>
                <p class="error error_bairro text-center alert alert-danger hidden"></p>
            </div>

            <!-- Cidade -->
            <div class="form-group col-sm-4 form-ficha-comercial cep">
                <h4 class="h4-fechamento">Cidade <span>Automático</span></h4>
                <div class="input-group input-group-alternative mb-3">
                    <input class="form-control" type="text" name="cidade" id="campo_cidade" maxlength="64" placeholder="Cidade" required>
                    <div class="icone-input-ficha-comercial">
                        <i class="ni ni-fat-remove"></i>
                    </div>
                </div>
                <p class="error error_cidade text-center alert alert-danger hidden"></p>
            </div>

            <!-- Estado -->
            <div class="form-group col-sm-4 form-ficha-comercial cep">
                <h4 class="h4-fechamento">Estado <span>Automático</span></h4>
                <div class="input-group input-group-alternative mb-3">
                    <input class="form-control" type="text" name="estado" id="campo_estado" placeholder="Estado(Sigla)" maxlength="2" required>
                    <div class="icone-input-ficha-comercial">
                        <i class="ni ni-fat-remove"></i>
                    </div>
                </div>
                <p class="error error_estado text-center alert alert-danger hidden"></p>
            </div>

            <!-- Número -->
            <div class="form-group col-sm-4 form-ficha-comercial numero-ficha">
                <h4 class="h4-fechamento">Número</h4>
                <div class="input-group input-group-alternative mb-3">
                    <input id="numero-ficha" class="form-control" type="text" name="numero" maxlength="12" placeholder="Número" required>
                    <div class="icone-input-ficha-comercial">
                        <i class="ni ni-fat-remove"></i>
                    </div>
                </div>
                <p class="error error_numero text-center alert alert-danger hidden"></p>
            </div>

            <!-- Complemento -->
            <div class="form-group col-sm-4 form-ficha-comercial complemento">
                <h4 class="h4-fechamento">Complemento</h4>
                <div class="input-group input-group-alternative mb-3">
                    <input id="complemento" class="form-control" type="text" name="complemento" placeholder="Complemento"/>
                    <div class="icone-input-ficha-comercial">
                        <i class="ni ni-fat-remove"></i>
                    </div>
                </div>
            </div>

        <!-- FIM Endereço -->

        <!-- Dia Boleto -->
        <div class="form-group col-sm-4 form-ficha-comercial dia-boleto">
            <h4 class="h4-fechamento">Dia Boleto</h4>
            <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                <select id="dia-boleto" class="form-control select-ficha" name="dia_boleto">
                    <option value="--">Melhor dia pra Boleto</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                </select>
                <div class="icone-input-ficha-comercial">
                    <i class="ni ni-fat-remove"></i>
                </div>
            </div>
            <p class="error error_dia_boleto text-center alert alert-danger hidden"></p>
        </div>

        <!-- Obserção Sobre o Boleto -->
        <div class="form-group col-sm-4 form-ficha-comercial observacao_boleto">
            <h4 class="h4-fechamento">Obserção Sobre o Boleto</h4>
            <div class="input-group input-group-alternative mb-3">
                <input id="observacao_boleto" class="form-control" name="observacao_boleto" placeholder="Observação Sobre Boleto" type="text" maxlength="150">
                <div class="icone-input-ficha-comercial">
                    <i class="ni"></i>
                </div>
            </div>
        </div>

        <!-- Nota Fiscal -->
        <div class="form-group col-sm-4 form-ficha-comercial nota_fiscal">
            <h4 class="h4-fechamento">Nota Fiscal</h4>
            <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                <select id="nota_fiscal" class="form-control select-ficha" name="nota_fiscal">
                    <option value="--">Nota Fiscal</option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
                <div class="icone-input-ficha-comercial">
                    <i class="ni ni-fat-remove"></i>
                </div>
            </div>
            <p class="error error_nota_fiscal text-center alert alert-danger hidden"></p>
        </div>

        <!-- Botão Próximo Passo -->
        <button type="submit" class="btn btn-ficha-comercial">
            <span class="btn-inner--text">Próximo Passo</span>
            <span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
        </button>
    </div>

</form>
