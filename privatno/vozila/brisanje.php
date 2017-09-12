<?php 
	include_once '../../konfiguracija.php'; 
	provjeraLogin();

	if(isset($_GET["sifra"])){
		$izraz = $veza->prepare("select a.sifra, c.datum_dojave 
								from vozilo a 
								inner join vozilo_intervencija b on a.sifra=b.vozilo
								inner join intervencija c on b.intervencija=c.sifra 
								where a.sifra=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$entiteti = $izraz -> fetchAll(PDO::FETCH_OBJ);
	}else{
		header("location: index.php");
	}
	
	if(count($entiteti)==0){
		$izraz = $veza -> prepare("delete from vozilo where sifra=:sifra");
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
  				Vozilo se ne može obristi jer je korišteno u:
  				<ul>
  					<?php foreach ($entiteti as $red) {
						  echo "<li>Intervenciji broj: " . $red->sifra. ", od datuma: " . date("Y-m-d",strtotime($red->datum_dojave)) . "</li>"; 
					  } ?>
  				</ul>
  				<a href="index.php" class="alert button expanded">Odustani</a>
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
  	</body>
</html>
