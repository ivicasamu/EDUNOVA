<?php
include_once '../../konfiguracija.php'; 
provjeraLogin();
provjeraUloga("Administrator");

$izraz=$veza->prepare("insert into sredstvo(naziv_sredstva, jedinicna_mjera) values ('','')");
$izraz->execute();
$zadnji = $veza->lastInsertId();


header("location: promjena.php?sifra=" . $zadnji);

