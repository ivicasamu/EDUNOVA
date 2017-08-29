<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
$stranica = 1;
if(isset($_GET["uvjet"])){
	if($_GET["stranica"]>0){
		$stranica = $_GET["stranica"];
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
  								<th>Ime i prezime</th>
  								<th>OIB</th>
  								<th>Adresa</th>
  								<th>Datum rođenja</th>
  								<th>Čin</th>
  								<th>Funkcija</th>
  								<th>Akcija</th>
  							</tr>
  						</thead>
  						<tbody>
  							<?php  
	  							$izraz = $veza->prepare("select  a.sifra, concat(a.ime,' ', a.prezime) as imePrezime, a.oib, a.datum_rodenja, 
	  							a.cin, a.funkcija, concat(a.mjesto,', ', a.ulica) as adresa, count(b.clan) as clan from clan a 
	  							left join dvd_clan b on a. sifra=b.clan 
	  							where a.ime like :uvjet 
	  							group by a.sifra, a.ime, a.prezime;");
								$uvjet="%" . $uvjet . "%";
								$izraz -> execute(array("uvjet"=>$uvjet));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ); 
								foreach ($rezultati as $red) :
  							?>
  							<tr>
  								<td data-label="Šifra"><?php echo $red->sifra; ?></td>
  								<td data-label="Ime i prezime"><?php echo $red->imePrezime; ?></td>
  								<td data-label="OIB"><?php echo $red->oib; ?></td>
  								<td data-label="Adresa"><?php echo $red->adresa; ?></td>
  								<td data-label="Datum rođenja"><?php echo $red->datum_rodenja; ?></td>
  								<td data-label="Čin"><?php echo $red->cin; ?></td>
  								<td data-label="Funkcija"><?php echo $red->funkcija; ?></td>
  								<td data-label="Akcija">
  									<a href="clanPromjena.php?sifra=<?php echo $red->sifra; 
  									if(isset($_GET["uvjet"])){
  										echo "&uvjet=" . $_GET["uvjet"];
  									}?>">Promjeni</a>
  									<?php if($red->clan===0): ?>|
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
  					<ul class="pagination text-center" role="navigation" aria-label="Pagination">
					  <li class="pagination-previous"><a href="?stranica=<?php echo $stranica-1; ?>&uvjet=<?php echo $uvjet; ?>" aria-label="Prethodna stranica">Prethodna</a></li>
					  <li class="current"> <?php echo $stranica . " / " . $ukupnoStranica; ?></li>
					  <li class="pagination-next"><a href="?stranica=<?php echo $stranica+1; ?>&uvjet=<?php echo $uvjet; ?>" aria-label="Sljedeća stranica">Sljedeća</a></li>
					</ul>
  				</div>
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php' ?>
  	</body>
</html>
