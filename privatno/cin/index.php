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
			<div class="large-6 medium-6 small-12 columns large-centered">
				<div class="callout">
					<div class="row">
						<div class="large-6 medium-6 small-12 columns">
							<form method="GET">
								<input type="text" placeholder="dio naziva" name="uvjet"
								value="<?php echo $uvjet; ?>" />
							</form>
						</div>
						<div class="large-6 medium-6 small-12 columns">
							<a href="unos.php" class="button expanded">DODAJ NOVI ČIN</a>
						</div>
					</div>
					<table class="hover unstriped">
						<thead>
							<tr>
								<th>Čin u vatrogastvu</th>
								<th>Akcija</th>
							</tr>
						</thead>				
						<tbody>
							<?php
								$uvjetUpit="%" . $uvjet . "%";
								$izraz = $veza->prepare("select sifra, naziv_cina from cin
								where naziv_cina like :uvjet");
								$izraz -> execute(array("uvjet"=>$uvjetUpit));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
							?>
							<tr>
								<td data-label="Čin u vatrogastvu"><?php echo $red->naziv_cina; ?></td>
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

				<?php
	include_once '../../predlosci/podnozje.php';
				?>
				<?php include_once '../../predlosci/skripte.php'
				?>
	</body>
</html>
