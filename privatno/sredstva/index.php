<?php
include_once '../../konfiguracija.php';
provjeraLogin();
provjeraUloga("Administrator");
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";

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
							<a href="unos.php" class="button expanded">DODAJ NOVO SREDSTVO</a>
						</div>
					</div>
					<table class="hover unstriped">
						<thead>
							<tr>
								<th>Šifra</th>
								<th>Naziv sredstva</th>
								<th>Jedinična mjera</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$uvjet = "%" . $uvjet . "%";
								$izraz = $veza->prepare("select sifra, naziv_sredstva, jedinicna_mjera from sredstvo 
														where naziv_sredstva like :uvjet order by naziv_sredstva");					
								$izraz -> execute(array("uvjet"=>$uvjet));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
							?>
							<tr>
								<td data-label="Šifra"><?php echo $red->sifra; ?></td>
								<td data-label="Vrsta intervencije"><?php echo $red->naziv_sredstva; ?></td>
								<td data-label="Pod vrsta intervencije"><?php echo $red->jedinicna_mjera; ?></td>
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
				</div>
			</div>
		</div>

		<?php include_once '../../predlosci/podnozje.php'; ?>
		<?php include_once '../../predlosci/skripte.php' ?>
	</body>
</html>
