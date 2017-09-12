<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["cin"]) && isset($_GET["clan"])){
	$izraz=$veza->prepare("delete from dvd_clan where dvd=:dvd and clan=:clan");
	$izraz->execute($_GET);
	echo "OK";
}