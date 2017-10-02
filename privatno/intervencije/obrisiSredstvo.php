<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["intervencija"]) && isset($_GET["sredstvo"])){
	$izraz=$veza->prepare("delete from sredstvo_intervencija where sredstvo=:sredstvo and intervencija=:intervencija");
	$izraz->execute($_GET);
	echo "OK";
}