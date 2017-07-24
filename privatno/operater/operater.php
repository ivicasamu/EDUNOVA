<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("admin");
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
  							<a href="operaterUnos.php" class="button expanded">DODAJ NOVOG OPERATERA</a>
  						</div>
  					</div>
  					<table class="hover">
  						<thead>
  							<tr>
  								<th width="6%">Šifra</th>
  								<th>Ime i prezime</th>
  								<th>Email</th>
  								<th>Uloga</th>
  								<th>Akcija</th>
  							</tr>
  						</thead>
  						<tbody>
  							<?php  
	  							$izraz = $veza->prepare("select sifra, concat(ime, ' ', prezime) as imePrezime, email, uloga from operater 
	  							where ime like :uvjet");
								$uvjet="%" . $uvjet . "%";
								$izraz -> execute(array("uvjet"=>$uvjet));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ); 
								foreach ($rezultati as $red) :
  							?>
  							<tr>
  								<td data-label="Šifra"><?php echo $red->sifra; ?></td>
  								<td data-label="Ime i prezime"><?php echo $red->imePrezime; ?></td>
  								<td data-label="Email"><?php echo $red->email; ?></td>
  								<td data-label="Uloga"><?php echo $red->uloga; ?></td>
  								<td data-label="Akcija">
									<a href="operaterPromjena.php?sifra=<?php echo $red->sifra;?>">Promjena podataka operatera</a></br>
									<a href="operaterLozinka.php?sifra=<?php echo $red->sifra;?>">Promjena lozinke</a></br>
									<a href="operaterBrisanje.php?sifra=<?php echo $red->sifra;?>">Obriši</a>
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
