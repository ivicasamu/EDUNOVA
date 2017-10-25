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
            data: [
                <?php 
                	$izraz = $veza->prepare("select b.vrsta_intervencije as intervencija, count(a.vrsta_intervencije) as ukupno
											from intervencija a inner join vrsta_intervencije b on b.sifra=a.vrsta_intervencije
											group by b.vrsta_intervencije;");
					$izraz -> execute();
					$rezultat = $izraz->fetchAll(PDO::FETCH_OBJ);
					foreach ($rezultat as $red): 
				?>
                {name : '<?php echo $red->intervencija; ?>',y : <?php echo $red->ukupno; ?>},
                <?php endforeach;?>
            ]
        }]
    });
</script>
