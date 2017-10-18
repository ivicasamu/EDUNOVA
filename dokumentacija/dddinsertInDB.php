<?php include_once '../konfiguracija.php';
provjeraLogin();
$veza->beginTransaction();
for($i=0; $i<4;$i++){
	for($j=0; $j<50; $j++){
	$izraz = $veza->query("insert into intervencija (vrsta_intervencije, datum_dojave, datum_zavrsetka, mjesto, opis, izvjesce_popunio) 
							values($i+1, '2017-01-01 10:10:10','2017-01-01 11:11:11','Testiranje','Testiranje','Đuro Šarićž')");
	}
}
echo "GOTOV INSERT INTERVENCIJA";
?>

<hr />

<?php  
for($i=1; $i<3;$i++){
	for($j=0; $j<50; $j++){
	$izraz = $veza->query("insert into sredstvo_intervencija (sredstvo, intervencija) 
							values($i, $j+1)");
	}
}
echo "GOTOV INSERT SREDSTVO_INTERVENCIJA";
?>

<hr />

<?php
for($i=0; $i<150;$i++){
	$izraz = $veza->query("insert into clan (ime, prezime, oib, datum_rodenja, ulica, mjesto, datum_uclanjenja ) 
							values('Ime $i','Prezime $i', '12345678909','1990-10-01','Osijek','Glavna $i','2009-10-01')");
}  
echo "GOTOV INSERT ČLANOVA";
?>

<hr />

<?php  
for($i=0; $i<25;$i++){
	$izraz = $veza->query("insert into cin (naziv_cina)
							values('Čin $i')");
	
}
echo "GOTOV INSERT ČINOVA";
?>

<hr />

<?php  
for($i=0; $i<25;$i++){
	for($j=((($i+1)*6)-6); $j<(($i+1)*6); $j++){
	$izraz = $veza->query("insert into clan_cin (clan, cin) 
							values($j+1, $i+1)");
	}
}
echo "GOTOV INSERT CLAN_CIN";
?>

<hr />

<?php  
for($i=0; $i<25;$i++){
	$izraz = $veza->query("insert into funkcija (naziv_funkcije)
							values('Funkcija $i')");
	
}
echo "GOTOVO INSERT FUNKCIJA";

?>

<hr />

<?php  

for($i=0; $i<25;$i++){
	for($j=((($i+1)*6)-6); $j<(($i+1)*6); $j++){
	$izraz = $veza->query("insert into clan_funkcija (clan, funkcija) 
							values($j+1, $i+1)");
	}
}
echo "GOTOVO INSERT ČLAN_FUNKCIJA";

?>

<hr />

<?php  

for($i=0; $i<10;$i++){
	$izraz = $veza->query("insert into dvd (vzo, naziv, oib, mb, ulica, mjesto)
							values('VZO $i','DVD $i','12345654321','1234321','Sporedna $i', 'Naselje $i')");
}
echo "GOTOV INSERT DVD";
?>

<hr />

<?php  

for($i=0; $i<10;$i++){
	for($j=((($i+1)*15)-15); $j<(($i+1)*15); $j++){
	$izraz = $veza->query("insert into dvd_clan (dvd, clan) 
							values($i+1, $j+1)");
	}
}
echo "GOTOVO INSERT DVD_CLAN";

?>

<hr />

<?php  

for($i=0; $i<30;$i++){
	for($j=((($i+1)*5)-5); $j<(($i+1)*5); $j++){
	$izraz = $veza->query("insert into intervencija_dvd_clan (intervencija, dvd_clan) 
							values($i+1, $j+1)");
	}
}
echo "GOTOVO INSERT INTERVENCIJA_DVD_CLAN";

?>

<hr />

<?php  

for($i=0; $i<10;$i++){
	for($j=0; $j<4; $j++){
	$izraz = $veza->query("insert into vozilo (dvd, vrsta, reg_oznaka, proizvodac, model, godina_proizvodnje) 
							values($i+1, $j+1, 'OS-123-AB','MAN', 'MAN', '2000-01-01')");
	}
}
echo "GOTOVO INSERT VOZILA";

?>

<hr />

<?php  

for($i=0; $i<40;$i++){
	for($j=((($i+1)*4)-4); $j<(($i+1)*4); $j++){
	$izraz = $veza->query("insert into vozilo_intervencija (vozilo, intervencija) 
							values($i+1, $j+1)");
	}
}
echo "GOTOVO INSERT VOZILO_INTERVENCIJA";

?>

<?php  
$veza->commit();
?>