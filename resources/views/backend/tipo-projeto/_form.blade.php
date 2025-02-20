<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }} col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="nome" placeholder="Nome" type="text" value="{{ isset($tipos_projetos->nome) ? $tipos_projetos->nome : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }} col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            </div>
            <input class="form-control" name="descricao" placeholder="Descrição" type="text" value="{{ isset($tipos_projetos->descricao) ? $tipos_projetos->descricao : '' }}" required>
        </div>
    </div>
</div>

<!-- Status do Dominio -->
<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} col-sm-12">
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <select class="form-control" name="status">
            <option value="">--</option>
            <option value="Ativo"       {{ (isset($tipos_projetos->status) && $tipos_projetos->status == 'Ativo' ? 'selected' : '')    }}>Ativo</option>
            <option value="Inativo"     {{ (isset($tipos_projetos->status) && $tipos_projetos->status == 'Inativo' ? 'selected' : '')  }}>Inativo</option>
        </select>
    </div>
</div>