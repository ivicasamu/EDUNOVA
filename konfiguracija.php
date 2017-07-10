<?php 
session_start();

include_once 'funkcije.php';

$naslovAplikacije = "Dobrovoljno vatrogasno društvo";

switch ($_SERVER["HTTP_HOST"]) {
	case 'localhost':
		$putanjaAPP="/dz5/";
		$mysqlHost="localhost";
		$mysqlBaza="vatrogasci";
		$mysqlKorisnik="dvd";
		$mysqlLozinka="123";
		break;
	case 'ivicasamu.byethost31.com':
		$putanjaAPP="/dz05/";
		$mysqlHost="sql208.byethost31.com";
		$mysqlBaza="b31_20115711_vatrogasci";
		$mysqlKorisnik="b31_20115711";
		$mysqlLozinka="PLjw6udVpomb.26R";
		break;
	case '185.114.38.183':
		$putanjaAPP="/";
		$mysqlHost="localhost";
		$mysqlBaza="vatrogasci";
		$mysqlKorisnik="root";
		$mysqlLozinka="root";
		break;
	default:
		$putanjaAPP="/";
		break;
}

try {
	$con = new PDO("mysql:host=". $mysqlHost.";dbname=".$mysqlBaza, $mysqlKorisnik, $mysqlLozinka);
	$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$con -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$con -> exec("SET CHARACTER SET utf8");
	$con -> exec("SET NAMES utf8");
} catch(PDOException $e) {
	switch($e->getCode()) {
		case 2002 :
			echo "Ne mogu se spojiti na MySQL server";
			break;
		case 1049 :
			echo "Na MySQL serveru ne postoji baza s danim imenom";
			break;
		case 1045 :
			echo "Na MySQL serveru ne postoji kombinacija danog korisničkog imena i lozinke";
			break;
		default :
			print_r($e);
			break;
	}
	exit ;
}