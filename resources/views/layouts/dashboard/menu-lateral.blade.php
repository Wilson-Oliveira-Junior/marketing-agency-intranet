<!-- Divider -->
<hr class="my-3" style="margin-top: -20px !important;">

<!-- Heading -->
<h6 class="navbar-heading text-muted">Menu de Navegação</h6>

<!-- Navigation -->
<ul class="navbar-nav">

  <!-- Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('backend.principal') }}">
      <i class="ni ni-tv-2 text-primary"></i>
      <span class="ocultar-pequeno">Dashboard</span>
    </a>
  </li>

  <!--
    <li class="nav-item treeview">
    <a class="nav-link" href="{{ route('backend.lembrete') }}">
      <i class="ni ni-air-baloon" style="color: #e5539b !important;"></i> Lembretes
    </a>
    </li>
  -->

    <li class="nav-item treeview">
      <a class="nav-link" href="{{ route('backend.cronograma.usuarios') }}">
        <i class="fas fa-calendar-plus" style="color: #762faf;"></i>
        <span class="ocultar-pequeno">Cronograma Equipes</span>
      </a>
    </li>

  <li class="nav-item treeview">
    <a class="nav-link" href="{{ route('backend.tarefa') }}">
      <i class="ni ni-active-40" style="color: #28d384 !important;"></i>
      <span class="ocultar-pequeno">Tarefas</span>
    </a>
  </li>

  <li class="nav-item treeview">
    <a class="nav-link" href="{{ route('backend.tarefa.backlog', Auth::user()->setor) }}">
      <i class="fas fa-atom" style="color: #00cdf1;"></i>
      <span class="ocultar-pequeno">Backlog</span>
    </a>
  </li>

  <li class="nav-item treeview">
    <a class="nav-link" href="{{ route('backend.tarefas.gut.index', Auth::user()->setor) }}">
      <i class="fa fa-tasks" aria-hidden="true" style="color: #f5365c"></i>
      <span class="ocultar-pequeno">GUT - Priorização</span>
    </a>
  </li>

  <li class="nav-item treeview">
    <a class="nav-link" href="{{ route('backend.pauta.index') }}">
      <i class="ni ni-building" style="color: #7962e4;"></i>
      <span class="ocultar-pequeno">Pautas</span>
    </a>
  </li>

</ul>

    <!-- Divider -->
    <hr class="my-3">

      <ul class="navbar-nav mb-md-3" style="margin-bottom: 0px !important;">
        <li class="nav-item">

          <a class="nav-link collapsed" href="#navbar-usuario" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-usuario">
            <i class="far fa-user text-info" style="color: #ffd800 !important;"></i>
            <span class="nav-link-text ocultar-pequeno">Meu espaço</span>
          </a>

          <div class="collapse" id="navbar-usuario" style="">
            <ul class="nav nav-sm flex-column">

                <li class="nav-item">
                  <a class="nav-link" href="{{ route('backend.usuario.editar',Auth::user()->id) }}">
                    <i class="ni ni-badge text-yellow" style="color: #8fce00 !important;"></i> Meu Perfil
                  </a>
                </li>

                <li class="nav-item treeview">
                  <a class="nav-link" href="{{ route('backend.cronograma.usuario',Auth::user()->id) }}">
                    <i class="fas fa-user-clock" style="color: #e34593;"></i> Meu Cronograma
                  </a>
                </li>

                <li class="nav-item treeview">
                  <a class="nav-link" href="{{ route('backend.evento') }}">
                    <i class="ni ni-calendar-grid-58" style="color: #000;"></i> Meu Calendário
                  </a>
                </li>

              </ul>
            </div>
        </li>
      </ul>

  <!-- MÓDULOS TAREFAS -->
  @can('listar_cliente')

    <!-- Divider -->
    <hr class="my-3">

    <!-- MÓDULOS TAREFAS -->
      <ul class="navbar-nav mb-md-3" style="margin-bottom: 0px !important;">
        <li class="nav-item">
          <a class="nav-link collapsed" href="#navbar-tarefas" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-tarefas">
            <i class="ni ni-active-40" style="color: #00ce86;"></i>
            <span class="nav-link-text ocultar-pequeno">Módulos da Tarefa</span>
          </a>

          <div class="collapse" id="navbar-tarefas" style="">
            <ul class="nav nav-sm flex-column">

            @can('listar_cliente')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.cliente') }}">
                  <i class="ni ni-spaceship text-orange"></i> Clientes
                </a>
              </li>
            @endcan

            @can('listar_tipo_tarefa')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.tipotarefa') }}">
                  <i class="ni ni-palette text-yellow"></i> Tipo de Tarefa
                </a>
              </li>
            @endcan

            @can('listar_status')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.status') }}">
                  <i class="ni ni-bullet-list-67 text-red"></i> Status
                </a>
              </li>
            @endcan

            @can('listar_segmentos')
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('backend.segmento') }}">
                    <i class="ni ni-building" style="color: #00cdf1;"></i>
                    Segmentos Clientes
                  </a>
              </li>
            @endcan

            @can('listar_tipo_projeto')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.tipo-projeto') }}">
                  <i class="ni ni-money-coins" style="color: #ffd700;"></i> Tipo de Projeto
                </a>
              </li>
            @endcan

            </ul>
          </div>
        </li>
      </ul>

  @endcan

  <!-- Divider -->
  <hr class="my-3">

  <!-- Relatórios -->
  <ul class="navbar-nav mb-md-3" style="margin-bottom: 0px !important;">
    <li class="nav-item">

      <a class="nav-link collapsed" href="#navbar-relatorio" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-relatorio">
        <i class="far fa-clipboard text-info"></i>
        <span class="nav-link-text">Relat&oacute;rios</span>
      </a>

      <div class="collapse" id="navbar-relatorio" style="">
        <ul class="nav nav-sm flex-column">

          <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.cliente.listagem') }}">
              <i class="fas fa-users" style="color: #fb2d55;"></i> Listagem de Clientes
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.relatorio.cliente.ftps') }}">
              <i class="fas fa-upload"></i> Listagem de FTPs
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.cliente.registro-senha.listagem') }}">
              <i class="fas fa-key"></i> Registros de Senha
            </a>
          </li>

          @can('listar_relatorio_cronograma')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('backend.relatorio.tarefa.cronograma') }}">
                <i class="fas fa-chart-bar" style="color: #fb2d55;"></i> Relatórios Tarefas
              </a>
            </li>
          @endcan

          <li class="nav-item">
            <a href="#navbar-multilevel" class="nav-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-multilevel"><i class="far fa-folder-open" style="color: #00cdf1;"></i>Documentos</a>
              <div class="collapse show" id="navbar-multilevel" style="">
                      <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('backend.relatorio.documentosgerais', 7) }}">Administrativo</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('backend.relatorio.documentosgerais', 2) }}">Atendimento</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('backend.relatorio.documentosgerais', 4) }}">Comercial</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('backend.relatorio.documentosgerais', 3) }}">Cria&ccedil;&atilde;o</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('backend.relatorio.documentosgerais', 1) }}">Desenvolvimento</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('backend.relatorio.documentosgerais', 5) }}">Marketing</a>
                        </li>
                      </ul>
                    </div>
                  </li>

                </ul>
              </div>
            </li>
    </ul>
  </ul>

  <!-- Divider -->
  <hr class="my-3">

    <!-- GESTÃO -->
    <ul class="navbar-nav mb-md-3" style="margin-bottom: 0px !important;">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#navbar-gestao" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-gestao">
          <i class="ni ni-collection" style="color: #fb2d55;"></i>
          <span class="nav-link-text">Gestão</span>
        </a>

        <div class="collapse" id="navbar-gestao" style="">
          <ul class="nav nav-sm flex-column">

            @can('listar_tipo_usuario')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.tipo-usuario') }}">
                  <i class="ni ni-badge text-pink"></i> Tipos de Usuários
                </a>
              </li>
            @endcan

            @can('listar_usuario')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.usuario') }}">
                  <i class="ni ni-single-02 text-red"></i> Usuários
                </a>
              </li>
            @endcan

            @can('listar_setores')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.setor') }}">
                  <i class="ni ni-circle-08 text-info"></i> Setores
                </a>
              </li>
            @endcan

            @can('listar_permissoes')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('backend.permissao') }}">
                  <i class="ni ni-notification-70" style="color: #000;"></i> Permissões
                </a>
              </li>
            @endcan

            @can('listar_gatilhos')
              <li class="nav-item">

                <a href="#navbar-multilevel-2" class="nav-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-multilevel">
                  <i class="ni ni-active-40" style="color: #fc8135;"></i>
                  Gatilhos
                </a>

                <div class="collapse show" id="navbar-multilevel-2">
                  <ul class="nav nav-sm flex-column">

                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('backend.gatilhos.geral') }}">Gatilhos em Gerais</a>
                    </li>

                    @if(Auth::user()->id == 1 || Auth::user()->id == 3)
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend.gatilhos') }}">Templates Gatilhos</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend.gatilhos.grupo') }}">Grupos dos Gatilhos</a>
                      </li>
                    @endif

                  </ul>
                </div>
              </li>
            @endcan

            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="ni ni-settings-gear-65 text-success"></i> Configuração
              </a>
            </li>

          </ul>
        </div>
      </li>
    </ul>

    @canany(['listar_boletos_vencidos', 'listar_devedores_conta_azul'])
        <!-- Divider -->
        <hr class="my-3">

        <ul class="navbar-nav mb-md-3" style="margin-bottom: 0px !important;">
        <li class="nav-item">

            <a class="nav-link collapsed" href="#navbar-financeiro" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-financeiro">
            <i class="fas fa-donate text-info" style="color: #2687e9 !important;"></i>
            <span class="nav-link-text ocultar-pequeno">Financeiro</span>
            </a>

            <div class="collapse" id="navbar-financeiro" style="">
                <ul class="nav nav-sm flex-column">
                    @can('listar_boletos_vencidos')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('backend.cliente.vencidos') }}">
                        <i class="fas fa-barcode" style="color: #2687e9"></i>
                        <span class="ocultar-pequeno" style="color: #2687e9">Boletos Vencidos Asaas</span>
                        </a>
                    </li>
                    @endcan
                    @can('listar_devedores_conta_azul')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.contaazul.devedores') }}">
                            <i class="fas fa-money-bill-alt" style="color: #2687e9"></i>
                            <span class="ocultar-pequeno" style="color: #2687e9">Devedores CA</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </li>
        </ul>


    @endcan

  <!-- Divider -->
  <hr class="my-3">

  <!-- Heading -->
  <h6 class="navbar-heading text-light" style="display: block!important;">Redes Sociais</h6>

  <!-- Redes Sociais -->
  <ul class="navbar-nav mb-md-3">

    <li class="nav-item">
      <a class="nav-link" href="https://www.facebook.com/agencialogicadigital/" target="_blank">
        <i class="fab fa-facebook-square" style="color:#4267b2"></i>
        <span class="ocultar-pequeno">Facebook</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="https://www.instagram.com/agencialogicadigital/" target="_blank">
        <i class="fab fa-instagram" style="color: #c23884;"></i>
        <span class="ocultar-pequeno">Instagram</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="https://www.youtube.com/channel/UCibYLnhb7tT6febvhlZtMXg" target="_blank">
        <i class="fab fa-youtube" style="color: #ff0000;"></i>
        <span class="ocultar-pequeno">Youtube</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="https://www.linkedin.com/company/l-gica-digital/mycompany/" target="_blank">
        <i class="fab fa-linkedin" style="color: #0a66c2;"></i>
        <span class="ocultar-pequeno">Linkedin</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="https://br.pinterest.com/logicadigital" target="_blank">
        <i class="fab fa-pinterest" style="color: #e60023;"></i>
        <span class="ocultar-pequeno">Pinterest</span>
      </a>
    </li>

  </ul>
