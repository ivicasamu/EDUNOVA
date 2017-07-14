<?php  
include_once 'konfiguracija.php';
if(!isset($_POST["korisnik"]) || !isset($_POST["korisnik"])){
	header("location: " . $putanjAPP ."index.php");
}

if($_POST["korisnik"]==="dvd" && $_POST["lozinka"]==='123'){
	$_SESSION["logiran"]=$_POST["korisnik"];
	header("location: ". $putanjaAPP ."privatno/nadzornaPloca.php");
}else{
	header("location: ".putanjaAPP ."javno/prijava.php?neuspio&korisnik=". $_POST["korisnik"]);
}

?>