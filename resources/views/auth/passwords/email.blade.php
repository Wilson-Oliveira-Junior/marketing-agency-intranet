@extends('layouts.app-login')

@section('mensagem-header')
<h1 class="text-white">Esqueceu a Senha?</h1>
<p class="text-lead text-light" style="color: #f5f5f5 !important;">Não tem problema, nós damos um jeito! Um E-mail será enviada e você recupera a sua senha em um instante.</p>
@endsection

@section('content')

<!-- Page content -->
<div class="container mt--8 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary shadow border-0">

        <div class="card-body px-lg-5 py-lg-5">

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group row">

                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Enviar E-mail') }}
                    </button>
                </div>
            </form>

        </div>

      </div>

    </div>
  </div>
</div>
@endsection
