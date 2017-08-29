<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
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
      						<a href="drustvoUnos.php" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">DODAJ NOVO DRUŠTVO</a>
      					</div>
      				</form>
      			</div>
      		</div>
      		</form>
      		<table class="table table-bordered">
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
  								}?>" class="badge badge-success">Promjeni</a>
  								<?php if($red->clan===0): ?>
  								<a href="drustvoBrisanje.php?sifra=<?php echo $red->sifra; 
  								if(isset($_GET["uvjet"])){
  									echo"&uvjet=". $_GET["uvjet"];
  								}?>" class="badge badge-danger">Obriši</a>
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
