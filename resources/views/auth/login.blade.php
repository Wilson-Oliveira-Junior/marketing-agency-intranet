@extends('layouts.app-login')

@section('mensagem-header')
<h1 class="text-white">Bem-Vindo!</h1>
<p class="text-lead text-light" style="color: #f5f5f5 !important;">Seja bem-vindo(a) à {{ config('app.name', 'Intranet') }}, um novo mundo apresentado a você!</p>
@endsection

@section('content')

    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">

                <div class="text-center text-muted mb-4">
                    <small>Use suas credenciais</small>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input id="password" type="password" placeholder="Senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        </div>
                    </div>

                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Lembre-me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Entrar</button>
                </div>
              </form>

            </div>

          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{ route('password.request') }}" class="text-white"><small>Esqueceu a senha?</small></a>
            </div>
            <div class="col-6 text-right">
              <!--<a href="#" class="text-light"><small>Criar uma nova conta</small></a>-->
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
