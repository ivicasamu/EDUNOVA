<?php
include_once '../../konfiguracija.php'; 
provjeraLogin();
$izraz=$veza->prepare("insert into intervencija (vrsta_intervencije, datum_dojave, datum_zavrsetka, mjesto, opis, izvjesce_popunio) 
					values( 1,'', '', '', '', '');");
$izraz->execute();
$zadnji = $veza->lastInsertId();
header("location: promjena.php?sifra=" . $zadnji);