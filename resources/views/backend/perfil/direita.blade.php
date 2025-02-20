<div class="col-xl-8 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Minha Conta</h3>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <form>
                <h6 class="heading-small text-muted mb-4">Informações do Usuário</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Nome</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="{{ $usuarios->name }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">E-mail</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="{{ $usuarios->email }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Celular</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Celular" value="{{ $usuarios->celular }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Data de Aniversário</label>
                        <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" value="{{ date( 'd/m/Y' , strtotime($usuarios->nascimento))}}">
                      </div>
                    </div>
                  </div>
                </div>
                
                <hr class="my-4" />

                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Informações de Endereço</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Endereço</label>
                        <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="{{ $usuarios->endereco }}" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Cidade</label>
                        <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" value="{{ $usuarios->cidade }}">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Estado</label>
                        <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="{{ $usuarios->estado }}">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">CEP</label>
                        <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="{{ $usuarios->cep }}">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Sobre Mim</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <textarea rows="4" class="form-control form-control-alternative">{{ $usuarios->descricao }}</textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
		