<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["intervencija"]) && isset($_GET["dvd"])){
	$izraz=$veza->prepare("delete from intervencija_dvd where intervencija=:intervencija and dvd=:dvd");
	$izraz->execute($_GET);
	echo "OK";
}