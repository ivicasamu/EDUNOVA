<?php include_once '../../konfiguracija.php'; ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
		<?php include_once '../../predlosci/head.php'; ?>
  </head>
  <body>
  		<?php include_once'../../predlosci/izbornik.php'; ?>
  		<div class="row">
  			<?php  
  			$komanda = $con->query("select * from clan");
			$komanda->execute();
			$rezultati = $komanda->fetchALL(PDO::FETCH_OBJ);
			
			foreach ($rezultati as $red) {
				echo $red->ime. "<br />";
			}
			
  			?>
  		</div>
  		<?php include_once '../../predlosci/podnozje.php' ?>
		<?php include_once '../../predlosci/skripte.php'; ?>
  </body>
</html>
