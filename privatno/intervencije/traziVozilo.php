<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["intervencija"])){
	$izraz=$veza->prepare("select a.sifra, d.vrsta_vozila, a.reg_oznaka, c.naziv from vozilo a left join vozilo_intervencija b on a.sifra=b.vozilo
							left join dvd c on a.dvd=c.sifra
							left join kategorizacija_vozila d on a.vrsta=d.sifra
							where concat(d.vrsta_vozila, ' ', a.reg_oznaka, ' ', c.naziv) like :uvjetVozilo and a.sifra not in
							(select vozilo from vozilo_intervencija where intervencija=:intervencija)
							order by c.naziv limit 10");
	$izraz->execute(array("intervencija"=>$_GET["intervencija"],"uvjetVozilo"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
}
