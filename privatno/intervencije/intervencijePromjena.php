<?php include_once '../../konfiguracija.php'; 
provjeraLogin();

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from intervencija where sifra=:sifra");
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
	$izraz=$veza->prepare("update intervencija set vrsta_intervencije=:vrstaIntervencije, podvrsta_intervencije=:podVrstaIntervencije, 
	datum_nastanka=:datumNastanka, datum_dojave=:datumDojave, datum_dolaska=:datumDolaska, datum_zavrsetka=:datumZavrsetka, mjesto=:mjesto, 
	ulica=:ulica, dojava=:dojava, utrosena_sredstva=:utrosenaSredstva, opis=:opis, izvjesce_popunio=:izvjescePopunio where sifra=:sifra");
	$izraz->execute($_POST);
	header("location: intervencije.php?uvjet=" . $uvjet);
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
  						<legend>Izmjena podataka intervencije</legend>
  						
  						<label id="vrstaIntervencije" for="vrstaIntervencije">Vrsta intervencije</label>
  						<select id="vrstaIntervencije" name="vrstaIntervencije">
  					
  							<option value="pozarna" <?php echo ($entitet->vrsta_intervencije==="pozarna") ? " selected=\"selected\" " : ""; ?>>Požarna intervencija</option>
  							<option value="tehnicka" <?php echo ($entitet->vrsta_intervencije==="tehnicka") ? " selected=\"selected\" " : ""; ?>>Tehnička intervencija</option>
  							<option value="ostale" <?php echo ($entitet->vrsta_intervencije==="ostale") ? " selected=\"selected\" " : ""; ?>>Ostale intervencije</option>
  							<option value="druge" <?php echo ($entitet->vrsta_intervencije==="druge") ? " selected=\"selected\" " : ""; ?>>Druge aktivnosti</option>
  						</select>
  						
  						<label id="podVrstaIntervencije" for="podVrstaIntervencije">Podvrsta intervencije</label>
  						<select id="podVrstaIntervencije" name="podVrstaIntervencije">
	  							<option value="stambenog" <?php echo ($entitet->podvrsta_intervencije==="stambenog") ? " selected=\"selected\" " : ""; ?>>Požar stambenog objekta</option>
	  							<option value="poslovnog"<?php echo ($entitet->podvrsta_intervencije==="poslovnog") ? " selected=\"selected\" " : ""; ?>>Požar poslovnog objekta</option>
	  							<option value="javna"<?php echo ($entitet->podvrsta_intervencije==="javna") ? " selected=\"selected\" " : ""; ?>>Požar objekta javne namjene</option>
	  							<option value="gospodarski"<?php echo ($entitet->podvrsta_intervencije==="gospodarski") ? " selected=\"selected\" " : ""; ?>>Požar gospodarskog objekta</option>
	  							<option value="komunalni"<?php echo ($entitet->podvrsta_intervencije==="komunalni") ? " selected=\"selected\" " : ""; ?>>Požar objekta komunalne namjene</option>
	  							<option value="prometnog"<?php echo ($entitet->podvrsta_intervencije==="prometnog") ? " selected=\"selected\" " : ""; ?>>Požar prometnog sredstva</option>
	  							<option value="otvoreni"<?php echo ($entitet->podvrsta_intervencije==="otvoreni") ? " selected=\"selected\" " : ""; ?>>Požar na otvorenom prostoru</option>
	  							<option value="dimnjak"<?php echo ($entitet->podvrsta_intervencije==="dimnjak") ? " selected=\"selected\" " : ""; ?>>Požar dimnjaka</option>
	  							<option value="eksplozijaPozar"<?php echo ($entitet->podvrsta_intervencije==="eksplozijaPozar") ? " selected=\"selected\" " : ""; ?>>Eksplozije</option>
	  							<option value="ostalePozar"<?php echo ($entitet->podvrsta_intervencije==="ostalePozar") ? " selected=\"selected\" " : ""; ?>>Ostale požarne intervencije</option>
	  							<option value="nezgode"<?php echo ($entitet->podvrsta_intervencije==="nezgode") ? " selected=\"selected\" " : ""; ?>>Nezgode u prometu</option>
	  							<option value="visine"<?php echo ($entitet->podvrsta_intervencije==="visine") ? " selected=\"selected\" " : ""; ?>>Spašavanje s visine i dubine</option>
	  							<option value="potraga"<?php echo ($entitet->podvrsta_intervencije==="potraga") ? " selected=\"selected\" " : ""; ?>>Potraga za nestalom osobom</option>
	  							<option value="spasavanje"<?php echo ($entitet->podvrsta_intervencije==="spasavanje") ? " selected=\"selected\" " : ""; ?>>Spašavanje na?pod vodom</option>
	  							<option value="poplave"<?php echo ($entitet->podvrsta_intervencije==="poplave") ? " selected=\"selected\" " : ""; ?>>Radovi na vodi i zaštita od poplava</option>
	  							<option value="rusevine"<?php echo ($entitet->podvrsta_intervencije==="rusevine") ? " selected=\"selected\" " : ""; ?>>Spašavanje iz ruševina</option>
	  							<option value="objekti"<?php echo ($entitet->podvrsta_intervencije==="objekti") ? " selected=\"selected\" " : ""; ?>>Tehničke intervencije u objektu</option>
	  							<option value="opasne"<?php echo ($entitet->podvrsta_intervencije==="opasne") ? " selected=\"selected\" " : ""; ?>>Intervencija s opasnim tvarima</option>
	  							<option value="eksplozijaTehnicka"<?php echo ($entitet->podvrsta_intervencije==="eksplozijaTehnicka") ? " selected=\"selected\" " : ""; ?>>Ekslopzije</option>
	  							<option value="ostaleTehnicka"<?php echo ($entitet->podvrsta_intervencije==="ostaleTehnicka") ? " selected=\"selected\" " : ""; ?>>Ostale tehničke intervencije</option>
  						</select>
  						
  						<label id="datumNastanka" for="datumNastanka">Datum nastanka</label>
  						<input name="datumNastanka" id="datumNastanka" type="datetime" placeholder="yyyy/mm/dd hh-mm" 
  						value="<?php echo $entitet->datum_nastanka ?>"/>
  						
  						<label id="ldatumDojave" for="datumDojave">Datum dojave</label>
  						<input 
  						<?php if(isset($greske["datumDojave"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						}?>
  						name="datumDojave" id="datumDojave" type="datetime" placeholder="yyyy/mm/dd hh-mm" 
  						value="<?php echo $entitet->datum_dojave ?>" />
  						
  						<label id="datumDolaska" for="datumDolaska">Datum dolaska</label>
  						<input name="datumDolaska" id="datumDolaska" type="datetime" placeholder="yyyy/mm/dd hh-mm" 
  						value="<?php echo $entitet->datum_dolaska ?>"/>
  						
  						<label id="datumZavrsetka" for="datumZavrsetka">Datum završetka</label>
  						<input name="datumZavrsetka" id="datumZavrsetka" type="datetime" placeholder="yyyy/mm/dd hh-mm"
  						value="<?php echo $entitet->datum_zavrsetka ?>" />
  						
  						<label id="mjesto" for="mjesto">Mjesto</label>
  						<input name="mjesto" id="mjesto" type="text" value="<?php echo $entitet->mjesto ?>"/>
  						
  						<label id="ulica" for="ulica">Ulica</label>
  						<input name="ulica" id="ulica" type="text" value="<?php echo $entitet->ulica ?>"/>
  						
  						<label id="dojava" for="dojava">Dojava</label>
  						<input name="dojava" id="dojava" type="text" value="<?php echo $entitet->dojava ?>"/>
  						
  						<label id="utrosenaSredstva" for="utrosenaSredstva">Utrošena sredstva</label>
  						<input name="utrosenaSredstva" id="utrosenaSredstva" type="text" value="<?php echo $entitet->utrosena_sredstva ?>"/>
  						
  						<label id="opis" for="opis">Opis intervencije</label>
  						<input name="opis" id="opis" type="text" value="<?php echo $entitet->opis ?>"/>
  						
  						<label id="izvjescePopunio" for="izvjescePopunio">Voditelj intervencije</label>
  						<input name="izvjescePopunio" id="izvjescePopunio" type="text" value="<?php echo $entitet->izvjesce_popunio ?>"/>
  						
  						<input type="submit" class="button" value="Promjeni" />
  						<input type="hidden" name="sifra" value="<?php echo $entitet->sifra ?>" />
  						<a href="intervencije.php" class="alert button">Odustani</a>
  						</fieldset>
  				</form>	
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
    	
  	</body>
</html>
