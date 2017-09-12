<?php include_once '../../konfiguracija.php'; 
provjeraLogin();

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from dvd where sifra=:sifra");
	$izraz -> execute(array("sifra"=>$_GET["sifra"]));
	$entitet = $izraz -> fetch(PDO::FETCH_OBJ);
}

if(isset($_POST["promjena"])){
	$izraz = $veza -> prepare("update dvd set vzo=:vzo, naziv=:naziv, oib=:oib, mb=:mb, ulica=:ulica, mjesto=:mjesto, telefon=:telefon, mail=:mail, 
								web=:web, godina_osnivanja=:godina_osnivanja where sifra=:sifra");
	$izraz -> execute(array(
	"vzo"=>$_POST["vzo"],
	"naziv"=>$_POST["naziv"],
	"oib"=>$_POST["oib"],
	"mb"=>$_POST["mb"],
	"ulica"=>$_POST["ulica"],
	"mjesto"=>$_POST["mjesto"],
	"telefon"=>$_POST["telefon"],
	"mail"=>$_POST["mail"],
	"web"=>$_POST["web"],
	"godina_osnivanja"=>$_POST["godina_osnivanja"],
	"sifra"=>$_POST["sifra"]
	));	
	
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["naziv"]==""){
		$izraz = $veza -> prepare("delete from dvd where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
	}
	header("location: index.php");
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
  						<legend>UNOSNI PODACI</legend>
  						
  						<label id="vzo" for="vzo">VZO</label>
  						<input name="vzo" id="vzo" type="text" value="<?php echo $entitet->vzo; ?>" />
  						
  						<label id="naziv" for="naziv">Naziv društva</label>
  						<input name="naziv" id="naziv" type="text" value="<?php echo $entitet->naziv; ?>" />
  						
  						<label id="oib" for="oib">OIB</label>
  						<input name="oib" id="oib" type="number" value="<?php echo $entitet->oib; ?>" />
  						
  						<label id="mb" for="mb">Matični broj</label>
  						<input name="mb" id="mb" type="number" value="<?php echo $entitet->mb; ?>" />
  						
  						<label id="ulica" for="ulica">Ulica</label>
  						<input name="ulica" id="ulica" type="text" value="<?php echo $entitet->ulica; ?>" />
  						
  						<label id="mjesto" for="mjesto">Mjesto</label>
  						<input name="mjesto" id="mjesto" type="text" value="<?php echo $entitet->mjesto; ?>" />
  						
  						<label id="telefon" for="telefon">Telefon</label>
  						<input name="telefon" id="telefon" type="text" value="<?php echo $entitet->telefon; ?>" />
  						
  						<label id="mail" for="mail">Email</label>
  						<input name="mail" id="mail" type="email" value="<?php echo $entitet->mail; ?>" />
  						
  						<label id="web" for="web">Web</label>
  						<input name="web" id="web" type="text" value="<?php echo $entitet->web; ?>" />
  						
  						<label id="godina_osnivanja" for="godina_osnivanja">Godina osnivanja</label>
  						<input name="godina_osnivanja" id="godina_osnivanja" type="date" 
  						value="<?php echo date("Y",strtotime($entitet->godina_osnivanja)); ?>" />
  						
  						<input name="promjena" type="submit" class="button expanded" value="<?php 
							if($entitet->naziv==""){
								echo "Dodaj novi";
							}else{
								echo "Promjeni";
							}
							
							?>"/>
						<input type="hidden" name="sifra" value="<?php echo $entitet->sifra; ?>" />
						<input name="odustani" type="submit" class="alert button expanded" value="Odustani" />
  					</fieldset>
  				</form>	
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
  	</body>
</html>
