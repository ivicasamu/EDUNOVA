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
  					
  							<option value="Požarna intervencija" <?php echo ($entitet->vrsta_intervencije==="Požarna intervencija") ? " 
		  						selected=\"selected\" " : ""; ?>>Požarna intervencija</option>
		  					<option value="Tehnička intervencija" <?php echo ($entitet->vrsta_intervencije==="Tehnička intervencija") ? " 
		  						selected=\"selected\" " : ""; ?>>Tehnička intervencija</option>
		  					<option value="Ostale intervencije" <?php echo ($entitet->vrsta_intervencije==="Ostale intervencije") ? " 
		  						selected=\"selected\" " : ""; ?>>Ostale intervencije</option>
		  					<option value="Druge aktivnosti" <?php echo ($entitet->vrsta_intervencije==="Druge aktivnosti") ? " 
		  						selected=\"selected\" " : ""; ?>>Druge aktivnosti</option>
  						</select>
  						
  						<label id="podVrstaIntervencije" for="podVrstaIntervencije">Podvrsta intervencije</label>
  						<select id="podVrstaIntervencije" name="podVrstaIntervencije">
	  							<option value="Požar stambenog objekta" <?php echo ($entitet->podvrsta_intervencije==="Požar stambenog objekta") ? " 
			  							selected=\"selected\" " : ""; ?>>Požar stambenog objekta</option>
			  						<option value="Požar poslovnog objekta" <?php echo ($entitet->podvrsta_intervencije==="Požar poslovnog objekta") ? " 
			  							selected=\"selected\" " : ""; ?>>Požar poslovnog objekta</option>
			  						<option value="Požar objekta javne namjene" <?php echo ($entitet->podvrsta_intervencije==="Požar objekta javne namjene") ? " 
			  							selected=\"selected\" " : ""; ?>>Požar objekta javne namjene</option>
			  						<option value="Požar gospodarskog objekta" <?php echo ($entitet->podvrsta_intervencije==="Požar gospodarskog objekta") ? " 
			  							selected=\"selected\" " : ""; ?>>Požar gospodarskog objekta</option>
			  						<option value="Požar objekta komunalne namjene" <?php echo ($entitet->podvrsta_intervencije==="Požar objekta komunalne namjene") ? " 
			  							selected=\"selected\" " : ""; ?>>Požar objekta komunalne namjene</option>
			  						<option value="Požar prometnog sredstva" <?php echo ($entitet->podvrsta_intervencije==="Požar prometnog sredstva") ? " 
			  							selected=\"selected\" " : ""; ?>>Požar prometnog sredstva</option>
			  						<option value="Požar na otvorenom prostoru" <?php echo ($entitet->podvrsta_intervencije==="Požar na otvorenom prostoru") ? " 
			  							selected=\"selected\" " : ""; ?>>Požar na otvorenom prostoru</option>
			  						<option value="Požar na otvorenom prostoru" <?php echo ($entitet->podvrsta_intervencije==="Požar dimnjaka") ? " 
			  							selected=\"selected\" " : ""; ?>>Požar dimnjaka</option>
									<option value="Eksplozije" <?php echo ($entitet->podvrsta_intervencije==="Eksplozije") ? " 
										selected=\"selected\" " : ""; ?>>Eksplozije</option>
		  							<option value="Ostale požarne intervencije"<?php echo ($entitet->podvrsta_intervencije==="Ostale požarne intervencije") ? " 
		  								selected=\"selected\" " : ""; ?>>Ostale požarne intervencije</option>
		  							<option value="Nezgode u prometu" <?php echo ($entitet->podvrsta_intervencije==="Nezgode u prometu") ? " 
		  								selected=\"selected\" " : ""; ?>>Nezgode u prometu</option>
			  						<option value="Spašavanje s visine i dubine" <?php echo ($entitet->podvrsta_intervencije==="Spašavanje s visine i dubine") ? " 
			  							selected=\"selected\" " : ""; ?>>Spašavanje s visine i dubine</option>
			  						<option value="Potraga za nestalom osobom" <?php echo ($entitet->podvrsta_intervencije==="Potraga za nestalom osobom") ? " 
			  							selected=\"selected\" " : ""; ?>>Potraga za nestalom osobom</option>
			  						<option value="Spašavanje na/pod vodom" <?php echo ($entitet->podvrsta_intervencije==="Spašavanje na/pod vodom") ? " 
			  							selected=\"selected\" " : ""; ?>>Spašavanje na/pod vodom</option>
			  						<option value="Radovi na vodi i zaštita od poplava" <?php echo ($entitet->podvrsta_intervencije==="Radovi na vodi i zaštita od poplava") ? " 
			  							selected=\"selected\" " : ""; ?>>Radovi na vodi i zaštita od poplava</option>
			  						<option value="Spašavanje iz ruševina" <?php echo ($entitet->podvrsta_intervencije==="Spašavanje iz ruševina") ? " 
			  							selected=\"selected\" " : ""; ?>>Spašavanje iz ruševina</option>
			  						<option value="Tehničke intervencije u objektu" <?php echo ($entitet->podvrsta_intervencije==="Tehničke intervencije u objektu") ? " 
			  							selected=\"selected\" " : ""; ?>>Tehničke intervencije u objektu</option>
									<option value="Intervencija s opasnim tvarima" <?php echo ($entitet->podvrsta_intervencije==="Intervencija s opasnim tvarima") ? " 
										selected=\"selected\" " : ""; ?>>Intervencija s opasnim tvarima</option>
		  							<option value="Ekslopzije" <?php echo ($entitet->podvrsta_intervencije==="Ekslopzije") ? " 
		  								selected=\"selected\" " : ""; ?>>Ekslopzije</option>
		  							<option value="Ostale tehničke intervencije"<?php echo ($entitet->podvrsta_intervencije==="Ostale tehničke intervencije") ? " 
		  								selected=\"selected\" " : ""; ?>>Ostale tehničke intervencije</option>
  						</select>
  						
  						<label id="datumNastanka" for="datumNastanka">Datum nastanka</label>
  						<input name="datumNastanka" id="datumNastanka" type="datetime" placeholder="yyyy-mm-dd hh-mm" 
  						value="<?php echo $entitet->datum_nastanka ?>"/>
  						
  						<label id="ldatumDojave" for="datumDojave">Datum dojave</label>
  						<input 
  						<?php if(isset($greske["datumDojave"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						}?>
  						name="datumDojave" id="datumDojave" type="datetime" placeholder="yyyy-mm-dd hh-mm" 
  						value="<?php echo $entitet->datum_dojave ?>" />
  						
  						<label id="datumDolaska" for="datumDolaska">Datum dolaska</label>
  						<input name="datumDolaska" id="datumDolaska" type="datetime" placeholder="yyyy-mm-dd hh-mm" 
  						value="<?php echo $entitet->datum_dolaska ?>"/>
  						
  						<label id="datumZavrsetka" for="datumZavrsetka">Datum završetka</label>
  						<input name="datumZavrsetka" id="datumZavrsetka" type="datetime" placeholder="yyyy-mm-dd hh-mm"
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
