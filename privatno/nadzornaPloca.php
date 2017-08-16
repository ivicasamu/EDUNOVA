<?php include_once '../konfiguracija.php' ?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<?php include_once '../predlosci/zaglavlje.php' ?>
  </head>

  <body>
    	<?php include_once '../predlosci/izbornik.php' ?>
    <div class="container">
      	<div class="starter-template">
      		<div id="pieChart" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        </div>
    </div>
    <?php include_once '../predlosci/podnozje.php' ?>
    <?php include_once '../predlosci/skripte.php'; ?>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>		
	<?php include_once 'nadzornaPlocaChart.php'; ?>
  </body>
</html>
