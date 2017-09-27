<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["intervencija"])){
	$izraz=$veza->prepare("select a.sifra, concat(a.ime,' ',a.prezime) as imePrezime, c.naziv from clan a 
							left join dvd_clan b on a.sifra=b.clan 
							left join dvd c on b.dvd=c.sifra 
							where concat(a.ime,' ',a.prezime) like :uvjetClan and a.sifra not in 
							(select clan from intervencija_clan where intervencija=:intervencija)
							limit 10");
	$izraz->execute(array("intervencija"=>$_GET["intervencija"],"uvjetClan"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
}
