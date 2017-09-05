<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from sredstvo where sifra=:sifra");
	$izraz -> execute(array("sifra"=>$_GET["sifra"]));
	$entitet = $izraz -> fetch(PDO::FETCH_OBJ);
}

if(isset($_POST["promjena"])){
	$izraz = $veza -> prepare("update sredstvo set naziv_sredstva=:naziv_sredstva, jedinicna_mjera=:jedinicna_mjera where sifra=:sifra");
	$izraz -> execute(array(
	"naziv_sredstva"=>$_POST["naziv_sredstva"],
	"jedinicna_mjera"=>$_POST["jedinicna_mjera"],
	"sifra"=>$_POST["sifra"]
	));	
	
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["naziv"]==""){
		$izraz = $veza -> prepare("delete from sredstvo where sifra=:sifra");
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
  						
  						<label id="naziv_sredstva" for="naziv_sredstva">Naziv sredstva</label>
  						<input name="naziv_sredstva" id="naziv_sredstva" type="text" value="<?php echo $entitet->naziv_sredstva; ?>" />
  						
  						<label id="jedinicna_mjera" for="jedinicna_mjera">Jedinična mjera</label>
  						<input name="jedinicna_mjera" id="jedinicna_mjera" type="text" value="<?php echo $entitet->jedinicna_mjera; ?>" />
  						
  						<input name="promjena" type="submit" class="button expanded" value="<?php 
							if($entitet->naziv_sredstva==""){
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
