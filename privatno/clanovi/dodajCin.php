<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["clan"]) && isset($_GET["cin"])){
	$izraz=$veza->prepare("insert into clan_cin(clan,cin) values (:clan,:cin)");
	$izraz->execute($_GET);
	echo "OK";
}