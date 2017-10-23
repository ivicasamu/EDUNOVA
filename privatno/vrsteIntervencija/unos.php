<?php
include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

$izraz=$veza->prepare("insert into vrsta_intervencije (vrsta_intervencije, podvrsta_intervencije, podpodvrsta_intervencije)
							values ('','','')");
$izraz->execute();
$zadnji = $veza->lastInsertId();


header("location: promjena.php?sifra=" . $zadnji);

