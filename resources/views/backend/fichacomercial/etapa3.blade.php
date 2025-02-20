<form method="POST" action="" id="formulario-passo-3">

    @csrf

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

        <input id="id-ficha-comercial-projeto" name="id_ficha_comercial" type="text" value="" style="display:none;">

        <input id="id_numeros_projeto" name="numeros_projeto" type="text" value="1" style="display:none;">

        <!-- Dados do Formulário -->
        <div id="clonar-campos-projeto">
            <div class="cloned-projeto-principal">

                <h3 class="h3-numero-projetos">_0</h3>

                <!-- Selecionar Campo -->
                <div id="projeto-ficha-comercial">

                    <!-- Tipo de Projeto -->
                    <div class="form-group col-sm-12 form-ficha-comercial tipo-projeto" style="width: 98% !important;">
                        <h4 class="h4-fechamento">Selecione um projeto:</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow: none !important;border: 1px solid #e1e1e1;border-radius: 3px;padding: 3px;font-size: 14px;">
                            <select class="form-control select-ficha select2" name="tipo_projeto">
                                <option value="--">Selecione o Tipo de Projeto</option>
                                @foreach($tipo_projetos as $registro)
                                    <option value="{{ $registro->id }}">{{ $registro->nome }}</option>
                                @endforeach
                            </select>
                            <div class="icone-input-ficha-comercial" style="top: 5px;">

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
                            <input class="form-control" name="fechamento_contrato" type="date">
                            <div class="icone-input-ficha-comercial">

                            </div>
                        </div>
                    </div>

                    <!-- Prazo -->
                    <div class="form-group col-sm-4 form-ficha-comercial prazo_projeto">
                        <h4 class="h4-fechamento">Prazo</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select class="form-control select-ficha" name="prazo_projeto">
                                <option value="--">--</option>
                                <option value="30">30 dias</option>
                                <option value="40">45 dias</option>
                                <option value="50">50 dias</option>
                                <option value="60">65 dias</option>
                            </select>
                            <div class="icone-input-ficha-comercial">

                            </div>
                        </div>
                    </div>

                    <!-- Tipo de Manutenção -->
                    <div class="form-group col-sm-4 form-ficha-comercial tipo_manutencao">
                        <h4 class="h4-fechamento">Tipo de Manutenção</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select class="form-control select-ficha" name="tipo_manutencao">
                                <option value="--">--</option>
                                <option value="Mensal">Mensal</option>
                                <option value="Hora Técnica">Hora Técnica</option>
                            </select>
                            <div class="icone-input-ficha-comercial">

                            </div>
                        </div>
                    </div>

                    <!-- Conteúdo -->
                    <div class="form-group col-sm-4 form-ficha-comercial conteudo_site">
                        <h4 class="h4-fechamento">Conteúdo</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select class="form-control select-ficha" name="conteudo_site">
                                <option value="--">--</option>
                                <option value="Responsabilidade do Cliente">Responsabilidade do Cliente</option>
                                <option value="Nós vamos desenvolver">Nós vamos desenvolver</option>
                                <option value="Baseado no site antigo">Baseado no site antigo</option>
                                <option value="Reestrutura do Conteúdo">Reestrutura do Conteúdo</option>
                            </select>
                            <div class="icone-input-ficha-comercial">

                            </div>
                        </div>
                    </div>

                    <!-- Idiomas -->
                    <div class="form-group col-sm-4 form-ficha-comercial idiomas">
                        <h4 class="h4-fechamento">Idiomas</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select class="form-control select-ficha" name="idiomas">
                                <option value="--">--</option>
                                <option value="Português">Português</option>
                                <option value="Inglês">Inglês</option>
                                <option value="Espanhol">Espanhol</option>
                                <option value="Italiano">Italiano</option>
                                <option value="Outro">Outro</option>
                            </select>
                            <div class="icone-input-ficha-comercial">

                            </div>
                        </div>
                    </div>

                    <!-- Vai ter SSL/CDN -->
                    <div class="form-group col-sm-4 form-ficha-comercial ssl-cdn">
                        <h4 class="h4-fechamento">Vai ter SSL/CDN?</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <select class="form-control select-ficha" name="ssl-cdn">
                                <option value="--">--</option>
                                <option value="SSL">SSL</option>
                                <option value="CDN">CDN</option>
                                <option value="SSL/CDN">SSL/CDN</option>
                                <option value="Não Terá">Não Terá</option>
                            </select>
                            <div class="icone-input-ficha-comercial">

                            </div>
                        </div>
                    </div>

                    <!-- Itens de Menu -->
                    <div class="form-group col-sm-6 form-ficha-comercial itens_menu" style="width:48% !important;">
                        <h4 class="h4-fechamento">Itens de Menu</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <textarea class="form-control" name="itens_menu" type="text" placeholder="Escreva aqui os itens de menu..."></textarea>
                            <div class="icone-input-ficha-comercial">

                            </div>
                        </div>
                    </div>

                    <!-- Itens Página Principal -->
                    <div class="form-group col-sm-6 form-ficha-comercial itens_pp" style="width:48% !important;">
                        <h4 class="h4-fechamento">Itens Página Principal</h4>
                        <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                            <textarea class="form-control" name="itens_pp" type="text" placeholder="Escreva aqui os itens da página principal..."></textarea>
                            <div class="icone-input-ficha-comercial">

                            </div>
                        </div>
                    </div>

                    <!-- Perguntas Sobre o Slider -->
                    <div class="div-slider">

                        <h5>Slider</h5>

                        <a class="collapse-table-slider-ficha-comercial">
                            <i class="ni ni-fat-add" style="color:#f8424b;"></i>
                        </a>

                        <div class="collapse-table-slider">

                            <!-- Vai ter na Página Principal? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_pp">
                                <h4 class="h4-fechamento">Vai ter na Página Principal?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select class="form-control select-ficha" name="slider_pp">
                                        <option value="--">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Nós que vamos fazer as artes? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_nos_desenvolvemos">
                                <h4 class="h4-fechamento">Nós que vamos fazer as artes?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select class="form-control select-ficha" name="slider_nos_desenvolvemos">
                                        <option value="--">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Quantidade? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_qtd">
                                <h4 class="h4-fechamento">Quantidade?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select class="form-control select-ficha" name="slider_qtd">
                                        <option value="--">--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Vai se feito uma vez só? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_vezes">
                                <h4 class="h4-fechamento">Vai ser feito uma vez só?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select class="form-control select-ficha" name="slider_vezes">
                                        <option value="--">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Qual Periodicidade? -->
                            <div class="form-group col-sm-4 form-ficha-comercial slider_periodicidade">
                                <h4 class="h4-fechamento">Qual Periodicidade?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select class="form-control select-ficha" name="slider_periodicidade">
                                        <option value="--">--</option>
                                        <option value="Mensal">Mensal</option>
                                        <option value="Trimestral">Trimestral</option>
                                        <option value="Semestral">Semestral</option>
                                        <option value="Anual">Anual</option>
                                        <option value="Sazonal">Sazonal</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Observação do Slider -->
                            <div class="form-group col-sm-6 form-ficha-comercial slider_observacao">
                                <h4 class="h4-fechamento">Observação do Slider</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <input class="form-control" name="slider_observacao" placeholder="Escreva aqui..." type="text">
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Perguntas Sobre o Domínio -->
                    <div class="div-dominio">

                        <h5>Domínio</h5>

                        <a class="collapse-table-dominio-ficha-comercial">
                            <i class="ni ni-fat-add" style="color:#00cdf3;"></i>
                        </a>

                        <div class="collapse-table-dominio">

                            <!-- Domínio do Site -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_principal">
                                <h4 class="h4-fechamento">Domínio do Site</h4>
                                <div class="input-group input-group-alternative mb-3">
                                    <input class="form-control" name="dominio_principal" placeholder="Escreva aqui..." type="text">
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Domínio já está registrado? -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_registrado">
                                <h4 class="h4-fechamento">Domínio já está registrado?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select class="form-control select-ficha" name="dominio_registrado">
                                        <option value="--">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Criação/Migração? -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_criacao_migracao">
                                <h4 class="h4-fechamento">Criação/Migração?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select class="form-control select-ficha" name="dominio_criacao_migracao">
                                        <option value="--">--</option>
                                        <option value="Migração">Migração</option>
                                        <option value="Criação">Criação</option>
                                        <option value="Criação com E-mail">Criação com E-mail</option>
                                        <option value="MX Externo">MX Externo</option>
                                        <option value="Hospedagem Externa">Hospedagem Externa</option>
                                        <option value="Apontamento WWW">Apontamento WWW</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Em que momento vamos executar? -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_executar">
                                <h4 class="h4-fechamento">Qual momento vamos executar?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select class="form-control select-ficha" name="dominio_executar">
                                        <option value="--">--</option>
                                        <option value="Imediatamente">Imediatamente</option>
                                        <option value="Após Lançamento">Após Lançamento</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Os e-mails vão ficar com a gente? -->
                            <div class="form-group col-sm-4 form-ficha-comercial dominio_email">
                                <h4 class="h4-fechamento">Os e-mails vão ficar com a gente?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select class="form-control select-ficha" name="dominio_email">
                                        <option value="--">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Observação do Slider -->
                            <div class="form-group col-sm-6 form-ficha-comercial dominio_observacao">
                                <h4 class="h4-fechamento">Observação do Domínio</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <input class="form-control" name="dominio_observacao" placeholder="Escreva aqui..." type="text">
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Perguntas Sobre o Redirects -->
                    <div class="div-redirects">

                        <h5>Redirects</h5>

                        <a class="collapse-table-redirects-ficha-comercial">
                            <i class="ni ni-fat-add" style="color:#ffd800;"></i>
                        </a>

                        <div class="collapse-table-redirects">

                            <!-- Haverá Redirect?? -->
                            <div class="form-group col-sm-6 form-ficha-comercial redirect" style="width:49% !important;">
                                <h4 class="h4-fechamento">Haverá Redirect?</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <select id="redirect" class="form-control select-ficha" name="dominio_registrado">
                                        <option value="--">--</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Se sim, quais redirects e para onde elas devem ir? -->
                            <div class="form-group col-sm-6 form-ficha-comercial redirect_direcao" style="width:49% !important;">
                                <h4 class="h4-fechamento">Se sim, Para onde eles devem ir?</h4>
                                <div class="input-group input-group-alternative mb-3">
                                    <input id="redirect_direcao" class="form-control" name="redirect_direcao" placeholder="Ex: dominio.com.br para nomedominio.com.br ..." type="text">
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                            <!-- Observação sobre Redirect -->
                            <div class="form-group col-sm-12 form-ficha-comercial redirect_observacao" style="width:100% !important;">
                                <h4 class="h4-fechamento">Observação sobre Redirect</h4>
                                <div class="input-group input-group-alternative mb-3" style="box-shadow:none !important;">
                                    <input id="redirect_observacao" class="form-control" name="redirect_observacao" placeholder="Escreva aqui..." type="text">
                                    <div class="icone-input-ficha-comercial">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Campos caso o projeto for Marketing -->
                <div class="projetos-marketing">

                    <h5>Marketing</h5>

                    <a class="collapse-table-marketing-ficha-comercial">
                        <i class="ni ni-fat-add" style="color:#5c6ce8;"></i>
                    </a>

                    <div class="collapse-table-marketing">

                        <!-- Data de Inicio das ações -->
                        <div class="form-group col-sm-4 form-ficha-comercial data-inicio-marketing">
                            <h4 class="h4-fechamento">Data de Inicio das ações</h4>
                            <div class="input-group input-group-alternative mb-3">
                                <input id="data-inicio-marketing" class="form-control" name="fechamento_contrato_marketing" type="date">
                                <div class="icone-input-ficha-comercial">

                                </div>
                            </div>
                        </div>

                        <!-- Investimento -->
                        <div class="form-group col-sm-4 form-ficha-comercial investimento-marketing">
                            <h4 class="h4-fechamento">Investimento Mensal P/ Média</h4>
                            <div class="input-group input-group-alternative mb-3">
                                <input id="investimento-marketing" class="form-control" name="investimento_marketing" type="text">
                                <div class="icone-input-ficha-comercial">

                                </div>
                            </div>
                        </div>

                        <!-- Número de Post por Mês -->
                        <div class="form-group col-sm-4 form-ficha-comercial numero-post-marketing">
                            <h4 class="h4-fechamento">Número de Post por Mês</h4>
                            <div class="input-group input-group-alternative mb-3">
                                <input id="numero-post-marketing" class="form-control" name="numero-post-marketing" type="number">
                                <div class="icone-input-ficha-comercial">

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <!-- Botão de Adicionar mais de um Projeto -->
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
            <span class="btn-inner--text">Finalizar</span>
            <span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
        </button>

    </div>

</form>
