<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["clan"])){
	$izraz=$veza->prepare("select sifra, naziv_funkcije from funkcija 
							where naziv_funkcije like :uvjetFunkcija and sifra not in
							(select funkcija from clan_funkcija where clan=:clan)
							group by naziv_funkcije limit 10");
	$izraz->execute(array("clan"=>$_GET["clan"],"uvjetFunkcija"=>"%" . $_GET["term"] . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
}
