<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
$greske = array();

if(isset($_POST["datumDojave"])){
	if(trim($_POST["datumDojave"])===""){
		$greske["datumDojave"]="Obavezan unos datuma i vremena dojave";
	}

	if(count($greske)===0){
		$izraz = $veza->prepare("insert into intervencija (vrsta_intervencije, podvrsta_intervencije, datum_nastanka, datum_dojave, datum_dolaska, 
		datum_zavrsetka, mjesto, ulica, dojava, utrosena_sredstva, opis, izvjesce_popunio) 
		values (:vrstaIntervencije, :podVrstaIntervencije, :datumNastanka, :datumDojave, :datumDolaska, :datumZavrsetka, :mjesto, :ulica, 
		:dojava, :utrosenaSredstva, :opis, :izvjescePopunio)");
		$unioRedova = $izraz->execute($_POST);
	}
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
  						<legend>UNOS NOVE INTERVENCIJE</legend>
  						
  						<label id="vrstaIntervencije" for="vrstaIntervencije">Vrsta intervencije</label>
  						<select id="vrstaIntervencije" name="vrstaIntervencije">
  							<option value="" selected="selected"></option>
  							<option value="pozarna">Požarna intervencija</option>
  							<option value="tehnicka">Tehnička intervencija</option>
  							<option value="ostale">Ostale intervencije</option>
  							<option value="druge">Druge aktivnosti</option>
  						</select>
  						
  						<label id="podVrstaIntervencije" for="podVrstaIntervencije">Podvrsta intervencije</label>
  						<select id="podVrstaIntervencije" name="podVrstaIntervencije">
  								<option value="" selected="selected"></option>
	  							<option value="stambenog">Požar stambenog objekta</option>
	  							<option value="poslovnog">Požar poslovnog objekta</option>
	  							<option value="javna">Požar objekta javne namjene</option>
	  							<option value="gospodarski">Požar gospodarskog objekta</option>
	  							<option value="komunalni">Požr objekta komunalne namjene</option>
	  							<option value="prometnog">Požar prometnog sredstva</option>
	  							<option value="otvoreni">Požar na otvorenom prostoru</option>
	  							<option value="dimnjaka">Požar dimnjaka</option>
	  							<option value="eksplozijePozar">Eksplozije</option>
	  							<option value="ostalePozar">Ostale požarne intervencije</option>
	  							<option value="nezgode">Nezgode u prometu</option>
	  							<option value="visine">Spašavanje s visine i dubine</option>
	  							<option value="potraga">Potraga za nestalom osobom</option>
	  							<option value="spasavanje">Spašavanje na?pod vodom</option>
	  							<option value="poplave">Radovi na vodi i zaštita od poplava</option>
	  							<option value="rusevine">Spašavanje iz ruševina</option>
	  							<option value="objekti">Tehničke intervencije u objektu</option>
	  							<option value="opasne">Intervencija s opasnim tvarima</option>
	  							<option value="eksplozijeTehnicke">Ekslopzije</option>
	  							<option value="ostaleTehnicke">Ostale tehničke intervencije</option>
  						</select>
  						
  						<label id="datumNastanka" for="datumNastanka">Datum nastanka</label>
  						<input name="datumNastanka" id="datumNastanka" type="datetime" placeholder="yyyy/mm/dd hh-mm" />
  						
  						<label id="ldatumDojave" for="datumDojave">Datum dojave</label>
  						<input 
  						<?php if(isset($greske["datumDojave"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						}?>
  						name="datumDojave" id="datumDojave" type="datetime" placeholder="yyyy/mm/dd hh-mm" />
  						
  						<label id="datumDolaska" for="datumDolaska">Datum dolaska</label>
  						<input name="datumDolaska" id="datumDolaska" type="datetime" placeholder="yyyy/mm/dd hh-mm" />
  						
  						<label id="datumZavrsetka" for="datumZavrsetka">Datum završetka</label>
  						<input name="datumZavrsetka" id="datumZavrsetka" type="datetime" placeholder="yyyy/mm/dd hh-mm" />
  						
  						<label id="mjesto" for="mjesto">Mjesto</label>
  						<input name="mjesto" id="mjesto" type="text" />
  						
  						<label id="ulica" for="ulica">Ulica</label>
  						<input name="ulica" id="ulica" type="text" />
  						
  						<label id="dojava" for="dojava">Dojava</label>
  						<input name="dojava" id="dojava" type="text" />
  						
  						<label id="utrosenaSredstva" for="utrosenaSredstva">Utrošena sredstva</label>
  						<input name="utrosenaSredstva" id="utrosenaSredstva" type="text" />
  						
  						<label id="opis" for="opis">Opis intervencije</label>
  						<input name="opis" id="opis" type="text" />
  						
  						<label id="izvjescePopunio" for="izvjescePopunio">Voditelj intervencije</label>
  						<input name="izvjescePopunio" id="izvjescePopunio" type="text" />
  						
  						<input type="submit" class="button" value="Dodaj intervenciju" />
  						<a href="intervencije.php" class="alert button">Odustani</a>
  						<?php if(isset($unioRedova) && $unioRedova>0): ?>
  						<h1 id="unio" class="success button">Zapis uspješno pohranjen</h1>
  						<?php endif; ?>
  					</fieldset>
  				</form>	
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
    	
    	<script>
    		<?php if(isset($unioRedova) && $unioRedova>0): ?>
    			setTimeout(function(){$("#unio").fadeOut(); },3000);
    		<?php endif;?>
    		
    		<?php if(isset($greske["datumDojave"])) :?>
    			$("#ldatumDojave").fadeOut(1000, function(){
    				$("#ldatumDojave").html("<?php echo $greske["datumDojave"]?>");
    				$("#ldatumDojave").fadeIn();
    			})
    		<?php endif;?>
    	</script>
  	</body>
</html>
