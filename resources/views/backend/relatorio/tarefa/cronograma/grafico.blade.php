@extends('layouts.app-backend')

@section('style')
	<link href="{{ asset('css/tarefa.css') }}" rel="stylesheet">
	<link href="{{ asset('chart/Chart.css') }}" rel="stylesheet">
	<script src="{{ asset('chart/Chart.min.js') }}"></script>
    <script src="{{ asset('chart/utils.js') }}"></script>
	<style>
		canvas{
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
		.exibicao h3{
			text-align: center;
    		font-weight: 400;
    		color: #5f5f5f;
		}
		.grafico-semanal{
			margin-top:20px;
		}
		.exibicao form{
			width: 60%;
		}
		.exibicao form .input-group{
			float: left;
			width: 40%;
			margin-bottom: 0px !important;
			margin-right: 1%;
		}
		.exibicao select{

		}
		.exibicao h3 span{
			font-size: 10px;
			font-weight: bold;
			color: #5d6ee7;
		}
		.h2-grafico{
			color: #3e3e3e;
			font-weight: 500;
			line-height: 25px;
			text-align: center;
			font-size: 20px;
			padding: 0px 35%;
			padding-top: 50px;
			min-height: 220px;
		}
    </style>
@endsection

@section('name-page')
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('backend.principal') }}" style="font-size: 11px;margin-bottom: -5px !important;">
        Dashboard
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="" style="font-size: 11px;margin-bottom: -5px !important;">
        Relat&oacute;rio
    </a>
    <span style="color: #FFF;margin: 10px;"> / </span>
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">
        Cronograma
    </a>
@endsection

@section('content')

	<!-- Gráfico do Mês Completo -->
    <div class="col col-xl-12">
        <div class="card shadow">

				<!-- Exibição do Nome -->
				<div class="exibicao">
					@if( $users->image == NULL )
						<img src="{{ asset('img/user.png') }}">
					@else
						<img src="{{ $users->image ? config('app.url').'/'.ltrim($users->image, '/') : asset('img/user.svg') }}">
					@endif
					<h3 style="text-align: left;width: 30%;">{{ $users->name }} {{ $users->sobrenome }}</h3>

					<form action="{{ route('backend.relatorio.tarefa.cronogramagraficoBuscar',$users->id) }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}

						<div class="input-group input-group-alternative mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
							</div>
							<select class="form-control" name="mes">
								<option value="01" @if( date("m") == "01" ) selected="selected" @endif>Janeiro</option>
								<option value="02" @if( date("m") == "02" ) selected="selected" @endif>Fevereiro</option>
								<option value="03" @if( date("m") == "03" ) selected="selected" @endif>Março</option>
								<option value="04" @if( date("m") == "04" ) selected="selected" @endif>Abril</option>
								<option value="05" @if( date("m") == "05" ) selected="selected" @endif>Maio</option>
								<option value="06" @if( date("m") == "06" ) selected="selected" @endif>Junho</option>
								<option value="07" @if( date("m") == "07" ) selected="selected" @endif>Julho</option>
								<option value="08" @if( date("m") == "08" ) selected="selected" @endif>Agosto</option>
								<option value="09" @if( date("m") == "09" ) selected="selected" @endif>Setembro</option>
								<option value="10" @if( date("m") == "10" ) selected="selected" @endif>Outubro</option>
								<option value="11" @if( date("m") == "11" ) selected="selected" @endif>Novembro</option>
								<option value="12" @if( date("m") == "12" ) selected="selected" @endif>Dezembro</option>
							</select>
						</div>

						<div class="input-group input-group-alternative mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
							</div>
							<select class="form-control" name="ano">
								@for($i=date('Y')-1;$i<=date('Y')+2;$i++)
                                    <option value="{{$i}}" @if($i==date('Y'))selected="selected"@endif>{{$i}}</option>
                                @endfor

							</select>
						</div>

						<button class="btn btn-info">Buscar</button>

					</form>
				</div>

				<h3 class="titulo-formulario">Mês: <strong>{{ $nome_mes }}</strong></h3>

				<!-- Gráfico -->
				<div style="width:100%;">
					<canvas id="canvas-{{ $users->id }}" style="height:350px"></canvas>
				</div>

				<!-- Script -->
				<script>
					var config = {
						type: 'line',
						data: {
							labels: [@foreach($relatorio_cronograma as $registro) '{{ date( "d/m/Y" , strtotime($registro->dtSemana)) }}' , @endforeach],
							datasets: [{
								label: 'Tarefas Associadas',
								backgroundColor: window.chartColors.red,
								borderColor: window.chartColors.red,
								data: [ @foreach($relatorio_cronograma as $registro){{ $registro->qtdeAssociada }},@endforeach],
								fill: false,
							}, {
								label: 'Tarefas Finalizadas',
								backgroundColor: window.chartColors.blue,
								borderColor: window.chartColors.blue,
								data: [@foreach($relatorio_cronograma as $registro){{ $registro->qtdeFinalizada }},@endforeach],
								fill: false,
							}]
						},
							options: {
								responsive: true,
								showLines: true,
								title: {
									display: true,
									text: 'Gráfico Semanal de Tarefas'
								},
								scales: {
									xAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: 'Dias da Semana'
										},
										gridLines: {
											drawOnChartArea: true,
											lineWidth: 1
										}
									}],
									yAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: 'Tarefas'
										},
										ticks: {
											min: 0,
											max: 40,
											beginAtZero: true
										},
										gridLines: {
											drawOnChartArea: true,
											lineWidth: 1
										}
									}]
								},
								hover: {
									mode: 'nearest',
									intersect: true
								},
								tooltips: {
									mode: 'index',
									intersect: false,
								},
								legend:	{
									display: true,
									labels:	{
										fontColor: 'black',
									}
								},
								layout: {
									padding: {
										left: 20,
										right: 20,
										top: 0,
										bottom: 20
									}
								}
							}
						};

						window.onload = function() {
							var ctx = document.getElementById('canvas-{{ $users->id }}').getContext('2d');
							window.myLine = new Chart(ctx, config);
						};
				</script>

		</div>
	</div>

	<!-- Primeira Semana -->
	<div class="col col-xl-6 grafico-semanal">
        <div class="card shadow">

			<div class="exibicao">
				<h3>Primeira Semana <span>{{ date( 'd/m/Y' , strtotime($Dt_primeira)) }} - {{ date( 'd/m/Y' , strtotime($Dt_1_comparacao)) }}</span></h3>
			</div>
			@if($cronograma_primeira_semana == null)
				<h2 class="h2-grafico">Sem Registro essa Semana</h2>
			@else
				<canvas id="chartjs-1"></canvas>
				<script>
					new Chart(document.getElementById("chartjs-1"),{
						type:"doughnut",
						data:{
							labels:["Associadas","Entregues","Tarefas"],
							datasets:[{
								data:[{{ $cronograma_primeira_semana->qtdeAssociada }},{{ $cronograma_primeira_semana->qtdeFinalizada }},{{ $tarefas_primeira_abertas }}],
								backgroundColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
								label: 'Tarefas Associadas',
								borderColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
								fill: true,
							}],
						},
						options: {
							layout: {
								padding: {
									left: 0,
									right: 0,
									top: 0,
									bottom: 20
								}
							}
						}
					});
				</script>
			@endif

		</div>
	</div>

	<!-- Segunda Semana -->
	<div class="col col-xl-6 grafico-semanal">
        <div class="card shadow">

			<div class="exibicao">
				<h3>Segunda Semana <span>{{ date( 'd/m/Y' , strtotime($Dt_segunda)) }} - {{ date( 'd/m/Y' , strtotime($Dt_2_comparacao)) }}</span></h3>
			</div>
			@if($cronograma_segunda_semana == null)
				<h2 class="h2-grafico">Sem Registro essa Semana</h2>
			@else
				<canvas id="chartjs-2"></canvas>
				<script>
					new Chart(document.getElementById("chartjs-2"),{
						type:"doughnut",
						data:{
							labels:["Associadas","Entregues","Tarefas"],
							datasets:[{
								data:[{{ $cronograma_segunda_semana->qtdeAssociada }},{{ $cronograma_segunda_semana->qtdeFinalizada }},{{ $tarefas_segunda_abertas }}],
								backgroundColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
								label: 'Tarefas Associadas',
								borderColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
								fill: true,
							}],
						},
						options: {
							layout: {
								padding: {
									left: 0,
									right: 0,
									top: 0,
									bottom: 20
								}
							}
						}
					});
				</script>
			@endif
		</div>
	</div>

	<!-- Terceira Semana -->
	<div class="col col-xl-6 grafico-semanal">
        <div class="card shadow">

			<div class="exibicao">
				<h3>Terceira Semana <span>{{ date( 'd/m/Y' , strtotime($Dt_terceira)) }} - {{ date( 'd/m/Y' , strtotime($Dt_3_comparacao)) }}</span></h3>
			</div>
			@if($cronograma_terceira_semana == null)
				<h2 class="h2-grafico">Sem Registro essa Semana</h2>
			@else
				<canvas id="chartjs-3"></canvas>
				<script>
					new Chart(document.getElementById("chartjs-3"),{
						type:"doughnut",
						data:{
							labels:["Associadas","Entregues","Tarefas"],
							datasets:[{
								data:[{{ $cronograma_terceira_semana->qtdeAssociada }},{{ $cronograma_terceira_semana->qtdeFinalizada }},{{ $tarefas_terceira_abertas }}],
								backgroundColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
								label: 'Tarefas Associadas',
								borderColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
								fill: true,
							}],
						},
						options: {
							layout: {
								padding: {
									left: 0,
									right: 0,
									top: 0,
									bottom: 20
								}
							}
						}
					});
				</script>
			@endif
		</div>
	</div>

	<!-- Quarta Semana -->
	<div class="col col-xl-6 grafico-semanal">
        <div class="card shadow">

			<div class="exibicao">
				<h3>Quarta Semana <span>{{ date( 'd/m/Y' , strtotime($Dt_quarta)) }} - {{ date( 'd/m/Y' , strtotime($Dt_4_comparacao)) }}</span></h3>
			</div>
			@if($cronograma_quarta_semana == null)
				<h2 class="h2-grafico">Sem Registro essa Semana</h2>
			@else

				<canvas id="chartjs-4"></canvas>
				<script>
					new Chart(document.getElementById("chartjs-4"),{
						type:"doughnut",
						data:{
							labels:["Associadas","Entregues","Tarefas"],
							datasets:[{
								data:[{{ $cronograma_quarta_semana->qtdeAssociada }},{{ $cronograma_quarta_semana->qtdeFinalizada }},{{ $tarefas_quarta_abertas }}],
								backgroundColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
								label: 'Tarefas Associadas',
								borderColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
								fill: true,
							}],
						},
						options: {
							layout: {
								padding: {
									left: 0,
									right: 0,
									top: 0,
									bottom: 20
								}
							}
						}
					});
				</script>
			@endif

		</div>
	</div>

@endsection
