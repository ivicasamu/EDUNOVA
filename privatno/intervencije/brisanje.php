<?php 
	include_once '../../konfiguracija.php'; 
	provjeraLogin();
	provjeraUloga("Administrator");

	if(isset($_GET["sifra"])){
		$izraz = $veza->prepare("select intervencija from intervencija_clan where intervencija=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$entitetiClan = $izraz -> fetchAll(PDO::FETCH_OBJ);
	}else{
		header("location: index.php");
	}	
	
	if(isset($_GET["sifra"])){
		$izraz = $veza->prepare("select intervencija from intervencija_dvd where intervencija=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$entitetiDvd = $izraz -> fetchAll(PDO::FETCH_OBJ);
	}else{
		header("location: index.php");
	}
	
	if(isset($_GET["sifra"])){
		$izraz = $veza->prepare("select intervencija from vozilo_intervencija where intervencija=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$entitetiVozilo = $izraz -> fetchAll(PDO::FETCH_OBJ);
	}else{
		header("location: index.php");
	}
	
	if(isset($_GET["sifra"])){
		$izraz = $veza->prepare("select intervencija from sredstvo_intervencija where intervencija=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$entitetiSredstvo = $izraz -> fetchAll(PDO::FETCH_OBJ);
	}else{
		header("location: index.php");
	}
	if(count($entitetiClan)==0 && count($entitetiDvd)==0 && count($entitetiVozilo)==0 && count($entitetiSredstvo)==0){
		$izraz = $veza -> prepare("delete from intervencija where sifra=:sifra");
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
  				Intervencija se ne može obrisati, zato što joj je pridruženo društvo, član, vozilo ili sredstvo...
  				<a href="index.php" class="alert button expanded">Odustani</a>
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
  	</body>
</html>
