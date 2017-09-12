<?php

include_once '../../konfiguracija.php'; provjeraLogin();


$izraz=$veza->prepare("insert into clan (ime, prezime, oib, datum_rodenja, ulica, mjesto, datum_uclanjenja) values('', '', '', '', '', '', '');");
$izraz->execute();
$zadnji = $veza->lastInsertId();


header("location: promjena.php?sifra=" . $zadnji);

