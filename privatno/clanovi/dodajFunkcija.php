<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["clan"]) && isset($_GET["funkcija"])){
	$izraz=$veza->prepare("insert into clan_funkcija(clan,funkcija) values (:clan,:funkcija)");
	$izraz->execute($_GET);
	echo "OK";
}