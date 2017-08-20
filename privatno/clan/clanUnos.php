<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
$greske = array();

if(isset($_POST["ime"])){
	if(trim($_POST["ime"])===""){
		$greske["ime"]="Obavezan unos imena";
	}else{
		if(strlen(trim($_POST["ime"]))<2){
			$greske["ime"]="Ime mora imati više od dva znaka";
		}
	}
}

if(isset($_POST["prezime"])){
	if(trim($_POST["prezime"])===""){
		$greske["prezime"]="Obavezan unos prezimena";
	}else{
		if(strlen(trim($_POST["prezime"]))<2){
			$greske["prezime"]="Prezime mora imati više od dva znaka";
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
		$izraz = $veza->prepare("insert into clan (ime, prezime, oib, datum_rodenja, ulica, mjesto, telefon, mail, datum_uclanjenja, cin, funkcija) 
		values (:ime, :prezime, :oib, :datumRodenja, :ulica, :mjesto, :telefon, :mail, :datumUclanjenja, :cin, :funkcija)");
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
      						<legend>UNOS NOVOG ČLANA</legend>
							<div class="form-group">
						    	<label id="lime" for="ime">*Ime</label>
  								<input <?php if(isset($greske["ime"])){echo " style=\"background-color: #f7e4e1\" ";}?>
  								name="ime" id="ime" type="text" class="form-control" />
						  	</div>
						  	<div class="form-group">
							  	<label id="lprezime" for="prezime">*Prezime</label>
	  							<input <?php if(isset($greske["prezime"])){echo " style=\"background-color: #f7e4e1\" ";}?>
	  							name="prezime" id="prezime" type="text" class="form-control" />
							</div>
							<div class="form-group">
							  	<label id="loib" for="oib">*OIB</label>
	  							<input <?php if(isset($greske["oib"])){echo " style=\"background-color: #f7e4e1\" ";}?>
	  							name="oib" id="oib" type="number" class="form-control" />
							</div>
						  	<div class="form-group">
						  		<label id="datumRodenja" for="datumRodenja">Datum rođenja</label>
  								<input name="datumRodenja" id="datumRodenja" type="datetime" class="form-control" placeholder="yyyy-mm-dd hh-mm" 
  								class="form-control" />
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
						  		<label id="datumUcljanjenja" for="datumUclanjenja">Datum učlanjenja</label>
  								<input name="datumUclanjenja" id="datumUclanjenja" type="datetime" placeholder="yyyy-mm-dd hh-mm" 
  								class="form-control" />
  							</div>
						 	<div class="form-group">
						 		<label id="cin" for="cin">Čin u vatrogastvu</label>
		  						<select class="form-control" id="cin" name="cin">
		  							<option value="Nema čin"selected="selected">Nema čin</option>
		  							<option value="Vatrogasac">Vatrogasac</option>
		  							<option value="Vatrogasac 1.klase">Vatrogasac 1.klase</option>
		  							<option value="Dočasnik">Dočasnik</option>
		  							<option value="Dočasnik 1. klase">Dočasnik 1. klase</option>
		  							<option value="Časnik">Časnik</option>
		  							<option value="Časnik 1. klase">Časnik 1. klase</option>
		  						</select>
						 	</div>
							<div class="form-group">
								<label id="funkcija" for="funkcija">Funkcija u vatrogastvu</label>
		  						<select class="form-control" id="funkcija" name="funkcija">
		  							<option value="Član društva" selected="selected">Član društva</option>
		  							<option value="Predsjednik društva">Predsjednik društva</option>
		  							<option value="Zamjenik predsjednika društva">Zamjenik predsjednika društva</option>
		  							<option value="Tajnik društva">Tajnik društva</option>
		  							<option value="Blagajnik društva">Blagajnik društva</option>
		  							<option value="Član upravnog odbora">Član upravnog odbora</option>
		  							<option value="Zapovjednik društva">Zapovjednik društva</option>
		  							<option value="Zamjenik zapovjednika društva">Zamjenik zapovjednika društva</option>
		  							<option value="Član zapovjedništva">Član zapovjedništva</option>
		  							<option value="Član nadzornog odbora">Član nadzornog odbora</option>
		  						</select>
							</div>
							<h6>*Obavezan unos</h6>
						 	<button type="submit" class="btn btn-primary">Dodaj</button>
						  	<a href="clan.php" class="btn btn-danger">Odustani</a>
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
