<?php  
include_once 'konfiguracija.php';
if(!isset($_POST["korisnik"]) || !isset($_POST["korisnik"])){
	header("location:".$putanjaAPP."index.php");
}

if($_POST["korisnik"]==="dvd" && $_POST["lozinka"]==="123" ){
	//logian si	
	$_SESSION["logiran"]=$_POST["korisnik"];
	header("location:".$putanjaAPP."privatno/nadzornaPloca.php");
}else{
	//nisi logiran
	header("location:".$putanjaAPP."javno/login.php?neuspio&korisnik=" .$_POST["korisnik"]);
}
?>