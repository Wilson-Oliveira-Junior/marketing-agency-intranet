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
                background-color: #000;
                color:#444;
                padding: 50px 70px;
                font-family: 'Nunito', sans-serif;
                border-top: 3px solid #6c47ff;
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
                color: #33b4ff;
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
                background-color: #4883fd;
                padding: 10px 15px;
                font-family: 'Nunito', sans-serif;
                color: #FFF;
                text-decoration: none;
                font-weight: bold;
                transition: all .3s linear;
                border: 2px dashed #4883fd;
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
            .style-email table{
                width:100%;
            }
            .style-email table, th, td{
                border: 1px solid #ccc;
                border-collapse: collapse;
            }
            .style-email table thead tr{
                text-align: center;
            }
            .style-email table thead tr td{
                font-family: Arial,sans-serif;
                font-weight: bold;
                font-size: 11px;
                text-align: center;
            }
            .style-email table tbody tr{
                text-align: center;
            }
            .style-email table tbody tr td{
                font-family: Arial,sans-serif;
                font-weight: normal;
                font-size: 10px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="col-md-12 style-email">
            <img src="https://www.logicadigital.com.br/arquivos/2018/08/logo-preto.png" class="logo">
            <h2>Gatilhos Atrasados !</h2>

            <div class="bloco-texto">
                <p>Olá Equipe,</p>
                <p>Os gatilhos abaixo estão atrasados, precisamos agilizar para finalizar, bora bora, se não a sirene 📢 vai tocar e a bomba estourar 💣 </p>
                <p>Então, vamos se movimentar 🏃</p>
                <p>Precisamos de <strong>você!</strong></p>

                <table>
                    <thead>
                        <tr>
                            <td>👨 Cliente</td>
                            <td>🚀 Projeto</td>
                            <td>🌐 Gatilho</td>
                            <td>📅 Data Limite</td>
                            <td>👨 Envolvidos</td>
                            <td>Ação</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($arrProjetos as $projeto)

                        @if($projeto['qtdeGatAtraso'] > 0)

                                @if(count($projeto['gatilhosAtrasados'])> 0)
                                    @foreach ($projeto['gatilhosAtrasados'] as $key => $atraso)
                                    <tr>
                                        <td>{{$projeto['cliente']}}</td>
                                        <td>{{$projeto['projeto']}}</td>
                                        <td>{{$atraso['gatilho']}}</td>
                                        <td>{{date('d/m/Y', strtotime($atraso['data_limite']))}}</td>
                                        <td>{{$atraso['envolvidos']}}</td>
                                        <td><a href="http://intranet.logicadigital.com.br/backend/gatilhos/projeto/{{$projeto['id']}}">🌐</a></td>
                                    </tr>
                                    @endforeach
                                @endif

                        @endif
                    @endforeach
                    </tbody>
                </table>


            </div>
            <p class="desenvolvido">Desenvolvido por <a href="https://logicadigital.com.br"><img src="https://www.logicadigital.com.br/arquivos/2022/02/cropped-fav-32x32.png" width="19" height="19">Lógica Digital</a></p>
        </div>
    </body>
</html>
