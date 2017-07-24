<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/zaglavlje.php' ?>
	</head>
  	<body>
  		<?php include_once '../../predlosci/izbornik.php' ?>
  		<div class="row">
  			<div class="large-12 medium-12 small-12 columns">
  				<div class="callout">
  					<div class="row">
  						<div class="large-6 medium-6 small-12 columns">
  							<form method="GET">
  								<input type="text" placeholder="dio naziva" name="uvjet"
  								value="<?php echo $uvjet; ?>" />
  							</form>
  						</div>
  						<div class="large-6 medium-6 small-12 columns">
  							<a href="intervencijeUnos.php" class="button expanded">DODAJ NOVU INTERVENCIJU</a>
  						</div>
  					</div>
  					<table class="hover">
  						<thead>
  							<tr>
  								<th>Datum nastanka</th>
  								<th>Vrsta intervencije</th>
  								<th>Mjesto intervencije</th>
  								<th>Dojava</th>
  								<th>Voditelj intervencije</th>
  								<th>Akcija</th>
  							</tr>
  						</thead>
  						<tbody>
  							<?php  
	  							$izraz = $veza->prepare("select a.sifra, a.datum_nastanka, a.vrsta_intervencije, a.mjesto,a.dojava, a.izvjesce_popunio, 
	  							count(b.dvd_clan) as vatrogasac 
	  							from intervencija a left join intervencija_clan b on a.sifra=b.intervencija  
	  							where a.vrsta_intervencije like :uvjet 
	  							group by a.sifra;");
								$uvjet="%" . $uvjet . "%";
								$izraz -> execute(array("uvjet"=>$uvjet));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ); 
								foreach ($rezultati as $red) :
  							?>
  							<tr>
  								<td data-label="Datum nastanka"><?php echo $red->datum_nastanka; ?></td>
  								<td data-label="Vrsta intervencije"><?php echo $red->vrsta_intervencije; ?></td>
  								<td data-label="Mjesto intervencije"><?php echo $red->mjesto; ?></td>
  								<td data-label="Dojava"><?php echo $red->dojava; ?></td>
  								<td data-label="Voditelj intervencije"><?php echo $red->izvjesce_popunio; ?></td>
  								<td data-label="Akcija">
  									<a href="intervencijePromjena.php?sifra=<?php echo $red->sifra; 
  									if(isset($_GET["uvjet"])){
  										echo "&uvjet=" . $_GET["uvjet"];
  									}?>">Promjeni</a>
  									<?php if($red->vatrogasac===0): ?>|
  									<a href="intervencijeBrisanje.php?sifra=<?php echo $red->sifra; 
  									if(isset($_GET["uvjet"])){
  										echo"&uvjet=". $_GET["uvjet"];
  									}?>">Obriši</a>
  									<?php endif; ?>
  								</td>
  							</tr>
  							<?php endforeach; ?>
  						</tbody>
  					</table>
  					
  				</div>
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php' ?>
  	</body>
</html>
