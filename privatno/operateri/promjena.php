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
							prezime=:prezime, email=:email, uloga=:uloga, rezultata_po_stranici=:rezultata_po_stranici where sifra=:sifra");
	$izraz->execute($_POST);
	$_SESSION["logiran"]->rezultata_po_stranici = $_POST["rezultata_po_stranici"];
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
  						<legend>UNOS NOVOG OPERATERA</legend>
  						
  						<label id="ime" for="ime">Ime</label>
  						<input name="ime" id="ime" type="text"  value="<?php echo $entitet->ime; ?>" />
  						
  						<label id="prezime" for="prezime">Prezime</label>
  						<input name="prezime" id="prezime" type="text" value="<?php echo $entitet->prezime; ?>" />
  						
  						<label id="email" for="email">Email</label>
  						<input name="email" id="email" type="email" value="<?php echo $entitet->email; ?>"/>
  						
  						<label for="rezultata_po_stranici">Rezultata po stranici</label>
						<input name="rezultata_po_stranici" id="rezultata_po_stranici" type="number" value="<?php echo$entitet->rezultata_po_stranici; ?>"/>
  						
						<label for="uloga">Uloga</label>
						<select id="uloga" name="uloga">
							<option value="Korisnik" <?php echo ($entitet->uloga=="Korisnik") ? " selected=\"selected\" " : "";	?>>
								Korisnik</option>
							<option value="Administrator" <?php echo ($entitet->uloga=="Administrator") ? " selected=\"selected\" " : "";	?>>
								Administrator</option>
						</select>
  						
  						
  						<input type="submit" class="button" value="Promjeni" />
  						<input type="hidden" name="sifra" value="<?php echo $entitet->sifra; ?>" />
  						<a href="index.php" class="alert button">Odustani</a>
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
