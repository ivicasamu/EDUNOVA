<?php
include_once 'konfiguracija.php';
 ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once 'predlosci/head.php';
		?>
	</head>
	<body>
		<?php
		include_once 'predlosci/izbornik.php';
		?>
		<div class="row">
			<div class="large-12 columns">
				<div class="callout">
					<div class"large-12 columns">
						<div id="container"></div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once 'predlosci/podnozje.php'
		?>
		<?php
			include_once 'predlosci/skripte.php';
		?>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script>
			Highcharts.chart('container', {

			title: {
			text: 'Statistika intervencija 2010-2017'
			},

			yAxis: {
			title: {
			text: 'Broj intervencija'
			}
			},
			legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
			},

			plotOptions: {
			series: {
			pointStart: 2010
			}
			},

			series: [{
			name: 'Požarne intervencije',
			data: [306, 520, 490, 709, 444, 305, 690]
			}, {
			name: 'Tehničke intervencije',
			data: [580, 709, 888, 390, 555, 409, 503]
			}, {
			name: 'Ostale intervencije',
			data: [109, 88, 49, 58, 89, 99, 70]
			},]

			});
		</script>
	</body>
</html>
