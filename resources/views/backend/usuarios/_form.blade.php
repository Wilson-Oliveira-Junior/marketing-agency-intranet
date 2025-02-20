<h3 class="titulo-formulario">Informações do Usuário</h3>

<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="name" placeholder="Nome" type="text" value="{{ isset($usuario->name) ? $usuario->name : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('sobrenome') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="sobrenome" placeholder="Sobrenome" type="text" value="{{ isset($usuario->sobrenome) ? $usuario->sobrenome : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('apelido') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" name="apelido" placeholder="Apelido" type="text" value="{{ isset($usuario->apelido) ? $usuario->apelido : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
            </div>
            <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ isset($usuario->email) ? $usuario->email : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('sexo') ? 'has-error' : '' }} col-sm-4">
        Sexo:
        <div class="form-check form-check-inline mb-3">

            <input type="radio" name="sexo" id="sexo-feminino" class="form-check-input" value="F" {{ (isset($usuario->sexo) && $usuario->sexo == 'F') ? 'checked' : '' }}>
            <label class="form-check-label" for="sexo-feminino">
                F
              </label>
        </div>
        <div class="form-check form-check-inline mb-3">
            <input type="radio" name="sexo" id="sexo-masculino" class="form-check-input" value="M" {{ (isset($usuario->sexo) && $usuario->sexo == 'M') ? 'checked' : '' }}>
            <label class="form-check-label" for="sexo-masculino">
                  M
            </label>
        </div>
    </div>


    <div class="form-group col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-atom"></i></span>
            </div>
            <select name="setor" style="width: 85%;border: none;padding: 10px;color: #aeaeae;">
                @foreach($setores as $setore)
                    <option value="{{ $setore->id }}" {{ (isset($usuario->setor) && $usuario->setor == $setore->id ? 'selected' : '') }}>{{ $setore->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group {{ $errors->has('user_rede') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-laptop"></i></span>
            </div>
            <input class="form-control" name="user_rede" placeholder="Usuário da rede" type="text" value="{{ isset($usuario->user_rede) ? $usuario->user_rede : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('nascimento') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
            </div>
            <input class="form-control" placeholder="Nascimento" name="nascimento" type="date" value="{{ isset($usuario->nascimento) ? $usuario->nascimento : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('celular') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
            </div>
            <input class="form-control" placeholder="Celular" name="celular" type="text" value="{{ isset($usuario->celular) ? $usuario->celular : '' }}">
        </div>
    </div>

</div>

<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }} col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="btn">
                <input type="file" name="image" class="form-control-file">
            </div>

            @if(isset($usuario->image))
                <img src="{{ asset($usuario->image) }}" width="100" style="height: 45px;width: 45px;">
            @endif
        </div>
    </div>

    <div class="form-group col-sm-6">
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Senha">
        </div>
    </div>
</div>
<div class="row col-sm-12">
    <div class="form-group {{ $errors->has('ramal') ? 'has-error' : '' }} col-sm-12">
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
            </div>
            <input type="text" name="ramal" class="form-control" maxlength="6" placeholder="Ramal .Ex: 7212" value="{{ isset($usuario->ramal) ? $usuario->ramal : '' }}">
        </div>
    </div>
</div>

<h3 class="titulo-formulario">Informações de Endereço</h3>

<div class="row col-sm-12">

    <div class="form-group {{ $errors->has('cep') ? 'has-error' : '' }} col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
            </div>
            <input class="form-control" type="text" name="cep" id="campo_cep" onchange="dadosCep(this.value);" placeholder="Digite o CEP" value="{{ isset($usuario->cep) ? $usuario->cep : '' }}" />
        </div>
    </div>

    <div class="form-group {{ $errors->has('endereco') ? 'has-error' : '' }} col-sm-6">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
            </div>
            <input class="form-control" type="text" name="endereco" id="campo_logradouro" placeholder="Endereço" value="{{ isset($usuario->endereco) ? $usuario->endereco : '' }}"/>
        </div>
    </div>

    <div class="form-group {{ $errors->has('bairro') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
            </div>
            <input class="form-control" type="text" name="bairro" id="campo_bairro" placeholder="Bairro" value="{{ isset($usuario->bairro) ? $usuario->bairro : '' }}" />
        </div>
    </div>

    <div class="form-group {{ $errors->has('cidade') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
            </div>
            <input class="form-control" type="text" name="cidade" id="campo_cidade" placeholder="Cidade" value="{{ isset($usuario->cidade) ? $usuario->cidade : '' }}"/>
        </div>
    </div>

    <div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
            </div>
            <input class="form-control" type="text" name="estado" id="campo_estado" placeholder="Estado" value="{{ isset($usuario->estado) ? $usuario->estado : '' }}"/>
        </div>
    </div>
</div>

<h3 class="titulo-formulario">Redes Sociais</h3>

<div class="row col-sm-12">

    <div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fab fa-facebook-square"></i></span>
            </div>
            <input class="form-control" name="facebook" placeholder="Link Facebook" type="text" value="{{ isset($usuario->facebook) ? $usuario->facebook : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('instagram') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fab fa-instagram"></i></span>
            </div>
            <input class="form-control" name="instagram" placeholder="Link Instagram" type="text" value="{{ isset($usuario->instagram) ? $usuario->instagram : '' }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('linkedin') ? 'has-error' : '' }} col-sm-4">
        <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
            </div>
            <input class="form-control" name="linkedin" placeholder="Link Linkedin" type="text" value="{{ isset($usuario->linkedin) ? $usuario->linkedin : '' }}">
        </div>
    </div>

</div>

<h3 class="titulo-formulario">Curiosidades Sobre Você</h3>

<div class="row col-sm-12">

    <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }} col-sm-12">
        <div class="input-group input-group-alternative mb-3">
            <textarea rows="4" name="descricao" class="form-control form-control-alternative" placeholder="Escreva um pouco sobre você ...">{{ isset($usuario->descricao) ? $usuario->descricao : '' }}</textarea>
        </div>
    </div>

</div>

@section('script')
    <script>
        function dadosCep(cep){
            //https://viacep.com.br/ws/13035270/json/

            var camp_cep = document.getElementById("campo_cep");
            var cep = camp_cep.value;

            //Etapa 1: criar requisição
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            }
            else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }

            //Etapa 2: tratar estados do ajax
            xhr.onreadystatechange=function() {
                if(xhr.readyState == 4) {
                    var dados = JSON.parse(xhr.responseText);
                    document.getElementById("campo_logradouro").value = dados.logradouro;
                    document.getElementById("campo_bairro").value = dados.bairro;
                    document.getElementById("campo_cidade").value = dados.localidade;
                    document.getElementById("campo_estado").value = dados.uf;
                }
            }

            //Etapa 3: enviar requisição
            var contentUrl = 'https://viacep.com.br/ws/'+ cep +'/json/';
            xhr.open("GET", contentUrl, true);
            xhr.send(null);
        }
    </script>
@endsection
