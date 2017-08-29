<?php include_once '../konfiguracija.php' ?>
<?php
	if (isset($_SESSION["logiran"])) {
		header("location:" . $GLOBALS["putanjaAPP"] . "privatno/nadzornaPloca.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once '../predlosci/zaglavlje.php'
		?>
	</head>

	<body>
		<?php include_once '../predlosci/izbornik.php'
		?>
		<div class="container">
			<div class="starter-template">
				<div class="row">
					<h1 class="form-signin-heading">Prijava u aplikaciju</h1>
					<?php
					if (isset($_GET["neuspio"])) {
						echo "Nepostojeći korisnik ili neispravna kombinacija korisnika i lozinke";
					}

					if (isset($_GET["nemateOvlasti"])) {
						echo "Morate se prvo prijaviti u aplikaciju!";
					}

					if (isset($_GET["odlogiranSi"])) {
						echo "Uspiješno ste se odjavili iz aplikacije!";
					}

					if (isset($_GET["registracijaUspjesna"])) {
						echo "Uspješno ste se registirali!";
					}
					?>
					<form method="post" class="form-signin" action="<?php echo $putanjaAPP; ?>autorizacija.php">
						<label for="korisnik" class="sr-only">E-mail</label>
						<input type="text" name="korisnik" id="korisnik" class="form-control" 
							value="<?php echo isset($_GET["korisnik"]) ? $_GET["korisnik"] : ""; ?>" placeholder="E-mail">
						<label for="lozinka" class="sr-only">Lozinka</label>
						<input type="password" name="lozinka" id="lozinka" class="form-control" placeholder="lozinka">
						<button class="btn btn-lg btn-primary btn-block" type="submit">
							PRIJAVA
						</button>
						<a href="<?php echo $putanjaAPP ?>privatno/operater/operaterUnos.php">Registracija korisnika</a>
					</form>
					
				</div>
			</div>
		</div>
		<?php include_once '../predlosci/podnozje.php'
		?>
		<?php
			include_once '../predlosci/skripte.php';
		?>
	</body>
</html>
