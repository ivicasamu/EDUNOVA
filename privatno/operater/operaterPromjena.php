<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

if(isset($_GET["sifra"])){
	$izraz=$veza->prepare("select * from operater where sifra=:sifra");
	$izraz->execute(array("sifra"=>$_GET["sifra"]));
	$entitet = $izraz->fetch(PDO::FETCH_OBJ);
}

if(isset($_POST["sifra"])){
	$izraz=$veza->prepare("update operater set ime=:ime, 
							prezime=:prezime, email=:email, uloga=:uloga where sifra=:sifra");
	$izraz->execute($_POST);
	header("location: operater.php");
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
  						<input name="ime" id="ime" type="text"  value="<?php echo $entitet->ime; ?>" />
  						
  						<label id="prezime" for="prezime">Prezime</label>
  						<input name="prezime" id="prezime" type="text" value="<?php echo $entitet->prezime; ?>" />
  						
  						<label id="email" for="email">Email</label>
  						<input name="email" id="email" type="email" value="<?php echo $entitet->email; ?>"/>
  						
						<label for="uloga">Uloga</label>
						<select id="uloga" name="uloga">
							<option value="Korisnik" <?php echo ($entitet->uloga=="Korisnik") ? " selected=\"selected\" " : "";	?>>
								Korisnik</option>
							<option value="Administrator" <?php echo ($entitet->uloga=="Administrator") ? " selected=\"selected\" " : "";	?>>
								Administrator</option>
						</select>
  						
  						
  						<input type="submit" class="button" value="Promjeni" />
  						<input type="hidden" name="sifra" value="<?php echo $entitet->sifra; ?>" />
  						<a href="operater.php" class="alert button">Odustani</a>
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
