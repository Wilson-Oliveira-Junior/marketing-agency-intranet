    <!-- Projetos -->
    <td>
        <div class="avatar-group">
            @foreach ($cliente->projetos as $projeto)

                <!-- Magento -->
                @if($projeto->id_tipo_projeto == 1)
                <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                    <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-magento.png') }}">
                </a>
                @endif

                <!-- Wordpress -->
                @if($projeto->id_tipo_projeto == 2)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-wordpress.png') }}">
                    </a>
                @endif

                <!-- Woocommerce -->
                @if($projeto->id_tipo_projeto == 3)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-woocommerce.png') }}">
                    </a>
                @endif

                <!-- One Page -->
                @if($projeto->id_tipo_projeto == 4)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-one-page.png') }}">
                    </a>
                @endif

                <!-- Identidade Visual -->
                @if($projeto->id_tipo_projeto == 5)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-identidade-visual.png') }}">
                    </a>
                @endif

                <!-- Oruc -->
                @if($projeto->id_tipo_projeto == 6)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-oruc.png') }}">
                    </a>
                @endif

                <!-- Catalogo -->
                @if($projeto->id_tipo_projeto == 7)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-catalogo.png') }}">
                    </a>
                @endif

                <!-- E-mail Marketing -->
                @if($projeto->id_tipo_projeto == 8)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-email-marketing.png') }}">
                    </a>
                @endif

                <!-- Manutenção Site -->
                @if($projeto->id_tipo_projeto == 9)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-manutencao.png') }}">
                    </a>
                @endif

                <!-- Hora Técnica -->
                @if($projeto->id_tipo_projeto == 10)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-hora-tecnica.png') }}">
                    </a>
                @endif

                <!-- Intranet -->
                @if($projeto->id_tipo_projeto == 11)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-intranet.png') }}">
                    </a>
                @endif

                <!-- SEO -->
                @if($projeto->id_tipo_projeto == 12)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-seo.png') }}">
                    </a>
                @endif

                <!-- Sistema -->
                @if($projeto->id_tipo_projeto == 13)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-sistema.png') }}">
                    </a>
                @endif

                <!-- Teaser -->
                @if($projeto->id_tipo_projeto == 14)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-teaser.png') }}">
                    </a>
                @endif

                <!-- Redes Sociais -->
                @if($projeto->id_tipo_projeto == 15)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-redes-sociais.png') }}">
                    </a>
                @endif

                <!-- Apresentação -->
                @if($projeto->id_tipo_projeto == 16)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-apresentacao.png') }}">
                    </a>
                @endif

                <!-- Google Ads -->
                @if($projeto->id_tipo_projeto == 17)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-google-ads.png') }}">
                    </a>
                @endif

                <!-- Facebook Ads -->
                @if($projeto->id_tipo_projeto == 18)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-facebook.png') }}">
                    </a>
                @endif

                <!-- Instagram Ads -->
                @if($projeto->id_tipo_projeto == 19)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-instagram.png') }}">
                    </a>
                @endif

                <!-- Business Manager -->
                @if($projeto->id_tipo_projeto == 20)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-bussines-maneger.png') }}">
                    </a>
                @endif

                <!-- Geração de Conteúdo -->
                @if($projeto->id_tipo_projeto == 21)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-geracao-de-conteudo.png') }}">
                    </a>
                @endif

                <!-- Hospedagem -->
                @if($projeto->id_tipo_projeto == 22)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-hospedagem.png') }}">
                    </a>
                @endif

                <!-- Blog -->
                @if($projeto->id_tipo_projeto == 23)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-blog.png') }}">
                    </a>
                @endif

                <!-- Material Offline -->
                @if($projeto->id_tipo_projeto == 24)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-material-off.png') }}">
                    </a>
                @endif

                <!-- Projeto Antigo (Sem Imagem) -->
                @if($projeto->id_tipo_projeto == 25)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-projeto-antigo.png') }}">
                    </a>
                @endif

                <!-- Responsabilidade Social (Sem Imagem) -->
                @if($projeto->id_tipo_projeto == 26)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-responsabilidade-social.png') }}">
                    </a>
                @endif

                <!-- Inbound Marketing -->
                @if($projeto->id_tipo_projeto == 27)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-inbound-marketing.png') }}">
                    </a>
                @endif

                <!-- Landbot -->
                @if($projeto->id_tipo_projeto == 28)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-landbot.png') }}">
                    </a>
                @endif

                <!-- Landing Page -->
                @if($projeto->id_tipo_projeto == 29)
                    <a href="{{route('backend.gatilhos.projeto', $projeto->id)}}" class="avatar avatar-xl rounded-circle" data-toggle="tooltip" data-original-title="{{ $projeto->projeto }}" style="background-color: #FFF !important;border-radius: 50% !important;">
                        <img alt="{{ $projeto->projeto }}" src="{{ asset('img/icones-clientes/icone-landing-page.png') }}">
                    </a>
                @endif
            @endforeach


        </div>
    </td>
