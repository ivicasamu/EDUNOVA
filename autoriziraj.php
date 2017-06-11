<?php 
if($_POST["korisnik"]=="edunova" && $_POST["lozinka"]=="e"){
	//logiran si
	session_start();
	$_SESSION["logiran"]=$_POST["korisnik"];
	header("location: privatno/nadzornaPloca.php");
}else{
	//nisi logiran
	header("location:login.php?neuspio&korisnik=".$_POST["korisnik"]);
}
?>