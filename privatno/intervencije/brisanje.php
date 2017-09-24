<?php 
	include_once '../../konfiguracija.php'; 
	provjeraLogin();
	provjeraUloga("Administrator");

		$izraz = $veza -> prepare("delete from intervencija where sifra=:sifra");
		$izraz -> execute(array("sifra"=>$_GET["sifra"]));
		header("location: index.php?stranica=".$_GET["stranica"]."&uvjet=".$_GET["uvjet"]);

