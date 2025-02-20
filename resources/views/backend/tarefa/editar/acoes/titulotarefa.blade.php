@if($registro->id_usuario_criador == Auth::user()->id)
    <h5 class="modal-title" id="exampleModalLabel">
        <span class="titulo-primeiro">
            <div id="novo-texto" style="float: left;">
                <div class="teste">{{ $registro->titulo }}</div>
            </div>

            <button id="botao-editar-titulo">
                <i class="fas fa-pencil-alt"></i>
            </button>
        </span>
    </h5>

    <form method="POST" id="ajax_form" class="form" style="display:none;position: relative;">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="POST">
                                                
        <!-- Campos para função Ajax -->
        <input name="nome_usuario_principal" value="{{ Auth::user()->name }} {{ Auth::user()->sobrenome }}" style="display:none" />
        <input name="id_tarefa_principal" value="{{ $registro->id_tarefa }}" style="display:none" />
        <input type="text" name="titulo-tarefa" class="classe-auxiliar" value="{{ $registro->titulo }}" />
        <button id="enviar-informacao" type="submit"><i class="fas fa-check"></i></button>
    </form>
@else    
    <h5 class="modal-title-sem-hover" id="exampleModalLabel">
        {{ $registro->titulo }}
    </h5>
@endif