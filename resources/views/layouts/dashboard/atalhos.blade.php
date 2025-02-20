  <li class="nav-item dropdown">
    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="ni ni-ungroup"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right" style="min-width: 320px;">
      <div class="row shortcuts px-4">
        
        <a href="{{ route('backend.tarefa') }}" class="col-4 shortcut-item">
          <span class="shortcut-media avatar rounded-circle bg-gradient-green">
            <i class="ni ni-active-40"></i>
          </span>
          <small>Tarefas</small>
        </a>

        <a href="{{ route('backend.evento') }}" class="col-4 shortcut-item">
          <span class="shortcut-media avatar rounded-circle bg-gradient-red">
            <i class="ni ni-calendar-grid-58"></i>
          </span>
          <small>Calendario</small>
        </a>

        <a href="{{ route('backend.cronograma.usuario',Auth::user()->id) }}" class="col-4 shortcut-item">
          <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
            <i class="fas fa-user-clock"></i>
          </span>
          <small>Cronograma</small>
        </a>

        <a href="{{ route('backend.tarefa.backlog', Auth::user()->setor) }}" class="col-4 shortcut-item">
          <span class="shortcut-media avatar rounded-circle bg-gradient-info">
            <i class="fas fa-atom"></i>
          </span>
          <small>Backlog</small>
        </a>

        <a href="{{ route('backend.gatilhos.geral') }}" class="col-4 shortcut-item">
          <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
            <i class="ni ni-chart-pie-35"></i>
          </span>
          <small>Gatilhos</small>
        </a>

      </div>
    </div>
  </li>