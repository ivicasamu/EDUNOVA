<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["intervencija"])){
	$izraz=$veza->prepare("select sifra, naziv from dvd 
							where naziv like :uvjetDvd and sifra not in
							(select a.dvd from dvd_clan a inner join intervencija_dvd_clan b on a.sifra=b.dvd_clan where b.intervencija=:intervencija)
							group by naziv limit 10");
	$izraz->execute(array("intervencija"=>$_GET["intervencija"],"uvjetDvd"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
}
