@extends('layouts.app-backend')

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a> 
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.gatilhos.geral') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Listagem de Gatilhos
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Listagem de Gatilhos em Processo
    </a>
@endsection

@section('content')
    <div class="col">

        <div class="card shadow">
            
            <div class="card-header border-0" style="display: flex;position: relative;">
                
                <!-- Título -->
                <h3 class="mb-0">Listagem de Gatilhos em Processo " - {{ $projeto->nome }} - "</h3> 

                <!-- Botao Voltar -->
                <a href="{{ route('backend.gatilhos.geral') }}" class="btn btn-outline-primary" style="position: absolute;right: 330px;top: 10px;">VOLTAR</a>

                <!-- Busca -->
                <div class="form-group mb-0" style="position: absolute;right: 30px;margin-right: 0px !important;top: 10px;width: 25%;">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: #a2a2a2;"><i class="fas fa-search"></i></span>
                        </div>
                        <input id="txtBusca" class="form-control" placeholder="Buscar Projeto..." type="text" style="color: #a2a2a2;">
                    </div>
                </div>

            </div>

            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Status</th>
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Abertos</th>
                            <th scope="col">Total</th>
                            <th scope="col">Processo</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gatilhos as $registro)	
                           @if($registro->status_gatilho == 0) 		
                            <tr class="bloco">
                                <td><i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i></td>
                                <td>{{ $registro->id_projetos_gatilhos }}</td>
                                <td>{{ $registro->nome_fantasia }}</td>
                                <td>{{ $registro->status_gatilho }}</td>
                                <td>{{ $registro->qtd_total_status }}</td>
                                <!-- Formula para descobrir a porcentagem do processo -->
                                @php
                                   $variavel = ($registro->qtd_total_status - $registro->status_gatilho) / $registro->qtd_total_status * 100;
                                @endphp 
                                <td>
                                    <small>Processo está em: @php echo number_format($variavel, 2) @endphp%</small>
                                    <div class="progress progress-xs my-2">
                                        <div class="progress-bar bg-success" style="width: @php echo number_format($variavel, 2) @endphp%;"></div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('backend.gatilhos.projeto', $registro->id_projetos_gatilhos) }}" class="btn" style="background-color:#00cdf1;color:#FFF;">Acompanhe o Processo</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        
    </div>   
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){ 
            $("#txtBusca").keyup(function(){
                var texto = $(this).val();
                $(".bloco").each(function(){
                var resultado = $(this).text().toUpperCase().indexOf(' '+texto.toUpperCase());
                if(resultado < 0) {
                    $(this).fadeOut();
                }else {
                    $(this).fadeIn();
                }
                }); 
            });
        });
    </script>

@endsection

    
