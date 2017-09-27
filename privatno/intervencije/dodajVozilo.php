<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["intervencija"]) && isset($_GET["vozilo"])){
	$izraz=$veza->prepare("insert into vozilo_intervencija(vozilo, intervencija) values (:vozilo, :intervencija)");
	$izraz->execute($_GET);
	echo "OK";
}