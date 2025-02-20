<div class="modal fade" id="modal-form-{{ $registro->idRegistroSenha }}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-registro-senha modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>            
        </div>
            <div class="modal-body p-0">
                    <div class="form-group mb-12">
                    <h3 class="titulo-formulario">
                        <i class="ni ni-key-25"></i> 
                        Registro de Senhas
                    </h3>


<div class="row col-sm-12">

<form method="post" id="formEditarAprovacao{{ $registro->idRegistroSenha }}" action="#" style="align-items: center;display: flex;flex-wrap: wrap;">
    {{ csrf_field() }}
    <input type="hidden" name="id_cliente" value="{{ $cliente->id }}">
    <input type="hidden" name="alt-idregistrosenha" value="{{ $registro->idRegistroSenha }}">
    <input type="hidden" name="_method" value="put">

    <!-- Nome do URL - Se for painel -->
    <div class="form-group col-sm-4">
        <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }} col-sm-12">
            <label>URL</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-link"></i></span>
                </div>
                <input class="form-control" id="alt-url" name="url" type="text" value="{{ isset($registro_senhas->strURL) ? $registro_senhas->strURL : '' }}">
            </div>
        </div>
    </div>

    <!-- Login -->
    <div class="form-group col-sm-6" style="">
        <div class="form-group {{ $errors->has('login') ? 'has-error' : '' }} col-sm-12">
            <label>Login *</label>
            @if($errors->has('login'))
                <span class="help-block"><strong>{{ $errors->first('login') }}</strong></span>
            @endif
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                </div>
                <input class="form-control" id="alt-login" name="login" type="text" value="{{ isset($registro_senhas->strLogin) ? $registro_senhas->strLogin : '' }}">
            </div>
        </div>
    </div>

    <!-- Senha-->
    <div class="form-group col-sm-6" style="margin-top: -20px;">
        <div class="form-group {{ $errors->has('senha') ? 'has-error' : '' }} col-sm-12">
            <label>Senha *</label>
            @if($errors->has('senha'))
                <span class="help-block"><strong>{{ $errors->first('senha') }}</strong></span>
            @endif
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                </div>
                <input class="form-control" id="alt-senha" name="senha" type="text" value="{{ isset($registro_senhas->strSenha) ? $registro_senhas->strSenha : '' }}">
            </div>
        </div><button class="btn btn-info btn-solicita-aprovacao" data-id="{{ $registro->idRegistroSenha }}" style="margin: 17px;margin-top: -10px;    height: 40px;">Atualizar</button>
        <span class="loading msg-loading-{{ $registro->idRegistroSenha }}"><img src="{{ asset('img/gif-carregamento.gif') }}" width="64px" /></span>
    </div>

    

    

</div>
                    </div>
                </form>    
            </div>
        </div> 
    </div>
</div>  
