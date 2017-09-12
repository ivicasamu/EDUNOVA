<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["clan"])){
	$izraz=$veza->prepare("select distinct c.naziv_cina
							 from clan a inner join clan_cin b on a.sifra=b.clan
							 inner join cin c on c.sifra=b.cin 
							 where c.naziv_cina :uvjet");
	$izraz->execute(array("naziv_cina"=>$_GET["naziv_cina"], "uvjet"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));

}
