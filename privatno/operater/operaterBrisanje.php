<?php include_once '../../konfiguracija.php'; 
provjeraLogin(); 
provjeraUloga("admin");
if(isset($_GET["sifra"])){
	$izraz=$veza->prepare("delete from operater where sifra=:sifra");
	$izraz->execute(array("sifra"=>$_GET["sifra"]));
	$uvjet = "";
		if(isset($_GET["uvjet"])){
			$uvjet = $_GET["uvjet"];
		}
		header("location: operater.php?uvjet=" . $uvjet);
}
