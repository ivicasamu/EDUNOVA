<?php
include_once '../../konfiguracija.php';
provjeraLogin();
provjeraUloga("Administrator");
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
							<a href="unos.php" class="button expanded">DODAJ NOVU VRSTU INTERVENCIJE</a>
						</div>
					</div>
					<?php
					$uvjetUpit = "%" . $uvjet . "%";
					$izraz = $veza -> prepare("select count(*) from vrsta_intervencije where concat (vrsta_intervencije, podvrsta_intervencije,
												podpodvrsta_intervencije, podpodpodvrsta_intervencije) like :uvjet");
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
								<th>Vrsta intervencije</th>
								<th>Pod vrsta intervencije</th>
								<th>PodPod vrsta intervencije</th>
								<th>PodPodPod vrsta intervencije</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$izraz = $veza->prepare("select sifra, vrsta_intervencije, podvrsta_intervencije, podpodvrsta_intervencije, 
														podpodpodvrsta_intervencije, count(*) from vrsta_intervencije 
														where concat (vrsta_intervencije, podvrsta_intervencije, podpodvrsta_intervencije, podpodpodvrsta_intervencije) like :uvjet
														group by sifra order by vrsta_intervencije, podvrsta_intervencije
														limit " .(($rezultataPoStranici*$stranica)-$rezultataPoStranici) . "," .$rezultataPoStranici);					
								$izraz -> execute(array("uvjet"=>$uvjetUpit));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
							?>
							<tr>
								<td data-label="Vrsta intervencije"><?php echo $red->vrsta_intervencije; ?></td>
								<td data-label="Pod vrsta intervencije"><?php echo $red->podvrsta_intervencije; ?></td>
								<td data-label="PodPod vrsta intervencije"><?php echo $red->podpodvrsta_intervencije; ?></td>
								<td data-label="PodPodPod vrsta intervencije"><?php echo $red->podpodpodvrsta_intervencije; ?></td>
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
