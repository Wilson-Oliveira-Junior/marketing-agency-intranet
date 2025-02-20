<h3 class="titulo-formulario">Informações Gerais</h3>

<div class="row col-sm-12">

    <div class="nav-wrapper col-md-5" style="padding-left: 15px;">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <span style="padding-top: 10px;margin-right: 15px;font-weight: bold;">Responsável:</span>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                    <i class="fas fa-user"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                    <i class="fas fa-users"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content col-md-7" id="myTabContent">
        <!-- Usuário -->
        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">             
            <div class="form-group {{ $errors->has('usuario_id') ? 'has-error' : '' }}" style="margin-top: 20px;">
                <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <select name="usuario_id" style="width: 85%;border: none;padding: 10px;color: #aeaeae;">
                        <option value="">- Selecione o Usuário -</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ (isset($usuario->usuario_id) && $usuario->usuario_id == $usuario->id ? 'selected' : '') }}>{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <!-- Setor -->
        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
            <div class="form-group {{ $errors->has('setor_id') ? 'has-error' : '' }}" style="margin-top: 20px;">
                <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-users"></i></span>
                    </div>
                    <select name="setor_id" style="width: 85%;border: none;padding: 10px;color: #aeaeae;">
                        <option value="">- Selecione o Setor -</option>
                        @foreach($setores as $setor)
                            <option value="{{ $setor->id }}" {{ (isset($usuario->setor_id) && $usuario->setor_id == $setor->id ? 'selected' : '') }}>{{ $setor->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('cliente_id') ? 'has-error' : '' }} col-md-12">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-users"></i></span>
            </div>
            <select name="cliente_id" style="width: 90%;border: none;padding: 10px;color: #aeaeae;">
                <option value="">- Selecione o Cliente -</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ (isset($cliente->cliente_id) && $cliente->cliente_id == $cliente->id ? 'selected' : '') }}>{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>

<h3 class="titulo-formulario">Informações de Envio</h3>

<div class="row col-sm-12">

    <div class="nav-wrapper col-md-12" style="padding-left: 15px;">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item botao-envio">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="true">
                    <i class="far fa-clock"></i> Enviar Agora
                </a>
            </li>
            <li class="nav-item botao-envio">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">
                    <i class="fas fa-user-clock"></i> Programar o Envio
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content col-md-12" id="myTabContent">
        
        <!-- DATA/HORA - AGORA -->
        <div class="tab-pane fade show active" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">             
            
            <!-- DATA -->
            <div class="form-group {{ $errors->has('data') ? 'has-error' : '' }} col-md-6" style="float: left;padding-left: 0px;">
                <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" name="data" class="form-control" placeholder="Data Envio" value="{{ date( 'd/m/Y') }}" style="background-color: #FFF;" disabled>
                </div>
            </div>

            <!-- HORA -->
            <div class="form-group {{ $errors->has('hora') ? 'has-error' : '' }} col-md-6" style="float: left;padding-right: 0px;">
                <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="text" name="hora" class="form-control" placeholder="Hora Do Envio" value="{{ date( 'H:i') }}" style="background-color: #FFF;" disabled>
                </div>
            </div>
            
        </div>

        <!-- DATA/HORA - PROGRAMADO  -->
        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
            
            <!-- DATA -->
            <div class="form-group {{ $errors->has('data') ? 'has-error' : '' }} col-md-6" style="float: left;padding-left: 0px;">
                <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="date" name="data" id='enviarLembrete' class="form-control" placeholder="Data Envio" value="{{ isset($lembretes->data) ? $lembretes->data : '' }}">
                </div>
            </div>

            <!-- HORA -->
            <div class="form-group {{ $errors->has('hora') ? 'has-error' : '' }} col-md-6" style="float: left;padding-right: 0px;">
                <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                    </div>
                    <input type="time" name="hora" id="horaLembrete" class="form-control" placeholder="Hora Do Envio" value="{{ isset($lembretes->hora) ? $lembretes->hora : '' }}">
                </div>
            </div>

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
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comment"></i></span>
            </div>
            <textarea name="mensagem" class="validate form-control" rows="5" placeholder="Escreva sua Mensagem Aqui..." value="{{ isset($lembretes->mensagem) ? $lembretes->mensagem : '' }}" required></textarea>
        </div>
    </div>

    <div class="form-group{{ $errors->has('postou_id') ? 'has-error' : '' }}" style="display:none">
        <label for="postou_id">ID do Usuário</label>
        <input type="text" name="postou_id" class="validate form-control" placeholder="ID Usuário" value="{{ Auth::user()->id }}">
    </div>

</div>