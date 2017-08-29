<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
$greske = array();

if(isset($_POST["naziv"])){
	if(trim($_POST["naziv"])===""){
		$greske["naziv"]="Obavezan unos naziva";
	}else{
		if(strlen(trim($_POST["naziv"]))<2){
			$greske["naziv"]="Naziv mora imati više od dva znaka";
		}
	}
}

if(isset($_POST["oib"])){
	if(trim($_POST["oib"])===""){
		$greske["oib"]="Obavezan unos OIB-a";
	}else{
		if(strlen(trim($_POST["oib"]))!=11){
			$greske["oib"]="OIB mora imati 11 znamenki";
		}
	}
	if(count($greske)===0){
		$izraz = $veza->prepare("insert into dvd (naziv, vzo, oib, mb, ulica, mjesto, telefon, mail, web, godina_osnivanja) 
		values (:naziv, :vzo, :oib, :mb, :ulica, :mjesto, :telefon, :mail, :web, :godinaOsnivanja)");
		$unioRedova = $izraz->execute($_POST);
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
      						<legend>UNOS NOVOG DRUŠTVA</legend>
							<div class="form-group">
						    	<label id="lnaziv" for="naziv">*Naziv</label>
  								<input <?php if(isset($greske["naziv"])){echo " style=\"background-color: #f7e4e1\" ";}?>
  								name="naziv" id="naziv" type="text" class="form-control" />
						  	</div>
						  	<div class="form-group">
						  		<label id="vzo" for="vzo">Vatrogasna zajednica</label>
  								<input name="vzo" id="vzo" type="text" class="form-control" />
						  	</div>
						  	<div class="form-group">
						  		<label id="loib" for="oib">*OIB društva</label>
  								<input <?php if(isset($greske["oib"])){echo " style=\"background-color: #f7e4e1\" ";}?>
  								name="oib" id="oib" type="number" class="form-control" />
						  	</div>
						  	<div class="form-group">
						  		<label id="mb" for="mb">Matični broj društva</label>
  								<input name="mb" id="mb" type="number" class="form-control" />
						  	</div>
						  	<div class="form-group">
						  		<label id="ulica" for="ulica">Ulica i broj</label>
  								<input name="ulica" id="ulica" type="text" class="form-control" />
						  	</div>
						  	<div class="form-group">
						  		<label id="mjesto" for="mjesto">Mjesto</label>
  								<input name="mjesto" id="mjesto" type="text" class="form-control" />
						  	</div>
						  	<div class="form-group">
						  		<label id="telefon" for="telefon">Telefon</label>
  								<input name="telefon" id="telefon" type="text" class="form-control" />
						  	</div>
						  	<div class="form-group">
						  		<label id="mail" for="mail">Email</label>
  								<input name="mail" id="mail" type="email" class="form-control" />
  							</div>
						  	<div class="form-group">
						  		<label id="web" for="web">Web adresa</label>
  								<input name="web" id="web" type="text" class="form-control" />
						  	</div>
						  	<div class="form-group">
						  		<label id="godinaOsnivanja" for="godinaOsnivanja">Datum osnivanja</label>
  								<input name="godinaOsnivanja" id="godinaOsnivanja" type="datetime" placeholder="yyyy-mm-dd hh-mm" class="form-control" />
						  	</div>
						  	<h6>*Obavezan unos</h6>
						  	<button type="submit" class="btn btn-primary">Dodaj</button>
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
