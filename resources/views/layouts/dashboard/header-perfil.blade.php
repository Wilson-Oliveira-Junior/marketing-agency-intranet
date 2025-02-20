    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url({{ asset('img/profile-cover.jpg') }}); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Olá {{ Auth::user()->name }},</h1>
            <p class="text-white mt-0 mb-5">Eu sou {{ $usuarios->name }}, esta é a sua página de perfil. Você pode ver as minhas informações, como por exemplo data de aniversário ou até mesmo onde eu moro. Aproveitando que está aqui, me segue nas redes sociais rsrs ;)</p>
            <a href="{{ route('backend.usuario.editar',Auth::user()->id) }}" class="btn btn-info">Editar Perfil</a>
          </div>
        </div>
      </div>
    </div>