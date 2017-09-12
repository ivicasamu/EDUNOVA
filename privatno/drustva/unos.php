<?php
include_once '../../konfiguracija.php'; 
provjeraLogin();

$izraz=$veza->prepare("insert into dvd (vzo, naziv, oib, mb, ulica, mjesto, telefon, mail, web, godina_osnivanja)
							values ('','','','','','','','','','')");
$izraz->execute();
$zadnji = $veza->lastInsertId();


header("location: promjena.php?sifra=" . $zadnji);

