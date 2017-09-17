<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["clan"])){
	$izraz=$veza->prepare("select a.sifra, c.naziv from clan a 
							inner join dvd_clan b on a.sifra=b.clan
							inner join dvd c on b.dvd=c.sifra 
							where c.naziv like :uvjetDvd limit 10;");
	$izraz->execute(array("clan"=>$_GET["clan"], "uvjet"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));

}
