<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
	<a class="navbar-brand" href="<?php echo $putanjaAPP; ?>index.php"><?php echo $naslovAPP; ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<?php if(isset($_SESSION["logiran"])): ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $putanjaAPP; ?>privatno/nadzornaPloca.php">NADZORNA PLOČA</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" 
						aria-expanded="false">MODULI</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="#">DRUŠTVO</a>
						<a class="dropdown-item" href="#">ČLANOVI</a>
						<a class="dropdown-item" href="#">VOZILA</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">INTERVENCIJE</a>
				</li>
				<?php if(isset($_SESSION["logiran"])  && $_SESSION["logiran"]->uloga==="admin"): ?>
					<li class="nav-item">
						<a class="nav-link" href="#">OPERATERI</a>
					</li>
				<?php endif; ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" 
						aria-expanded="false">LINKOVI</a>
					<div class="dropdown-menu" aria-labelledby="dropdown02">
						<a class="dropdown-item" href="#">GITHUB KOD</a>
						<a class="dropdown-item" href="#">ERA DIAGRAM</a>
					</div>
				</li>
			<?php endif; ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $putanjaAPP; ?>javno/kontakt.php">KONTAKT</a>
			</li>
			<?php if(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga==="korisnik"): ?>
				<li class="nav-item">
					<a class="nav-link" href="#">PROFIL OPERATERA</a>
				</li>
			<?php endif; ?>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<?php if(!isset($_SESSION["logiran"])): ?>
				<a href="<?php echo $putanjaAPP; ?>javno/prijava.php" class="btn btn-secondary btn-sm" role="button" aria-pressed="true">PRIJAVA</a>
			<?php else: ?>
				<a href="<?php echo $putanjaAPP; ?>javno/odjava.php" class="btn btn-danger btn-sm" role="button" aria-pressed="true">
					ODJAVA <?php echo $_SESSION["logiran"]->ime. " " .$_SESSION["logiran"]->prezime; ?></a>
			<?php endif; ?>	
		</form>
	</div>
</nav>