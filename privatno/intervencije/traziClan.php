<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["intervencija"])){
	$izraz=$veza->prepare("select a.sifra as sifraClan, c.sifra as sifraDvd, concat(a.ime, ' ', a.prezime) as imePrezime, c.naziv from clan a 
							inner join dvd_clan b on a.sifra=b.clan
							inner join dvd c on b.dvd=c.sifra
							where concat(ime, ' ', prezime) like :uvjetClan and a.sifra not in
							(select clan from dvd_clan a inner join intervencija_dvd_clan b on a.sifra=b.dvd_clan 
							where b.intervencija=:intervencija)
							limit 10");
	$izraz->execute(array("intervencija"=>$_GET["intervencija"],"uvjetClan"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
}
