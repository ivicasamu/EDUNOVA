<?php  
include_once 'konfiguracija.php';
if(!isset($_POST["korisnik"]) || !isset($_POST["korisnik"])){
	header("location: " . $putanjAPP ."index.php");
}

$izraz=$veza->prepare("select * from operater where email=:email and lozinka=md5(:lozinka)");
$izraz->execute(array("email"=>$_POST["korisnik"], "lozinka" =>$_POST["lozinka"]));
$operater = $izraz->fetch(PDO::FETCH_OBJ);
print_r($operater);

if($operater!=null){
	$_SESSION["logiran"] = $operater;
	header("location: " . $putanjaAPP . "privatno/nadzornaPloca.php");
}else{
	header("location: " . $putanjaApp . "javno/prijava.php?neuspio&korisnik=" . $_POST["korisnik"]);
}

?>