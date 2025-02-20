<div class="form-group col-sm-4">
    <label>Nome do Gatilho</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <input class="form-control" name="gatilho" placeholder="Nome" type="text" value="{{ isset($gatilhos->gatilho) ? $gatilhos->gatilho : '' }}">
    </div>
</div>

<div class="form-group col-sm-4">
    <label>Nome do Projeto</label>
    <div class="input-group input-group-alternative mb-3"> 
        <select class="form-control" name="id_tipo_projeto">
            @foreach($tipos_projetos as $registro)
                <option value="{{ $registro->id }}" {{ (isset($gatilhos->id_tipo_projeto) && $gatilhos->id_tipo_projeto == $registro->id ? 'selected' : '') }}>{{ $registro->nome }}</option>
            @endforeach
        </select>
    </div>  
</div>

<div class="form-group col-sm-4">
    <label>Tipo de Gatilho</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <select class="form-control" name="tipo_gatilho">
            <option value="Equipe"  {{ (isset($gatilhos->tipo_gatilho) && $gatilhos->tipo_gatilho == 'Equipe' ? 'selected' : '') }}>-</option>
            <option value="Cliente" {{ (isset($gatilhos->tipo_gatilho) && $gatilhos->tipo_gatilho == 'Cliente' ? 'selected' : '') }}>Cliente</option>
            <option value="Equipe"  {{ (isset($gatilhos->tipo_gatilho) && $gatilhos->tipo_gatilho == 'Equipe' ? 'selected' : '') }}>Equipe</option>
        </select>
    </div>
</div>

<div class="form-group col-sm-4">
    <label>Dias Padrões</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <input class="form-control" name="dias_limite_padrao" placeholder="Dias Padrões" type="text" value="{{ isset($gatilhos->dias_limite_padrao) ? $gatilhos->dias_limite_padrao : '' }}">
    </div>
</div>

<div class="form-group col-sm-4">
    <label>Dias para Projeto de 50</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <input class="form-control" name="dias_limite_50" placeholder="Dias para Projeto de 50" type="text" value="{{ isset($gatilhos->dias_limite_50) ? $gatilhos->dias_limite_50 : '' }}">
    </div>
</div>

<div class="form-group col-sm-4">
    <label>Dias para Projeto de 40</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <input class="form-control" name="dias_limite_40" placeholder="Dias para Projeto de 40" type="text" value="{{ isset($gatilhos->dias_limite_40) ? $gatilhos->dias_limite_40 : '' }}">
    </div>
</div>

<div class="form-group col-sm-4">
    <label>Dias para Projeto de 30</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <input class="form-control" name="dias_limite_30" placeholder="Dias para Projeto de 30" type="text" value="{{ isset($gatilhos->dias_limite_30) ? $gatilhos->dias_limite_30 : '' }}">
    </div>
</div>

<div class="form-group col-sm-4">
    <label>Gatilho Referencia</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <select class="form-control" name="id_referente">
            <option value="">-</option>
            @foreach($id_ref as $registro)
                <option value="{{ $registro->id_gatilho_template }}" {{ (isset($gatilhos->id_referente) && $gatilhos->id_referente == $registro->id_gatilho_template ? 'selected' : '') }}>{{ $registro->nome_gatilho }} - {{ $registro->nome_projeto }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group col-sm-4">
    <label>Grupo de Notificação</label>
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <select class="form-control" name="id_grupo_gatilho">
            <option value="">-</option>
            @foreach($gatilhos_grupos as $registro)
                <option value="{{ $registro->id }}" {{ (isset($gatilhos->id_grupo_gatilho) && $gatilhos->id_grupo_gatilho == $registro->id ? 'selected' : '') }}>{{ $registro->descricao }}</option>
            @endforeach
        </select>
    </div>
</div>