<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["cin"]) && isset($_GET["clan"])){
	$izraz=$veza->prepare("delete from clan_cin where cin=:cin and clan=:clan");
	$izraz->execute($_GET);
	echo "OK";
}