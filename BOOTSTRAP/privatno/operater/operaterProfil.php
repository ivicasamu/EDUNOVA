<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Korisnik");

$izraz=$veza->prepare("select * from operater where sifra=:sifra");
$izraz->execute(array("sifra"=>$_SESSION["logiran"]->sifra));
$entitet = $izraz->fetch(PDO::FETCH_OBJ);

if(isset($_POST["sifra"])){
	
if(strlen(trim($_POST["lozinka"]))>0){
	$izraz=$veza->prepare("update operater set ime=:ime, lozinka=md5(:lozinka),  
						prezime=:prezime, rezultata_po_stranici=:rezultata_po_stranici where sifra=:sifra");
	}else{
		unset($_POST["lozinka"]);
		$izraz=$veza->prepare("update operater set ime=:ime, 
							prezime=:prezime, rezultata_po_stranici=:rezultata_po_stranici where sifra=:sifra");
	}
$izraz->execute($_POST);
if(isset($_POST["lozinka"])){
		header("location: " . $putanjaAPP . "javno/odjava.php");
	}else{
		header("location: " . $putanjaAPP . "privatno/nadzornaPloca.php");
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
								<label for="lozinka">Lozinka</label>
								<input name="lozinka" id="lozinka" type="password" class="form-control"/>
							</div>
							<div class="form-group">
								<label for="rezultata_po_stranici">Rezultata po stranici</label>
								<input name="rezultata_po_stranici" id="rezultata_po_stranici" type="number" class="form-control" 
								value="<?php echo $entitet->rezultata_po_stranici; ?>"/>
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
