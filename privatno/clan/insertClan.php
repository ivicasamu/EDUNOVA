<?php include_once '../../konfiguracija.php'; provjeraLogin();

for($i=0; $i<150;$i++){
	$izraz = $veza->query("insert into clan 
	(ime, prezime, oib, datum_rodenja, ulica, mjesto, datum_uclanjenja) 
	values('Ime ".$i."', 'Prezime ".$i."','12345654321','2000-10-10 00:00:00','Ulica ".$i."', 'Mjesto ".$i."', '2017-01-01 10:10:10')");
}

echo "GOTOVO";
