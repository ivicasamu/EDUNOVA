<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["intervencija"]) && isset($_GET["clan"])){
	$izraz=$veza->prepare("insert into intervencija_clan(intervencija,clan) values (:intervencija,:clan)");
	$izraz->execute($_GET);
	echo "OK";
}