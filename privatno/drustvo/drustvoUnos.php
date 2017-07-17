<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
$greske = array();

if(isset($_POST["naziv"])){
	if(trim($_POST["naziv"])===""){
		$greske["naziv"]="Obavezan unos naziva";
	}else{
		if(strlen(trim($_POST["naziv"]))<2){
			$greske["naziv"]="Naziv mora imati više od dva znaka";
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
		$izraz = $veza->prepare("insert into dvd (naziv, vzo, oib, mb, ulica, mjesto, telefon, mail, web, godina_osnivanja) 
		values (:naziv, :vzo, :oib, :mb, :ulica, :mjesto, :telefon, :mail, :web, :godinaOsnivanja)");
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
  						<legend>Unos podataka</legend>
  						
  						<label id="lnaziv" for="naziv">Naziv</label>
  						<input 
  						<?php if(isset($greske["naziv"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="naziv" id="naziv" type="text" />
  						
  						<label id="vzo" for="vzo">Vatrogasna zajednica</label>
  						<input name="vzo" id="vzo" type="text" />
  						
  						<label id="loib" for="oib">OIB društva</label>
  						<input 
  						<?php if(isset($greske["oib"])){
  							echo " style=\"background-color: #f7e4e1\" ";
  						} 
  						?>
  						name="oib" id="oib" type="number" />
  						
  						<label id="mb" for="mb">Matični broj društva</label>
  						<input name="mb" id="mb" type="number" />
  						
  						<label id="ulica" for="ulica">Ulica i broj</label>
  						<input name="ulica" id="ulica" type="text" />
  						
  						<label id="mjesto" for="mjesto">Mjesto</label>
  						<input name="mjesto" id="mjesto" type="text" />
  						
  						<label id="telefon" for="telefon">Telefon</label>
  						<input name="telefon" id="telefon" type="text" />
  						
  						<label id="mail" for="mail">Email</label>
  						<input name="mail" id="mail" type="email" />
  						
  						<label id="web" for="web">Web adresa</label>
  						<input name="web" id="web" type="text" />
  						
  						<label id="godinaOsnivanja" for="godinaOsnivanja">Godina osnivanja</label>
  						<input name="godinaOsnivanja" id="godinaOsnivanja" type="date" />
  						
  						<input type="submit" class="button" value="Dodaj" />
  						<a href="drustvo.php" class="alert button">Odustani</a>
  						<?php if(isset($unioRedova) && $unioRedova>0): ?>
  						<h1 id="unio" class="success button">Zapis uspješno pohranje</h1>
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
    		
    		<?php if(isset($greske["naziv"])) :?>
    			$("#naziv").focus();
    			$("#lnaziv").fadeOut(1000, function(){
    				$("#lnaziv").html("<?php echo $greske["naziv"]?>");
    				$("#lnaziv").fadeIn();
    			})
    		<?php endif;?>
    		
    		<?php if(isset($greske["oib"])) :?>
    			<?php if($_POST["naziv"]!="") : ?>
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
