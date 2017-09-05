<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

if(isset($_POST["sifra"])){
	$izraz=$veza->prepare("update operater set lozinka=md5(:lozinka) where sifra=:sifra");
	$izraz->execute($_POST);
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
  						<legend>UNOSITE NOVU LOZINKU</legend>
  						
  						<label for="lozinka">Lozinka</label>
						<input name="lozinka" id="lozinka" type="password"/>
  				
  						<input type="submit" class="button" value="Promjeni" />
  						<input type="hidden" name="sifra" value="<?php echo $_GET["sifra"]; ?>" />
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
