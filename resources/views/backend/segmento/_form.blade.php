<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }} col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="nome" placeholder="Nome" type="text" value="{{ isset($segmentos->nome) ? $segmentos->nome : '' }}">
        </div>
    </div>
</div>