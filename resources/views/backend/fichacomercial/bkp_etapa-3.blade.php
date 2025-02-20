<form method="POST" action="" id="formulario-passo-3">

    {{ csrf_field() }}

    <!-- Dados de Contato -->
    <div class="tab-pane" role="tabpanel" id="step3">

        <!-- Título do Cliente -->
        <h2 class="h2-titulo"><i class="ni ni-paper-diploma"></i> <span>Dados do</span> Projeto</h2>

        <!-- Próximo e Volta -->
        <div id="passo-3" class="proximo-anterior">
            <a class="btn btn-anterior">
                <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
            </a>

            <a class="btn btn-proximo" style="background-color: #c2c6ff;cursor: inherit;">
                <span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
            </a>
        </div>

        <!-- Dados do Formulário -->
        <div id="clonar-campos-projeto">
            <div class="cloned-contato-projeto">

                <!-- Selecionar Campo -->
                <div id="projeto-ficha-comercial">

                    <!-- Tipo de Projeto -->
                    <div class="form-group col-sm-12 form-ficha-comercial tipo-projeto" style="width: 98% !important;">
                        <h4 class="h4-fechamento">Selecione um projeto:</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow: none !important;border: 1px solid #e1e1e1;border-radius: 3px;padding: 3px;font-size: 14px;">
                            <select id="tipo-projeto" class="form-control select-ficha select2" name="tipo_projeto_0" onchange="optionTipoProjeto()">
                                <option value="NULL">Selecione o Tipo de Projeto</option>
                                @foreach($tipo_projetos as $registro)
                                    <option value="{{ $registro->id }}">{{ $registro->nome }}</option>
                                @endforeach
                            </select>
                            <div class="icone-input-ficha-comercial" style="top: 5px;">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Campos caso o projeto for Site -->
                <div class="projetos-sites">

                    <!-- Data Fechamento do Contrato -->
                    <div class="form-group col-sm-4 form-ficha-comercial data-fechamento-contrato">
                        <h4 class="h4-fechamento">Data Fechamento do Contrato</h4>
                        <div class="input-group input-group-alternative mb-3">
                            <input id="data-fechamento-contrato" class="form-control" name="fechamento_contrato_0" type="date">
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Prazo -->
                    <div class="form-group col-sm-4 form-ficha-comercial prazo_projeto">
                        <h4 class="h4-fechamento">Prazo</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select id="prazo_projeto" class="form-control select-ficha" name="prazo_projeto_0">
                                <option value="0">--</option>
                                <option value="30">30 dias</option>
                                <option value="40">45 dias</option>
                                <option value="50">50 dias</option>
                                <option value="60">65 dias</option>
                            </select>
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de Manutenção -->
                    <div class="form-group col-sm-4 form-ficha-comercial tipo_manutencao">
                        <h4 class="h4-fechamento">Tipo de Manutenção</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select id="tipo_manutencao" class="form-control select-ficha" name="tipo_manutencao_0">
                                <option value="NULL">--</option>
                                <option value="Mensal">Mensal</option>
                                <option value="Hora Técnica">Hora Técnica</option>
                            </select>
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Conteúdo -->
                    <div class="form-group col-sm-4 form-ficha-comercial tipo_manutencao">
                        <h4 class="h4-fechamento">Conteúdo</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select id="tipo_manutencao" class="form-control select-ficha" name="tipo_manutencao_0">
                                <option value="NULL">--</option>
                                <option value="Responsabilidade do Cliente">Responsabilidade do Cliente</option>
                                <option value="Nós vamos desenvolver">Nós vamos desenvolver</option>
                                <option value="Baseado no site antigo">Baseado no site antigo</option>
                                <option value="Reestrutura do Conteúdo">Reestrutura do Conteúdo</option>
                            </select>
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Idiomas -->
                    <div class="form-group col-sm-4 form-ficha-comercial idiomas">
                        <h4 class="h4-fechamento">Idiomas</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select id="idiomas" class="form-control select-ficha" name="idiomas_0">
                                <option value="NULL">--</option>
                                <option value="Português">Português</option>
                                <option value="Inglês">Inglês</option>
                                <option value="Espanhol">Espanhol</option>
                                <option value="Italiano">Italiano</option>
                                <option value="Outro">Outro</option>
                            </select>
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Vai ter SSL/CDN -->
                    <div class="form-group col-sm-4 form-ficha-comercial tipo_manutencao">
                        <h4 class="h4-fechamento">Vai ter SSL/CDN?</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select id="tipo_manutencao" class="form-control select-ficha" name="tipo_manutencao_0">
                                <option value="NULL">--</option>
                                <option value="SSL">SSL</option>
                                <option value="CDN">CDN</option>
                                <option value="SSL/CDN">SSL/CDN</option>
                                <option value="Não Terá">Não Terá</option>
                            </select>
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Itens de Menu -->
                    <div class="form-group col-sm-6 form-ficha-comercial itens_menu" style="width:48% !important;">
                        <h4 class="h4-fechamento">Itens de Menu</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <textarea id="itens_menu" class="form-control" name="itens_menu_0" type="text" placeholder="Escreva aqui os itens de menu..."></textarea>
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Itens Página Principal -->
                    <div class="form-group col-sm-6 form-ficha-comercial itens_pp" style="width:48% !important;">
                        <h4 class="h4-fechamento">Itens Página Principal</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <textarea id="itens_pp" class="form-control" name="itens_pp_0" type="text" placeholder="Escreva aqui os itens da página principal..."></textarea>
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Perguntas Sobre o Slider -->
                    <div class="div-slider">
                        
                        <h5>Slider</h5>

                        <a class="collapse-table-slider-ficha-comercial">
                            <i class="ni ni-fat-add" style="color:#FFF;"></i> 
                        </a>
                        
                        <div class="collapse-table-slider">

                            <!-- Vai ter na Página Principal? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_pp">
                                <h4 class="h4-fechamento">Vai ter na Página Principal?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="slider_pp" class="form-control select-ficha" name="slider_pp_0">
                                        <option value="NULL">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Nós que vamos fazer as artes? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_nos_desenvolvemos">
                                <h4 class="h4-fechamento">Nós que vamos fazer as artes?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="slider_nos_desenvolvemos" class="form-control select-ficha" name="slider_nos_desenvolvemos_0">
                                        <option value="NULL">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Quantidade? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_qtd">
                                <h4 class="h4-fechamento">Quantidade?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="slider_qtd" class="form-control select-ficha" name="slider_qtd_0">
                                        <option value="NULL">--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Vai se feito uma vez só? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_vezes">
                                <h4 class="h4-fechamento">Vai ser feito uma vez só?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="slider_vezes" class="form-control select-ficha" name="slider_vezes_0">
                                        <option value="NULL">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Qual Periodicidade? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_periodicidade">
                                <h4 class="h4-fechamento">Qual Periodicidade?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="slider_periodicidade" class="form-control select-ficha" name="slider_periodicidade_0">
                                        <option value="NULL">--</option>
                                        <option value="Sim">Mensal</option>
                                        <option value="Não">Trimestral</option>
                                        <option value="Não">Semestral</option>
                                        <option value="Não">Anual</option>
                                        <option value="Não">Sazional</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Observação do Slider -->
                            <div class="form-group col-sm-6 form-ficha-comercial slider_observacao">
                                <h4 class="h4-fechamento">Observação do Slider</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <input id="slider_observacao" class="form-control" name="slider_observacao_0" placeholder="Escreva aqui..." type="text">
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Perguntas Sobre o Domínio -->
                    <div class="div-dominio">
                        
                        <h5>Domínio</h5>

                        <a class="collapse-table-dominio-ficha-comercial">
                            <i class="ni ni-fat-add" style="color:#FFF;"></i> 
                        </a>
                        
                        <div class="collapse-table-dominio">

                            <!-- Domínio do Site -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_principal">
                                <h4 class="h4-fechamento">Domínio do Site</h4>
                                <div class="input-group input-group-alternative mb-3">
                                    <input id="dominio_principal" class="form-control" name="dominio_principal_0" placeholder="Escreva aqui..." type="text">
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Domínio já está registrado? -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_registrado">
                                <h4 class="h4-fechamento">Domínio já está registrado?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="dominio_registrado" class="form-control select-ficha" name="dominio_registrado_0">
                                        <option value="NULL">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Criação/Migração? -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_criacao_migracao">
                                <h4 class="h4-fechamento">Criação/Migração?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="dominio_criacao_migracao" class="form-control select-ficha" name="dominio_criacao_migracao_0">
                                        <option value="NULL">--</option>
                                        <option value="Sim">Migração</option>
                                        <option value="Não">Criação</option>
                                        <option value="Não">Criação com E-mail</option>
                                        <option value="Não">MX Externo</option>
                                        <option value="Não">Hospedagem Externa</option>
                                        <option value="Não">Apontamento WWW</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Em que momento vamos executar? -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_executar">
                                <h4 class="h4-fechamento">Qual momento vamos executar?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="dominio_executar" class="form-control select-ficha" name="dominio_executar_0">
                                        <option value="NULL">--</option>
                                        <option value="Imediatamente">Imediatamente</option>
                                        <option value="Após Lançamento">Após Lançamento</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Os e-mails vão ficar com a gente? -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_email">
                                <h4 class="h4-fechamento">Os e-mails vão ficar com a gente?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="dominio_email" class="form-control select-ficha" name="dominio_email_0">
                                        <option value="NULL">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Observação do Slider -->
                            <div class="form-group col-sm-6 form-ficha-comercial dominio_observacao">
                                <h4 class="h4-fechamento">Observação do Domínio</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <input id="dominio_observacao" class="form-control" name="dominio_observacao_0" placeholder="Escreva aqui..." type="text">
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Perguntas Sobre o Redirects -->
                    <div class="div-redirects">
                        
                        <h5>Redirects</h5>

                        <a class="collapse-table-redirects-ficha-comercial">
                            <i class="ni ni-fat-add" style="color:#FFF;"></i> 
                        </a>

                        <div class="collapse-table-redirects">

                            <!-- Haverá Redirect?? -->
                            <div class="form-group col-sm-6 form-ficha-comercial redirect" style="width:49% !important;">
                                <h4 class="h4-fechamento">Haverá Redirect?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="redirect" class="form-control select-ficha" name="dominio_registrado_0">
                                        <option value="NULL">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Se sim, quais redirects e para onde elas devem ir? -->
                            <div class="form-group col-sm-6 form-ficha-comercial redirect_direcao" style="width:49% !important;">
                                <h4 class="h4-fechamento">Se sim, Para onde eles devem ir?</h4>
                                <div class="input-group input-group-alternative mb-3">
                                    <input id="redirect_direcao" class="form-control" name="redirect_direcao_0" placeholder="Ex: dominio.com.br para nomedominio.com.br ..." type="text">
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Observação sobre Redirect -->
                            <div class="form-group col-sm-12 form-ficha-comercial redirect_observacao" style="width:100% !important;">
                                <h4 class="h4-fechamento">Observação sobre Redirect</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <input id="redirect_observacao" class="form-control" name="redirect_observacao_0" placeholder="Escreva aqui..." type="text">
                                    <div class="icone-input-ficha-comercial">
                                        <i class="ni ni-fat-remove"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Campos caso o projeto for Marketing -->
                <div class="projetos-marketing">
                    
                    <!-- Data Fechamento do Contrato -->
                    <div class="form-group col-sm-4 form-ficha-comercial data-fechamento-contrato-marketing">
                        <h4 class="h4-fechamento">Data Fechamento do Contrato</h4>
                        <div class="input-group input-group-alternative mb-3">
                            <input id="data-fechamento-contrato-marketing" class="form-control" name="fechamento_contrato_marketing_0" type="date">
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Data de Inicio das ações -->
                    <div class="form-group col-sm-4 form-ficha-comercial data-inicio-marketing">
                        <h4 class="h4-fechamento">Data de Inicio das ações</h4>
                        <div class="input-group input-group-alternative mb-3">
                            <input id="data-inicio-marketing" class="form-control" name="fechamento_contrato_marketing_0" type="date">
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Data de Inicio das ações -->
                    <div class="form-group col-sm-4 form-ficha-comercial investimento-marketing">
                        <h4 class="h4-fechamento">Investimento Mensal P/ Média</h4>
                        <div class="input-group input-group-alternative mb-3">
                            <input id="investimento-marketing" class="form-control" name="investimento_marketing_0" type="text">
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Número de Post por Mês -->
                    <div class="form-group col-sm-12 form-ficha-comercial investimento-marketing" style="width:98% !important;">
                        <h4 class="h4-fechamento">Número de Post por Mês</h4>
                        <div class="input-group input-group-alternative mb-3">
                            <input id="investimento-marketing" class="form-control" name="investimento_marketing_0" type="number">
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Campos caso o projeto for Design -->
                <div class="projetos-design">
                    
                    <!-- Data Fechamento do Contrato -->
                    <div class="form-group col-sm-6 form-ficha-comercial data-fechamento-contrato-marketing" style="width:48% !important;">
                        <h4 class="h4-fechamento">Data Fechamento do Contrato</h4>
                        <div class="input-group input-group-alternative mb-3">
                            <input id="data-fechamento-contrato-marketing" class="form-control" name="fechamento_contrato_marketing_0" type="date">
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Prazo -->
                    <div class="form-group col-sm-6 form-ficha-comercial prazo_projeto" style="width:48% !important;">
                        <h4 class="h4-fechamento">Prazo</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select id="prazo_projeto" class="form-control select-ficha" name="prazo_projeto_0">
                                <option value="0">--</option>
                                <option value="30">30 dias</option>
                                <option value="40">45 dias</option>
                                <option value="50">50 dias</option>
                                <option value="60">65 dias</option>
                            </select>
                            <div class="icone-input-ficha-comercial">
                                <i class="ni ni-fat-remove"></i>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- Botão de Adicionar mais de um Contato -->
        <div id="adicionar-mais-projeto" class="mais-projeto">
            <a class="btn btn-add-mais">
                <span class="btn-inner--icon">
                    <i class="fas fa-plus my-float"></i>
                    Adicionar mais Projeto
                </span>
            </a>
        </div>

        <!-- Botão Próximo Passo -->
        <button type="submit" class="btn btn-ficha-comercial-3">
            <span class="btn-inner--text">Próximo Passo</span>
            <span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
        </button>

    </div>

</form>