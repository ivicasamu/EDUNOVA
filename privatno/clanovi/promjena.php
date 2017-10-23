	<?php include_once '../../konfiguracija.php'; 
provjeraLogin();

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from clan where sifra=:sifra");
	$izraz -> execute(array("sifra"=>$_GET["sifra"]));
	$entitet = $izraz -> fetch(PDO::FETCH_OBJ);
	if($entitet->oib==""){
		$entitet->oib=dohvatiOIB();
	}
}

if(isset($_POST["promjena"])){
	$izraz = $veza -> prepare("update clan set ime=:ime, prezime=:prezime, oib=:oib, datum_rodenja=:datum_rodenja, ulica=:ulica, mjesto=:mjesto, 
								telefon=:telefon, mail=:mail, datum_uclanjenja=:datum_uclanjenja where sifra=:sifra");
	$izraz -> execute(array(
	"ime"=>$_POST["ime"],
	"prezime"=>$_POST["prezime"],
	"oib"=>$_POST["oib"],
	"datum_rodenja"=>$_POST["datum_rodenja"],
	"ulica"=>$_POST["ulica"],
	"mjesto"=>$_POST["mjesto"],
	"telefon"=>$_POST["telefon"],
	"mail"=>$_POST["mail"],
	"datum_uclanjenja"=>$_POST["datum_uclanjenja"],
	"sifra"=>$_POST["sifra"]
	));	
	
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["ime"]==""){
		$izraz = $veza -> prepare("delete from clan where sifra=:sifra");
		$izraz->execute(array("sifra"=>$_POST["sifra"] ));
	}
	header("location: index.php");
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/zaglavlje.php' ?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	</head>
  	<body>
  		<?php include_once '../../predlosci/izbornik.php' ?>
  		<div class="row">
  			<div class="large-6 medium-12 small-12 columns large-centered">
  				<form method="POST">
  					<fieldset class="fieldset">
  						<legend>UNOSNI PODACI</legend>
  						
  						<label id="ime" for="ime">Ime</label>
  						<input name="ime" id="ime" type="text" value="<?php echo $entitet->ime; ?>" />
  						
  						<label id="prezime" for="prezime">Prezime</label>
  						<input name="prezime" id="prezime" type="text" value="<?php echo $entitet->prezime; ?>" />
  						
  						<label id="oib" for="oib">OIB</label>
  						<input name="oib" id="oib" type="number" value="<?php echo $entitet->oib; ?>" />
  						
  						<label id="datum_rodenja" for="datum_rodenja">Datum rođenja</label>
  						<input name="datum_rodenja" id="datum_rodenja" type="date" value="<?php echo date("Y-m-d",strtotime($entitet->datum_rodenja)); ?>" />
  						
  						<fieldset class="fieldset">
						<legend>Članstvo u društvima</legend>
						<input id="uvjetDvd" type="text" placeholder="dio naziva drustva" />
	  						<table>
								<thead>
									<tr>
										<th>Društvo</th>
										<th>Akcija</th>
									</tr>
								</thead>
								<tbody id="clanDvd">
									<?php 
									$izraz=$veza->prepare("select c.sifra, c.naziv
														 from clan a inner join dvd_clan b on a.sifra=b.clan
														 inner join dvd c on c.sifra=b.dvd where a.sifra=" . $entitet->sifra);
									$izraz->execute();
									$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
									foreach ($rezultati as $dvd) :
											?>
											<tr>
												<td data-label="Društvo"><?php echo $dvd->naziv ?></td>
												<td><i id="b_<?php echo $dvd->sifra; ?>" title="Brisanje" class="step fi-page-delete size-48 brisanjeDvd"></i></td>
											</tr>
											<?php endforeach; ?>
								</tbody>
							</table>
						</fieldset>
  						
  						<label id="ulica" for="ulica">Ulica</label>
  						<input name="ulica" id="ulica" type="text" value="<?php echo $entitet->ulica; ?>" />
  						
  						<label id="mjesto" for="mjesto">Mjesto</label>
  						<input name="mjesto" id="mjesto" type="text" value="<?php echo $entitet->mjesto; ?>" />
  						
  						<label id="telefon" for="telefon">Telefon</label>
  						<input name="telefon" id="telefon" type="text" value="<?php echo $entitet->telefon; ?>" />
  						
  						<label id="mail" for="mail">Mail</label>
  						<input name="mail" id="mail" type="text" value="<?php echo $entitet->mail; ?>" />
  						
  						<label id="datum_uclanjenja" for="datum_uclanjenja">Datum učlanjenja</label>
  						<input name="datum_uclanjenja" id="datum_uclanjenja" type="date" 
  						value="<?php echo date("Y-m-d",strtotime($entitet->datum_uclanjenja)); ?>" />
  						
  						<fieldset class="fieldset">
						<legend>Činovi</legend>
						<input id="uvjetCin" type="text" placeholder="dio naziva čina" />
	  						<table>
								<thead>
									<tr>
										<th>Čin</th>
										<th>Akcija</th>
									</tr>
								</thead>
								<tbody id="clanCin">
									<?php 
									$izraz=$veza->prepare("select c.sifra, c.naziv_cina from clan a inner join clan_cin b on a.sifra=b.clan
															inner join cin c on c.sifra=b.cin where a.sifra=" . $entitet->sifra);
									$izraz->execute();
									$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
									foreach ($rezultati as $cin) :
											?>
											<tr>
												<td data-label="Čin"><?php echo $cin->naziv_cina ?></td>
												<td><i id="b_<?php echo $cin->sifra; ?>" title="Brisanje" class="step fi-page-delete size-48 brisanjeCin"></i></td>
											</tr>
											<?php endforeach; ?>
								</tbody>
							</table>
						</fieldset>
						
						<fieldset class="fieldset">
						<legend>Funkcije</legend>
						<input id="uvjetFunkcija" type="text" placeholder="dio naziva funkcije" />
	  						<table>
								<thead>
									<tr>
										<th>Funkcija</th>
										<th>Akcija</th>
									</tr>
								</thead>
								<tbody id="clanFunkcija">
									<?php 
									$izraz=$veza->prepare("select c.sifra, c.naziv_funkcije from clan a inner join clan_funkcija b on a.sifra=b.clan
															inner join funkcija c on c.sifra=b.funkcija where a.sifra=" . $entitet->sifra);
									$izraz->execute();
									$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
									foreach ($rezultati as $funkcija) :
											?>
											<tr>
												<td data-label="Funkcija"><?php echo $funkcija->naziv_funkcije ?></td>
												<td><i id="b_<?php echo $funkcija->sifra; ?>" title="Brisanje" class="step fi-page-delete size-48 brisanjeFunkcija"></i></td>
											</tr>
											<?php endforeach; ?>
								</tbody>
							</table>
						</fieldset>
  						
  						<input name="promjena" type="submit" class="button expanded" value="<?php 
							if($entitet->ime==""){
								echo "Dodaj novi";
							}else{
								echo "Promjeni";
							}
							
							?>"/>
						<input type="hidden" name="sifra" value="<?php echo $entitet->sifra; ?>" />
						<input name="odustani" type="submit" class="alert button expanded" value="Odustani" />
  					</fieldset>
  				</form>	
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
    	<?php include_once '../../predlosci/skripte.php'; ?>
    	<?php include_once 'clanoviSkripte.php'; ?>
  	</body>
</html>
