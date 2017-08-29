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
  							<a href="drustvoUnos.php" class="button expanded">DODAJ NOVO DRUŠTVO</a>
  						</div>
  					</div>
  					<table class="hover">
  						<thead>
  							<tr>
  								<th>Šifra</th>
  								<th>Naziv društva</th>
  								<th>OIB</th>
  								<th>Adresa</th>
  								<th>Godina osnivanja</th>
  								<th>Akcija</th>
  							</tr>
  						</thead>
  						<tbody>
  							<?php  
	  							$izraz = $veza->prepare("select  a.sifra, a.naziv, a.oib, concat(a.mjesto,', ',a.ulica) as adresa, a.godina_osnivanja, 
	  							count(b.clan) as clan, count(b.dvd) as vozilo
	  							from dvd a left join dvd_clan b on a. sifra=b.dvd
	  							where a.naziv like :uvjet 
	  							group by a.sifra, a.naziv");
								$uvjet="%" . $uvjet . "%";
								$izraz -> execute(array("uvjet"=>$uvjet));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ); 
								foreach ($rezultati as $red) :
  							?>
  							<tr>
  								<td data-label="Šifra"><?php echo $red->sifra; ?></td>
  								<td data-label="Naziv društva"><?php echo $red->naziv; ?></td>
  								<td data-label="OIB"><?php echo $red->oib; ?></td>
  								<td data-label="Adresa"><?php echo $red->adresa; ?></td>
  								<td data-label="Godina osnivanja"><?php echo $red->godina_osnivanja; ?></td>
  								<td data-label="Akcija">
  									<a href="drustvoPromjena.php?sifra=<?php echo $red->sifra; 
  									if(isset($_GET["uvjet"])){
  										echo "&uvjet=" . $_GET["uvjet"];
  									}?>">Promjeni</a>
  									<?php if($red->clan===0): ?>
  									<a href="drustvoBrisanje.php?sifra=<?php echo $red->sifra; 
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
