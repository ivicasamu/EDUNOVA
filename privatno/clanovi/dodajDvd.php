<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["clan"]) && isset($_GET["dvd"])){
	$izraz=$veza->prepare("insert into dvd_clan(clan,dvd) values (:clan,:dvd)");
	$izraz->execute($_GET);
	echo "OK";
}