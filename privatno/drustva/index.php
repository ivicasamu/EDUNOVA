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
							<a href="unos.php" class="button expanded">DODAJ NOVO DRUŠTVO</a>
						</div>
					</div>
					<?php  
						$uvjetUpit = "%" . $uvjet . "%";
						$izraz=$veza->prepare("select count(*) from dvd where concat(vzo, naziv, mjesto) like :uvjet");
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
								<th>VZO</th>
								<th>Naziv</th>
								<th>OIB</th>
								<th>Matični broj</th>
								<th>Mjesto</th>
								<th>Ulica</th>
								<th>Godina osnivanja</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php
							
								$izraz = $veza->prepare("select sifra, vzo, naziv, oib, mb, mjesto, ulica, godina_osnivanja from dvd 
														where concat(vzo, naziv, mjesto) like :uvjet
														limit " . (($rezultataPoStranici*$stranica)-$rezultataPoStranici) . ", " . $rezultataPoStranici);					
								$izraz -> execute(array("uvjet"=>$uvjetUpit));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
							?>
							<tr>
								<td data-label="VZO"><?php echo $red->vzo; ?></td>
								<td data-label="Naziv">
									<span style="cursor: pointer;" title="Klikni za članove" id="n_<?php echo $red->sifra; ?>" class="naziv">
										<?php echo $red->naziv; ?>
									</span>
								</td>
								<td data-label="OIB"><?php echo $red->oib; ?></td>
								<td data-label="MB"><?php echo $red->mb; ?></td>
								<td data-label="Mjesto"><?php echo $red->mjesto; ?></td>
								<td data-label="Ulica"><?php echo $red->ulica; ?></td>
								<td data-label="Godina osnivanja"><?php echo date("Y",strtotime($red->godina_osnivanja)); ?></td>
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
					<?php include '../../predlosci/paginator.php'; ?>
				</div>
			</div>
		</div>

		<?php include_once '../../predlosci/podnozje.php'; ?>
		<div class="reveal" id="revealClanovi" data-reveal>
		  <h1>Članovi</h1>
		  <ol id="clanovi">
		  	
		  </ol>
		  <button class="close-button" data-close aria-label="Close modal" type="button">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php include_once '../../predlosci/skripte.php' ?>
		<script>
			$(".naziv").click(function(){
				$("#clanovi").html("Klik za polaznike");
				var element = $(this);
				var id = element.attr("id").split("_")[1];
				$.get("clanoviDrustva.php?drustvo=" + id, function(vratioServer){
					$("#clanovi").html(vratioServer);
					$("#revealClanovi").foundation('open');
				});
				return false;
			});
		</script>
	</body>
</html>
