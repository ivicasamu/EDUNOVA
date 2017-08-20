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
      						<legend>UNOS NOVOG OPERATERA</legend>
							<div class="form-group">
						    	<label id="ime" for="ime">Ime</label>
  								<input name="ime" id="ime" type="text" class="form-control" />
						  	</div>
						  	<div class="form-group">
							  	<label id="prezime" for="prezime">Prezime</label>
  								<input name="prezime" id="prezime" type="text" class="form-control" />
							</div>
							<div class="form-group">
							  	<label id="email" for="email">Email</label>
  								<input name="email" id="email" type="email" class="form-control" />
							</div>
							<div class="form-group">
								<label for="lozinka">Lozinka</label>
								<input name="lozinka" id="lozinka" type="password" class="form-control"/>
							</div>
							<div class="form-group">
						  		<?php if(isset($_SESSION["logiran"])): ?>
									<label for="uloga">Uloga</label>
									<select id="uloga" name="uloga" class="form-control">
										<option value="Korisnik" selected="selected">Korisnik</option>
										<option value="Administrator">Administrator</option>
									</select>
		  						<?php endif; ?>
							</div>
							<button type="submit" class="btn btn-primary">Dodaj</button>
						  	<a href="<?php if(isset($_SESSION["logiran"])):?>
										operater.php
									<?php else: ?>
									<?php echo $putanjaAPP; ?>javno/prijava.php;
									<?php endif; ?>" class="btn btn-danger">Odustani</a>
  							<?php if(isset($unioRedova) && $unioRedova>0): ?>
  							<h1 id="unio" class="btn btn-success">Zapis uspješno pohranjen</h1>
  						<?php endif; ?>
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
