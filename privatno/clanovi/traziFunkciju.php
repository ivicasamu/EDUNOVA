<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["grupa"])){
	$izraz=$veza->prepare("select c.sifra, c.naziv
						 from clan a inner join dvd_clan b on a.sifra=b.clan
						 inner join dvd c on c.sifra=b.dvd where a.sifra= :uvjet");
	$izraz->execute(array("naziv_cina"=>$_GET["naziv_cina"], "uvjet"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));

}
