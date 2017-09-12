<?php 
	include_once '../../konfiguracija.php'; 
	provjeraLogin();
	
	if(isset($_GET["sifra"])){
		$izraz = $veza->prepare("select a.sifra, concat(c.ime, ' ',c.prezime) as imePrezime
								from dvd a 
								inner join dvd_clan b on a.sifra=b.dvd
								inner join clan c on b.clan=c.sifra
								where a.sifra=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		$entiteti = $izraz -> fetchAll(PDO::FETCH_OBJ);
	}else{
		header("location: index.php");
	}
	
	if(count($entiteti)==0){
		$izraz = $veza -> prepare("delete from dvd where sifra=:sifra");
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
  				Društvo se ne može obristi jer su mu dodani članovi:
  				<ul>
  					<?php foreach ($entiteti as $red) {
						  echo "<li>Ime i prezime: " . $red->imePrezime. "</li>"; 
					  } ?>
  				</ul>
  				<a href="index.php" class="alert button expanded">Odustani</a>
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
  	</body>
</html>
