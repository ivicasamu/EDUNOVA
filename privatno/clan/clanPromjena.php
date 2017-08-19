<?php include_once '../../konfiguracija.php'; 
provjeraLogin();

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from clan where sifra=:sifra");
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
	$izraz=$veza->prepare("update clan set ime=:ime, prezime=:prezime, oib=:oib, datum_rodenja=:datumRodenja, ulica=:ulica, mjesto=:mjesto, 
	telefon=:telefon, mail=:mail, datum_uclanjenja=:datumUclanjenja, cin=:cin, funkcija=:funkcija where sifra=:sifra");
	$izraz->execute($_POST);
	header("location: clan.php?uvjet=" . $uvjet);
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
						    	<label id="lime" for="ime">Ime</label>
  								<input <?php if(isset($greske["ime"])){echo " style=\"background-color: #f7e4e1\" ";}?>
  								name="ime" id="ime" type="text" class="form-control" value="<?php echo $entitet->ime; ?>" />
						  	</div>
						  	<div class="form-group">
							  	<label id="lprezime" for="prezime">Prezime</label>
	  							<input <?php if(isset($greske["prezime"])){echo " style=\"background-color: #f7e4e1\" ";}?>
	  							name="prezime" id="prezime" type="text" class="form-control" value="<?php echo $entitet->prezime; ?>" />
							</div>
							<div class="form-group">
							  	<label id="loib" for="oib">OIB</label>
	  							<input <?php if(isset($greske["oib"])){echo " style=\"background-color: #f7e4e1\" ";}?>
	  							name="oib" id="oib" type="number" class="form-control"value="<?php echo $entitet->oib; ?>" />
							</div>
						  	<div class="form-group">
						  		<label id="datumRodenja" for="datumRodenja">Datum rođenja</label>
  								<input name="datumRodenja" id="datumRodenja" type="datetime" class="form-control" placeholder="yyyy-mm-dd hh-mm" 
  								class="form-control" type="text" value="<?php echo $entitet->datum_rodenja; ?>" />
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
						  		<label id="datumUcljanjenja" for="datumUclanjenja">Datum učlanjenja</label>
  								<input name="datumUclanjenja" id="datumUclanjenja" type="datetime" placeholder="yyyy-mm-dd hh-mm" 
  								class="form-control" value="<?php echo $entitet->datum_uclanjenja; ?>" />
  							</div>
						 	<div class="form-group">
						 		<label id="cin" for="cin">Čin u vatrogastvu</label>
		  						<select class="form-control" id="cin" name="cin">
		  							<option value="Nema čin" <?php echo ($entitet->cin=="Nema čin") ? " selected=\"selected\" " : "";	?>>
		  								Nema čin</option>
  									<option value="Vatrogasac" <?php echo ($entitet->cin=="Vatrogasac") ? " selected=\"selected\" " : "";	?>>
  										Vatrogasac</option>
  									<option value="Vatrogasac 1.klase"<?php echo ($entitet->cin=="Vatrogasac 1.klase") ? " selected=\"selected\" " : "";?>>
  										Vatrogasac 1.klase</option>
  									<option value="Dočasnik" <?php echo ($entitet->cin=="Dočasnik") ? " selected=\"selected\" " : "";	?>>
  										Dočasnik</option>
  									<option value="Dočasnik 1. klase" <?php echo ($entitet->cin=="Dočasnik 1. klase") ? " selected=\"selected\" " : "";	?>>
  										Dočasnik 1. klase</option>
  									<option value="Časnik" <?php echo ($entitet->cin=="Časnik") ? " selected=\"selected\" " : "";	?>>Časnik</option>
  									<option value="Časnik 1. klase" <?php echo ($entitet->cin=="Časnik 1. klase") ? " selected=\"selected\" " : "";	?>>
  										Časnik 1. klase</option>
		  						</select>
						 	</div>
							<div class="form-group">
								<label id="funkcija" for="funkcija">Funkcija u vatrogastvu</label>
		  						<select class="form-control" id="funkcija" name="funkcija">
		  							<option value="Član društva" <?php echo ($entitet->funkcija=="Član društva") ? " selected=\"selected\" " : "";	?>>
		  								Član društva</option>
  									<option value="predsjednik" <?php echo ($entitet->funkcija=="predsjednik") ? " selected=\"selected\" " : ""; ?>>
  										Predsjednik društva</option>
  									<option value="Zamjenik predsjednika društva" <?php echo ($entitet->funkcija=="Zamjenik predsjednika društva") ? 
  										"selected=\"selected\" " : "";	?>>Zamjenik predsjednika društva</option>
  									<option value="Tajnik društva" <?php echo ($entitet->funkcija=="Tajnik društva") ? " selected=\"selected\" " : "";	?>>
  										Tajnik društva</option>
  									<option value="Blagajnik društva" <?php echo ($entitet->funkcija=="Blagajnik društva") ? " selected=\"selected\" " : ""; ?>>
  										Blagajnik društva</option>
  									<option value="Član upravnog odbora" <?php echo ($entitet->funkcija=="Član upravnog odbora") ? " selected=\"selected\" " : "";	?>>
  										Član upravnog odbora</option>
  									<option value="Zapovjednik društva"<?php echo ($entitet->funkcija=="Zapovjednik društva") ? " selected=\"selected\" " : "";	?>>
  										Zapovjednik društva</option>
  									<option value="Zamjenik zapovjednika društva"<?php echo ($entitet->funkcija=="Zamjenik zapovjednika društva") ? 
  										"selected=\"selected\" " : "";	?>>Zamjenik zapovjednika društva</option>
  									<option value="Član zapovjedništva" <?php echo ($entitet->funkcija=="Član zapovjedništva") ? 
  										"selected=\"selected\" " : ""; ?>>Član zapovjedništva</option>
  									<option value="Član nadzornog odbora" <?php echo ($entitet->funkcija=="Član nadzornog odbora") ? " selected=\"selected\" " : "";	?>>
  										Član nadzornog odbora</option>
		  						</select>
							</div>
						  <button type="submit" class="btn btn-primary">Promjeni</button>
						  <input type="hidden" name="sifra" value="<?php echo $entitet->sifra ?>" />
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
