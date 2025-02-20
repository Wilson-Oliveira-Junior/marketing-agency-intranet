<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('servidor') ? 'has-error' : '' }} col-sm-12">
        Servidor
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="servidor" placeholder="Exemplo: 177.73.233.244" type="text" value="{{ isset($vFTP->servidor) ? $vFTP->servidor : '' }}">
            @if($errors->has('servidor'))
                <span class="help-block"><strong>{{ $errors->first('servidor') }}</strong></span>
            @endif
        </div>
    </div>
</div>
<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('protocolo') ? 'has-error' : '' }} col-sm-12">
        Protocolo
        @if(isset($vFTP->protocolo)):
        <div class="custom-control custom-radio mb-3">
            <input name="protocolo" class="custom-control-input" id="protocolo-ftp" type="radio"  @if($vFTP->protocolo == 'ftp' || $vFTP->protocolo == '') checked="checked" @endif value="ftp">
            <label class="custom-control-label" for="protocolo-ftp">FTP</label>
        </div>
        <div class="custom-control custom-radio mb-3">
            <input name="protocolo" class="custom-control-input" id="protocolo-ssh" type="radio" @if($vFTP->protocolo == 'ssh') checked="checked" @endif value="ssh">
            <label class="custom-control-label" for="protocolo-ssh">SSH</label>
        </div>
        <div class="custom-control custom-radio mb-3">
            <input name="protocolo" class="custom-control-input" id="protocolo-sftp" type="radio" @if($vFTP->protocolo == 'sftp') checked="checked" @endif value="sftp">
            <label class="custom-control-label" for="protocolo-sftp">SFTP</label>
        </div>
        @else
        <div class="custom-control custom-radio mb-3">
            <input name="protocolo" class="custom-control-input" id="protocolo-ftp" type="radio"   checked="checked" value="ftp">
            <label class="custom-control-label" for="protocolo-ftp">FTP</label>
        </div>
        <div class="custom-control custom-radio mb-3">
            <input name="protocolo" class="custom-control-input" id="protocolo-ssh" type="radio" value="ssh">
            <label class="custom-control-label" for="protocolo-ssh">SSH</label>
        </div>
        <div class="custom-control custom-radio mb-3">
            <input name="protocolo" class="custom-control-input" id="protocolo-sftp" type="radio" value="sftp">
            <label class="custom-control-label" for="protocolo-sftp">SFTP</label>
        </div>
        @endif
        
        
    </div>
</div>
<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }} col-sm-12">
        Usu&aacute;rio
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="usuario" placeholder="Exemplo: prod_logica" type="text" value="{{ isset($vFTP->usuario) ? $vFTP->usuario : '' }}">
        </div>
    </div>
</div>
<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('senha') ? 'has-error' : '' }} col-sm-12">
        Senha
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="senha" placeholder="Exemplo: xhgˆ75402" type="text" value="{{ isset($vFTP->senha) ? $vFTP->senha : '' }}">
        </div>
    </div>
</div>
<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('protocolo') ? 'has-error' : '' }} col-sm-12">
        Observa&ccedil;&atilde;o
        <textarea class="form-control form-control-alternative" name="observacao" rows="3" placeholder="Se tiver alguma observação, pode colcoar.">{{ isset($vFTP->observacao) ? $vFTP->observacao : '' }}</textarea>
        
    </div>
</div>