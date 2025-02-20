<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800,900&display=swap" rel="stylesheet">
        <style>
            .style-email{
                width: 600px;
                margin-left: auto;
                margin-right: auto;
                background-color: #e2e2e2;
                color: #444;
                padding: 70px 0px;
                overflow: auto;
                padding-bottom: 0px;
                font-family: 'Muli', sans-serif;
                border-top: 1px solid #dc4c91;
                background-image: url(http://intranet.logicadigital.com.br/img/gatilhos/bg-gatilho-email.png);
            }
            .style-email .logo{
                margin-left: auto;
                margin-right: auto;
                font-family: 'Nunito', sans-serif;
                display: block;
                width: 350px;
            }
            .style-email h2{
                text-align: left;
                padding-left: 100px;
                margin-top: 25px;
                font-size: 70px;
                font-family: 'Muli', sans-serif;
                text-transform: inherit;
                color: #ffffff;
                font-weight: bold;
                margin-bottom: 0px;
                padding-bottom: 0px;
            }
            .style-email h3{
                padding-left: 105px;
                color: #FFF;
                font-size: 35px;
                font-family: 'Muli', sans-serif;
                width: 450px;
                margin-bottom: 0px;
                margin-top: 0px;
            }
            .style-email h4{
                color: #636363;
                padding-top: 60px;
                font-size: 13px;
                font-family: 'Muli', sans-serif;
                padding-left: 30px;
                line-height: 25px;
                width: 250px;
                float: left;
                text-align: justify;
                font-weight: 400;
            }
            .style-email h5{
                color: #636363;
                font-weight: 400;
                width: 210px;
                padding-top: 125px;
                margin-left: 40px;
                font-family: 'Muli', sans-serif;
                line-height: 25px;
                font-size: 13px;
                float: left;
                text-align: justify;
            }
            .style-email h6{
                padding-left: 350px;
                padding-top: 0px;
                width: 170px;
                float: left;
                font-family: 'Muli', sans-serif;
                color: #636363;
                line-height: 25px;
                text-align: justify;
                font-size: 13px;
                font-weight: 400;
            }
            .style-email .bloco-texto{
                background-color: transparent;
                padding: 30px 30px;
                font-size: 12px;
                width: auto;
                font-family: 'Muli', sans-serif;
                border: none;
                margin-left: auto;
                margin-right: auto;
                line-height: 20px;          
            }
            .style-email .p-diferente{
                font-size: 19px;
                text-transform: uppercase;
                text-align: center;
                color: #d8d8d8;
                float: left;
                padding: 0px 65px;
                padding-top: 35px;
                font-family: 'Muli', sans-serif;
                font-weight: bold;
                margin-bottom: -15px;
            }
            .style-email .p-2{
                float: left;
                width: 100%;
                font-weight: bold;
                color: #683af0;
                line-height: 20px;
                letter-spacing: -1px;
                font-family: 'Muli', sans-serif;
                font-size: 25px;
                text-align: center;
                padding-top: 20px;
            }
            .style-email .p-2 span{
                font-weight: 400;
                font-family: 'Muli', sans-serif;
            }
            .style-email ul{
                float: left;
                list-style-type: none;
                padding-top: 40px !important;
                font-family: 'Muli', sans-serif;
                padding: 0px;
            }
            .style-email ul li{
                float: left;
                width: 27%;
                text-align: center;
                margin-left: 27px;
                font-family: 'Muli', sans-serif;
                line-height: 20px;
                font-weight: bold;
                font-size: 12px;
                color: #FFF;
            }
            .style-email ul li span{
                width: 100%;
                float: left;
                font-size: 15px;
                min-height: 50px;
                font-family: 'Muli', sans-serif;
                text-align: center;
            }
            .style-email .logo-logica{
                width: 300px;
                margin-left: auto;
                margin-right: auto;
                display: block;
                padding-top: 40px;
            }
            .nao-responder{
                text-align: center;
                font-weight: bold;
                font-family: 'Muli', sans-serif;
                padding-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="col-md-12 style-email">
            
            <!-- Cabeçalho -->
            <h2>Olá,</h2>
            <h3>{{ $cliente }}</h3>
            
            <div class="bloco-texto">

                <!-- Primeiro Texto -->
                <h4>
                    Aqui na agência estamos trabalhando a todo vapor no seu projeto. 
                    Esse e-mail é apenas um lembrete de que precisamos da sua ajuda para 
                    seguirmos em frente. Então atenção, arrume um tempinho para nos passar todo o 
                    <strong>conteúdo</strong> já solicitado.
                </h4>

                <!-- Texto Balão -->
                <h5>
                    O prazo de entrega do projeto é <strong>{{ date( 'd/m/Y' , strtotime($data_limite)) }}</strong>, 
                    fique atendo a falta do conteúdo pode atrasar o seu projeto e não queremos isso, 😫
                    não é mesmo?
                </h5>

                <h6>
                    Essa é uma <strong>mensagem automática</strong>. 
                    Caso precise de ajuda ou tenha duvidas sobre qual conteúdo 
                    deve ser enviado entre em contato conosco.
                </h6>
                
                <div class="p-diferente">contato: (19) 2519-7200 | (11) 4750-1312 | (21) 3952-7684 | WhatsApp (19) 99335-9012</div>
                <div class="p-2">Sua colaboração<br/><span>é muito importante !</span></div>

                <ul>
                    <li style="padding-left: 15px;"><span>DATA DE INÍCIO:</span>09/10/2019</li>
                    <li style="margin-left: 11px;"><span>DATA DE FINALIZAÇÃO:</span>09/10/2019</li>
                    <li style="margin-left: 15px;"><span>DIAS PASSADOS:</span>09/10/2019</li>
                </ul>

                <img src="http://intranet.logicadigital.com.br/img/gatilhos/logo-logica-digital.png" class="logo-logica">
           
                <div class="nao-responder">Por favor, não responder esse e-mail</div>
            </div>
        </div>
    </body>
</html>