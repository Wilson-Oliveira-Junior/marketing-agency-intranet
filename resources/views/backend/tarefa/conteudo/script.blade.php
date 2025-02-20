    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.22.2/sweetalert2.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{ asset('js/json_nova_tarefa.js') }}"></script>

    <script type="text/javascript">
        $(function(){
            $("#txtBusca").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-tipo .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaTarefaEvento").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-tarefa_evento .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaUsuarioEvento").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-usuario_evento .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaSegmentos").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-segmentos .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaAbertaProjeto").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-aberta-projeto .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaCronograma").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-cronograma .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaCronogramaTerca").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-cronograma-terca .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaCronogramaQuarta").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-cronograma-quarta .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaCronogramaQuinta").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-cronograma-quinta .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaCronogramaSexta").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-cronograma-sexta .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });


            $("#txtBuscaStatus").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-status .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });


            $("#txtBuscatarefa_tipos").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-tarefa_tipos .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscatarefa_usuario").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-tarefa_usuario .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaUsuario").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-usuarios .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaSeguidores").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-seguidores .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaSetores").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-setores .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaSetorBacklog").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-setores-backlog .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaProjetos").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-projetos .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaTipoProjeto").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-tipo-projeto .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaProjetosPauta").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-projetos-pauta .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaUsuarioPauta").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-usuarios-pauta .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

            $("#txtBuscaUsuarioCompartilhado").keyup(function(){
                var texto = $(this).val();

                $(".conteudo-compartilhar-pauta .bloco").each(function(){
                    if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0) {
                        $(this).fadeOut();
                    }else {
                        $(this).fadeIn();
                    }
                });
            });

        });
    </script>

    @include('backend.tarefa.conteudo.validando_campos_formulario')
