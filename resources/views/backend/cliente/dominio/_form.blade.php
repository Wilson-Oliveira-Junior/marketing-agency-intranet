<h3 class="titulo-formulario">Informações do Dominio</h3>

<div class="row col-sm-12">

    <input type="hidden" name="id_cliente" value="{{ $clientes->id }}">

    <!-- Nome do Domínio -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }} col-sm-12">
            <label>Dominio do Site *</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" name="dominio" type="text" value="{{ isset($clientes_dominios->dominio) ? $clientes_dominios->dominio : '' }}" required>
            </div>
        </div>
    </div>

    <!-- Tipo de Hospedagem -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('tipo_hospedagem') ? 'has-error' : '' }} col-sm-12">
            <label>Tipo de Hospedagem</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <select class="form-control" name="tipo_hospedagem">
                    <option value="">--</option>
                    <option value="Redirecionamento"        {{ (isset($clientes_dominios->tipo_hospedagem) && $clientes_dominios->tipo_hospedagem == 'Redirecionamento' ? 'selected' : '')      }}>Redirecionamento</option>
                    <option value="Hospedagem Interna"      {{ (isset($clientes_dominios->tipo_hospedagem) && $clientes_dominios->tipo_hospedagem == 'Hospedagem Interna' ? 'selected' : '')   }}>Hospedagem Interna</option>
                    <option value="Hospedagem Externa"      {{ (isset($clientes_dominios->tipo_hospedagem) && $clientes_dominios->tipo_hospedagem == 'Hospedagem Externa' ? 'selected' : '')    }}>Hospedagem Externa</option>
               </select>
            </div>
        </div>
    </div>

    <!-- Dominio Principal -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('dominio_principal') ? 'has-error' : '' }} col-sm-12">
            <label>Dominio Principal</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <select class="form-control" name="dominio_principal">
                    <option value="">--</option>
                    <option value="Sim"  {{ (isset($clientes_dominios->dominio_principal) && $clientes_dominios->dominio_principal == 'Sim' ? 'selected' : '')    }}>Sim</option>
                    <option value="Não"  {{ (isset($clientes_dominios->dominio_principal) && $clientes_dominios->dominio_principal == 'Não' ? 'selected' : '')      }}>Não</option>
               </select>
            </div>
        </div>
    </div>

    <!-- SSL -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('ssl') ? 'has-error' : '' }} col-sm-12">
            <label>SSL</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <select class="form-control" name="ssl">
                    <option value="">--</option>
                    <option value="1" {{ (isset($clientes_dominios->ssl) && $clientes_dominios->ssl == true ? 'selected' : '')    }}>Sim</option>
                    <option value="0" {{ (isset($clientes_dominios->ssl) && $clientes_dominios->ssl == false ? 'selected' : '')  }}>N&atilde;o</option>
               </select>
            </div>
        </div>
    </div>

    <!-- CDN -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('ssl') ? 'has-error' : '' }} col-sm-12">
            <label>CDN</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <select class="form-control" name="cdn">
                    <option value="1" selected="selected">--</option>
                    <option value="1"       {{ (isset($clientes_dominios->cdn) && $clientes_dominios->cdn == true ? 'selected' : '')    }}>Sim</option>
                    <option value="0"     {{ (isset($clientes_dominios->cdn) && $clientes_dominios->cdn == false ? 'selected' : '')  }}>N&atilde;o</option>
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
                    <option value="Ativo"       {{ (isset($clientes_dominios->status) && $clientes_dominios->status == 'Ativo' ? 'selected' : '')    }}>Ativo</option>
                    <option value="Inativo"     {{ (isset($clientes_dominios->status) && $clientes_dominios->status == 'Inativo' ? 'selected' : '')  }}>Inativo</option>
               </select>
            </div>
        </div>
    </div>

</div>