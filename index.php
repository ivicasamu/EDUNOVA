<?php include_once 'konfiguracija.php'; 
if(isset($_SESSION["logiran"])){
	header("location: " . $GLOBALS["putanjaAPP"] ."privatno/nadzornaPloca.php");
}

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once 'predlosci/zaglavlje.php' ?>
	</head>
  
  	<body>
  		<?php include_once 'predlosci/izbornik.php' ?>
  		<div class="row">
  			<div class="large-12 medium-12 small-12 centered columns">
  				<div class="callout">
  					<div class="row">
  						<div class="large-6 medium-12 small-12 columns">
  							<table class="hover unstriped">
  								<thead>
  									<tr>
  										<th>Broj društava u sustavu</th>
  										<th>Broj članova u sustavu</th>
  										<th>Broj operatera sustava</th>
  										<th>Broj vozila u sustavu</th>
  									</tr>
  								</thead>
  								<tbody>
  									<?php  
  										$izraz = $veza->prepare("select count(sifra) from dvd");					
										$izraz -> execute();
										$countDvd = $izraz->fetchColumn();
										
										$izraz = $veza->prepare("select count(sifra) from clan");					
										$izraz -> execute();
										$countClan = $izraz->fetchColumn();
										
										$izraz = $veza->prepare("select count(sifra) from operater");					
										$izraz -> execute();
										$countOperater = $izraz->fetchColumn();
										
										$izraz = $veza->prepare("select count(sifra) from vozilo");					
										$izraz -> execute();
										$countVozilo = $izraz->fetchColumn();
  									?>
  									<tr>
  										<td data-label="Broj društava u sustavu"><?php echo $countDvd ?></td>
  										<td data-label="Broj članova u sustavu"><?php echo $countClan ?></td>
  										<td data-label="Broj operatera sustava"><?php echo $countOperater ?></td>
  										<td data-label="Broj vozila u sustavu"><?php echo $countVozilo ?></td>
  									</tr>
  								</tbody>
  							</table>
  						</div>
  						
  						<div class="large-6 medium-12 small-12 columns">
  							
  							<table class="hover unstriped">
  								<?php 
				                	$izraz = $veza->prepare("select b.vrsta_intervencije as intervencija, count(a.vrsta_intervencije) as ukupno
															from intervencija a inner join vrsta_intervencije b on b.sifra=a.vrsta_intervencije
															group by a.vrsta_intervencije;");
									$izraz -> execute();
									$rezultat = $izraz->fetchAll(PDO::FETCH_OBJ);
								?>
								<thead>
  									<tr>
  										<th>Broj požarnih intervencija</th>
  										<th>Broj tehničkih intervencija</th>
  										<th>Broj ostalih intervencija</th>
  										<th>Broj drugih aktivnosti</th>
  									</tr>
  								<tbody>
  									<tr>
  										<?php foreach ($rezultat as $red): ?>
  											<td data-label="<?php echo $red->intervencija; ?>"><?php echo $red->ukupno; ?></td>
  										<?php endforeach; ?>
  									</tr>
  								</tbody>
  							</table>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
    
		<?php include_once 'predlosci/podnozje.php'; ?>
    	<?php include_once 'predlosci/skripte.php' ?>
  	</body>
</html>
