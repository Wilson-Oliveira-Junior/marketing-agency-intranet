  <!-- Header -->
    <div class="header bg-gradient-novo pb-8 pt-5 pt-md-8 todos">

        <!-- Cabeçalho Mobile -->
        <div class="caixa-logo" style="background-color: #0a0a43">
          <a href="{{ route('backend.principal') }}">
            <img src="{{ asset('img/logo.png') }}" class="logo-mobile" >
          </a>
        </div>

      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row mobile-row">

            <div class="col-xl-3 col-lg-6 mobile-numero">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Entregues</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $data['quadro1'] }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                    <span class="text-nowrap"><?php echo date('Y') ?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 mobile-numero">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tarefas</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $data['quadro2'] }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="far fa-sticky-note"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"><?php echo date('Y') ?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 mobile-numero">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Usuários</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $data['quadro3'] }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"><?php echo date('Y') ?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 mobile-numero">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Clientes</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $data['quadro4'] }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-child"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"><?php echo date('Y') ?></span>
                  </p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
