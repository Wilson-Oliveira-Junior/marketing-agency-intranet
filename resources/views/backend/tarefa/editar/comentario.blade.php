<i class="fas fa-at mencionar"></i>

<div id="textAreaComentario"></div>
<div class="form-group">
    <div class="mention comentario" id="editorComentario"></div>
</div>
<textarea class="mention comentario d-none" name="comentario" id="mytextareacomentariointerna"></textarea>

<div style="display:none">
    <input type="text" name="id_usuario" value="{{ Auth::user()->id }}">
</div>
