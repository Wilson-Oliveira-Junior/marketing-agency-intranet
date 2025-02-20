<h3 class="titulo-formulario">Informações do Cliente</h3>

<div class="row col-sm-12">
    
    <!-- Domínio -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }} col-sm-12">
            <label>Dominio *</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" name="nome" type="text" value="{{ isset($clientes->nome) ? $clientes->nome : '' }}">
            </div>
        </div>
    </div>

    <!-- Razão Social -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('razao_social') ? 'has-error' : '' }} col-sm-12">
            <label>Razão Social *</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" name="razao_social" type="text" value="{{ isset($clientes->razao_social) ? $clientes->razao_social : '' }}">
            </div>
        </div>
    </div>

    <!-- Nome Fantasia -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('nome_fantasia') ? 'has-error' : '' }} col-sm-12">
            <label>Nome Fantasia *</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" name="nome_fantasia" type="text" value="{{ isset($clientes->nome_fantasia) ? $clientes->nome_fantasia : '' }}">
            </div>
        </div>
    </div>

    <!-- CNPJ -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('CNPJ') ? 'has-error' : '' }} col-sm-12">
            <label>CPF / CNPJ</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control cpf_cnpj" name="CNPJ" type="text" id="cnpj" value="{{ isset($clientes->CNPJ) ? $clientes->CNPJ : '' }}">
            </div>
        </div>
    </div>

    <!-- Perfil do Cliente -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('perfil_cliente') ? 'has-error' : '' }} col-sm-12">
            <label>Perfil do Cliente *</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <select class="form-control" name="perfil_cliente">
                    <option value="Conhecimento básico"         {{ (isset($clientes->perfil_cliente) && $clientes->perfil_cliente == 'Sim' ? 'selected' : '')                           }}>Conhecimento básico</option>
                    <option value="Conhecimento intermediário"  {{ (isset($clientes->perfil_cliente) && $clientes->perfil_cliente == 'Conhecimento intermediário' ? 'selected' : '')    }}>Conhecimento intermediário</option>
                    <option value="Conhecimento Avançado"       {{ (isset($clientes->perfil_cliente) && $clientes->perfil_cliente == 'Conhecimento Avançado' ? 'selected' : '')         }}>Conhecimento Avançado</option>
                    <option value="Aberto a novas ideias"       {{ (isset($clientes->perfil_cliente) && $clientes->perfil_cliente == 'Aberto a novas ideias' ? 'selected' : '')         }}>Aberto a novas ideias</option>
                    <option value="Exigente"                    {{ (isset($clientes->perfil_cliente) && $clientes->perfil_cliente == 'Exigente' ? 'selected' : '')                      }}>Exigente</option>
                    <option value="Pró ativo"                   {{ (isset($clientes->perfil_cliente) && $clientes->perfil_cliente == 'Pró ativo' ? 'selected' : '')                     }}>Pró ativo</option>
                    <option value="Indeciso / Confuso"          {{ (isset($clientes->perfil_cliente) && $clientes->perfil_cliente == 'Indeciso / Confuso' ? 'selected' : '')            }}>Indeciso / Confuso</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Inscrição Estadual -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('inscricao_estadual') ? 'has-error' : '' }} col-sm-12">
            <label>Inscrição Estadual</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" name="inscricao_estadual" type="text" value="{{ isset($clientes->inscricao_estadual) ? $clientes->inscricao_estadual : '' }}">
            </div>
        </div>
    </div>

    <!-- Melhor dia para Boleto -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('dia_boleto') ? 'has-error' : '' }} col-sm-12">
            <label>Melhor dia para Boleto</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <select class="form-control" name="dia_boleto">
                    <option value="10" {{ (isset($clientes->dia_boleto) && $clientes->dia_boleto == '10' ? 'selected' : '') }}>10</option>
                    <option value="15" {{ (isset($clientes->dia_boleto) && $clientes->dia_boleto == '15' ? 'selected' : '') }}>15</option>
                    <option value="20" {{ (isset($clientes->dia_boleto) && $clientes->dia_boleto == '20' ? 'selected' : '') }}>20</option>
                    <option value="25" {{ (isset($clientes->dia_boleto) && $clientes->dia_boleto == '25' ? 'selected' : '') }}>25</option>
                    <option value="30" {{ (isset($clientes->dia_boleto) && $clientes->dia_boleto == '30' ? 'selected' : '') }}>30</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Segmento do Cliente -->
    @include('backend.cliente.editar.segmentos')

</div>

<h3 class="titulo-formulario">Informações de Endereço</h3>

<div class="row col-sm-12">

    <!-- CEP -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('cep') ? 'has-error' : '' }} col-sm-12">
            <label>CEP do Cliente</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                </div>
                <input class="form-control" type="text" name="cep" id="cep" placeholder="Digite o CEP" value="{{ isset($clientes->cep) ? $clientes->cep : '' }}" />
            </div>
        </div>
    </div>

    <!-- Endereço -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('endereco') ? 'has-error' : '' }} col-sm-12">
            <label>Endereço</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                </div>
                <input class="form-control" type="text" name="endereco" id="campo_logradouro" placeholder="Endereço" value="{{ isset($clientes->endereco) ? $clientes->endereco : '' }}"/>
            </div>
        </div>
    </div>

    <!-- Bairro -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('bairro') ? 'has-error' : '' }} col-sm-12">
            <label>Bairro</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                </div>
                <input class="form-control" type="text" name="bairro" id="campo_bairro" placeholder="Bairro" value="{{ isset($clientes->bairro) ? $clientes->bairro : '' }}" />
            </div>
        </div>
    </div>

    <!-- Cidade -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('cidade') ? 'has-error' : '' }} col-sm-12">
            <label>Cidade</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                </div>
                <input class="form-control" type="text" name="cidade" id="campo_cidade" placeholder="Cidade" value="{{ isset($clientes->cidade) ? $clientes->cidade : '' }}"/>
            </div>
        </div>
    </div>

    <!-- Estado -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }} col-sm-12">
            <label>Estado</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                </div>
                <input class="form-control" type="text" name="estado" id="campo_estado" placeholder="Estado" value="{{ isset($clientes->estado) ? $clientes->estado : '' }}"/>
            </div>
        </div>
    </div>

    <!-- Número -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('numero') ? 'has-error' : '' }} col-sm-12">
            <label>Número</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                </div>
                <input class="form-control" type="text" name="numero" placeholder="numero" value="{{ isset($clientes->numero) ? $clientes->numero : '' }}"/>
            </div>
        </div>
    </div>

        <!-- Número -->
    <div class="form-group col-sm-12">
        <div class="form-group {{ $errors->has('complemento') ? 'has-error' : '' }} col-sm-12">
            <label>Complemento</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                </div>
                <input class="form-control" type="text" name="complemento" placeholder="Complemento" value="{{ isset($clientes->complemento) ? $clientes->complemento : '' }}"/>
            </div>
        </div>
    </div>
    
</div>