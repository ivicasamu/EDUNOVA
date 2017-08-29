<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

if(isset($_POST["sifra"])){
	$izraz=$veza->prepare("update operater set lozinka=md5(:lozinka) where sifra=:sifra");
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
      						<legend>UNOS NOVE LOZINKE</legend>
							<div class="form-group">
						    	<label for="lozinka">Lozinka</label>
								<input name="lozinka" id="lozinka" type="password" class="form-control" />
						  	</div>
						  	
							<button type="submit" class="btn btn-primary">Promjeni</button>
							<input type="hidden" name="sifra" value="<?php echo $_GET["sifra"]; ?>" />
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
