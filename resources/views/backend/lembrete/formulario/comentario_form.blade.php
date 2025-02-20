<div class="form-group col-md-12">
    <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-comment"></i></span>
        </div>
        <textarea name="comentario" id="mytextarea" class="validate form-control" rows="5" placeholder="Adicone um Comentário..." value=""></textarea>
    </div>
</div>

<div class="form-group{{ $errors->has('id_usuario_logado') ? 'has-error' : '' }}" style="display:none">
    <label for="id_usuario_logado">ID do Usuário</label>
    <input type="text" name="id_usuario_logado" class="validate form-control" placeholder="ID Usuário" value="{{ Auth::user()->id }}">
</div>