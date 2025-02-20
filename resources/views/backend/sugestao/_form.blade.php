<div class="row col-sm-12">
    
    <div class="form-group col-sm-12">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="titulo" placeholder="Título da Sugetão" type="text" value="{{ isset($sugestoes->projeto) ? $sugestoes->projeto : '' }}" required>
        </div>
    </div>

    <div class="form-group col-sm-12" style="padding: 0px;padding-right: 20px;">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <div class="input-group input-group-alternative mb-3">
                <textarea rows="4" name="descricao" class="form-control form-control-alternative" placeholder="Escreva aqui sua sugestão ..."></textarea>
            </div>
        </div>
    </div>

    <input class="form-control" name="id_usuario" type="text" value="{{ Auth::user()->id }}" style="display:none;">

</div>