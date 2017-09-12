<?php include_once '../../konfiguracija.php'; 
provjeraLogin();

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from vozilo where sifra=:sifra");
	$izraz -> execute(array("sifra"=>$_GET["sifra"]));
	$entitet = $izraz -> fetch(PDO::FETCH_OBJ);
}

if(isset($_POST["promjena"])){
	$izraz = $veza -> prepare("update vozilo set dvd=:dvd, vrsta=:vrsta, reg_oznaka=:reg_oznaka, naziv=:naziv, proizvodac=:proizvodac, model=:model,
	 							godina_proizvodnje=:godina_proizvodnje where sifra=:sifra");
	$izraz -> execute(array(
	"dvd"=>$_POST["dvd"],
	"vrsta"=>$_POST["vrsta"],
	"reg_oznaka"=>$_POST["reg_oznaka"],
	"naziv"=>$_POST["naziv"],
	"proizvodac"=>$_POST["proizvodac"],
	"model"=>$_POST["model"],
	"godina_proizvodnje"=>$_POST["godina_proizvodnje"],
	"sifra"=>$_POST["sifra"]
	));	
	
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["vrsta_intervencije"]==""){
		$izraz = $veza -> prepare("delete from vozilo where sifra=:sifra");
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
  						
  						<label for="dvd">DVD</label>
  						<select name="dvd">
  							<?php  
  								$izraz = $veza -> prepare("select sifra, naziv from dvd order by naziv");
								$izraz->execute();
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red) :
  							?>
  							<option <?php  
	  							if($entitet->naziv!="" && $entitet->dvd == $red->sifra){
	  								echo "selected=\"selected\" ";
	  							}
  							?>value="<?php echo $red->sifra; ?>"><?php echo $red->naziv; ?></option>
  							<?php endforeach; ?>
  						</select>
  						
  						<label for="vrsta">Vrsta vozila</label>
  						<select name="vrsta">
  							<?php  
  								$izraz = $veza -> prepare("select sifra, concat(vrsta_vozila, ' / ', podvrsta_vozila, ' / ',podpodvrsta_vozila, ' / ') as vrsta 
  															from kategorizacija_vozila order by vrsta_vozila");
								$izraz->execute();
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red) :
  							?>
  							<option <?php  
	  							if($entitet->vrsta!="" && $entitet->vrsta == $red->sifra){
	  								echo "selected=\"selected\" ";
	  							}
  							?>value="<?php echo $red->sifra; ?>"><?php echo $red->vrsta; ?></option>
  							<?php endforeach; ?>
  						</select>
  						
  						<label id="reg_oznaka" for="reg_oznaka">Registarska oznaka</label>
  						<input name="reg_oznaka" id="reg_oznaka" type="text" value="<?php echo $entitet->reg_oznaka; ?>" />
  						
  						<label id="naziv" for="naziv">Naziv</label>
  						<input name="naziv" id="naziv" type="text" value="<?php echo $entitet->naziv; ?>" />
  						
  						<label id="proizvodac" for="proizvodac">Proizvođač</label>
  						<input name="proizvodac" id="proizvodac" type="text" value="<?php echo $entitet->proizvodac; ?>" />
  						
  						<label id="model" for="model">Model</label>
  						<input name="model" id="model" type="text" value="<?php echo $entitet->model; ?>" />
  						
  						<label id="godina_proizvodnje" for="godina_proizvodnje">Godina proizvodnje</label>
  						<input name="godina_proizvodnje" id="godina_proizvodnje" type="date" 
  						value="<?php echo date("Y",strtotime($entitet->godina_proizvodnje)); ?>" />
  						
  						<input name="promjena" type="submit" class="button expanded" value="<?php 
							if($entitet->reg_oznaka==""){
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
