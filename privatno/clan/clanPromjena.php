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
  							<option value="nemaCin" <?php echo ($entitet->cin=="nemaCin") ? " selected=\"selected\" " : "";	?>>Nema čin</option>
  							<option value="vatrogasac" <?php echo ($entitet->cin=="vatrogasac") ? " selected=\"selected\" " : "";	?>>Vatrogasac</option>
  							<option value="vatrogasacKlase"<?php echo ($entitet->cin=="vatrogasacKlase") ? " selected=\"selected\" " : "";	?>>
  								Vatrogasac 1.klase</option>
  							<option value="docasnik" <?php echo ($entitet->cin=="docasnik") ? " selected=\"selected\" " : "";	?>>Dočasnik</option>
  							<option value="docasnikKlase" <?php echo ($entitet->cin=="docasnikKlase") ? " selected=\"selected\" " : "";	?>>
  								Dočasnik 1. klase</option>
  							<option value="casnik" <?php echo ($entitet->cin=="casnik") ? " selected=\"selected\" " : "";	?>>Časnik</option>
  							<option value="casnikKlase" <?php echo ($entitet->cin=="casnikKlase") ? " selected=\"selected\" " : "";	?>>
  								Časnik 1. klase</option>
  						</select>
  						
  						<label id="funkcija" for="funkcija">Funkcija u vatrogastvu</label>
  						<select id="funkcija" name="funkcija">
  							<option value="clan" <?php echo ($entitet->funkcija=="clan") ? " selected=\"selected\" " : "";	?>>Član društva</option>
  							<option value="predsjednik" <?php echo ($entitet->funkcija=="predsjednik") ? " selected=\"selected\" " : ""; ?>>
  								Predsjednik društva</option>
  							<option value="zamjenikPredsjednika" <?php echo ($entitet->funkcija=="zamjenikPredsjednika") ? " 
  							selected=\"selected\" " : "";	?>>Zamjenik predsjednika društva</option>
  							<option value="tajnik" <?php echo ($entitet->funkcija=="tajnik") ? " selected=\"selected\" " : "";	?>>
  								Tajnik društva</option>
  							<option value="blagajnik" <?php echo ($entitet->funkcija=="blagajnik") ? " selected=\"selected\" " : ""; ?>>
  								Blagajnik društva</option>
  							<option value="clanUO" <?php echo ($entitet->funkcija=="clanUO") ? " selected=\"selected\" " : "";	?>>
  								Član upravnog odbora</option>
  							<option value="zapovjednik"<?php echo ($entitet->funkcija=="zapovjednik") ? " selected=\"selected\" " : "";	?>>
  								Zapovjednik društva</option>
  							<option value="zamjenikZapovjednika"<?php echo ($entitet->funkcija=="zamjenikZapovjednika") ? " 
  							selected=\"selected\" " : "";	?>>Zamjenik zapovjednika društva</option>
  							<option value="clanZapovjednistva" <?php echo ($entitet->funkcija=="clanZapovjednistva") ? " 
  							selected=\"selected\" " : ""; ?>>Član zapovjedništva</option>
  							<option value="članNO" <?php echo ($entitet->funkcija=="clanNO") ? " selected=\"selected\" " : "";	?>>Član nadzornog odbora</option>
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
