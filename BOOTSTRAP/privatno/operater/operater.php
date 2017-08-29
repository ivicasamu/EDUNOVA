<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");
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
      							<input type="text" class="form-control-lg" placeholder="unesite dio naziva" aria-label="dio naziva" name="uvjet" 
      							value="<?php echo $uvjet ?>">
      						</span>
      					</div>
      					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
      						<a href="operaterUnos.php" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">DODAJ NOVOG OPERATERA</a>
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
								<a href="operaterPromjena.php?sifra=<?php echo $red->sifra;?>" class="badge badge-success" >Promjena podataka operatera</a></br>
								<a href="operaterLozinka.php?sifra=<?php echo $red->sifra;?>" class="badge badge-primary">Promjena lozinke</a></br>
								<a href="operaterBrisanje.php?sifra=<?php echo $red->sifra;?>" class="badge badge-danger">Obriši</a>
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
