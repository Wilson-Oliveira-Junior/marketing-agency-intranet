<div class="card card-profile shadow">
        
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-12">
                    <h3 class="mb-0">Níveis de Importância</h3>
                </div>
            </div>
        </div>

        <div class="card-body painel-lembrete" style="background-color: #fbfbfb;padding-bottom: 0px;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link seven" href="{{ route('backend.lembrete.nivel-de-importancia.alta') }}">
                    <i class="fas fa-angle-double-up"></i> Alta
                    </a>
                </li>
                
                <hr class="my-1">
                
                <li class="nav-item treeview">
                    <a class="nav-link eight" href="{{ route('backend.lembrete.nivel-de-importancia.media') }}">
                    <i class="fas fa-angle-double-right"></i> Média
                    </a>
                </li>

                <hr class="my-1">

                <li class="nav-item treeview">
                    <a class="nav-link" href="{{ route('backend.lembrete.nivel-de-importancia.baixa') }}">
                    <i class="fas fa-angle-double-down"></i> Baixa
                    </a>
                </li>

            </ul>
        </div>

    </div>