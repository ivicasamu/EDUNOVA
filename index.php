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
  						<div class="large-12 medium-12 small-12 columns">
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
  								<ul class="stats-list">
								  <li>
								    <?php echo $countDvd ?> <span class="stats-list-label">Broj društava</span>
								  </li>
								  <li class="stats-list-positive">
								    <?php echo $countClan ?> <span class="stats-list-label">Broj članova</span>
								  </li>
								  <li>
								    <?php echo $countOperater ?> <span class="stats-list-label">Broj operatera</span>
								  </li>
								  <li class="stats-list-positive">
								    <?php echo $countVozilo ?> <span class="stats-list-label">Broj vozila</span>
								  </li>
								</ul>
						</div>
						
						<hr />
						
  						<div class="large-12 medium-12 small-12 columns">
							<?php 
			                	$izraz = $veza->prepare("select b.vrsta_intervencije as intervencija, count(a.vrsta_intervencije) as ukupno
														from intervencija a inner join vrsta_intervencije b on b.sifra=a.vrsta_intervencije
														group by b.vrsta_intervencije;");
								$izraz -> execute();
								$rezultat = $izraz->fetchAll(PDO::FETCH_OBJ);
							?>
							<ul class="stats-list">
								<?php foreach ($rezultat as $red): ?>
									<li class="stats-list-negative">
							    		<?php echo $red->ukupno; ?> <span class="stats-list-label"><?php echo $red->intervencija; ?></span>
							  		</li>
								<?php endforeach; ?>
							</ul>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  		<?php phpinfo(); ?>
    
		<?php include_once 'predlosci/podnozje.php'; ?>
    	<?php include_once 'predlosci/skripte.php' ?>
  	</body>
</html>
