<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
            .style-email{
                width: 40%;
                margin-left: auto;
                margin-right: auto;
                background-color: #e2e2e2;
                color:#444;
                padding: 50px 70px;
                border-top: 3px solid #dc4c91;
            }
            .style-email .logo{
                margin-left: auto;
                margin-right: auto;
                display: block;
                width: 350px;
            }
            .style-email h2{
                text-align: center;
                margin-top: 25px;
                font-size: 22px;
                text-transform: uppercase;
                color: #525252;
                font-weight: bold;
            }
            .style-email .bloco-texto{
                background-color: #ffffff;
                padding: 30px 30px;
                font-size: 12px;
                width: 80%;
                margin-left: auto;
                margin-right: auto;
                box-shadow: 0px 1px 18px -4px rgba(0,0,0,0.75);  
                line-height: 20px;              
            }
            .style-email .link-mail{
                background-color: #0094bf;
                padding: 10px 15px;
                color: #FFF;
                text-decoration: none;
                font-weight: bold;
                transition: all .3s linear;
                border: 2px dashed #0094bf;
            }
            .style-email .link-mail:hover{
                background-color:#FFF;
                color: #0094bf;
            }
            .style-email .desenvolvido{
                text-align: center;
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div class="col-md-12 style-email">
            <img src="{{ asset('img/logo.svg') }}" class="logo">
            <h2>Usuário Adicionado !</h2>
            <div class="bloco-texto">
                <p>Olá</p>
                <p>Um novo usuário foi adicionado,<br/>
                Está tudo pronto para o novo usuário começar a usar o sistema de lembrete, lembrando que você, o administrador tem total controle sobre os usuários que estão cadastrado e a demais funções !</p>
                <p>Clique no botão abaixo e verifique os usuários cadastrados no sistema</p>
                <p style="text-align: center;margin-top: 30px;"><a href="#" class="link-mail">CLIQUE AQUI</a>
            </div>
            <p class="desenvolvido">Desenvolvido por <a href="#"><img src="<?php echo asset('img/logo.png'); ?>">Empresa</a></p>
        </div>
    </body>
</html>