<?php include_once '../../konfiguracija.php'; 
provjeraLogin();

if(isset($_GET["sifra"])){
	$izraz = $veza->prepare("select * from intervencija where sifra=:sifra");
	$izraz -> execute(array("sifra"=>$_GET["sifra"]));
	$entitet = $izraz -> fetch(PDO::FETCH_OBJ);
}

if(isset($_POST["promjena"])){
	$izraz = $veza -> prepare("update intervencija set vrsta_intervencije=:vrsta_intervencije, datum_nastanka=:datum_nastanka, datum_dojave=:datum_dojave, 
								datum_dolaska=:datum_dolaska, datum_lokalizacije=:datum_lokalizacije, datum_zavrsetka=:datum_zavrsetka, mjesto=:mjesto,
								ulica=:ulica, vlasnik=:vlasnik, osteceno=:osteceno,prijedeno_km=:prijedeno_km, povrijedenih_osoba=:povrijedenih_osoba, 
								umrlih_osoba=:umrlih_osoba, opis=:opis, izvjesce_popunio=:izvjesce_popunio where sifra=:sifra");
	$izraz -> execute(array(
	"vrsta_intervencije"=>$_POST["vrsta_intervencije"],
	"datum_nastanka"=>$_POST["datum_nastanka"],
	"datum_dojave"=>$_POST["datum_dojave"],
	"datum_dolaska"=>$_POST["datum_dolaska"],
	"datum_lokalizacije"=>$_POST["datum_lokalizacije"],
	"datum_zavrsetka"=>$_POST["datum_zavrsetka"],
	"mjesto"=>$_POST["mjesto"],
	"ulica"=>$_POST["ulica"],
	"vlasnik"=>$_POST["vlasnik"],
	"osteceno"=>$_POST["osteceno"],
	"prijedeno_km"=>$_POST["prijedeno_km"],
	"povrijedenih_osoba"=>$_POST["povrijedenih_osoba"],
	"umrlih_osoba"=>$_POST["umrlih_osoba"],
	"opis"=>$_POST["opis"],
	"izvjesce_popunio"=>$_POST["izvjesce_popunio"],
	"sifra"=>$_POST["sifra"]
	));	
	
	header("location: index.php");
}

if(isset($_POST["promjenaKolicinaSredstva"])){
	$izraz = $veza -> prepare("update intervencija set vrsta_intervencije=:vrsta_intervencije, datum_nastanka=:datum_nastanka, datum_dojave=:datum_dojave, 
								datum_dolaska=:datum_dolaska, datum_lokalizacije=:datum_lokalizacije, datum_zavrsetka=:datum_zavrsetka, mjesto=:mjesto,
								ulica=:ulica, vlasnik=:vlasnik, osteceno=:osteceno,prijedeno_km=:prijedeno_km, povrijedenih_osoba=:povrijedenih_osoba, 
								umrlih_osoba=:umrlih_osoba, opis=:opis, izvjesce_popunio=:izvjesce_popunio where sifra=:sifra");
	$izraz -> execute(array(
	"vrsta_intervencije"=>$_POST["vrsta_intervencije"],
	"datum_nastanka"=>$_POST["datum_nastanka"],
	"datum_dojave"=>$_POST["datum_dojave"],
	"datum_dolaska"=>$_POST["datum_dolaska"],
	"datum_lokalizacije"=>$_POST["datum_lokalizacije"],
	"datum_zavrsetka"=>$_POST["datum_zavrsetka"],
	"mjesto"=>$_POST["mjesto"],
	"ulica"=>$_POST["ulica"],
	"vlasnik"=>$_POST["vlasnik"],
	"osteceno"=>$_POST["osteceno"],
	"prijedeno_km"=>$_POST["prijedeno_km"],
	"povrijedenih_osoba"=>$_POST["povrijedenih_osoba"],
	"umrlih_osoba"=>$_POST["umrlih_osoba"],
	"opis"=>$_POST["opis"],
	"izvjesce_popunio"=>$_POST["izvjesce_popunio"],
	"sifra"=>$_POST["sifra"]
	));	
	
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["izvjesce_popunio"]===""){
		$izraz = $veza -> prepare("delete from intervencija where sifra=:sifra");
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
  			<div class="large-10 columns large-centered">
  				<form method="POST">
  					<fieldset class="fieldset">
  						<legend>UNOSNI PODACI</legend>
  						
  						<div class="large-6 columns">
	  						<label id="izvjesce_popunio" for="izvjesce_popunio">Voditelj intervencije</label>
	  						<input name="izvjesce_popunio" id="izvjesce_popunio" type="text" value="<?php echo $entitet->izvjesce_popunio; ?>" />
	  						
	  						<label for="vrsta_intervencije">Vrsta intervencije</label>
	  						<select name="vrsta_intervencije">
	  						<?php  
	  								$izraz = $veza -> prepare("select sifra, concat(vrsta_intervencije,' - ', podvrsta_intervencije,' - ', podpodvrsta_intervencije,' - ', 
	  															podpodpodvrsta_intervencije) as vrstaIntervencije from vrsta_intervencije order by vrstaIntervencije");
									$izraz->execute();
									$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
									foreach ($rezultati as $red) :
	  							?>
	  							<option <?php  
		  							if($entitet->vrsta_intervencije!="" && $entitet->vrsta_intervencije == $red->sifra){
		  								echo "selected=\"selected\" ";
		  							}
	  							?>value="<?php echo $red->sifra; ?>"><?php echo $red->vrstaIntervencije; ?></option>
	  							<?php endforeach; ?>
	  						</select>
	  						
	  						<label id="datum_nastanka" for="datum_nastanka">Datum nastanka</label>
	  						<input name="datum_nastanka" id="datum_nastanka" type="datetime" placeholder="yyyy-mm-dd hh:mm:ss" value="<?php 
	  						if($entitet->datum_nastanka!=0){
	  							echo date("Y-m-d H:i:s",strtotime($entitet->datum_nastanka)); }?>"/>
	  						
	  						<label id="datum_dojave" for="datum_dojave">Datum dojave</label>
	  						<input name="datum_dojave" id="datum_dojave" type="datetime" placeholder="yyyy-mm-dd hh:mm:ss" value="<?php 
	  						if($entitet->datum_dojave!=0){
	  							echo date("Y-m-d H:i:s",strtotime($entitet->datum_dojave)); }?>" />
	  						
	  						<label id="datum_dolaska" for="datum_dolaska">Datum dolaska</label>
	  						<input name="datum_dolaska" id="datum_dolaska" type="datetime" placeholder="yyyy-mm-dd hh:mm:ss" value="<?php 
	  						if($entitet->datum_dolaska!=0){
	  							echo date("Y-m-d H:i:s",strtotime($entitet->datum_dolaska)); }?>" />
	  						
	  						<label id="datum_lokalizacije" for="datum_lokalizacije">Datum lokalizacije</label>
	  						<input name="datum_lokalizacije" id="datum_lokalizacije" type="datetime" placeholder="yyyy-mm-dd hh:mm:ss" value="<?php 
	  						if($entitet->datum_lokalizacije!=0){
	  							echo date("Y-m-d H:i:s",strtotime($entitet->datum_lokalizacije)); }?>" />
	  						
	  						<label id="datum_zavrsetka" for="datum_zavrsetka">Datum završetka intervencije</label>
	  						<input name="datum_zavrsetka" id="datum_zavrsetka" type="datetime" placeholder="yyyy-mm-dd hh:mm:ss" value="<?php 
	  						if($entitet->datum_zavrsetka!=0){
	  							echo date("Y-m-d H:i:s",strtotime($entitet->datum_zavrsetka)); }?>" />
	  						
	  						<label id="mjesto" for="mjesto">Mjesto</label>
	  						<input name="mjesto" id="mjesto" type="text" value="<?php echo $entitet->mjesto; ?>" />
	  						
	  						<label id="ulica" for="ulica">Ulica i kućni broj</label>
	  						<input name="ulica" id="ulica" type="text" value="<?php echo $entitet->ulica; ?>" />
  						</div>
  						
  						<div class="large-6 columns">
	  						<label id="vlasnik" for="vlasnik">Vlasnik</label>
	  						<input name="vlasnik" id="vlasnik" type="text" value="<?php echo $entitet->vlasnik; ?>" />
	  						
	  						<label id="osteceno" for="osteceno">Ostećeno</label>
	  						<input name="osteceno" id="osteceno" type="text" value="<?php echo $entitet->osteceno; ?>" />
	  							
	  						<label id="prijedeno_km" for="prijedeno_km">Prijeđeno kilometara</label>
	  						<input name="prijedeno_km" id="prijedeno_km" type="number" value="<?php echo $entitet->prijedeno_km; ?>" />
	  							
	  						<label id="povrijedenih_osoba" for="povrijedenih_osoba">Povrijeđeno osoba</label>
	  						<input name="povrijedenih_osoba" id="povrijedenih_osoba" type="number" value="<?php echo $entitet->povrijedenih_osoba; ?>" />
	  						
	  						<label id="umrlih_osoba" for="umrlih_osoba">Umrlih osoba</label>
	  						<input name="umrlih_osoba" id="umrlih_osoba" type="number" value="<?php echo $entitet->umrlih_osoba; ?>" />
	  						
	  						<label id="opis" for="opis">Opis</label>
	  						<textarea rows="8" name="opis" id="opis" type="text"><?php echo $entitet->opis; ?></textarea>
  						</div>	
  						
  						<hr/ >
  							<div class="large-6 columns">
  								<fieldset class="fieldset">
  									<legend>društva</legend>
									<input id="uvjetDvd" type="text" placeholder="dio naziva društva" />
				  						<table>
											<thead>
												<tr>
													<th>Društvo</th>
													<th>Akcija</th>
												</tr>
										</thead>
											<tbody id="intervencijaDvd">
												<?php 
												$izraz=$veza->prepare("select a.intervencija, b.sifra, b.naziv from intervencija_dvd a 
																		inner join dvd b on a.dvd=b.sifra where a.intervencija= '$entitet->sifra' 
																		group by naziv");
												$izraz->execute();
												$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
												foreach ($rezultati as $dvd) :
														?>
														<tr>
															<td><?php echo $dvd->naziv ?></td>
															<td><i id="b_<?php echo $dvd->sifra; ?>" title="Brisanje" class="step fi-page-delete size-48 brisanjeDvd"></i></td>
														</tr>
														<?php endforeach; ?>
											</tbody>
									</table>
  								</fieldset>
  							</div>
  							
  							<div class="large-6 columns">
  								<fieldset class="fieldset">
  									<legend>vozila</legend>
  									<input id="uvjetVozilo" type="text" placeholder="dio naziva vozila" />
  									<table>
  										<thead>
											<tr>
												<th>Vrsta vozila</th>
												<th>Reg. oznaka</th>
												<th>Društvo</th>
												<th>Akcija</th>
											</tr>
										</thead
										<tbody id="intervencijaVozilo">
											<?php 
												$izraz=$veza->prepare("select d.vrsta_vozila, a.reg_oznaka, c.naziv from vozilo a inner join vozilo_intervencija b on a.sifra=b.vozilo
																		inner join dvd c on a.dvd=c.sifra
																		inner join kategorizacija_vozila d on a.vrsta=d.sifra
																		where b.intervencija='$entitet->sifra'
																		order by c.naziv");
												$izraz->execute();
												$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
												foreach ($rezultati as $vozilo) :
											?>
											<tr>
												<td><?php echo $vozilo->vrsta_vozila ?></td>
												<td><?php echo $vozilo->reg_oznaka ?></td>
												<td><?php echo $vozilo->naziv ?></td>
												<td>
													<i id="b_<?php echo $vozilo->sifra; ?>" title="Brisanje"class="step fi-page-delete size-48 brisanjeVozilo"></i>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
  								</fieldset>
  							</div>
  							<hr />
  							<div class="large-6 columns">
  								<fieldset class="fieldset">
  									<legend>članovi</legend>
  									<input id="uvjetClan" type="text" placeholder="dio naziva društva" />
  									<table>
  										<thead>
											<tr>
												<th>Ime i prezime</th>
												<th>Društvo</th>
												<th>Akcija</th>
											</tr>
										</thead
										<tbody id="intervencijaClan">
											<?php 
												$izraz=$veza->prepare("select a.sifra, concat(a.ime, ' ', a.prezime) as imePrezime, d.naziv 
																		from clan a inner join intervencija_clan b on a.sifra=b.clan 
																		left join dvd_clan c on a.sifra=c.clan 
																		left join dvd d on c.dvd=d.sifra 
																		where b.intervencija='$entitet->sifra'
																		group by imePrezime");
												$izraz->execute();
												$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
												foreach ($rezultati as $clan) :
											?>
											<tr>
												<td><?php echo $clan->imePrezime ?></td>
												<td><?php echo $clan->naziv ?></td>
												<td>
													<i id="b_<?php echo $clan->sifra; ?>" title="Brisanje"class="step fi-page-delete size-48 brisanjeClan"></i>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
  								</fieldset>
  							</div>
  							<div class="large-6 columns">
  								<fieldset class="fieldset">
  									<legend>sredstva za gašenje</legend>
  									<input id="uvjetSredstvo" type="text" placeholder="dio naziva sredstva" />
  									<table>
  										<thead>
											<tr>
												<th>Vrsta sredstva</th>
												<th>Količina</th>
												<th>Akcija</th>
											</tr>
										</thead
										<tbody id="intervencijaSredstvo">
											<?php 
												$izraz=$veza->prepare("select b.sifra, b.naziv_sredstva, a.kolicina_sredstava, b.jedinicna_mjera from sredstvo_intervencija a 
																		inner join sredstvo b on a.sredstvo=b.sifra where intervencija='$entitet->sifra'");
												$izraz->execute();
												$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
												foreach ($rezultati as $sredstvo) :
											?>
											<tr>
												<td><?php echo $sredstvo->naziv_sredstva ?></td>
												<td><?php echo $sredstvo->kolicina_sredstava?> <?php echo $sredstvo->jedinicna_mjera ?></td>
												<td>
													<span title="Promjena količine" id="n_<?php echo $sredstvo->sifra; ?>" class="promjenaSredstvo">
														<i id="b_<?php echo $sredstvo->sifra; ?>" class="step fi-page-edit size-72"></i>
													</span>
													
													<i id="b_<?php echo $sredstvo->sifra; ?>" title="Brisanje"class="step fi-page-delete size-48 brisanjeSredstvo"></i>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
  								</fieldset>
  							</div>
  							
  						</div>
								
						<div class="large-10 columns large-centered">		
	  						<input name="promjena" type="submit" class="button expanded" value="<?php 
								if($entitet->izvjesce_popunio==""){
									echo "Dodaj novi";
								}else{
									echo "Promjeni";
								}
								
								?>"/>
							<input type="hidden" name="sifra" value="<?php echo $entitet->sifra; ?>" />
							<input name="odustani" type="submit" class="alert button expanded" value="Odustani" />
						</div>
  					</fieldset>
  				</form>	
  				
  			</div>
  		</div>
    
		<?php include_once '../../predlosci/podnozje.php'; ?>
		<div class="reveal" id="revealSredstvo" data-reveal>
		  	<form method="POST">
		  		<p id="promjenaSredstvo"></p>
		  		<input name="promjenaSredstvo" id="promjenaSredstvo" type="number" value=""/>
			  	<a href="#" class="button">Promijeni</a>
				<button class="close-button" data-close aria-label="Close modal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
		  	</form>
		</div>
    	<?php include_once '../../predlosci/skripte.php'; ?>
    	<?php include_once 'intervecijeSkripte.php'; ?>
  	</body>
</html>
