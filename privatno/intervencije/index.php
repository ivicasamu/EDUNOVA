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
							<a href="unos.php" class="button expanded">DODAJ NOVU INTERVENCIJU</a>
						</div>
					</div>
					<?php  
						$uvjetUpit = "%" . $uvjet . "%";
						$izraz=$veza->prepare("select count(a.sifra) from intervencija a 
												inner join vrsta_intervencije b on a.vrsta_intervencije=b.sifra 
												where concat(b.vrsta_intervencije,' ', a.mjesto,' ', a.izvjesce_popunio) 
												like :uvjet");
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
								<th>Vrsta intervencije</th>
								<th>Datum dojave</th>
								<th>Mjesto</th>
								<th>Voditelj intervencije</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php
							
								$izraz = $veza->prepare("select a.sifra, b.vrsta_intervencije, a.datum_dojave, a.datum_zavrsetka, a.mjesto,
														a.izvjesce_popunio from intervencija a 
														inner join vrsta_intervencije b on a.vrsta_intervencije=b.sifra
														where concat(b.vrsta_intervencije,' ', a.mjesto, ' ', a.izvjesce_popunio) like :uvjet order by a.sifra
														limit " . (($rezultataPoStranici*$stranica)-$rezultataPoStranici) . ", " . $rezultataPoStranici);					
								$izraz -> execute(array("uvjet"=>$uvjetUpit));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultati as $red):
							?>
							<tr>
								<td data-label="Vrsta intervencije">
									<span style="cursor: pointer;" title="Klikni za sudionike" id="n_<?php echo $red->sifra; ?>" class="vrsta_intervencije">
										<?php echo $red->vrsta_intervencije; ?>
									</span>
								</td>
								<td data-label="Datum dojave"><?php echo date("d.m.Y H:i:s",strtotime($red->datum_dojave)); ?></td>
								<td data-label="Mjesto"><?php echo $red->mjesto; ?></td>
								<td data-label="Voditelj intervencije"><?php echo $red->izvjesce_popunio; ?></td>
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
		<div class="reveal" id="revealDrustva" data-reveal>
		  <h4>Sudionici</h4>
		  <ol id="drustva">
		  	
		  </ol>
		  <button class="close-button" data-close aria-label="Close modal" type="button">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php include_once '../../predlosci/skripte.php' ?>
		<script>
			$(".vrsta_intervencije").click(function(){
				$("#drustva").html("Klik za sudionike");
				var element = $(this);
				var id = element.attr("id").split("_")[1];
				$.get("intervencijeDrustva.php?intervencija=" + id, function(vratioServer){
					$("#drustva").html(vratioServer);
					$("#revealDrustva").foundation('open');
				});
				return false;
			});
		</script>
	</body>
</html>
