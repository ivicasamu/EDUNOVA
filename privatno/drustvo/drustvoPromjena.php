<?php include_once '../../konfiguracija.php'; 
provjeraLogin();

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from dvd where sifra=:sifra");
	$izraz -> execute(array("sifra"=>$_GET["sifra"]));
	$entitet = $izraz->fetch(PDO::FETCH_OBJ);
	if(isset($_GET["uvjet"])){
		$entitet->uvjet =$_GET["uvjet"];
	}
}

if(isset($_POST["sifra"])){
	$uvjet = "";
	if(isset($_POST["uvjet"])){
		$uvjet=$_POST["uvjet"];
			unset($_POST["uvjet"]);
	}
	$izraz=$veza->prepare("update dvd set vzo=:vzo, naziv=:naziv, oib=:oib, mb=:mb, ulica=:ulica, mjesto=:mjesto, telefon=:telefon, 
	mail=:mail, web=:web, godina_osnivanja=:godinaOsnivanja where sifra=:sifra");
	$izraz->execute($_POST);
	header("location: drustvo.php?uvjet=" . $uvjet);
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
							<div class="form-group">
								<legend>IZMJENA PODATAKA O DRUŠTVU</legend>
						    	<label id="lnaziv" for="naziv">*Naziv</label>
  								<input <?php if(isset($greske["naziv"])){echo " style=\"background-color: #f7e4e1\" ";}?>
  								name="naziv" id="naziv" type="text" class="form-control" value="<?php echo $entitet->naziv; ?>" />
						  	</div>
						  	<div class="form-group">
						  		<label id="vzo" for="vzo">Vatrogasna zajednica</label>
  								<input name="vzo" id="vzo" type="text" class="form-control" value="<?php echo $entitet->vzo; ?>" />
						  	</div>
						  	<div class="form-group">
						  		<label id="loib" for="oib">*OIB društva</label>
  								<input <?php if(isset($greske["oib"])){echo " style=\"background-color: #f7e4e1\" ";}?>
  								name="oib" id="oib" type="number" class="form-control" value="<?php echo $entitet->oib; ?>" />
						  	</div>
						  	<div class="form-group">
						  		<label id="mb" for="mb">Matični broj društva</label>
  								<input name="mb" id="mb" type="number" class="form-control"value="<?php echo $entitet->mb; ?>" />
						  	</div>
						  	<div class="form-group">
						  		<label id="ulica" for="ulica">Ulica i broj</label>
  								<input name="ulica" id="ulica" type="text" class="form-control" value="<?php echo $entitet->ulica; ?>" />
						  	</div>
						  	<div class="form-group">
						  		<label id="mjesto" for="mjesto">Mjesto</label>
  								<input name="mjesto" id="mjesto" type="text" class="form-control" value="<?php echo $entitet->mjesto; ?>" />
						  	</div>
						  	<div class="form-group">
						  		<label id="telefon" for="telefon">Telefon</label>
  								<input name="telefon" id="telefon" type="text" class="form-control" value="<?php echo $entitet->telefon; ?>" />
						  	</div>
						  	<div class="form-group">
						  		<label id="mail" for="mail">Email</label>
  								<input name="mail" id="mail" type="email" class="form-control" value="<?php echo $entitet->mail; ?>" />
  							</div>
						  	<div class="form-group">
						  		<label id="web" for="web">Web adresa</label>
  								<input name="web" id="web" type="text" class="form-control" value="<?php echo $entitet->web; ?>" />
						  	</div>
						  	<div class="form-group">
						  		<label id="godinaOsnivanja" for="godinaOsnivanja">Datum osnivanja</label>
  								<input name="godinaOsnivanja" id="godinaOsnivanja" type="datetime" placeholder="yyyy-mm-dd hh-mm" class="form-control" 
  								value="<?php echo $entitet->godina_osnivanja; ?>" />
						  	</div>
						  	<h6>*Obavezan unos</h6>
						  	<button type="submit" class="btn btn-primary">Promjeni</button>
						  	<input type="hidden" name="sifra" value="<?php echo $entitet->sifra ?>" />
						  	<?php if(isset($_GET["uvjet"])): ?>
  								<input type="hidden" name="uvjet" value="<?php echo $entitet->uvjet; ?>" />
  							<?php endif; ?>
						  	<a href="drustvo.php" class="btn btn-danger">Odustani</a>
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
