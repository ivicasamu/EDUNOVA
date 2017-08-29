<?php include_once '../../konfiguracija.php'; 
provjeraLogin();
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
$stranica = 1;
if(isset($_GET["stranica"])){
	if($_GET["stranica"]>0){
		$stranica = $_GET["stranica"];
	}
}
if(isset($_SESSION["logiran"]->rezultata_po_stranici)){
	$rezultataPoStranici = $_SESSION["logiran"]->rezultata_po_stranici;
}

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
      						<a href="intervencijeUnos.php" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">DODAJ NOVO INTERVENCIJU</a>
      					</div>
      				</form>
      			</div>
      		</div>
      		</form>
      		<table class="table table-bordered">
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
	  					$uvjetUpit="%" . $uvjet . "%";
						$izraz=$veza->prepare("select count(*) from intervencija where concat(vrsta_intervencije, mjesto, izvjesce_popunio) like :uvjet");
						$izraz->execute(array("uvjet"=>$uvjetUpit));
						$ukupnoStranica = ceil($izraz->fetchColumn()/$rezultataPoStranici);
						if($stranica>$ukupnoStranica){
							$stranica = $ukupnoStranica;
						}
	  					$izraz = $veza->prepare("select a.sifra, a.datum_nastanka, a.vrsta_intervencije, a.mjesto,a.dojava, a.izvjesce_popunio, 
	  					count(b.dvd_clan) as vatrogasac 
	  					from intervencija a left join intervencija_clan b on a.sifra=b.intervencija  
	  					where a.vrsta_intervencije like :uvjet 
	  					group by a.sifra
	  					limit " .(($rezultataPoStranici*$stranica)-$rezultataPoStranici) . "," .$rezultataPoStranici);
						$izraz -> execute(array("uvjet"=>$uvjetUpit));
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
  									if(isset($_GET["uvjet"])){echo "&uvjet=" . $_GET["uvjet"];}?>" class="badge badge-success">Promjeni</a>
  								<?php if($red->vatrogasac===0): ?>
  									<a href="intervencijeBrisanje.php?sifra=<?php echo $red->sifra; 
  										if(isset($_GET["uvjet"])){echo"&uvjet=". $_GET["uvjet"];}?>" class="badge badge-danger">Obriši</a>
  								<?php endif; ?>
  								</td>
  						</tr>
  						<?php endforeach; ?>				
				</tbody>
      		</table>
      		<?php if($ukupnoStranica>1): ?>
	      		<nav aria-label="Page navigation example">
				  <ul class="pagination justify-content-center">
				  	<li class="page-item 
				  		<?php if(!isset($_GET["stranica"]) || $_GET["stranica"]<=1){
				  			echo disabled;
				  		} ?>">
				      <a class="page-link" href="?stranica=<?php echo $stranica-1; ?>&uvjet=<?php echo $uvjet; ?>" aria-label="Prethodna stranica">Prethodna</a>
				    </li>
				    <?php if(isset($_GET["stranica"])): ?>
					    <?php if($_GET["stranica"]>1): ?>
						    <li class="page-item">
						    	<a class="page-link" href="?stranica=<?php echo $stranica-1; ?>&uvjet=<?php echo $uvjet; ?>"><?php echo $stranica-1 ?></a>
						    </li>
					    <?php endif; ?>
				    <?php endif; ?>
				    <li class="page-item active">
				    	<a class="page-link" href="?stranica=<?php echo $stranica; ?>&uvjet=<?php echo $uvjet; ?>"><?php echo $stranica ?></a>
				    </li>
				    <?php if(isset($_GET["stranica"])): ?>
					    <?php if($_GET["stranica"]<$ukupnoStranica): ?>
						    <li class="page-item">
						    	<a class="page-link" href="?stranica=<?php echo $stranica+1; ?>&uvjet=<?php echo $uvjet; ?>"><?php echo $stranica+1 ?></a>
						    </li>
						<?php endif; ?>
				    <?php endif; ?>
				    <li class="page-item 
				    	<?php if($_GET["stranica"]>$ukupnoStranica-1){
				  			echo disabled;
				  		} ?>">
				      <a class="page-link" href="?stranica=<?php echo $stranica+1; ?>&uvjet=<?php echo $uvjet; ?>" aria-label="Sljedeća stranica">Sljedeća</a>
				    </li>

				  </ul>
				</nav>
			<?php endif; ?>
        </div>
    </div>
    <?php include_once '../../predlosci/podnozje.php' ?>
    <?php include_once '../../predlosci/skripte.php'; ?>
  </body>
</html>
