<?php  
function provjeraLogin(){
	if(!isset($_SESSION["logiran"])){
		header("location: " . $GLOBALS["putanjaAPP"] ."javno/prijava.php?nemateOvlasti");
		exit;
	}
}

function provjeraUloga($uloga){
	if(!(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga===$uloga)){
		header("location:" .$GLOBALS["putanjaAPP"] . "privatno/nadzornaPloca.php");
		exit;
	}
}

?>