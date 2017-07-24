<?php 
	include_once '../../konfiguracija.php'; 
	provjeraLogin();
	if(isset($_GET["sifra"])){
		$izraz = $veza->prepare("delete from intervencija where sifra=:sifra ");
		$izraz->execute(array("sifra"=>$_GET["sifra"]));
		$uvjet = "";
		if(isset($_GET["uvjet"])){
			$uvjet = $_GET["uvjet"];
		}
		header("location: intervencije.php?uvjet=" . $uvjet);
	}
?>
