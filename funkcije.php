<?php  
function provjeraLogin(){
	if(!isset($_SESSION["logiran"])){
		header("location: " . $putanjaAPP ."javno/login?nemateOvlasti");
		exit;
	}
}

?>