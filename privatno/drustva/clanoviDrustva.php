<?php
	include_once '../../konfiguracija.php';
	provjeraLogin();
	if(isset($_GET["drustvo"])){
		$izraz = $veza->prepare("select concat (c.ime, ' ', c.prezime) as imePrezime, c.datum_rodenja
								from dvd a
								inner join dvd_clan b on a.sifra=b.dvd
								inner join clan c on c.sifra=b.clan
								where b.dvd=:drustvo");
		$izraz->execute(array("drustvo"=>$_GET["drustvo"]));
		$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
		foreach ($rezultati as $red) {
			echo "<li>". $red->imePrezime.", datum rođenja: ". date("m,d,Y",strtotime($red->datum_rodenja))."</li>";
		}
	}
