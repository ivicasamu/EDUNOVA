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
  						<legend>IZMJENA PODATAKA O ČLANU</legend>
  						
  						<label id="lime" for="ime">Ime</label>
  						<input 
  						<?php if(isset($greske["ime"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="ime" id="ime" type="text" value="<?php echo $entitet->ime; ?>"/>
  						
  						<label id="lprezime" for="prezime">Prezime</label>
  						<input 
  						<?php if(isset($greske["prezime"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="prezime" id="prezime" type="text" value="<?php echo $entitet->prezime; ?>" />
  						
  						<label id="loib" for="oib">OIB</label>
  						<input 
  						<?php if(isset($greske["oib"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="oib" id="oib" type="number" value="<?php echo $entitet->oib; ?>" />
  						
  						<label id="datumRodenja" for="datumRodenja">Datum rođenja</label>
  						<input name="datumRodenja" id="datumRodenja" type="datetime" placeholder="yyyy/mm/dd hh-mm"
  						value="<?php echo $entitet->datum_rodenja; ?>"/>
  						
  						<label id="ulica" for="ulica">Ulica i broj</label>
  						<input name="ulica" id="ulica" type="text" value="<?php echo $entitet->ulica; ?>" />
  						
  						<label id="mjesto" for="mjesto">Mjesto</label>
  						<input name="mjesto" id="mjesto" type="text" value="<?php echo $entitet->mjesto; ?>" />
  						
  						<label id="telefon" for="telefon">Telefon</label>
  						<input name="telefon" id="telefon" type="text" value="<?php echo $entitet->telefon; ?>" />
  						
  						<label id="mail" for="mail">Email</label>
  						<input name="mail" id="mail" type="email" value="<?php echo $entitet->mail; ?>" />
  						
  						<label id="datumUcljanjenja" for="datumUclanjenja">Datum učlanjenja</label>
  						<input name="datumUclanjenja" id="datumUclanjenja" type="datetime" placeholder="yyyy/mm/dd hh-mm"
  						value="<?php echo $entitet->datum_uclanjenja; ?>"/>
  						
  						<label id="cin" for="cin">Čin u vatrogastvu</label>
  						<select id="cin" name="cin">
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
  						
  						<label id="funkcija" for="funkcija">Funkcija u vatrogastvu</label>
  						<select id="funkcija" name="funkcija">
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
  						
  						<input type="submit" class="button" value="Promjeni" />
  						<input type="hidden" name="sifra" value="<?php echo $entitet->sifra ?>" />
  						<a href="clan.php" class="alert button">Odustani</a>
  						</fieldset>
  				</form>	
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
    	
  	</body>
</html>
