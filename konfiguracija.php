<?php 
session_start();

$naslovAplikacije = "Dobrovoljno vatrogasno društvo";

switch ($_SERVER["HTTP_HOST"]) {
	case 'localhost':
		$putanjaAPP="/dz5/";
		break;
	case 'ivicasamu.byethost31.com':
		$putanjaAPP="/dz05/";
		break;
	default:
		$putanjaAPP="/";
		break;
}

?>