<?php include_once '../konfiguracija.php' ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../predlosci/zaglavlje.php' ?>
	</head>
  
  	<body>
  		<?php include_once '../predlosci/izbornik.php' ?>
  		<div class="row">
  			<div class="large-12 columns">
  				<div class="callout">
  					<div class="row">
  						<h1 style="width:100%; text-align: center">Prijava u aplikaciju</h1>
  						<div class="large-4 columns large-centered">
  							<?php 
  							if(isset($_GET["neuspio"])){
  								echo "Nepostojeći korisnik ili neispravna kombinacija korisnika i lozinke";
  							}
							
							if(isset($_GET["nemateOvlasti"])){
								echo "Morate se prvo prijaviti u aplikaciju!";
							}
							
							if(isset($_GET["odlogiranSi"])){
								echo "Uspiješno ste se odjavili iz aplikacije!";
							}
  							?>
  							<form method="post" action="<?php echo $putanjaAPP; ?>autorizacija.php">
  								<label for="korisnik">E-mail</label>
  								<input type="text" name="korisnik" id="korisnik" 
  								value="<?php echo isset($_GET["korisnik"]) ? $_GET["korisnik"] : ""; ?>" />
  								<label for="lozinka">Lozinka</label>
  								<input type="password" id="lozinka" name="lozinka" />
  								<input type="submit" class="button expanded" value="Autoriziraj" />
  							</form>
  						</div>	
  					</div>
  				</div>
  			</div>
  		</div>
    
		<?php include_once '../predlosci/podnozje.php'; ?>
    	<?php include_once '../predlosci/skripte.php' ?>
  	</body>
</html>
