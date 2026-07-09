<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900" rel="stylesheet">
        <style>
            .style-email{
                width: 50%;
                margin-left: auto;
                margin-right: auto;
                background-color: #e2e2e2;
                color:#444;
                padding: 50px 70px;
                font-family: 'Nunito', sans-serif;
                border-top: 3px solid #dc4c91;
            }
            .style-email .logo{
                margin-left: auto;
                margin-right: auto;
                font-family: 'Nunito', sans-serif;
                display: block;
                width: 350px;
            }
            .style-email h2{
                text-align: center;
                margin-top: 25px;
                font-size: 22px;
                font-family: 'Nunito', sans-serif;
                text-transform: uppercase;
                color: #525252;
                font-weight: bold;
            }
            .style-email .bloco-texto{
                background-color: #ffffff;
                padding: 30px 30px;
                font-size: 12px;
                width: 90%;
                font-family: 'Nunito', sans-serif;
                border: 1px solid #b7b7b7;
                margin-left: auto;
                margin-right: auto;
                box-shadow: 0px 1px 18px -4px rgba(0,0,0,0.75);  
                line-height: 20px;              
            }
            .style-email .link-mail{
                background-color: #0094bf;
                padding: 10px 15px;
                font-family: 'Nunito', sans-serif;
                color: #FFF;
                text-decoration: none;
                font-weight: bold;
                transition: all .3s linear;
                border: 2px dashed #0094bf;
            }
            .style-email .link-mail:hover{
                background-color:#FFF;
                color: #0094bf;
                font-family: 'Nunito', sans-serif;
            }
            .style-email .desenvolvido{
                text-align: center;
                font-family: 'Nunito', sans-serif;
                margin-top: 30px;
            }
            .style-email p{
                color: #81929c;
                font-family: Arial,sans-serif;
                font-size: 16px;
                line-height: 24px;
                padding-bottom: 12px;
            }
            .style-email p span{
                font-size: 12px;
                color: #444;
                font-weight: bold;
            }
            .style-email .p-diferente{
                color: #1155cc;
            }
            .style-email .mensagem{
                font-family: Arial,sans-serif;
                font-size: 16px;
                line-height: 1.5em;
                margin-top: 10px;
                border-radius: 8px;
                background-color: #cae7f7;
                padding: 16px;
            }
        </style>
    </head>
    <body>
        <div class="col-md-12 style-email">
            <img src="{{ asset('img/logo.svg') }}" class="logo">
            <h2>Gatilho FINALIZADO !</h2>
            
            <div class="bloco-texto">
                <p>Olá,</p>
                <p>O Gatilho <strong>{{ $nome }}</strong> foi finalizado </p>
                
                <p class="p-diferente"><span>Cliente</span><br/> {{ $cliente }}</p>
                <p class="p-diferente"><span>Projeto Por</span><br/> {{ $projeto }}</p>
                <p class="p-diferente"><span>Gatilho</span><br/> {{ $nome }}</p>
                <p style="text-align: center;margin-top: 30px;"><a href="{{ $url }}" class="link-mail">Acompanhe o Processo</a>            
            </div>
            <p class="desenvolvido">Desenvolvido por <a href="#"><img src="{{ asset('img/logo.svg') }}">Empresa</a></p>
        </div>
    </body>
</html>