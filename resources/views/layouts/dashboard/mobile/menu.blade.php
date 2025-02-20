    <div class="menu-mobile">
         <!-- Perfil -->
        <div class="col-md-4">
            <ul class="navbar-nav align-items-center" style="">
                
                <li class="nav-item dropdown">
                    
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 2px;">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if( Auth::user()->image != NULL )
                                    <img alt="Image placeholder" src="http://intranet.logicadigital.com.br/{{ Auth::user()->image }}">
                                @else
                                    <img alt="Image placeholder" src="{{ asset('img/user.png') }}">
                                @endif
                            </span>
                        </div>
                    </a>

                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-arrow-personalizado dropdown-menu-right">
                    
                    <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Bem Vindo!</h6>
                    </div>
                    
                    <a href="http://intranet.logicadigital.com.br/backend/usuarios/editar/1" class="dropdown-item">
                    <i class="ni ni-single-02"></i>
                    <span>Meu Perfil</span>
                    </a>

                    <a href="http://intranet.logicadigital.com.br/backend/usuario/1/cronograma" class="dropdown-item">
                    <i class="ni ni-calendar-grid-58"></i>
                    <span>Meu Cronograma</span>
                    </a>

                    <a href="http://intranet.logicadigital.com.br/backend/tarefas/backlog/1" class="dropdown-item">
                    <i class="fas fa-atom"></i>
                    <span>Backlog do Meu Setor</span>
                    </a>

                    <div class="dropdown-divider"></div>
                    
                    <a href="http://intranet.logicadigital.com.br/backend/login/sair" class="dropdown-item">
                    <i class="ni ni-user-run"></i>
                    <span>Sair</span>
                    </a>

                </div>

            </li>
            </ul>
        </div>

        <!-- Adicionar Tarefa -->
        <div class="col-md-4">
            <a id="botao-mobile-tarefa" href="#" data-toggle="modal" data-target="#novatarefa">+</a>
        </div>

        <!-- Menu Principal -->
        <div class="col-md-4" style="padding-top: 10px;">

            <div id="abrir-menu-mobile" class="sidenav-toggler" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </div>

        </div>
    </div>