<div class="form-group col-sm-6">
    <label>Descrição do Grupo de Gatilho</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <input class="form-control" name="descricao" placeholder="Descrição" type="text" value="{{ isset($gatilhos_grupos->descricao) ? $gatilhos_grupos->descricao : '' }}">
    </div>
</div>

<div class="form-group col-sm-6">
    <label>E-mail do Grupo</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <input class="form-control" name="email" placeholder="E-mail do Grupo" type="text" value="{{ isset($gatilhos_grupos->email) ? $gatilhos_grupos->email : '' }}">
    </div>
</div>

<div class="form-group col-sm-6">
    <label>Outros e-maiis</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <input class="form-control" name="email_adicionais" placeholder="Outros e-maiis" type="text" value="{{ isset($gatilhos_grupos->email_adicionais) ? $gatilhos_grupos->email_adicionais : '' }}">
    </div>
</div>