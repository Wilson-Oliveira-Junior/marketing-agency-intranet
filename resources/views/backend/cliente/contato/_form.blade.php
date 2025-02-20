<h3 class="titulo-formulario">Informações de Contato</h3>

<div class="row col-sm-12">

    <input type="hidden" name="id_cliente" value="{{ $clientes->id }}">

    <!-- Nome do Contato -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }} col-sm-12">
            <label>Nome do Contato *</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" name="nome_contato" type="text" value="{{ isset($clientes_contatos->nome_contato) ? $clientes_contatos->nome_contato : '' }}">
            </div>
        </div>
    </div>

    <!-- Telefone -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('telefone') ? 'has-error' : '' }} col-sm-12">
            <label>Telefone</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                </div>
                <input class="form-control" name="telefone" id="telefone" type="text" value="{{ isset($clientes_contatos->telefone) ? $clientes_contatos->telefone : '' }}">
            </div>
        </div>
    </div>

    <!-- Ramal -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('ramal') ? 'has-error' : '' }} col-sm-6">
            <label>Ramal</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                </div>
                <input class="form-control" name="ramal" size="12" maxlength="12" id="ramal" type="text" value="{{ isset($clientes_contatos->ramal) ? $clientes_contatos->ramal : '' }}">
            </div>
        </div>
    </div>

    <!-- Celular -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('celular') ? 'has-error' : '' }} col-sm-12">
            <label>Celular</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                </div>
                <input class="form-control" name="celular" id="celular" type="text" value="{{ isset($clientes_contatos->celular) ? $clientes_contatos->celular : '' }}">
            </div>
        </div>
    </div>

    <!-- E-mail -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} col-sm-12">
            <label>E-mail</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control" name="email" type="text" id="email" value="{{ isset($clientes_contatos->email) ? $clientes_contatos->email : '' }}">
            </div>
        </div>
    </div>
    
    <!-- Responsavel do Projeto -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('responsavel') ? 'has-error' : '' }} col-sm-12">
            <label>Tipo de Contato *</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <select class="form-control" name="tipo_contato">
                    <option value="Responsável do Projeto"          {{ (isset($clientes_contatos->tipo_contato) && $clientes_contatos->tipo_contato == 'Responsável do Projeto' ? 'selected' : '')    }}>Responsável do Projeto</option>
                    <option value="Responsável Financeiro"          {{ (isset($clientes_contatos->tipo_contato) && $clientes_contatos->tipo_contato == 'Responsável Financeiro' ? 'selected' : '')    }}>Responsável Financeiro</option>
                    <option value="Responsável Projeto/Financeiro"  {{ (isset($clientes_contatos->tipo_contato) && $clientes_contatos->tipo_contato == 'Responsável Projeto/Financeiro' ? 'selected' : '')    }}>Responsável Projeto/Financeiro</option>
                    <option value="Outro"                           {{ (isset($clientes_contatos->tipo_contato) && $clientes_contatos->tipo_contato == 'Outro' ? 'selected' : '')                     }}>Outro</option>
               </select>
            </div>
        </div>
    </div>

</div>