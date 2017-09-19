<?php 
include_once '../../konfiguracija.php'; 
provjeraLogin(); 

if(isset($_GET["clan"])){
	$izraz=$veza->prepare("select sifra, naziv_cina from cin
							where naziv_cina like :uvjetCin and sifra not in
							(select cin from clan_cin where clan=:clan)
							group by naziv_cina limit 10");
	$izraz->execute(array("clan"=>$_GET["clan"],"uvjetCin"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
}
