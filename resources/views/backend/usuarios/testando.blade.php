@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}">
        Usuários
    </a>
@endsection

@section('content')
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Adicionando Usuário</h3>
            </div>
            <form id="testando-form" action="" method="POST" enctype="multipart/form-data">

                    <input class="form-control" name="name" placeholder="Nome" type="text">
                    <input class="form-control" name="email" placeholder="E-mail" type="text">
                    <input class="form-control" name="password" placeholder="Password" type="text">
                    <br/>
                    <button class="btn btn-info" style="margin: 17px;margin-top: -10px;">Adicionar</button> 
            </form>

        </div>
    </div> 
@endsection

@section('script')
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#testando-form').submit(function(){
                var dados = jQuery( this ).serialize();

                jQuery.ajax({
                    type: "POST",
                    url: "http://comprala.ldclientes.com.br/backend/api/usuario/app/salvar",
                    data: dados,
                    cache: false,
                    beforeSend: function () {

                    },
                    success: function(data){
                        console.log(data);
                    },
                    complete: function(){

                    }
                });
                
                return false;
            });
        });
    </script> 
@endsection