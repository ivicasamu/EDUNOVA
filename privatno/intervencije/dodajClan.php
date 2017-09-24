<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["clan"]) && isset($_GET["dvd"]) && isset($_GET["intervencija"])){
	$veza -> beginTransaction();
		$izraz=$veza->prepare("insert into dvd_clan(clan,dvd) values (:clan,:dvd)");
		$izraz->execute(array("clan"=>$_GET["clan"], "dvd"=>$_GET["dvd"]));
		$zadnji=$veza->lastInsertId();

		$izraz = $veza->prepare("insert into intervencija_dvd_clan(intervencija, dvd_clan) values (:intervencija,'" . $zadnji . "')");
		$izraz -> execute(array(
		"intervencija"=>$_GET["intervencija"]));
		$zadnji = $veza->lastInsertId();
	$veza->commit();
	
	echo "OK";
}