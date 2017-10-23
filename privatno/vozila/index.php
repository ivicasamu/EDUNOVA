<?php
include_once '../../konfiguracija.php';
provjeraLogin();
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
$stranica = 1;
if (isset($_GET["stranica"])) {
	if ($_GET["stranica"] > 0) {
		$stranica = $_GET["stranica"];
	}
}
if (isset($_SESSION["logiran"] -> rezultata_po_stranici)) {
	$rezultataPoStranici = $_SESSION["logiran"] -> rezultata_po_stranici;
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
							<a href="unos.php" class="button expanded">DODAJ NOVO VOZILO</a>
						</div>
					</div>
					<?php
					$uvjetUpit = "%" . $uvjet . "%";
					$izraz = $veza -> prepare("select count(sifra) from vozilo where concat(reg_oznaka, proizvodac, godina_proizvodnje) like :uvjet");
					$izraz -> execute(array("uvjet" => $uvjetUpit));
					$ukupnoStranica = ceil($izraz -> fetchColumn() / $rezultataPoStranici);
					if ($stranica > $ukupnoStranica) {
						$stranica = $ukupnoStranica;
					}
					?>
					<div>
						<?php
						include '../../predlosci/paginator.php';
						?>
					</div>
					<table class="hover unstriped">
						<thead>
							<tr>
								<th>DVD</th>
								<th>Vrsta vozila</th>
								<th>Registarska oznaka</th>
								<th>Naziv</th>
								<th>Proizvođač</th>
								<th>Godina proizvodnje</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$izraz = $veza->prepare("select a.sifra, a.dvd, a.vrsta, a.reg_oznaka, a.naziv as nazivVozilo, a.proizvodac, 
														a.godina_proizvodnje, b.naziv as nazivDvd, 
														concat (c.vrsta_vozila,'; ', c.podvrsta_vozila, '; ', c.podpodvrsta_vozila) as vozilo
														from vozilo a 
														inner join dvd b on a.dvd=b.sifra 
														inner join kategorizacija_vozila c on a.vrsta=c.sifra
														where concat(a.reg_oznaka, a.proizvodac, a.godina_proizvodnje) like :uvjet
														order by b.naziv
														limit " .(($rezultataPoStranici*$stranica)-$rezultataPoStranici) . "," .$rezultataPoStranici);					
								$izraz -> execute(array("uvjet"=>$uvjetUpit));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
							?>
							<tr>
								<td data-label="DVD"><?php echo $red->nazivDvd; ?></td>
								<td data-label="Vrsta"><?php echo $red->vozilo; ?></td>
								<td data-label="Registarska oznaka"><?php echo $red->reg_oznaka; ?></td>
								<td data-label="Naziv"><?php echo $red->nazivVozilo; ?></td>
								<td data-label="Model"><?php echo $red->proizvodac; ?></td>
								<td data-label="Godina proizvodnje"><?php echo date("Y",strtotime ($red->godina_proizvodnje)); ?></td>
								<td data-label="Akcija">
									<a href="promjena.php?sifra=<?php echo $red->sifra;?>">
										<i class="step fi-page-edit size-72" title="Promjena"></i>
									</a>
									<a onclick="return confirm('Sigurno obrisati?');" href="brisanje.php?sifra=<?php echo $red->sifra;?>">
										<i class="step fi-page-delete size-72" title="Brisanje"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
					<?php
						include '../../predlosci/paginator.php';
					?>
				</div>
			</div>
		</div>

		<?php include_once '../../predlosci/podnozje.php'; ?>
		<?php include_once '../../predlosci/skripte.php' ?>
	</body>
</html>
