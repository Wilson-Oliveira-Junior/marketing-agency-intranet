<div class="card card-profile shadow" style="margin-bottom: 20px;">
        
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-12">
                    <h3 class="mb-0">Painel de Navegação</h3>
                </div>
            </div>
        </div>

        <div class="card-body painel-lembrete" style="background-color: #fbfbfb;padding-bottom: 0px;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('backend.lembrete') }}">
                        <i class="fa fa-inbox"></i> Para Mim
                    </a>
                </li>
                
                <hr class="my-1">
                
                <li class="nav-item treeview">
                    <a class="nav-link two" href="{{ route('backend.lembrete.area-equipe') }}">
                        <i class="fa fa-inbox"></i> Setor
                    </a>
                </li>

                <hr class="my-1">

                <li class="nav-item treeview">
                    <a class="nav-link three" href="{{ route('backend.lembrete.eu-criei') }}">
                        <i class="fa fa-inbox"></i> Eu Criei
                    </a>
                </li>

                <hr class="my-1">

                <li class="nav-item">
                    <a class="nav-link four" href="{{ route('backend.lembrete.abertos') }}">
                        <i class="fa fa-inbox"></i> Abertos
                    </a>
                </li>

                <hr class="my-1">

                <li class="nav-item">
                    <a class="nav-link five" href="{{ route('backend.lembrete.pendentes') }}">
                        <i class="fa fa-inbox"></i> Pendentes
                    </a>
                </li>

                <hr class="my-1">

                <li class="nav-item">
                    <a class="nav-link six" href="{{ route('backend.lembrete.fechados') }}">
                        <i class="fa fa-inbox"></i> Fechados
                    </a>
                </li>
                
            </ul>
        </div>

    </div>