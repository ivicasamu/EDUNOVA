<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["intervencija"])){
	$izraz=$veza->prepare("select sifra, naziv_sredstva from sredstvo 
							where naziv_sredstva like :uvjetSredstvo and sifra not in
							(select sredstvo from sredstvo_intervencija where intervencija=:intervencija)
							limit 10");
	$izraz->execute(array("intervencija"=>$_GET["intervencija"],"uvjetSredstvo"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
}
