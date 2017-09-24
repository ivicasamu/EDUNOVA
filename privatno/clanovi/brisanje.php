<?php 
	include_once '../../konfiguracija.php'; 
	provjeraLogin();
	provjeraUloga("Administrator");

	if(isset($_GET["sifra"])){
		$izraz = $veza->prepare("select a.sifra from clan a 
									inner join clan_cin b on a.sifra=b.clan
									inner join cin c on b.cin=c.sifra
									where a.sifra=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$cin = $izraz -> fetchAll(PDO::FETCH_OBJ);
		
		$izraz = $veza->prepare("select a.sifra from clan a 
									inner join clan_funkcija b on a.sifra=b.funkcija
									inner join funkcija c on b.funkcija=c.sifra
									where a.sifra=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$funkcija = $izraz -> fetchAll(PDO::FETCH_OBJ);
		
		$izraz = $veza->prepare("select a.sifra from clan a 
									inner join dvd_clan b on a.sifra=b.clan
									inner join dvd c on b.dvd=c.sifra
									where a.sifra=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$dvd = $izraz -> fetchAll(PDO::FETCH_OBJ);
	}else{
		header("location: index.php?stranica=".$_GET["stranica"]."&uvjet=".$_GET["uvjet"]);
	}
	
	if(count($cin)==0 && count($funkcija)==0 && count($dvd)==0){
		$izraz = $veza -> prepare("delete from clan where sifra=:sifra");
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
  				Član se ne može obristi.
  				<a href="index.php" class="alert button expanded">Odustani</a>
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
  	</body>
</html>
