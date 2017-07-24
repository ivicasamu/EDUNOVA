<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("korisnik");

$izraz=$veza->prepare("select * from operater where sifra=:sifra");
$izraz->execute(array("sifra"=>$_SESSION["logiran"]->sifra));
$entitet = $izraz->fetch(PDO::FETCH_OBJ);

if(isset($_POST["sifra"])){
	
if(strlen(trim($_POST["lozinka"]))>0){
	$izraz=$veza->prepare("update operater set ime=:ime, lozinka=md5(:lozinka),  
						prezime=:prezime where sifra=:sifra");
	}else{
		unset($_POST["lozinka"]);
		$izraz=$veza->prepare("update operater set ime=:ime, 
							prezime=:prezime where sifra=:sifra");
	}
$izraz->execute($_POST);
if(isset($_POST["lozinka"])){
		header("location: " . $putanjaAPP . "javno/logout.php");
	}else{
		header("location: " . $putanjaAPP . "privatno/nadzornaPloca.php");
	}
	
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
  						<legend>PODACI OPERATERA</legend>
  						
  						<label id="ime" for="ime">Ime</label>
  						<input name="ime" id="ime" type="text"  value="<?php echo $entitet->ime; ?>" />
  						
  						<label id="prezime" for="prezime">Prezime</label>
  						<input name="prezime" id="prezime" type="text" value="<?php echo $entitet->prezime; ?>" />
  						
  						<label for="lozinka">Lozinka</label>
						<input name="lozinka" id="lozinka" type="password"/>
  						
  						<input type="submit" class="button" value="Promjeni" />
  						<input type="hidden" name="sifra" value="<?php echo $entitet->sifra; ?>" />
  						<a href="operater.php" class="alert button">Odustani</a>
  					</fieldset>
  				</form>	
  			</div>
  		</div>
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
  	</body>
</html>