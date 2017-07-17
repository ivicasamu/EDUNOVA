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
  							<a href="clanUnos.php" class="button expanded">DODAJ NOVOG ČLANA</a>
  						</div>
  					</div>
  					<table class="hover">
  						<thead>
  							<tr>
  								<th>Šifra</th>
  								<th>Ime</th>
  								<th>Prezime</th>
  								<th>OIB</th>
  								<th>Akcija</th>
  							</tr>
  						</thead>
  						<tbody>
  							<?php  
	  							$izraz = $veza->prepare("select  a.sifra, a.ime, a.prezime, a.oib, count(b.clan) as clan from clan a 
	  							left join dvd_clan b on a. sifra=b.clan 
	  							where a.ime like :uvjet 
	  							group by a.sifra, a.ime, a.prezime;");
								$uvjet="%" . $uvjet . "%";
								$izraz -> execute(array("uvjet"=>$uvjet));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ); 
								foreach ($rezultati as $red) :
  							?>
  							<tr>
  								<td><?php echo $red->sifra; ?></td>
  								<td><?php echo $red->ime; ?></td>
  								<td><?php echo $red->prezime; ?></td>
  								<td><?php echo $red->oib; ?></td>
  								<td>
  									<a href="clanPromjena.php?sifra=<?php echo $red->sifra; 
  									if(isset($_GET["uvjet"])){
  										echo "&uvjet=" . $_GET["uvjet"];
  									}?>">Promjeni</a>
  									<?php if($red->clan===0): ?>
  									<a href="clanBrisanje.php?sifra=<?php echo $red->sifra; 
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
