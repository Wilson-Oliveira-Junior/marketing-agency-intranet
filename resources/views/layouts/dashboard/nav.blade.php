<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        
      @yield('name-page')
             
        <!-- Pesquisar -->
        <form action="{{ route('backend.tarefa.busca') }}" name="frmBuscarTarefa" id="frmBuscarTarefa" method="POST" class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          {{ csrf_field() }}
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" name="busca-tarefa" value="" placeholder="Buscar..." type="text">
            </div>
          </div>
        </form>

          <ul class="navbar-nav align-items-center">
            @include('layouts.dashboard.notificacao')

            @include('layouts.dashboard.atalhos')
          </ul>

        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            
            <li class="nav-item dropdown">
                
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            @if( Auth::user()->image != NULL )
                                <img alt="Image placeholder" src="{{ Auth::user()->image ? config('app.url').'/'.ltrim(Auth::user()->image, '/') : asset('img/user.svg') }}">
                            @else
                                <img alt="Image placeholder" src="{{ asset('img/user.png') }}">
                            @endif
                        </span>
                    </div>
                </a>

              <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                
                <div class=" dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Bem Vindo!</h6>
                </div>
                
                <a href="{{ route('backend.usuario.editar',Auth::user()->id) }}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>Meu Perfil</span>
                </a>

                <a href="{{ route('backend.cronograma.usuario',Auth::user()->id) }}" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Meu Cronograma</span>
                </a>

                <a href="{{ route('backend.tarefa.backlog', Auth::user()->setor) }}" class="dropdown-item">
                  <i class="fas fa-atom"></i>
                  <span>Backlog do Meu Setor</span>
                </a>

                <div class="dropdown-divider"></div>
                
                <a href="{{ route('backend.login.sair') }}" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Sair</span>
                </a>

              </div>

          </li>
        </ul>
      </div>
    </nav>