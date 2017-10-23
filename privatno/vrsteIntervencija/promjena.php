<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from vrsta_intervencije where sifra=:sifra");
	$izraz -> execute(array("sifra"=>$_GET["sifra"]));
	$entitet = $izraz -> fetch(PDO::FETCH_OBJ);
}

if(isset($_POST["promjena"])){
	$izraz = $veza -> prepare("update vrsta_intervencije set vrsta_intervencije=:vrsta_intervencije, podvrsta_intervencije=:podvrsta_intervencije, 
							podpodvrsta_intervencije=:podpodvrsta_intervencije where sifra=:sifra");
	$izraz -> execute(array(
	"vrsta_intervencije"=>$_POST["vrsta_intervencije"],
	"podvrsta_intervencije"=>$_POST["podvrsta_intervencije"],
	"podpodvrsta_intervencije"=>$_POST["podpodvrsta_intervencije"],
	"sifra"=>$_POST["sifra"]
	));	
	
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["vrsta_intervencije"]==""){
		$izraz = $veza -> prepare("delete from vrsta_intervencije where sifra=:sifra");
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
  						
  						<label id="vrsta_intervencije" for="vrsta_intervencije">Vrsta intervencije</label>
  						<input name="vrsta_intervencije" id="vrsta_intervencije" type="text" value="<?php echo $entitet->vrsta_intervencije; ?>" />
  						
  						<label id="podvrsta_intervencije" for="podvrsta_intervencije">PodVrsta intervencije</label>
  						<input name="podvrsta_intervencije" id="podvrsta_intervencije" type="text" value="<?php echo $entitet->podvrsta_intervencije; ?>" />
  						
  						<label id="podpodvrsta_intervencije" for="podpodvrsta_intervencije">PodPodVrsta intervencije</label>
  						<input name="podpodvrsta_intervencije" id="podpodvrsta_intervencije" type="text" value="<?php echo $entitet->podpodvrsta_intervencije; ?>" />
  						
  						<input name="promjena" type="submit" class="button expanded" value="<?php 
							if($entitet->vrsta_intervencije==""){
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
