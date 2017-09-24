<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["clan"]) && isset($_GET["funkcija"])){
	$izraz=$veza->prepare("delete from clan_funkcija where funkcija=:funkcija and clan=:clan");
	$izraz->execute($_GET);
	echo "OK";
}