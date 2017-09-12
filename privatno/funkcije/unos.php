<?php
include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

$izraz=$veza->prepare("insert into funkcija (naziv_funkcije) values ('')");
$izraz->execute();
$zadnji = $veza->lastInsertId();


header("location: promjena.php?sifra=" . $zadnji);

