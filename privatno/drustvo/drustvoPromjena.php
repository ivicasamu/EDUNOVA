<?php include_once '../../konfiguracija.php'; 
provjeraLogin();

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from dvd where sifra=:sifra");
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
	$izraz=$veza->prepare("update dvd set vzo=:vzo, naziv=:naziv, oib=:oib, mb=:mb, ulica=:ulica, mjesto=:mjesto, telefon=:telefon, 
	mail=:mail, web=:web, godina_osnivanja=:godinaOsnivanja where sifra=:sifra");
	$izraz->execute($_POST);
	header("location: drustvo.php?uvjet=" . $uvjet);
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
  						<legend>Unos podataka</legend>
  						
  						<label id="lnaziv" for="naziv">Naziv</label>
  						<input 
  						<?php if(isset($greske["naziv"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="naziv" id="naziv" value="<?php echo $entitet->naziv; ?>" type="text" />
  						
  						<label id="vzo" for="vzo">Vatrogasna zajednica</label>
  						<input name="vzo" id="vzo" value="<?php echo $entitet->vzo; ?>" type="text" />
  						
  						<label id="loib" for="oib">OIB društva</label>
  						<input 
  						<?php if(isset($greske["oib"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="oib" id="oib" value="<?php echo $entitet->oib; ?>" type="number" />
  						
  						<label id="mb" for="mb">Matični broj društva</label>
  						<input name="mb" id="mb" value="<?php echo $entitet->mb; ?>" type="number" />
  						
  						<label id="ulica" for="ulica">Ulica i broj</label>
  						<input name="ulica" id="ulica" value="<?php echo $entitet->ulica; ?>"type="text" />
  						
  						<label id="mjesto" for="mjesto">Mjesto</label>
  						<input name="mjesto" id="mjesto" value="<?php echo $entitet->mjesto; ?>" type="text" />
  						
  						<label id="telefon" for="telefon">Telefon</label>
  						<input name="telefon" id="telefon" value="<?php echo $entitet->telefon; ?>" type="text" />
  						
  						<label id="mail" for="mail">Email</label>
  						<input name="mail" id="mail" value="<?php echo $entitet->mail; ?>" type="email" />
  						
  						<label id="web" for="web">Web adresa</label>
  						<input name="web" id="web" value="<?php echo $entitet->web; ?>" type="text" />
  						
  						<label id="godinaOsnivanja" for="godinaOsnivanja">Godina osnivanja</label>
  						<input name="godinaOsnivanja" id="godinaOsnivanja"value="<?php echo $entitet->godina_osnivanja; ?>" type="datetime" />
  						
  						<input type="submit" class="button" value="Promjeni" />
  						<input type="hidden" name="sifra" value="<?php echo $entitet->sifra ?>" />
  						<?php if(isset($_GET["uvjet"])): ?>
  							<input type="hidden" name="uvjet" value="<?php echo $entitet->uvjet; ?>" />
  						<?php endif; ?>
  						<a href="drustvo.php" class="alert button">Odustani</a>
  						<?php if(isset($unioRedova) && $unioRedova>0): ?>
  						<h1 id="unio" class="success button">Zapis uspješno pohranjen</h1>
  						<?php endif; ?>
  					</fieldset>
  				</form>	
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
    	
  	</body>
</html>
