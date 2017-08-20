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
							prezime=:prezime, email=:email, lozinka=:lozinka, uloga=:uloga where sifra=:sifra");
	$izraz->execute($_POST);
	header("location: operater.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
		<?php include_once '../../predlosci/zaglavlje.php' ?>
  </head>

  <body>
    	<?php include_once '../../predlosci/izbornik.php' ?>
    <div class="container">
      	<div class="starter-template">
      		<div class="container">
      			<div class="row">
      				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
      					<form method="post">
      						<legend>IZMJENA PODATAKA OPERATERA</legend>
							<div class="form-group">
						    	<label id="ime" for="ime">Ime</label>
  								<input name="ime" id="ime" type="text" class="form-control" value="<?php echo $entitet->ime; ?>" />
						  	</div>
						  	<div class="form-group">
							  	<label id="prezime" for="prezime">Prezime</label>
  								<input name="prezime" id="prezime" type="text" class="form-control" value="<?php echo $entitet->prezime; ?>" />
							</div>
							<div class="form-group">
							  	<label id="email" for="email">Email</label>
  								<input name="email" id="email" type="email" class="form-control" value="<?php echo $entitet->email; ?>" />
							</div>
						  	<div class="form-group">
						  		<label for="lozinka">Lozinka</label>
								<input name="lozinka" id="lozinka" type="password" class="form-control"/>
						  	</div>
							<div class="form-group">
									<label for="uloga">Uloga</label>
									<select id="uloga" name="uloga" class="form-control">
										<option value="Korisnik" <?php echo ($entitet->uloga=="Korisnik") ? " selected=\"selected\" " : "";	?>>
											Korisnik</option>
										<option value="Administrator" <?php echo ($entitet->uloga=="Administrator") ? " selected=\"selected\" " : "";	?>>
											Administrator</option>
									</select>
							</div>
							<button type="submit" class="btn btn-primary">Promjeni</button>
							<input type="hidden" name="sifra" value="<?php echo $entitet->sifra; ?>" />
						  	<a href="operater.php" class="btn btn-danger">Odustani</a>
  						</form>
      				</div>
      			</div>
      		</div>
        </div>
    </div>
    <?php include_once '../../predlosci/podnozje.php' ?>
    <?php include_once '../../predlosci/skripte.php'; ?>
  </body>
</html>
