<?php
	include_once '../../konfiguracija.php';
	provjeraLogin();
	if(isset($_GET["intervencija"])){
		$izraz = $veza->prepare("select d.naziv from intervencija a 
								inner join intervencija_dvd_clan b on a.sifra=b.intervencija
								inner join dvd_clan c on b.dvd_clan=c.sifra
								inner join dvd d on c.dvd=d.sifra
								where b.intervencija=:intervencija
								group by d.naziv");
		$izraz->execute(array("intervencija"=>$_GET["intervencija"]));
		$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
		if(empty($rezultati)){
			echo "Na intervenciji nije bilo sudionika";
		}else{
			foreach ($rezultati as $red) {
				echo "<li>". $red->naziv."	</li>";
			}
		}
		
	}