<?php include_once '../../konfiguracija.php'; provjeraLogin();

for($i=0; $i<154;$i++){
	$izraz = $veza->query("insert into intervencija (vrsta_intervencije, podvrsta_intervencije, datum_nastanka, datum_dojave, datum_dolaska, 
		datum_zavrsetka, mjesto, ulica, dojava, utrosena_sredstva, opis, izvjesce_popunio) values('Požarna intervencija', 'Požar dimnjaka','2017-01-01 10:10:10',
		'2017-01-01 10:10:10', '2017-01-01 10:10:10','2017-01-01 10:10:10','Testiranje','Testiranje $i','Požar','Voda 1m3','Požar dimnjaka',
		'Đuro Šarićž')");
}

for($i=0; $i<78;$i++){
	$izraz = $veza->query("insert into intervencija (vrsta_intervencije, podvrsta_intervencije, datum_nastanka, datum_dojave, datum_dolaska, 
		datum_zavrsetka, mjesto, ulica, dojava, utrosena_sredstva, opis, izvjesce_popunio) values('Tehnička intervencija', 'Nezgode u prometu','2017-01-01 10:10:10',
		'2017-01-01 10:10:10', '2017-01-01 10:10:10','2017-01-01 10:10:10','Testiranje','Testiranje $i','Prometna','Voda 1m3','Prometna nesreća',
		'Đuro Šarićž')");
}

for($i=0; $i<13;$i++){
	$izraz = $veza->query("insert into intervencija (vrsta_intervencije, podvrsta_intervencije, datum_nastanka, datum_dojave, datum_dolaska, 
		datum_zavrsetka, mjesto, ulica, dojava, utrosena_sredstva, opis, izvjesce_popunio) values('Ostale intervencije', 'Ostale tehničke intervencije','2017-01-01 10:10:10',
		'2017-01-01 10:10:10', '2017-01-01 10:10:10','2017-01-01 10:10:10','Testiranje','Testiranje $i','Prometna','Voda 1m3','Prometna nesreća',
		'Đuro Šarićž')");
}

echo "GOTOVO";
