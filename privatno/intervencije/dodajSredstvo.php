<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["intervencija"]) && isset($_GET["sredstvo"]) && isset($_GET["sredstvo"])){
	$izraz=$veza->prepare("insert into sredstvo_intervencija(sredstvo,intervencija, kolicina_sredstava) values (:sredstvo,:intervencija, :kolicina)");
	$izraz->execute($_GET);
	echo "OK";
}