<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["intervencija"]) && isset($_GET["vozilo"])){
	$izraz=$veza->prepare("delete from vozilo_intervencija where vozilo=:vozilo and intervencija=:intervencija");
	$izraz->execute($_GET);
	echo "OK";
}