<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }} col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="nome" placeholder="Nome" type="text" value="{{ isset($setores->nome) ? $setores->nome : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            </div>
            <input class="form-control" name="email" placeholder="E-mail do Setor" type="text" value="{{ isset($setores->email) ? $setores->email : '' }}" required>
        </div>
    </div>
</div>

<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }} col-sm-12">
        <div class="input-group input-group-alternative mb-3">
            <textarea rows="4" name="descricao" class="form-control form-control-alternative" placeholder="Descrição sobre o Setor ...">{{ isset($setores->descricao) ? $setores->descricao : '' }}</textarea>
        </div>
    </div>
</div>