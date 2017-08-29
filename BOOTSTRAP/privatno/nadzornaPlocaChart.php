<script>
	Highcharts.chart('pieChart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Statistika intervencija u 2017. godini'
        },
        
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Vrsta intervencije',
            colorByPoint: true,
            data: [{
                name: 'Požarne intervencije', 
                <?php 
                	$izraz = $veza->prepare("select count(vrsta_intervencije) as vrsta from intervencija where vrsta_intervencije='Požarna intervencija'");
					$izraz -> execute();
					$rezultat = $izraz->fetchAll(PDO::FETCH_OBJ);
					foreach ($rezultat as $red): 
				?>
                y: <?php echo $red->vrsta; ?>
                <?php endforeach;?>
            }, {
                name: 'Tehničke intervencije',
                <?php 
                	$izraz = $veza->prepare("select count(vrsta_intervencije) as vrsta from intervencija where vrsta_intervencije='Tehnička intervencija'");
					$izraz -> execute();
					$rezultat = $izraz->fetchAll(PDO::FETCH_OBJ);
					foreach ($rezultat as $red): 
				?>
                y: <?php echo $red->vrsta; ?>
                <?php endforeach;?>
            }, {
                name: 'Ostale intervencije',
                <?php 
                	$izraz = $veza->prepare("select count(vrsta_intervencije) as vrsta from intervencija where vrsta_intervencije='Ostale intervencije'");
					$izraz -> execute();
					$rezultat = $izraz->fetchAll(PDO::FETCH_OBJ);
					foreach ($rezultat as $red): 
				?>
                y: <?php echo $red->vrsta; ?>
                <?php endforeach;?>            
            }, {
                name: 'Druge aktivnosti',
                <?php 
                	$izraz = $veza->prepare("select count(vrsta_intervencije) as vrsta from intervencija where vrsta_intervencije='Druge aktivnosti'");
					$izraz -> execute();
					$rezultat = $izraz->fetchAll(PDO::FETCH_OBJ);
					foreach ($rezultat as $red): 
				?>
                y: <?php echo $red->vrsta; ?>
                <?php endforeach;?>
            }, ]
        }]
    });
</script>
