<?php
include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

$izraz=$veza->prepare("insert into cin (naziv_cina) values ('')");
$izraz->execute();
$zadnji = $veza->lastInsertId();


header("location: promjena.php?sifra=" . $zadnji);

