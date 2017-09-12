<?php
include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

$izraz=$veza->prepare("insert into kategorizacija_vozila (vrsta_vozila, podvrsta_vozila, podpodvrsta_vozila) values ('','','')");
$izraz->execute();
$zadnji = $veza->lastInsertId();


header("location: promjena.php?sifra=" . $zadnji);

