<?php include_once '../konfiguracija.php'; 
provjeraLogin();

$greske=array();

if(isset($_POST["ime"])){
	
	if(trim($_POST["ime"])===""){
		$greske["ime"]="Obavezan unos imena";
	}	
}

if(isset($_POST["prezime"])){
	
	if(trim($_POST["prezime"])===""){
		$greske["prezime"]="Obavezan unos prezimena";
	}
	//else{
		//if(count(trim($_POST["ime"])<2)){
		//$greske["ime"]="Ime mora imati više od dva slova";
		//}
	//}	
}

if(isset($_POST["oib"])){
	
	if(trim($_POST["oib"])===""){
		$greske["oib"]="Obavezan unos OIB-a";
	}	
	if(count($greske)==0){
		$izraz=$con->prepare("insert into clan (ime, prezime, oib, datum_rodenja, ulica, mjesto, telefon, mail, datum_uclanjenja, cin, funkcija) 
		values (:ime, :prezime, :oib, :datum_rodenja, :ulica, :mjesto, :telefon, :mail, :datum_uclanjenja, :cin, :funkcija)");
		$unioRedova = $izraz->execute($_POST);
	}

}

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
		<?php include_once '../predlosci/head.php'; ?>
  </head>
  <body>
  		<?php include_once'../predlosci/izbornik.php'; ?>
  		<div class="row">
  			<div class="large-6 large-centered">
  					<form method="POST">
  					<fieldset class="fieldset">
  						<legend>Unos podataka</legend>
  							<label id="lime"for="ime">Ime</label>
  							<input 
  							<?php 
							if(isset($greske["ime"])){
								echo " style=\"background-color: #f7e4e1\" ";
							}
							?> 
							name="ime" id="ime" type="text" />
							
  							<label id="lprezime"for="prezime">Prezime</label>
  							<input 
  							<?php 
							if(isset($greske["prezime"])){
								echo " style=\"background-color: #f7e4e1\" ";
							}
							?> 
  							name="prezime" id="prezime" type="text" />
  							
  							<label id="loib"for="oib">OIB</label>
  							<input 
  							<?php 
							if(isset($greske["oib"])){
								echo " style=\"background-color: #f7e4e1\" ";
							}
							?> 
  							name="oib" id="oib" type="text" />
  							
  							<label id="datum_rodenja"for="datum_rodenja">Datum rođenja</label>
  							<input name="datum_rodenja" id="datum_rodenja" type="date" />
  							
  							<label id="ulica"for="ulica">Ulica</label>
  							<input name="ulica" id="ulica" type="text" />
  							
  							<label id="mjesto"for="mjesto">Mjesto</label>
  							<input name="mjesto" id="mjesto" type="text" />
  							
  							<label id="telefon"for="telefon">Telefon</label>
  							<input name="telefon" id="telefon" type="text" />
  							
  							<label id="mail"for="mail">Mail</label>
  							<input name="mail" id="mail" type="text" />
  							
  							<label id="datum_uclanjenja"for="datum_uclanjenja">Datum učlanjenja</label>
  							<input name="datum_uclanjenja" id="datum_uclanjenja" type="date" />
  							
  							<label id="cin"for="cin">Čin u vatrogastvu</label>
  							<input name="cin" id="cin" type="text" />
  							
  							<label id="funkcija"for="funkcija">Funkcija</label>
  							<input name="funkcija" id="funkcija" type="text" />
  							
  							<input type="submit" class="button expanded" value="Dodaj novog člana" />
  							<a href="clanovi.php" class="alert button expanded">Odustani</a>
  							<?php if(isset($unioRedova) && $unioRedova>0):?>
							<h1 id="unio" class="success button expanded">Član uspješno dodan</h1>														
							<?php endif;?>
  					</fieldset>
  				</form>
  			</div>
  		</div>
  		<?php include_once '../predlosci/podnozje.php' ?>
		<?php include_once '../predlosci/skripte.php'; ?>
<script>
			<?php if(isset($unioRedova) && $unioRedova>0):?>
				setTimeout(function(){ $("#unio").fadeOut(); }, 2000);
			<?php endif;?>
			
			<?php 
				if(isset($greske["ime"])){
					echo " $(\"#ime\").focus(); ";
					echo " $(\"#lime\").fadeOut();";
					echo " $(\"#lime\").html(\"" . $greske["ime"] . "\");";
					echo " $(\"#lime\").fadeIn();";
				}
			?> 
			
			<?php 
				if(isset($greske["prezime"])){
					echo " $(\"#prezime\").focus(); ";
					echo " $(\"#lprezme\").fadeOut();";
					echo " $(\"#lprezime\").html(\"" . $greske["prezime"] . "\");";
					echo " $(\"#lprezime\").fadeIn();";
				}
			?>

			<?php 
				if(isset($greske["oib"])){
					echo " $(\"#oib\").focus(); ";
					echo " $(\"#loib\").fadeOut();";
					echo " $(\"#loib\").html(\"" . $greske["oib"] . "\");";
					echo " $(\"#loib\").fadeIn();";
				}
			?>

		</script>

  </body>
</html>
