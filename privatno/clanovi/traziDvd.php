<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["clan"])){
	$izraz=$veza->prepare("select sifra, naziv from dvd 
							where naziv like :uvjetDvd and sifra not in
							(select dvd from dvd_clan where clan=:clan)
							group by naziv limit 10");
	$izraz->execute(array("clan"=>$_GET["clan"],"uvjetDvd"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
}
