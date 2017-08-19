<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
$uvjet = isset($_GET["uvjet"])? $_GET["uvjet"] : "";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<?php include_once '../../predlosci/zaglavlje.php' ?>
  </head>

  <body>
    	<?php include_once '../../predlosci/izbornik.php' ?>
    <div class="container">
      	<div class="starter-template">
      		<div class="container">
      			<div class="row">
      				<form method="GET" class="form-inline">
      					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
      						<span>
      							<input type="text" class="form-control-lg" placeholder="unesite dio imena člana" aria-label="dio naziva" name="uvjet" 
      							value="<?php echo $uvjet ?>">
      						</span>
      					</div>
      					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
      						<a href="clanUnos.php" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">DODAJ NOVOG ČLANA</a>
      					</div>
      				</form>
      			</div>
      		</div>
      		
      			
      				
      				
      				
      			
      		</form>
      		<table class="table table-bordered">
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
        </div>
    </div>
    <?php include_once '../../predlosci/podnozje.php' ?>
    <?php include_once '../../predlosci/skripte.php'; ?>
  </body>
</html>
