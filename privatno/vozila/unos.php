<?php
include_once '../../konfiguracija.php'; 
provjeraLogin();

$izraz=$veza->prepare("insert into vozilo (dvd, vrsta, reg_oznaka, proizvodac, model, godina_proizvodnje)
							values (1,1,'','','','')");
$izraz->execute();
$zadnji = $veza->lastInsertId();


header("location: promjena.php?sifra=" . $zadnji);

