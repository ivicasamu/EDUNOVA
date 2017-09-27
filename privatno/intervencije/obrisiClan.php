<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["intervencija"]) && isset($_GET["clan"])){
	$izraz=$veza->prepare("delete from intervencija_clan where intervencija=:intervencija and clan=:clan");
	$izraz->execute($_GET);
	echo "OK";
}