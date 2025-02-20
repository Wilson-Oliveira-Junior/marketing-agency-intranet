<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            font-family: 'Montserrat', sans-serif;
            padding: 0;
            color: #434343;
            box-sizing: border-box;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url('{{asset("fonts/Montserrat-Regular.eot")}}');
            src: url('{{asset("fonts/Montserrat-Regular.eot?#iefix")}}') format('embedded-opentype'),
                url('{{asset("fonts/Montserrat-Regular.woff2")}}') format('woff2'),
                url('{{asset("fonts/Montserrat-Regular.woff")}}') format('woff'),
                url('{{asset("fonts/Montserrat-Regular.ttf")}}') format('truetype'),
                url('{{asset("fonts/Montserrat-Regular.svg#Montserrat-Regular")}}') format('svg');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url('{{asset("fonts/Montserrat-Medium.eot")}}');
            src: url('{{asset("fonts/Montserrat-Medium.eot?#iefix")}}') format('embedded-opentype'),
                url('{{asset("fonts/Montserrat-Medium.woff2")}}') format('woff2'),
                url('{{asset("fonts/Montserrat-Medium.woff")}}') format('woff'),
                url('{{asset("fonts/Montserrat-Medium.ttf")}}') format('truetype'),
                url('{{asset("fonts/Montserrat-Medium.svg#Montserrat-Medium")}}') format('svg');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url('{{asset("fonts/Montserrat-Bold.eot")}}');
            src: url('{{asset("fonts/Montserrat-Bold.eot?#iefix")}}') format('embedded-opentype'),
                url('{{asset("fonts/Montserrat-Bold.woff2")}}') format('woff2'),
                url('{{asset("fonts/Montserrat-Bold.woff")}}') format('woff'),
                url('{{asset("fonts/Montserrat-Bold.ttf")}}') format('truetype'),
                url('{{asset("fonts/Montserrat-Bold.svg#Montserrat-Bold")}}') format('svg');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Neometric';
            src: url('{{asset("fonts/Neometric-Regular.eot")}}');
            src: url('{{asset("fonts/Neometric-Regular.eot?#iefix")}}') format('embedded-opentype'),
                url('{{asset("fonts/Neometric-Regular.woff2")}}') format('woff2'),
                url('{{asset("fonts/Neometric-Regular.woff")}}') format('woff'),
                url('{{asset("fonts/Neometric-Regular.ttf")}}') format('truetype'),
                url('{{asset("fonts/Neometric-Regular.svg#Neometric-Regular")}}') format('svg');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
		/* CONTEUDO */
		body{
			margin: 0;
		}
		p{
			font-size: 19px;
			line-height: 1.2em;
			display: block;
			clear: both;
		}
		.content{
			width: 600px;
			background-color: #fff2de;
			display: block;
			padding: 50px 60px;
			position: relative;
			background-image: url('{{ asset("img/fundo_onboarding.png")}}');
			background-repeat: no-repeat;
			background-size: cover;
		}
		.forma-azul-1,.forma-azul-2,
		.forma-rosa-1, .forma-rosa-2{
			position:absolute;
			pointer-events: none;
		}
		.forma-azul-1{
			top:0px;
			left: 0px;
		}
		.forma-azul-2{
			top: 0px;
			right: 0px;
		}
		.forma-rosa-1{
			left:0;
			bottom: 0;
		}
		.forma-rosa-2{
			right:0px;
			bottom:0px;
		}
		.content img{
			max-width:100%;
		}
		.balao{
			display: block;
			width: 480px;
			height: 306px;
			background-image: url('{{ asset("img/balao.png")}}');
			padding-top: 76px;
		}
		.balao p span{
			color: #fff;
			text-transform:
			uppercase;
		}
		.balao p{
			text-align: center;
			font-weight: 700;
			font-size: 42px;
			line-height: 42px;
			color: #fff;
			width: 390px;
			margin-left: 70px;
		}
		.detailed-desc{
			margin-top:45px;
			padding: 0px 30px;
		}
		.columns{display: block;}
		.columns .block-info:first-child{
			margin-right: 25px;
		}
		.block-info{
			border-radius: 15px;
			width: 187px;
			height: 154px;
			color: #fff;
			position: relative;
			display: inline-block;
			padding: 20px;
			background-repeat: no-repeat;
			font-size: 17px;
			float: left;
			margin-bottom: 25px;
            margin-right:15px;
		}
		.block-info.rosa{
			background-image: url('{{ asset("img/box-rosa.jpg")}}');
		}
		.block-info.azul{
			background-image: url('{{ asset("img/box-azul.jpg")}}');
		}
		.block-info.azul.largo{
			background-image: url('{{ asset("img/box-azul-full.jpg")}}');
			height:162px;
			margin-top: 25px;
			padding: 35px;
		}
		.block-info.lilas{
			background-image: url('{{ asset("img/box-lilas-full.jpg")}}');
		}
		.block-info.largo{
			width:407px;
			height:174px;
		}
		.block-info a{
			color: #fff;
			text-decoration:none;
			transition: all .3s;
		}
		.block-info a:hover{
			color:gold;
		}
		.block-info ul{
			list-style: none;
			margin: 0;
			margin-top:10px
		}
		.block-info ul li{
			color:#fff;
			font-size: 14.3px;
		}
		.block-info ul li .circle{
			content: "";
			display: block;
			width:12px;
			height:12px;
			border-radius:6px;
			background: #fff;
			margin-right: 7px;
			float: left;
			margin-top: 3px;
		}
		.lista-plataformas{
			list-style:none;
			display:flex;
			flex-wrap:wrap;
			justify-content:space-between;
			margin: 35px 0px
		}
		.lista-plataformas li a{
			transition: all .3s;
			display:block;
		}
		.lista-plataformas li a:hover{
			transform: scale(1.1);
		}
		.logo{
			width:180px;
			display: block;
			margin-bottom:-30px;
			margin-top:50px;
			margin-left: 100px;
		}
    </style>
    <title>E-mail - Boas Vindas</title>
</head>
<body>
    <div class="content">
        <div class="balao">
            <p>
                {{ $bemvindo }}<br>
                <span>{{$apelido}}</span>
            </p>
        </div>

        <div class="detailed-desc">
            <p>
                Seja {{ strtolower($bemvindo) }} a Lógica Digital!<br>Sabemos que o primeiro dia é tenso, então vamos te ajudar.
            </p>
            <div class="columns">
                <div class="block-info azul">
                    Para o seu dia a dia:
                    <ul>
                        <li>
                            <div class="circle"></div> <a href="http://wiki.logicadigital.com.br/" target="_blank">WIKI</a>
                        </li>
                        <li>
                            <div class="circle"></div> <a href="http://intranet.logicadigital.com.br/" target="_blank">INTRANET</a>
                        </li>
                    </ul>
                </div>

                <div class="block-info rosa">
                    Sua Equipe:<br>
                    @foreach ($equipe as $key => $colaborador)
                        {{$colaborador}}@if ($key != count($equipe)-1),@endif
                        @if($key % 2 == 1 && $key > 0)
                            <br>
                        @endif

                    @endforeach
                </div>
            </div>

            <p>
                Toda a equipe estará disponível para te auxiliar nessa sua caminhada e  buscar a melhor performance dentro da empresa.
            </p>
            <p>
                Possuímos também algumas plataformas de cursos, pois queremos te ver sempre evoluindo com a gente!
            </p>

            <ul class="lista-plataformas">
                <li>
                    <a href="https://www.alura.com.br" target="_blank">
                        <img src="{{ asset('img/email-boas-vindas/alura-logo.png')}}" alt="Alura">
                    </a>
                </li>
                <li>
                    <a href="https://www.cursomarketingdeconteudo.com.br/login/" target="_blank">
                        <img src="{{ asset('img/email-boas-vindas/logo-acervo.png')}}" alt="Marketing">
                    </a>
                </li>
                <li>
                    <a href="https://www.devmedia.com.br" target="_blank">
                        <img src="{{ asset('img/email-boas-vindas/logo-devmedia.png')}}" alt="Devmedia">
                    </a>
                </li>
                <li>
                    <a href="https://app.puflix.com/" target="_blank">
                        <img src="{{ asset('img/email-boas-vindas/logo-pufflix.png')}}" alt="Pufflix">
                    </a>
                </li>
            </ul>

            <div class="columns">
                    <div class="block-info rosa" style="text-align:center">
                            Ficou com alguma dúvida? Não hesite em perguntar
                    </div>
                    <div class="block-info azul" style="text-align:center">
                            Lembrando que o cafézinho é OPEN!
                    </div>
            </div>

            <h2 style="text-align:center;margin-top:25px">Seus acessos:</h2>
            <div class="block-info lilas largo" style="text-align:center">
                <ul class="lista-acessos">
                    <li>Computador - Usuário: {{$usuario_rede}}</li>
                    <li>E-mail: {{$email}}</li>
                    <li>Intranet: {{$email}}</li>
                    <li>Senha para todos: 123mudar@LD</li>
                </ul>
            </div>
            <div class="block-info azul largo" style="text-align:center;">
                Estamos muito felizes em ter você aqui conosco, e esperamos unir forças para crescer juntos.
            </div>

            <img class="logo" src="{{ asset('img/email-boas-vindas/logo_logica.png')}}" alt="Lógica Digital">
        </div>
    </div>
</body>
</html>
