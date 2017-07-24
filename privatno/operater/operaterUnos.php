<?php include_once '../../konfiguracija.php'; 

$greske=array();

if(isset($_POST["email"])){
	if(isset($_SESSION["logiran"])){
		$izraz=$veza->prepare("insert into operater(ime, prezime, email, lozinka,uloga) 
		values (:ime,:prezime,:email,md5(:lozinka),:uloga)");
		$unioRedova = $izraz->execute($_POST);
		header("location: operater.php");
	}else{
		$izraz=$veza->prepare("insert into operater(ime, prezime, email, lozinka,uloga) 
		values (:ime,:prezime,:email,md5(:lozinka),'korisnik')");
		$unioRedova = $izraz->execute($_POST);
		header("location: " . $GLOBALS["putanjaAPP"] ."javno/prijava.php?registracijaUspjesna");
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
  						<legend>UNOS NOVOG OPERATERA</legend>
  						
  						<label id="ime" for="ime">Ime</label>
  						<input name="ime" id="ime" type="text" />
  						
  						<label id="prezime" for="prezime">Prezime</label>
  						<input name="prezime" id="prezime" type="text" />
  						
  						<label id="email" for="email">Email</label>
  						<input name="email" id="email" type="email" />
  						
  						<label for="lozinka">Lozinka</label>
						<input name="lozinka" id="lozinka" type="password"/>
						<?php if(isset($_SESSION["logiran"])): ?>
						<label for="uloga">Uloga</label>
						<select id="uloga" name="uloga">
							<option value="korisnik" selected="selected">Korisnik</option>
							<option value="admin">Administrator</option>
						</select>
  						<?php endif; ?>
  						
  						<input type="submit" class="button" value="Dodaj operatera" />
  						<a href="
							<?php if(isset($_SESSION["logiran"])):?>
								operater.php
							<?php else: ?>
								<?php echo $putanjaAPP; ?>javno/prijava.php;
							<?php endif; ?>
						 "class="alert button">Odustani</a>
  						<?php if(isset($unioRedova) && $unioRedova>0): ?>
  						<h1 id="unio" class="success button">Zapis uspješno pohranjen</h1>
  						<?php endif; ?>
  					</fieldset>
  				</form>	
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
    	
    	<script>
    		<?php if(isset($unioRedova) && $unioRedova>0): ?>
    			setTimeout(function(){$("#unio").fadeOut(); },3000);
    		<?php endif;?>
    	</script>
  	</body>
</html>
