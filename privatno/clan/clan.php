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
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/zaglavlje.php' ?>
	</head>
  	<body>
  		<?php include_once '../../predlosci/izbornik.php' ?>
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
  							<a href="clanUnos.php" class="button expanded">DODAJ NOVOG ČLANA</a>
  						</div>
  					</div>
  							<?php  
	  							$uvjetUpit="%" . $uvjet . "%";
								$izraz=$veza->prepare("select count(*) from clan where concat (ime, prezime, mjesto) like :uvjet");
								$izraz->execute(array("uvjet"=>$uvjetUpit));
								$ukupnoStranica = ceil($izraz->fetchColumn()/$rezultataPoStranici);
								if($stranica>$ukupnoStranica){
									$stranica = $ukupnoStranica;
								}
							?>
							<div class="hide-for-large">
								<?php include '../../predlosci/paginator.php'; ?>
							</div>
							<div class="row">
	  						<?php	
	  							$izraz = $veza->prepare("select  a.sifra, a.ime,a.prezime, a.oib, a.datum_rodenja, 
	  							a.cin, a.funkcija, concat(a.mjesto,', ', a.ulica) as adresa, count(b.clan) as clan from clan a 
	  							left join dvd_clan b on a. sifra=b.clan 
	  							where concat (ime, prezime, mjesto) like :uvjet 
	  							group by a.sifra, a.ime, a.prezime
	  							limit " .(($rezultataPoStranici*$stranica)-$rezultataPoStranici) . "," .$rezultataPoStranici);
								$izraz -> execute(array("uvjet"=>$uvjetUpit));
								$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ); 
								foreach ($rezultati as $red){
									include 'profil.php';
								}
  							?>
  							</div>
  						<?php include '../../predlosci/paginator.php'; ?>
  				</div>
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php' ?>
  	</body>
</html>
