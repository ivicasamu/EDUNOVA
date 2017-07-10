<?php include_once '../konfiguracija.php'; 
provjeraLogin();
?>
<?php  
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
		<?php include_once '../predlosci/head.php'; ?>
  </head>
  <body>
  		<?php include_once'../predlosci/izbornik.php'; ?>
  		<div class="row">
  			<div class="large-12 columns">
  				<div class="callout">
  					<div clas="row">
  						<div class="large-5 medium-10 small-10 columns">
  							<form method="GET">
  								<input type="text" placeholder="dio naziva" name="uvjet" value="<?php echo $uvjet; ?>" />
  							</form>
  						</div>
  						<div class="large-6 medium-12 small-12 columns">
  							<a href="unos.php" class="success button expanded">Dodaj člana</a>
  						</div>
  						<table>
  							<thead>
  								<tr>
  									<th>Šifra</th>
  									<th>Ime</th>
  									<th>Prezime</th>
  									<th>OIB</th>
  									<th>Datum rođenja</th>
  									<th>Ulica</th>
  									<th>Mjesto</th>
  									<th>Telefon</th>
  									<th>Mail</th>
  									<th>Datum učlanjenja</th>
  									<th>Čin</th>
  									<th>Funkcija</th>
  								</tr>
  							</thead>
  							<tbody>
  									<?php  
	  									$izraz = $con->prepare("select * from clan where ime like :uvjet");
										$uvjet ="%" . $uvjet . "%";
										$izraz->execute(array("uvjet"=>$uvjet));
										$rezultati = $izraz -> fetchall(PDO::FETCH_OBJ);
										foreach ($rezultati as $red) :
									?>
									<tr>
										<td><?php echo $red->sifra; ?></td>
										<td><?php echo $red->ime; ?></td>
										<td><?php echo $red->prezime; ?></td>
										<td><?php echo $red->oib; ?></td>
										<td><?php echo $red->datum_rodenja; ?></td>
										<td><?php echo $red->ulica; ?></td>
										<td><?php echo $red->mjesto; ?></td>
										<td><?php echo $red->telefon; ?></td>
										<td><?php echo $red->mail; ?></td>
										<td><?php echo $red->datum_uclanjenja; ?></td>
										<td><?php echo $red->cin; ?></td>
										<td><?php echo $red->funkcija; ?></td>
									</tr>
									<?php  
										endforeach;
									?>
  							</tbody>
  						</table>
  					</div>
  				</div>
  			</div>
  		</div>
  		<?php include_once '../predlosci/podnozje.php' ?>
		<?php include_once '../predlosci/skripte.php'; ?>
  </body>
</html>
