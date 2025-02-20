<div class="row col-sm-12">
    <div class="form-group col-sm-12">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="name" placeholder="Nome" type="text" value="{{ isset($roles->name) ? $roles->name : '' }}">
        </div>
    </div>
</div>

<div class="row col-sm-12">
    <div class="form-group col-sm-12">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="label" placeholder="Label" type="text" value="{{ isset($roles->label) ? $roles->label : '' }}">
        </div>
    </div>
</div>