<?php 
	include_once '../../konfiguracija.php'; 
	provjeraLogin();
	provjeraUloga("Administrator");

	if(isset($_GET["sifra"])){
		$izraz = $veza->prepare("select a.sifra as sifraKategorija, b.vrsta, b.dvd, b.reg_oznaka, c.sifra as sifraDVD, c.naziv 
								from kategorizacija_vozila a 
								inner join vozilo b on a.sifra=b.vrsta
								inner join dvd c on c.sifra=b.dvd 
								where a.sifra=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$entiteti = $izraz -> fetchAll(PDO::FETCH_OBJ);
	}else{
		header("location: index.php");
	}
	
	if(count($entiteti)==0){
		$izraz = $veza -> prepare("delete from kategorizacija_vozila where sifra=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		header("location: index.php");
	}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/zaglavlje.php' ?>
	</head>
  	<body>
  		<?php include_once '../../predlosci/izbornik.php' ?>
  		<div class="row">
  			<div class="large-6 medium-12 small-12 columns large-centered">
  				Kategorija vozila se ne može obristi jer je korištena kod:
  				<ul>
  					<?php foreach ($entiteti as $vozilo) {
						  echo "<li>Vozilo reg. oznake: " . $vozilo->reg_oznaka.  "</li>"; 
					  } ?>
  				</ul>
  				<a href="index.php" class="alert button expanded">Odustani</a>
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
  	</body>
</html>
