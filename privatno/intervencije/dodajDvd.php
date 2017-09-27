<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["intervencija"]) && isset($_GET["dvd"])){
	$izraz=$veza->prepare("insert into intervencija_dvd(intervencija,dvd) values (:intervencija,:dvd)");
	$izraz->execute($_GET);
	echo "OK";
}