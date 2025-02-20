<h3 class="titulo-formulario">Informações Gerais</h3>

<div class="row col-sm-12">

    @if($lembretes->usuario_id == null)

        <div class="form-group {{ $errors->has('setor_id') ? 'has-error' : '' }} col-sm-12">
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-atom"></i></span>
                </div>
                <select name="setor_id" style="width: 85%;border: none;padding: 10px;color: #aeaeae;">
                    @foreach($setores as $setor)
                        <option value="{{ $setor->id }}" {{ (isset($usuario->setor_id) && $usuario->setor_id == $setor->id ? 'selected' : '') }}>{{ $setor->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    
    @else

        <div class="form-group {{ $errors->has('setor_id') ? 'has-error' : '' }} col-sm-6">
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-atom"></i></span>
                </div>
                <select name="setor_id" style="width: 85%;border: none;padding: 10px;color: #aeaeae;">
                    @foreach($setores as $setor)
                        <option value="{{ $setor->id }}" {{ (isset($usuario->setor_id) && $usuario->setor_id == $setor->id ? 'selected' : '') }}>{{ $setor->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group {{ $errors->has('usuario_id') ? 'has-error' : '' }} col-md-6">
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <select name="usuario_id" style="width: 85%;border: none;padding: 10px;color: #aeaeae;">
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ (isset($usuario->usuario_id) && $usuario->usuario_id == $usuario->id ? 'selected' : '') }}>{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <div class="form-group{{ $errors->has('cliente_id') ? 'has-error' : '' }} col-md-12">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-users"></i></span>
            </div>
            <select name="cliente_id" style="width: 90%;border: none;padding: 10px;color: #aeaeae;">
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ (isset($cliente->id) && $lembretes->cliente_id == $cliente->id ? 'selected' : '') }}>{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>

<h3 class="titulo-formulario">Informações de Envio</h3>

<div class="row col-sm-12">

    <div class="form-group{{ $errors->has('data') ? 'has-error' : '' }} col-md-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <input type="date" name="data" class="form-control" placeholder="Data Envio" value="{{ isset($lembretes->data) ? $lembretes->data : '' }}">
        </div>
    </div>

    <div class="form-group{{ $errors->has('hora') ? 'has-error' : '' }} col-md-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-clock"></i></span>
            </div>
            <input type="time" name="hora" class="form-control" placeholder="Hora Do Envio" value="{{ isset($lembretes->hora) ? $lembretes->hora : '' }}">
        </div>
    </div>

</div>

<h3 class="titulo-formulario">Informações do Lembrete</h3>

<div class="row col-sm-12">

    <div class="form-group {{ $errors->has('notificar') ? 'has-error' : '' }} col-md-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-bell"></i></span>
            </div>
            <select name="notificar" style="width: 85%;border: none;padding: 10px;color: #aeaeae;">
                <option value="">- Estilo da Notificação -</option>
                <option value="e-mail" {{ (isset($lembretes->notificar) && $lembretes->notificar == 'E-mail' ? 'selected' : '') }}>E-mail</option>
                <option value="notificacao" {{ (isset($lembretes->notificar) && $lembretes->notificar == 'Notificação' ? 'selected' : '') }}>Notificação</option>        
            </select>    
        </div>
    </div>

    <div class="form-group {{ $errors->has('importancia') ? 'has-error' : '' }} col-md-6 divide">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-exclamation-circle"></i></span>
            </div>
            <select name="importancia" style="width: 85%;border: none;padding: 10px;color: #aeaeae;">
                <option value="">- Nível de importância -</option>
                <option value="alta" {{ (isset($lembretes->importancia) && $lembretes->importancia == 'Alta' ? 'selected' : '') }}>Alta</option>
                <option value="media" {{ (isset($lembretes->importancia) && $lembretes->importancia == 'Media' ? 'selected' : '') }}>Média</option>
                <option value="baixa" {{ (isset($lembretes->importancia) && $lembretes->importancia == 'Baixa' ? 'selected' : '') }}>Baixa</option>
            </select>    
        </div>
    </div>

    <div class="form-group{{ $errors->has('titulo') ? 'has-error' : '' }} col-md-12">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-ruler"></i></span>
            </div>
            <input type="text" name="titulo" class="validate form-control" placeholder="Título do Lembrete" value="{{ isset($lembretes->titulo) ? $lembretes->titulo : '' }}" required>
        </div>
    </div>

    <div class="form-group{{ $errors->has('mensagem') ? 'has-error' : '' }} col-md-12">
        <div class="input-group input-group-alternative mb-3" style="height: 100px;background-color: #f1f1f1;">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comment"></i></span>
            </div>
            <textarea name="mensagem" class="validate form-control" rows="5" placeholder="Escreva sua Mensagem Aqui..." value="{{ $lembretes->mensagem }}" disabled>{{ $lembretes->mensagem }}</textarea>   
        </div>
    </div>

</div>