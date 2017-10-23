<?php
include_once '../../konfiguracija.php';
provjeraLogin();
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
$stranica=1;
if(isset($_GET["stranica"])){
	if ($_GET["stranica"]>0){
		$stranica=$_GET["stranica"];
	}
}
if(isset($_SESSION["logiran"]->rezultata_po_stranici)){
	$rezultataPoStranici = $_SESSION["logiran"]->rezultata_po_stranici;
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/zaglavlje.php'
		?>
	</head>
	<body>
		<?php include_once '../../predlosci/izbornik.php'
		?>
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
							<a href="unos.php" class="button expanded">DODAJ NOVOG ČLANA</a>
						</div>
					</div>
					<?php  
						$uvjetUpit = "%" . $uvjet . "%";
						$izraz=$veza->prepare("select count(*) from clan where concat(ime,' ', prezime)  like :uvjet");
						$izraz->execute(array("uvjet"=>$uvjetUpit));
						$ukupnoPolaznika=$izraz->fetchColumn();
						$ukupnoStranica= ceil($ukupnoPolaznika/$rezultataPoStranici);
						if($stranica>$ukupnoStranica){
							$stranica=$ukupnoStranica;
						}
					
					?>
					<div>
						<?php include '../../predlosci/paginator.php'; ?>
					</div>

					<table class="hover unstriped">
						<thead>
							<tr>
								<th>Ime i prezime</th>
								<th>Datum rođenja</th>
								<th>Adresa</th>
								<th>Telefon</th>
								<th>Datum učlanjenja</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php
							
								$izraz = $veza->prepare("select sifra, concat(ime,' ', prezime) as imePrezime, datum_rodenja, concat(mjesto, ', ', ulica) as adresa, 
														telefon, datum_uclanjenja from clan 
														where concat(ime,' ', prezime) like :uvjet
														limit " . (($rezultataPoStranici*$stranica)-$rezultataPoStranici) . ", " . $rezultataPoStranici);					
								$izraz -> execute(array("uvjet"=>$uvjetUpit));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
							?>
							<tr>
								<td data-label="Ime i prezime"><?php echo $red->imePrezime; ?></td>
								<td data-label="Datum rođenja"><?php echo date("d.m.Y",strtotime($red->datum_rodenja)); ?></td>
								<td data-label="Adresa"><?php echo $red->adresa; ?></td>
								<td data-label="Telefon"><?php echo $red->telefon; ?></td>
								<td data-label="Datum ucnanjenja"><?php echo date("d.m.Y",strtotime($red->datum_uclanjenja)); ?></td>
								<td data-label="Akcija">
									<a href="promjena.php?sifra=<?php echo $red->sifra;?>">
										<i class="step fi-page-edit size-72" title="Promjena"></i>
									</a>
									<a onclick="return confirm('Sigurno obrisati?');" href="brisanje.php?sifra=<?php echo $red->sifra;?>&stranica=<?php echo $_GET["stranica"] ?>&uvjet=<?php echo $_GET["uvjet"] ?>">
										<i class="step fi-page-delete size-72" title="Brisanje"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
					<?php include '../../predlosci/paginator.php'; ?>
				</div>
			</div>
		</div>

		<?php include_once '../../predlosci/podnozje.php'; ?>
		<?php include_once '../../predlosci/skripte.php' ?>
	</body>
</html>
