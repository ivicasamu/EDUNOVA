<?php
	include_once '../../konfiguracija.php';
	provjeraLogin();
	if(isset($_GET["intervencija"]) && isset($_GET["sredstvo"])){
		$izraz = $veza->prepare("select kolicina_sredstava from sredstvo_intervencija where intervencija=:intervencija and sredstvo=:sredstvo");
		$izraz->execute($_GET);
		$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
			echo json_encode($rezultati);
	}
