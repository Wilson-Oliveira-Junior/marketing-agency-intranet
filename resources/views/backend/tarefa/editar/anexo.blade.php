<i class="fas fa-paperclip" style="color: #1f99c1;"></i>

<input multiple="multiple" type="file" name="anexos[]" class="form-control-file" style="padding: 10px 10px;margin-left: 15px;border: 2px dashed #CCC;">
                                                            
<div style="display:none">
    <input type="text" name="id_usuario_anexo" value="{{ Auth::user()->id }}">
</div>