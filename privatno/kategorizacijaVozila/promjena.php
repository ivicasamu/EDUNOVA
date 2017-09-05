<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from kategorizacija_vozila where sifra=:sifra");
	$izraz -> execute(array("sifra"=>$_GET["sifra"]));
	$entitet = $izraz -> fetch(PDO::FETCH_OBJ);
}

if(isset($_POST["promjena"])){
	$izraz = $veza -> prepare("update kategorizacija_vozila set vrsta_vozila=:vrsta_vozila, podvrsta_vozila=:podvrsta_vozila, 
								podpodvrsta_vozila=:podpodvrsta_vozila where sifra=:sifra");
	$izraz -> execute(array(
	"vrsta_vozila"=>$_POST["vrsta_vozila"],
	"podvrsta_vozila"=>$_POST["podvrsta_vozila"],
	"podpodvrsta_vozila"=>$_POST["podpodvrsta_vozila"],
	"sifra"=>$_POST["sifra"]
	));	
	
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["vrsta_vozila"]==""){
		$izraz = $veza -> prepare("delete from kategorizacija_vozila where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
	}
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
  				<form method="POST">
  					<fieldset class="fieldset">
  						<legend>UNOSNI PODACI</legend>
  						
  						<label id="vrsta_vozila" for="vrsta_vozila">Vrsta vozila</label>
  						<input name="vrsta_vozila" id="vrsta_vozila" type="text" value="<?php echo $entitet->vrsta_vozila; ?>" />
  						
  						<label id="podvrsta_vozila" for="podvrsta_vozila">PodVrsta vozila</label>
  						<input name="podvrsta_vozila" id="podvrsta_vozila" type="text" value="<?php echo $entitet->podvrsta_vozila; ?>" />
  						
  						<label id="podpodvrsta_vozila" for="podpodvrsta_vozila">PodPodVrsta vozila</label>
  						<input name="podpodvrsta_vozila" id="podpodvrsta_vozila" type="text" value="<?php echo $entitet->podpodvrsta_vozila; ?>" />
  						
  						<input name="promjena" type="submit" class="button expanded" value="<?php 
							if($entitet->vrsta_vozila==""){
								echo "Dodaj novi";
							}else{
								echo "Promjeni";
							}
							
							?>"/>
						<input type="hidden" name="sifra" value="<?php echo $entitet->sifra; ?>" />
						<input name="odustani" type="submit" class="alert button expanded" value="Odustani" />
  					</fieldset>
  				</form>	
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
  	</body>
</html>
