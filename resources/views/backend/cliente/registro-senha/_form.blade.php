<h3 class="titulo-formulario">Registro de Senhas</h3>

<div class="row col-sm-12">

    <input type="hidden" name="id_cliente" value="{{ $clientes->id }}">
    <!-- TIPO do Registro: Facebook, Instagram, Painel e etc. -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('tipo_registro') ? 'has-error' : '' }} col-sm-12">
            <label>Tipo de Registro *</label>
            @if($errors->has('tipo_registro'))
                <span class="help-block"><strong>{{ $errors->first('tipo_registro') }}</strong></span>
            @endif
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-bullet-list-67"></i></span>
                </div>
                <select class="form-control" name="tipo_registro">
                    <option value="--">--</option>
                    @foreach($tipos_registros as $tiporegistro)
                        @if(isset($registro_senhas->idTipoRegistro))
                            <option value="{{$tiporegistro->idTipoRegistro}}" {{($tiporegistro->idTipoRegistro == $registro_senhas->idTipoRegistro)?'selected=selected':''}}>{{$tiporegistro->nome}}</option>
                        @else
                            <option value="{{$tiporegistro->idTipoRegistro}}" {{($tiporegistro->idTipoRegistro == old('tipo_registro'))?'selected=selected':''}}>{{$tiporegistro->nome}}</option>
                        @endif
                    @endforeach
               </select>
            </div>
        </div>
    </div>

    <!-- Especificar Domínio? -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('id_dominio') ? 'has-error' : '' }} col-sm-12">
            <label>Dom&iacute;nio</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-bars"></i></span>
                </div>
                <select class="form-control" name="id_dominio">
                    <option value="0">--</option>
                    @foreach($clientes_dominios as $dominio)
                        @if(isset($registro_senhas->idDominio))
                        <option value="{{$dominio->id_dominio}}" {{$dominio->id_dominio == $registro_senhas->idDominio?'selected=selected':''}}>{{$dominio->dominio}}</option>
                        @else
                        <option value="{{$dominio->id_dominio}}" {{($dominio->id_dominio == old('id_dominio'))?'selected=selected':''}} >{{$dominio->dominio}}</option>        
                        @endif
                    @endforeach
               </select>
            </div>
        </div>
    </div>

    <!-- Nome do URL - Se for painel -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }} col-sm-12">
            <label>URL</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-link"></i></span>
                </div>
                <input class="form-control" name="url" type="text" value="{{ isset($registro_senhas->strURL) ? $registro_senhas->strURL : old('url') }}">
            </div>
        </div>
    </div>

    <!-- Login -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('login') ? 'has-error' : '' }} col-sm-12">
            <label>Login *</label>
            @if($errors->has('login'))
                <span class="help-block"><strong>{{ $errors->first('login') }}</strong></span>
            @endif
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                </div>
                <input class="form-control" name="login" type="text" value="{{ isset($registro_senhas->strLogin) ? $registro_senhas->strLogin : old('login') }}">
            </div>
        </div>
    </div>

    <!-- Senha -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('senha') ? 'has-error' : '' }} col-sm-12">
            <label>Senha *</label>
            @if($errors->has('senha'))
                <span class="help-block"><strong>{{ $errors->first('senha') }}</strong></span>
            @endif
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                </div>
                <input class="form-control" name="senha" type="text" value="{{ isset($registro_senhas->strSenha) ? $registro_senhas->strSenha : old('senha') }}">
            </div>
        </div>
    </div>

    

    <!-- Somente Admin -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('admin') ? 'has-error' : '' }} col-sm-12">
            <label>Somente Admin?</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-times"></i></span>
                </div>
                <select class="form-control" name="admin">
                    <option value="0">--</option>
                    @if(isset($registro_senhas->admin))
                    <option value="1" {{ ($registro_senhas->admin == 1 ? 'selected=selected' : '')}}>Sim</option>
                    <option value="0" {{ ($registro_senhas->admin == 0 ? 'selected=selected' : '')}}>N&atilde;o</option>
                    @else
                    <option value="1">Sim</option>
                    <option value="0">N&atilde;o</option>
                    @endif
               </select>
            </div>
        </div>
    </div>

    <!-- Observação -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('observacao') ? 'has-error' : '' }} col-sm-12">
            <label>Observa&ccedil;&atilde;o</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-archive"></i></span>
                </div>
                <textarea class="form-control" name="observacao">{{ isset($registro_senhas->observacao) ? $registro_senhas->observacao : old('observacao') }}</textarea>
            </div>
        </div>
    </div>
    @if(isset($registro_senhas->pendente)?$registro_senhas->pendente:0)
    <h3 class="titulo-formulario">Solicita&ccedil;&atilde;o Pendente</h3>

    <!-- Nome do URL - Se for painel(Pendente) -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('urlpendente') ? 'has-error' : '' }} col-sm-12">
            <label>URL Pendente</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-link"></i></span>
                </div>
                <input class="form-control" name="urlpendente" type="text" value="{{ isset($registro_senhas->urlPendente) ? $registro_senhas->urlPendente : '' }}">
            </div>
        </div>
    </div>

    <!-- Login (Pendente)-->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('loginpendente') ? 'has-error' : '' }} col-sm-12">
            <label>Login Pendente</label>
            @if($errors->has('loginpendente'))
                <span class="help-block"><strong>{{ $errors->first('loginpendente') }}</strong></span>
            @endif
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                </div>
                <input class="form-control" name="loginpendente" type="text" value="{{ isset($registro_senhas->loginPendente) ? $registro_senhas->loginPendente : '' }}">
            </div>
        </div>
    </div>

    <!-- Senha(Pendente) -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('senha') ? 'has-error' : '' }} col-sm-12">
            <label>Senha Pendente</label>
            @if($errors->has('senhapendente'))
                <span class="help-block"><strong>{{ $errors->first('senhapendente') }}</strong></span>
            @endif
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                </div>
                <input class="form-control" name="senhapendente" type="text" value="{{ isset($registro_senhas->senhaPendente) ? $registro_senhas->senhaPendente : '' }}">
            </div>
        </div>
    </div>

    <!-- Aprovado? -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('aprovado') ? 'has-error' : '' }} col-sm-12">
            <label>Aprovado?</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-times"></i></span>
                </div>
                <select class="form-control" id="aprovado" name="aprovado">
                    <option value="2">--</option>
                    <option value="1">Sim</option>
                    <option value="0">N&atilde;o</option>
                    
               </select>
            </div>
        </div>
    </div>

    <!-- Motivo -->
    <div class="form-group col-sm-4" id="divMotivo" style="display:none;">
        <div class="form-group {{ $errors->has('motivo') ? 'has-error' : '' }} col-sm-12">
            <label>Motivo</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-archive"></i></span>
                </div>
                <textarea class="form-control" name="motivo"></textarea>
            </div>
        </div>
    </div>
    
    @endif

</div>