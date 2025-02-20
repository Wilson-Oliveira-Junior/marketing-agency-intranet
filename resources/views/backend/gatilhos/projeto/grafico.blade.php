	<div class="card">
		
		<div class="card-header">
          	<h6 class="surtitle">Gráfico </h6>
          	<h5 class="h3 mb-0">Processo dos Gatilhos</h5>
        </div>

		<div class="card-body" style="padding: 0px;">
			<div class="chart">
				<canvas id="chart" style="display: block; height: 30px; width: 100%;" width="100%" height="30" class="chartjs-render-monitor"></canvas>
			</div>
		</div>

	</div>

    <script>
		Chart.defaults.global.pointHitDetectionRadius = 1;

		var customTooltips = function(tooltip) {

			var tooltipEl = document.getElementById('chartjs-tooltip');
			
			if (!tooltipEl) {
				tooltipEl = document.createElement('div');
				tooltipEl.id = 'chartjs-tooltip';
				tooltipEl.innerHTML = '<table></table>';
				this._chart.canvas.parentNode.appendChild(tooltipEl);
			}

			if (tooltip.opacity === 0) {
				tooltipEl.style.opacity = 0;
				return;
			}

			tooltipEl.classList.remove('above', 'below', 'no-transform');
			if (tooltip.yAlign) {
				tooltipEl.classList.add(tooltip.yAlign);
			} else {
				tooltipEl.classList.add('no-transform');
			}

			function getBody(bodyItem) {
				return bodyItem.lines;
			}

			if (tooltip.body) {
				var titleLines = tooltip.title || [];
				var bodyLines = tooltip.body.map(getBody);

				var innerHtml = '<thead>';

				titleLines.forEach(function(title) {
					innerHtml += '<tr><th>' + title + '</th></tr>';
				});
				innerHtml += '</thead><tbody>';

				bodyLines.forEach(function(body, i) {
					var colors = tooltip.labelColors[i];
					var style = 'background:' + colors.backgroundColor;
					style += '; border-color:' + colors.borderColor;
					style += '; border-width: 2px';
					var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
					innerHtml += '<tr><td>' + span + body + '</td></tr>';
				});
				innerHtml += '</tbody>';

				var tableRoot = tooltipEl.querySelector('table');
				tableRoot.innerHTML = innerHtml;
			}

			var positionY = this._chart.canvas.offsetTop;
			var positionX = this._chart.canvas.offsetLeft;

			tooltipEl.style.opacity = 1;
			tooltipEl.style.left = positionX + tooltip.caretX + 'px';
			tooltipEl.style.top = positionY + tooltip.caretY + 'px';
			tooltipEl.style.fontFamily = tooltip._bodyFontFamily;
			tooltipEl.style.fontSize = tooltip.bodyFontSize + 'px';
			tooltipEl.style.fontStyle = tooltip._bodyFontStyle;
			tooltipEl.style.padding = tooltip.yPadding + 'px ' + tooltip.xPadding + 'px';
		};

		var lineChartData = {
			labels: [ @foreach($gatilhos as $registro) '{{ $registro->gatilho }}' , @endforeach ],
			datasets: [{
				label: 'Datas Limites',
				borderColor: "#EE6868",
				backgroundColor: "#EE6868",
				pointBackgroundColor: "#EE6868",
				fill: false,
				data: [ 
					@foreach($gatilhos as $registro) 
						<?php $data1 = new DateTime( $registro->data_limite ); ?>
						<?php $data2 = new DateTime( $registro->created_at ); ?>
						<?php $intervalo = $data1->diff( $data2 ); ?>
						<?php echo "$intervalo->days," ?>
					@endforeach
				]
			}, {
				label: 'Datas de Conclusão',
				backgroundColor: "#5e72e4",
				borderColor: "#5e72e4",
				pointBackgroundColor: "#5e72e4",
				fill: false,
				data: [ 
					@foreach($gatilhos as $registro)
						@if($registro->data_conclusao == NULL)
							<?php echo "," ?>
						@else
							<?php $data4 		= new DateTime( $registro->data_limite ); ?>
							<?php $data3 		= new DateTime( $registro->data_conclusao ); ?>
							<?php $intervalo2 	= $data4->diff( $data3 ); ?>
							<?php echo "$intervalo2->days," ?>
						@endif
					@endforeach ]
			}]
		};

		window.onload = function() {
			var chartEl = document.getElementById('chart');
			window.myLine = new Chart(chartEl, {
				type: 'line',
				data: lineChartData,
				options: {
					tooltips: {
						enabled: false,
						mode: 'index',
						position: 'nearest',
						custom: customTooltips
					}
				}
			});
		};
	</script>