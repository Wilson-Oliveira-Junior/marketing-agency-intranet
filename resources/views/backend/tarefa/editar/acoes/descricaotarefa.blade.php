@if($registro->id_usuario_criador == Auth::user()->id)
    <h3>
        Descrição
        <button id="botao-editar-descricao">
            <i class="fas fa-pencil-alt"></i>
        </button>
    </h3>

    <div class="descricao">
        <span class="nova-descricao">{!! $registro->descricao !!}</span>
    </div>

    <form method="POST" id="ajax_form_descricao" class="form-descricao" style="display:none;position: relative;">

        {{ csrf_field() }}
        <input type="hidden" name="_method" value="POST">

        <!-- Campos para função Ajax -->
        <input name="nome_decricao_principal" value="{{ Auth::user()->name }} {{ Auth::user()->sobrenome }}" style="display:none" />
        <input name="id_tarefa_principal_descricao" value="{{ $registro->id_tarefa }}" style="display:none" />
        <div id="editor">{!! $registro->descricao !!}</div>
        <textarea class="mention descricao-tarefa d-none" name="alteradescricao" id="mytextarea">{!! $registro->descricao !!}</textarea>
        <button id="enviar-informacao-descricao" type="submit"><i class="fas fa-check"></i></button>

    </form>
@else
    <h3>Descrição</h3>
    <div class="descricao">
        <p style="font-size: 14px;color: #444;font-weight: 400;">{!! $registro->descricao !!}</p>
    </div>
@endif
