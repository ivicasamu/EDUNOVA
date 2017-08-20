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
  						<legend>UNOS NOVOG ČLANA</legend>
  						
  						<label id="lime" for="ime">Ime</label>
  						<input 
  						<?php if(isset($greske["ime"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="ime" id="ime" type="text" />
  						
  						<label id="lprezime" for="prezime">Prezime</label>
  						<input 
  						<?php if(isset($greske["prezime"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="prezime" id="prezime" type="text" />
  						
  						<label id="loib" for="oib">OIB</label>
  						<input 
  						<?php if(isset($greske["oib"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="oib" id="oib" type="number" />
  						
  						<label id="datumRodenja" for="datumRodenja">Datum rođenja</label>
  						<input name="datumRodenja" id="datumRodenja" type="datetime" placeholder="yyyy/mm/dd hh-mm" />
  						
  						<label id="ulica" for="ulica">Ulica i broj</label>
  						<input name="ulica" id="ulica" type="text" />
  						
  						<label id="mjesto" for="mjesto">Mjesto</label>
  						<input name="mjesto" id="mjesto" type="text" />
  						
  						<label id="telefon" for="telefon">Telefon</label>
  						<input name="telefon" id="telefon" type="text" />
  						
  						<label id="mail" for="mail">Email</label>
  						<input name="mail" id="mail" type="email" />
  						
  						<label id="datumUcljanjenja" for="datumUclanjenja">Datum učlanjenja</label>
  						<input name="datumUclanjenja" id="datumUclanjenja" type="datetime" placeholder="yyyy/mm/dd hh-mm" />
  						
  						<label id="cin" for="cin">Čin u vatrogastvu</label>
  						<select id="cin" name="cin">
  							<option value="Nema čin"selected="selected">Nema čin</option>
		  					<option value="Vatrogasac">Vatrogasac</option>
		  					<option value="Vatrogasac 1.klase">Vatrogasac 1.klase</option>
		  					<option value="Dočasnik">Dočasnik</option>
		  					<option value="Dočasnik 1. klase">Dočasnik 1. klase</option>
		  					<option value="Časnik">Časnik</option>
		  					<option value="Časnik 1. klase">Časnik 1. klase</option>
  						</select>
  						
  						<label id="funkcija" for="funkcija">Funkcija u vatrogastvu</label>
  						<select id="funkcija" name="funkcija">
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
  						
  						<input type="submit" class="button" value="Dodaj člana" />
  						<a href="clan.php" class="alert button">Odustani</a>
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
    		
    		<?php if(isset($greske["ime"])) :?>
    			$("#ime").focus();
    			$("#lime").fadeOut(1000, function(){
    				$("#lime").html("<?php echo $greske["ime"]?>");
    				$("#lime").fadeIn();
    			})
    		<?php endif;?>
    		
    		<?php if(isset($greske["prezime"])) :?>
    			<?php if($_POST["ime"]!="") : ?>
    				$("#prezime").focus();
    			<?php endif;?>
    			$("#lprezime").fadeOut(1000, function(){
    				$("#lprezime").html("<?php echo $greske["prezime"]?>");
    				$("#lprezime").fadeIn();
    			})
    		<?php endif;?>
    		
    		<?php if(isset($greske["oib"])) :?>
    			<?php if($_POST["ime"] && $_POST["prezime"]!="") : ?>
    				$("#oib").focus();
    			<?php endif;?>
    			$("#loib").fadeOut(1000, function(){
    				$("#loib").html("<?php echo $greske["oib"]?>");
    				$("#loib").fadeIn();
    			})
    		<?php endif;?>
    	</script>
  	</body>
</html>
