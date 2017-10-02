<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["intervencija"]) && isset($_GET["sredstvo"])){
	$izraz=$veza->prepare("insert into sredstvo_intervencija(sredstvo,intervencija) values (:sredstvo,:intervencija)");
	$izraz->execute($_GET);
	echo "OK";
}