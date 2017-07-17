<?php include_once '../konfiguracija.php';

session_destroy();
header("location: " . $putanjaAPP ."javno/prijava.php?odlogiranSi");